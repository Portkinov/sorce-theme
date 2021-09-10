<?php
namespace sorce\admin;
use sorce\Theme as Theme;
/* 

    Contact Forms 7 Integration Middleware class

    - Dynamic select categories
     *
     * @usage [select name taxonomy:{$taxonomy} ...]
     * 
     * @param Array $tag
     * 
     * @return Array $tag
 */


class Forms extends Theme  {

    public static function run(){

        #check for an audio or video upload before any submissions - this inserts other filters
        \add_action('wpcf7_acceptance', array(get_class(), 'pre_audio_video_check'));
       
        #dynamically populate categories
        \add_filter( 'wpcf7_contact_form_properties', array(get_class(), 'dynamic_inject_categories')); 
        
        #run with nonce - necessary for get user check sto work
        \add_filter( 'wpcf7_verify_nonce', '__return_true' );

    }




    /*
     * pre_audio_video_check 
     * This function provides the initial, pre-submission security & error checking 
     * And short-circuits the form submission if an Audio or Video upload is attempted
     * by a non-coach account
    */

    public static function pre_audio_video_check( $accepted ){
        error_log('pre_audio firing');
        if( (isset($_POST['filetyperadio']) && 
            (   $_POST['filetyperadio'] == 'Audio') || 
                $_POST['filetyperadio'] == 'Video') ){
            #Only coaches can perform this operation
            $loggedin = \is_user_logged_in();

            if( $loggedin ) {
                $user = \wp_get_current_user();
                $roles = ( array ) $user->roles;
                error_log('ROLES');
                error_log(print_r($roles,true));
                if(in_array('coaches', $roles)){

                    #avoid core file missing error
                    require_once( ABSPATH . '/wp-admin/includes/media.php' );

                    #hook a submission interception for Audio / Video uploads only
                    \add_action( 'wpcf7_before_send_mail', array(get_class(), 'intercept_cf7_submission'),99,3);

                    #continue CF7 events
                    return true;

                } else {
                    self::short_circuit_submission_false("Only coaches can perform this operation");
                    $accepted = 0;
                    return $accepted;
                }
                
            } else { 
                self::short_circuit_submission_false("You must be logged in to perform this operation");
                $accepted = 0;
                return $accepted;
            }
            
            
        }
        #only divert post requests with 'filetyperadio' set - all others validate normally
        return $accepted;
    }

    /*
     * intercept_cf7_submission
     * This function checks the integrity of audio / video files and then creates
     * the appropriate post based on the form data
    */
    public static function intercept_cf7_submission( $contact_form, &$abort, $submission ) {
        $abort = true;
        #Required fields have already been validated on front end

        #Get RMP
        $RMP = $submission->get_posted_data('upload-rmp');
        #Get Categories
        $cats = $submission->get_posted_data('category');
        #Get type of upload
        $filetype = $submission->get_posted_data('filetyperadio')[0];

        $description = $submission->get_posted_data('upload-description');

        $title = $submission->get_posted_data('upload-title');

        #required fields
        if($RMP && $filetype){
            error_log('SUBMISSION');
            $uploadedfiles = $submission->uploaded_files();
            switch ($filetype) {

                case "Audio" :
                    if(isset($uploadedfiles['audio']) && !empty($uploadedfiles['audio'])){

                        $filename = $uploadedfiles['audio'][0];
                        #do new audio post
                        $post = self::createAudioVideoPost('audio', $RMP, $cats, $filename, $description, $title );
                        error_log(print_r($post,true));
                        if($post){
                            self::short_circuit_submission_true( "New Audio post created!" );
                        } else {
                            self::short_circuit_submission_false( "Could not create new Audio post");
                        }
                    
                    } else {
                    
                        self::short_circuit_submission_false("Could not create Audio post");
                    }
                    break;

                case "Video" :
                    if(isset($uploadedfiles['video']) && !empty($uploadedfiles['video'])){

                        $filename = $uploadedfiles['video'][0];
                        #do new video post
                        $post = self::createAudioVideoPost('video', $RMP, $cats, $filename, $description, $title );

                        if($post){
                            self::short_circuit_submission_true( "New Video post created!" );
                        } else {
                            self::short_circuit_submission_false( "Could not create new Video post");
                        }
                    
                    } else {
                    
                        self::short_circuit_submission_false("Could not create Video post");
                    }
                    break;

                default : 
                self::short_circuit_submission_false("Strange. Upload type must be audio or video");
                    break; 
            }

        } else {
            self::short_circuit_submission_false("Required fields are missing or invalid");
            return false;
        }   

    }

