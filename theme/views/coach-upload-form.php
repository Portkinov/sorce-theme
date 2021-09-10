<?php 
require_once \get_template_directory().'/template-parts/components/coach-upload-form.php';  

use \sorce\core\TemplateHelpers as TemplateHelpers;
use \sorce\components\CoachUploadForm as CoachUploadForm;


$coach_upload_form = new CoachUploadForm(
        $this->coach_upload_logo, 
        $this->coach_upload_shortcode, 
);
$coach_upload_form->render();


TemplateHelpers::Spacer('padding-top:10vw;');

