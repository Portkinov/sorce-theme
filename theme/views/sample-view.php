<?php
require_once \get_template_directory().'/template-parts/components/box-mission.php';  
require_once \get_template_directory().'/template-parts/components/rich-text-right.php';

use \sorce\core\TemplateHelpers as TemplateHelpers;
use \sorce\components\BoxMission as BoxMission;
use \sorce\components\RichTextRight as RichTextRight;
 
$mission_statement = new BoxMission( 
    $this->services_mssn_img, 
    $this->services_mssn_text
);
$mission_statement->render();

#The spacer will provide padding top based on viewport width (height of spacer / grid width times 100)
#using Spacers will keep the modules free of layout styling for easy reuse
TemplateHelpers::Spacer('padding-top:10.42vw;');

# render a module with conditional 
$condition = \get_option('services_mod7_iscta'); #returns true false value for the checkbox field
if($condition){
    $ctatext = $this->services_mod7_cta_text;
    $ctaurl = $this->services_mod7_cta_url;
} else {
    $ctatext = false;
    $ctaurl = false;
}
$rich_args = array(
    'margins' => '19.16vw 0 10.41vw',
);

$richtextright = new RichTextRight(
    $this->services_mod7_img,
    $this->services_mod7_title,
    $this->services_mod7_text,
    $ctatext,
    $ctaurl,
    $rich_args
);
$richtextright->render();