    /* High Level Utility Functions */
    private static function createAudioVideoPost($type, $RMP, $cats, $filename, $description, $title ){

        $array_of_category_ids = self::category_names_to_id( $cats );

        #whatever I need to do to filename
        $awslink = self::getAWSLink($filename);
        
        $postid = self::createAudioVideo($type, $RMP, $array_of_category_ids, $description, $title); 
        $metafield = 'crb_' . strtolower($type);

        if($postid){
            #Success
            
            $check = \carbon_set_post_meta( $postid, $metafield, $awslink );
            #Feels gross but this is how Carbonfields sets it
            if(!$check) {
                $_POST[$metafield] = $awslink;
                $check = true;
            }
            if($check){
                $post_object = \get_post($postid);
                error_log(print_r($post_object, true));
                #now with meta fields attached we can save post and run trigger hooks
                \do_action( 'save_post', $postid, $post_object, true );
                
                return true;
            }
        }
        return false;   
    }
    
    private static function createAudioVideo( $post_type, $RMP, $array_of_category_ids, $description, $title ){
        
        $taxonomy_input = array(
            'RMP' => $RMP,
        );

        $post_fields = array(
            'post_content'  => $description,
            'post_content_filtered' => \apply_filters( 'the_content', $description ),
            'post_title'    => $title,
            'post_status'   => 'publish',
            'post_type'     => $post_type,
            'comment_status' => 'closed',
            'ping_status'   => 'closed',
            'post_category' => $array_of_category_ids,
            # 'tags_input'    => $array_of_tag_slugs,
            'tax_input'     => $taxonomy_input,
        );

        error_log(print_r($post_fields, true));

        #Insert the post
        return \wp_insert_post( $post_fields, true, false );
        
    }


    /* Utility Functions */
    private static function getAWSLink( $link = ''){
        error_log('Got to getAWSLink');
        $aws_base = 'https://sorce-wordpress-content.s3.amazonaws.com';
        $folder_array = explode('/', $link);
        $startindex = array_search('wp_content', $folder_array, true);
        $path_array = array_slice($folder_array, $startindex);
        $path = (is_array($path_array) && !empty($path_array)) ? implode('/', $path_array) : false;
        $awslink = $path ? $aws_base . $path : false;

        return $awslink;
    }

    private static function category_names_to_id( $namearray = array() ){
        error_log('firing category names to id');
        $idarray = array();
        if(!empty($namearray)){
            foreach($namearray as $name){
                $term = \get_term_by( 'name', $name, 'category');
                if($term) array_push($idarray, $term->term_id );
                
            }
        }
        return $idarray;
    }

    private static function short_circuit_submission_true( $message ){
        $response = json_encode( array(
            'into' => false, 
            'status' => 'Success', 
            'message' => $message,
            'posted_data_hash' => 0
            ) 
        );
        echo $response;
        die();

    }
    private static function short_circuit_submission_false ($message){
        $response = json_encode( array(
            'into' => false, 
            'status' => 
            'aborted', 
            'message' => $message,
            'posted_data_hash' => 0
            ) 
        );
        echo $response;
        die();
    }

    public static function dynamic_inject_categories( $form ){
        $markdown = $form['form'];

        if(strpos($markdown, '[checkbox category ]') !== false){
            #Dynamic Insertion
            $replacement_code = '[checkbox category ';
            $args = array(
                'hide_empty'      => false,
            );
            $terms = \get_categories( $args ); 
            foreach( $terms as $term ) {
                $replacement_code.= '"' . $term->name . '" ';
            }
            $replacement_code.= ']';
            $form['form'] = str_replace('[checkbox category ]', $replacement_code, $markdown);
        }
        return $form;
    }

};

\sorce\admin\Forms::run();