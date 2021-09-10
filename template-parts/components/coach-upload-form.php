<?php 
namespace sorce\components;
use sorce\core\TemplateHelpers as TemplateHelpers;
class CoachUploadForm{ 

    public $html; 

    public function __construct( $coach_upload_logo = "", $coach_upload_shortcode = ""){ 

        $this->coach_upload_logo = $coach_upload_logo ? $coach_upload_logo : false; 
        $this->coach_upload_shortcode = $coach_upload_shortcode ? $coach_upload_shortcode : false; 
        $this->html = $this->get_html( $this->coach_upload_logo, $this->coach_upload_shortcode);
       
    }

    private function get_html( $coach_upload_logo, $coach_upload_shortcode){ 
        #add your gatekeeping logic here 
        $markup ='<div class="containerwrap coachuploadform">';
        $markup.='<div class="container-fluid component p-0 m-0">';
        $loggedin = \is_user_logged_in();
        $markup.= $loggedin ? '<div>User Logged In: true</div>' : '<div>User Logged In: false</div>';

        $shortcode = TemplateHelpers::check_shortcode( $coach_upload_shortcode );
        if($shortcode) $markup.= $shortcode;


        $markup .='</div></div>'; 
        return $markup; 
    }
    public function render(){ echo $this->html; }
}