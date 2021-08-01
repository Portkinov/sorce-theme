<?php 
namespace friendlyrobot\components;


class ContactUs {

    public $html;
    /*
     * This Class Renders a ContactForm 7 form shortcode or similar (any shortcode will work)
     */

    public function __construct( $args = array() ){
        #this will render tile arrays directory if defined or else get the front page tiles
        $this->args = (!isset($args['shortcode'])) ? $this->getArgs() : $args;
        $this->html = $this->getHTML( $this->args );
        
    }
    public function render(){ echo $this->html; }
    private function getArgs(){
        $args = array();
		$title = \get_theme_mod( 'contactus_title');
		$shortcode = \get_theme_mod( 'contactus_shortcode');
              
        $args['title'] = $title ? $title : false;
        $args['shortcode'] = $shortcode ? $shortcode : false;
        return $args;
    }
    private function getHTML( $args ){
        $markup = '';
        if($args){
            $markup ='<div class="containerwrap contactus">';
            $markup.='<div class="container component">';
            $markup.='<div class="row">';
            foreach($tiles as $tile){
                $markup.= '<div class="col-12 formcontainer">';
                if($args['title']) $markup.='<h3 class="formtitle">'.$args['title'].'</h3>';
                if($args['shortcode']){
                    echo \do_shortcode( $args['shortcode'] );
                }
            }   
            $markup.='</div></div></div></div>';

        }
        return $markup;
    }
}