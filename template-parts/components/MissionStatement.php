<?php 
namespace friendlyrobot\components;

class MissionStatement{ 

    public $html; 

    public function __construct( $services_mssn_img = "", $services_mssn_text = ""){ 
        $this->services_mssn_img = $services_mssn_img ? $services_mssn_img : false; 
        $this->services_mssn_text = $services_mssn_text ? $services_mssn_text : false; 
        $this->html = $this->get_html( $this->services_mssn_img, $this->services_mssn_text); 
    }


    private function get_html( $services_mssn_img, $services_mssn_text){ 
        #add your gatekeeping logic here 
        $markup ='<div class="containerwrap missionstatement">';
        $markup.='<div class="container-fluid component p-0 m-0">';




        $markup ='</div></div>'; 
        return $markup; 
    }
    public function render(){ echo $this->html; }
}