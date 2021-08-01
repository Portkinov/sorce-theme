<?php 
namespace friendlyrobot\components;
use \friendlyrobot\Theme as Theme;

class Carousel {

    public $html;
    protected $slides;
    public static $id = 'bsCarousel';

    /*
     * This Class Renders a Bootstrap Carousel By Feeding the Contructor an $args array
     * $type: (String) accepts 'theme_mod' and 'post_type' 
     * $args: (Array) for 'theme_mod' Carousel, include a one-dimensional array of top-level
     * Image slugs in the wp_customizer. 'first_slide' etc.
     * 
     * $args: (Array) for 'post_type' include the $args for the get_post() call for your post
     * type. The image is the Featured Image and the meta information is postmeta that follows
     * the same naming convention of the wp_customizer (see code.)
     */

    public function __construct( $type = 'theme_mod', $args = array() ){
        $this->type = $type;
        $this->slides = (!isset($args['slides'])) ? $this->getSlides( $type, $args ) : $args['slides'];
        $this->html = $this->getHTML( $this->slides );
        
    }
    public function render(){ echo $this->html; }
    private function getHTML( $slides ){
        $do_arrows = \get_option('show_slide_arrows');
        $html = '<div id="'.self::$id.'" class="carousel slide carousel-fade" data-ride="carousel">';
        $html.= self::returnIndicators($slides);
        $html.= self::returnItems($slides);
        if($do_arrows) $html.= self::returnArrows();
        $html.= '</div>';
        return $html;
    }
    private function getSlides( $type, $args ){
        if($type == 'theme_mod'){
            //the args will be a list of slide img theme mod slugs
            $slides = array();
            foreach($args as $arg){
                $slide = self::returnSlideThemeMod( $arg );
                if($slide) array_push($slides, $slide);
            }
            return $slides;
        } else if($type == 'post_type'){
            $slides = self::returnSlidesPostType($args);
            return $slides;
        } else { return false;}
    }

    private function returnSlideThemeMod( $slidename ){
        $img = \get_theme_mod($slidename);
        $returnArray = false;
        if($img){
            $head =\get_theme_mod( $slidename . '_headline' );
            $subhead = \get_theme_mod($slidename .'_subhead');
            $cta = \get_theme_mod($slidename .'_cta_url');
            $cta_txt = \get_theme_mod($slidename .'_cta_text');
            if($img){
                $returnArray = array('img_url'=> $img, 'h1'=>$head, 'p'=>$subhead, 'cta'=>$cta,'cta_txt'=>$cta_txt);
            }
        }
        return $returnArray;  
    }
    private function returnSlidesPostType( $args ){

        $returnArray = array();
        $additional_args = array('fields' => 'ids');
        $query_args = array_merge($additional_args, $args);
        $posts = get_posts($query_args);
        foreach($posts as $the_id){
            $img_url = \wp_get_attachment_image_src( \get_post_thumbnail_id( $the_id ));
            $head = \get_the_title( $the_id );
            $subhead = \get_post_meta( $the_id, $post_type.'_subhead', true);
            $cta = \get_post_meta( $the_id, $post_type.'_cta_url', true);
            $cta_txt = \get_post_meta( $the_id, $post_type.'_cta_text', true);
            if($img_url){
                array_push(
                    $returnArray, 
                    array('img_url'=> $img1_url, 'h1'=>$head, 'p'=>$subhead, 'cta'=>$cta,'cta_txt'=>$cta_txt)
                );
            }
        }
        return $returnArray;
    }
    private function returnIndicators($slides){
        if($slides === false){
            if( Theme::$mode == 'development' ) error_log('Slides Could Not Be Loaded');
            return false;
        }
        $indicator_blob ='<ol class="carousel-indicators">';
        for($i = 0; $i<COUNT($slides); $i++){
            $class = ($i === 0) ? ' active' : '';
            $indicator_blob.='<li data-target="#'.self::$id.'" data-slide-to="'.$i.'" class="'.$class.'"></li>';
        }
        $indicator_blob.='</ol>';
        return $indicator_blob;
    }
    private function returnCTA( $cta_url ){
        $return_blob = '';
        if(false !== strpos($cta_url)){
            $return_blob.='href="'.$cta_url.'"';
        } else {
            $return_blob.='onclick='.$cta_url.'(event);return false;';
        }
        return $return_blob;
    }
    private function returnSlide( $slide, $active, $number, $leftright){
        $isactive = ($active) ? ' active' : '';
        $slide_blob ='<div class="carousel-item'.$isactive.'">';
        $slide_blob.='<img class='.$number.'-slide" ';
        $slide_blob.='src="'.$slide['img_url'].'" alt="'.ucfirst($number).' Slide">';
        if( isset($slide['h1']) ||
            isset($slide['p']) ||
            isset($slide['cta'])
        ){
            $slide_blob.='<div class="container"><div class="carousel-caption">';
            if( isset($slide['h1'])){

                $slide_blob.='<h1 class="homeslide">'.$slide['h1'].'</h1>';
            }
            if( isset($slide['p'])){
                $slide_blob.='<p class="carousel-text">'.$slide['p'].'</p>';
            }
            if( !empty($slide['cta']) && !empty($slide['cta_txt']) ){
                $slide_blob.='<p><a class="btn btn-lg btn-primary"';
                $slide_blob.= self::returnCTA($slide['cta']).' role="button">';
                $slide_blob.= $slide['cta_txt'].'</a></p>';       
            } 

            $slide_blob.='</div></div></div>';
        } else {
            $slide_blob.='</div>';
        } 
        return $slide_blob;
    }

    private function returnItems($slides){
        //Start the carousel markup
        $slides_blob = '<div class="carousel-inner">';
        //number to string form for some of the classes
        $verbose_numbers = array(
            'first', 'second', 'third', 'fourth', 'fifth', 'sixth', 'seventh', 'eighth',' ninth'
        );
        //loop each slide
        for($i = 0; $i<COUNT($slides); $i++){
            $slide = $slides[$i];
            $number = $verbose_numbers[$i + 1];
            $active = ($i === 0 ) ? true : false;
            $leftright = ($i % 2 ==0) ? 'left' : 'right';
            //Odd Slides have text and CTA to the right, even slides to the left
            $slides_blob.= self::returnSlide($slide, $active, $number, $leftright);
        }
        #close carousel-inner
        $slides_blob.= '</div>';

        return $slides_blob;
    }
    private function returnArrows(){
        $blob = '<a class="carousel-control-prev" href="#'.self::$id;
        $blob.='" role="button" data-slide="prev">';
        $blob.='<span class="carousel-control-prev-icon" aria-hidden="true"></span>';
        $blob.='<span class="sr-only">Previous</span></a>';
        $blob.='<a class="carousel-control-next" href="#'.self::$id;
        $blob.='" role="button" data-slide="next">';
        $blob.='<span class="carousel-control-next-icon" aria-hidden="true"></span>';
        $blob.='<span class="sr-only">Next</span></a>';
        return $blob;
    }


}