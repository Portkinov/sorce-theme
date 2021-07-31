<?php 
namespace friendlyrobot\components;

class VideoOne{ 

    public $html; 

    public function __construct( $services_one_videoembed = "", $services_one_title = "", $services_one_text = ""){ 
        $this->services_one_videoembed = $services_one_videoembed ? $services_one_videoembed : false; 
        $this->services_one_title = $services_one_title ? $services_one_title : false; 
        $this->services_one_text = $services_one_text ? $services_one_text : false; 
        $this->html = $this->get_html( $this->services_one_videoembed, $this->services_one_title, $this->services_one_text); 
    }


    private function get_html( $services_one_videoembed, $services_one_title, $services_one_text){ 
        #add your gatekeeping logic here 
        $markup ='<div class="containerwrap videoone">';
        $markup.='<div class="container-fluid component p-0 m-0">';




        $markup ='</div></div>'; 
        return $markup; 
    }
    public function render(){ echo $this->html; }
}