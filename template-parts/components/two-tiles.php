<?php 
namespace friendlyrobot\components;


class TwoTiles {

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

    public function __construct( $args = array() ){
        #this will render tile arrays directory if defined or else get the front page tiles
        $this->tiles = (!isset($args['tiles'])) ? $this->getTiles( ) : $args['tiles'];
        $this->html = $this->getHTML( $this->tiles );
        
    }
    public function render(){ echo $this->html; }
    private function getTiles(){
        $tilesarray = array();
        $tiles = array('tile_one', 'tile_two');
        foreach($tiles as $tile){
            $thistile = array();
            $image = \get_theme_mod( $tile . '_image');
			$title = \get_theme_mod(	$tile . '_title');
			$text = \get_theme_mod(	$tile . '_text');
			$shortcode = \get_theme_mod(	$tile . '_shortcode');
              
            $thistile['image'] = $image ? $image : false;
            $thistile['title'] = $title ? $title : false;
            $thistile['text'] = $text ? $text : false;
            $thistile['shortcode'] = $shortcode ? $shortcode : false;
            array_push($tilesarray, $thistile);
        }
        return $tilesarray;
    }
    private function getHTML( $tiles ){
        $markup = '';
        if($tiles){
            $markup ='<div class="containerwrap two-tiles">';
            $markup.='<div class="container component">';
            $markup.='<div class="row">';
            foreach($tiles as $tile){
                $markup.= '<div class="col-12 col-md-6 tile">';
                if($tiles['title']) $markup.='<h3 class="tiletitle">'.$tiles['title'].'</h3>';
                if($tiles['image']){
                    $markup.= '<div class="tileimage" style="background-image:url(';
                    $markup.= $tiles['image'].');"></div>';
                }
                if($tiles['text']) $markup.='<div class="tiletext">'.$tiles['text'].'</div>';
                if($tiles['shortcode']){
                    $markup.='<div class="tilecode">'.$tiles['shortcode'].'</div>';
                }
                $markup.='</div>';
            }   
            $markup.='</div></div></div>';

        }
        return $markup;
    }
}