<?php
namespace friendlyrobot\core\mvc;



//spin it up
#\nv_dailyvibe\theme\Template::get_instance();

class Model {

    public function __construct( $args, $id = null) {//accepts array of keys types and gets CarbonFields Content
        $this->id = $id;
        $this->args = $args;
        $this->data_array = self::model_get_fields($this->id, $args);

    }
    private static function model_get_fields( $id, $args ) {
        $return_array = array();
        if(is_array($args)){
            foreach($args as $key => $type){
                $value = self::return_field_data($id, $key, $type);
                $return_array[$key] = $value;
            }
        }

        return $return_array;
    }
    private static function return_field_data($id, $key, $type){
        switch ($type) {
            case "image":
                #get attachment ID
                $img = \carbon_get_post_meta( $id, $key ); 
                $img_src = \wp_get_attachment_image_src( $img, 'large', false );

                return (is_array($img_src)) ? $img_src[0] : false;
            break;
            case "bullets":
                $bullet_array = \carbon_get_post_meta( $id, $key);
                $return_array = array();
                if(is_array($bullet_array)){
                    foreach($bullet_array as $this_bullet){
                        array_push($return_array, $this_bullet['bullet']);
                    }
                }
                return $return_array;
            break;
            case "rich_text":
                return \apply_filters( 'the_content', \carbon_get_post_meta($id, $key) );
            break;
            case "conditional": 
                #NOTE CONDITIONALS MUST BE UNIQUELY NAMED AND TRUE MUST EQUAL "yes" TO WORK
                $value = \carbon_get_post_meta( $id, $key);

                \update_option($key, $value );

                break;
                
            default:
                return \carbon_get_post_meta( $id, $key );
        }
    }    
}