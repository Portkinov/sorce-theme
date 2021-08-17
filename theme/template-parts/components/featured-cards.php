<?php 
namespace friendlyrobot\components;

class HomeFeaturedCards {
    public $html;

    /*

     */

    public function __construct(){
        $this->cardinfo = $this->get_cardinfo();
        $this->html = $this->get_html( $this->cardinfo );
    }
    private function get_cardinfo(){
        $module_background = \get_theme_mod('bgimage_featurecards');
        $image1 = \get_theme_mod('first_featurecard');
        $image2 = \get_theme_mod('second_featurecard');
        $image3 = \get_theme_mod('third_featurecard');
            
        $title1 =\get_theme_mod('first_featurecard_title');
        $title2 =\get_theme_mod('second_featurecard_title');
        $title3 =\get_theme_mod('third_featurecard_title');

        $text1 = \get_theme_mod('first_featurecard_description');
        $text2 = \get_theme_mod('second_featurecard_description');
        $text3 = \get_theme_mod('third_featurecard_description');

        $button1 = \get_theme_mod('first_featurecard_buttontext');
        $button2 = \get_theme_mod('second_featurecard_buttontext');
        $button3 = \get_theme_mod('third_featurecard_buttontext');

        $url1 = \get_theme_mod('first_featurecard_url');
        $url2 = \get_theme_mod('second_featurecard_url');
        $url3 = \get_theme_mod('third_featurecard_url');

        $args = array( 
            'module_background' => $module_background,
            'card1'             => array(
                'image' => $image1,
                'title' => $title1,
                'text' => $text1,
                'buttontext' => $button1,
                'buttonurl' => $url1
            ),
            'card2'             => array(
                'image' => $image2,
                'title' => $title2,
                'text' => $text2,
                'buttontext' => $button2,
                'buttonurl' => $url2
            ),
            'card3'             => array(
                'image' => $image3,
                'title' => $title3,
                'text' => $text3,
                'buttontext' => $button3,
                'buttonurl' => $url3
            )
        );
        return $args;

    }
    private function get_html( $args){
        if(!is_array($args)) return false;
        $markup ='<div class="containerwrap featured-services-cards">';
        $markup.='<div class="container-fluid component px-0 mx-0">';
        $markup.='<div class="row mx-0 px-0 d-flex justify-content-center">';
        $markup.='<div class="cardholder marginbox">';
        
        $cardcount = 1;
        if(!empty($args['card'.$cardcount])){
            while($cardcount < 4){
                $card = $args['card'.$cardcount];
                $imgurl = $card['image'];
                $title = $card['title'];
                $text = $card['text'];
                $buttontext = $card['buttontext'];
                $buttonurl = $card['buttonurl'];

                #render out each card
                $markup.='<div class="card"><img class="card-img-top" src="'.$imgurl.'" />';
                $markup.='<div class="card-body">';
                if(!empty($title)) $markup.='<h5 class="card-title">'.$title.'</h5>';
                if(!empty($text) || (!empty($buttontext) && !empty($buttonurl) )){
                    $markup.='<div class="card-text">'.$text.'</div>';
                    if($buttontext || $buttonurl){
                        if(empty($buttontext)) $buttontext = 'Learn More';
                        $markup.='<div class="buttonwrap"><a href="'.$buttonurl.'">';
                        $markup.= '<div class="btn btn-primary">'.$buttontext.'</div></a></div>';
                    }
                   
                }
                $markup.='</div></div>';
                $cardcount++;
            }   
        }
        $markup.='</div></div></div></div>';

        return $markup;
    }
    public function render(){
        echo $this->html;
    }
}