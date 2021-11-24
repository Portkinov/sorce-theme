<?php
namespace sorce\admin;
use \Carbon_Fields\Container as Container;
use \Carbon_Fields\Field as Field;
use \Carbon_Fields\Block as Block;
use \sorce\core\mvc\Control as Control;

require_once( get_template_directory() .  '/core/mvc/control/modules.php');
require_once( get_template_directory() .  '/core/mvc/control/components.php');

use \sorce\core\mvc\control\Modules as Modules;
use \sorce\core\mvc\control\Components as Components;

use \sorce\Theme as Theme;

/**
 * Add Carbon Fields
 *
 * @package southportcapital
 * 
 * 

*/


class AddFields extends Theme  {

    public static function run(){
        #Boot Carbon Fields vendor dependency as soon as possible
        require_once get_template_directory() .  '/vendor/autoload.php';
        \Carbon_Fields\Carbon_Fields::boot();

        \add_action( 'carbon_fields_register_fields', array(get_class(), 'theme_add_fields'), 1 );

    }
    public static function theme_add_fields() {
        if( class_exists('\Carbon_Fields\Container')){

            \add_action('carbon_fields_register_fields', array(get_class(), 'crb_home_page' ) );
            \add_action('carbon_fields_register_fields', array(get_class(), 'crb_coach_upload_page' ) );

        }
    }
    
    /* CARBON FIELDS TAXONOMY FUNCTIONS */
    /* CARBON FIELDS POST TYPE FIELDS */
    public static function crb_add_term_meta(){

        
    }
    /* CARBON FIELDS PAGE FUNCTIONS */
    public static function crb_home_page(){
        
        Container::make( 'post_meta', 'Section One' )
            ->where( 'post_id', '=', get_option( 'page_on_front' ) )
            ->add_fields( array( 
                Field::make( 'text', 'sec_1_title', 'Title'),
                Field::make( 'file', 'home_video', 'Home Page Video' )
                ->set_type( 'video' )
                ->set_value_type( 'url' ),
            ) );
        /* Home Blocks */
        Block::make( __( 'Sorce Vector Carousel') )
            ->add_fields(array(
                Field::make('text', 'svc_title', __('Carousel Title')),
                Field::make('radio', 'svc_show_controls', __('Show Controls?'))
                ->set_help_text('Show left/right arrows on the Carousel?')
                ->set_options(array('Yes', 'No')),
                Field::make('complex', 'svc_slides', __('Slides'))
                    ->add_fields(array(
                    Field::make('image', 'svc_slide_img', 'Slide Image')
                        ->set_required(true)
                        ->set_value_type('url'),
                    Field::make('text', 'svc_slide_title', 'Slide Title'),
                    Field::make('rich_text', 'svc_slide_text', 'Slide Text'),
                    Field::make('color', 'svc_slide_color', 'Bubble Color'),
        
                )),
        
            ))
            ->set_icon('heart')
            ->set_keywords([__('Sorce') ])
            ->set_description(__('3D Sorce Carousel'))
            ->set_category('layout')->set_render_callback(function ($fields, $attributes, $inner_blocks)
        {
            $module_title = $fields['svc_title'];
            #controls
            $arrows = isset($fields['svc_show_controls']) ? $fields['svc_show_controls'] : false;
            $arrows = ($arrows === "Yes") ? true : false;

            $slides = $fields['svc_slides'];
            if($slides){
                #containing markup
                ?>
                <div class="mod carousel">
                    <h2 class="carouseltitle"><?php echo $module_title; ?></h2>
                    <div class="indicators">
                        <ol class="indicator-list">
                <?php
                    #indicators
                $index = 0;
                while($index < count($slides)){
                    echo '<li class="indicator';
                    if($index === 0 ) echo ' active';
                    echo '" data-slide="slide'.$count.'"></li>';
                    $index++;
                };
                ?>
                        </ol>
                    </div>
                <?php
                #controls
                if($arrows && count($slides > 1)){
                ?>
                    <div class="carouselcontrols">
                        <ol class="arrows">
                            <li class="arrowleft"><a href="carouselcontrol" href="#slide<?php echo (count($slides) - 1);?>" onclick="doCarouselClick(event)">Previous</a></li>
                            <li class="arrowright"><a href="carouselfcontrol" href="#slide1" onclick="doCarouselclick(event)">Next</a></li>
                        </ol>
                    </div>
                <?php
                }
                ?>
                    <div class="slides">
                <?php
                #slides
                $index = 0;
                foreach($slides as $slide){
                    $img = $slide['svc_slide_img'];
                    $title = $slide['svc_slide_title'];
                    $color = $slide['svc_slide_color'];
                ?>
                        <div class="carousel-slide" id="slide<?php echo $index;?>">
                            <div class="carousel-item 
                <?php 
                    echo ($index===0) ? ' active' : '';
                    $index++;
                ?>" style="background-color="
                <?php 
                
                echo (isset($color) && !empty($color)) ? $color : '##28E5BB' ; 
                
                ?>>
                                <img class="slideimg" src="
                <?php 
                    echo $img;    
                ?>" alt="<?php echo $title ?>">
                            </div>
                        </div>
                    </div>
                    <div class="slidemetas">
                <?php
                };
                $index=0;
                foreach($slides as $slide){
                    $title = $slide['svc_slide_title'];
                    $text = $slide['svc_slide_text'];
                    $color = $slide['svc_slide_color'];
                    ?>
                        <div class="slidemeta" id="slidemeta<?php echo $index; ?>">
                            <h3 class="slidetitle"><?php echo $title;?></h3>
                            <div class="slidetext"><?php echo $text;?></div>
                        </div>
                    <?php
                    $index++;
                }
                ?>
                    </div>
                </div>
                <?php
            };
    
        });
    }
            
    
    public static function crb_coach_upload_page(){
       #example function showing both Container:: fields for Model and Modules:: for View
        $services_templates = array();

        Container::make('post_meta', 'Coach Upload Form')
            ->show_on_page('coach-upload-form')
            ->add_fields( array(
                Field::make( 'image', 'coach_upload_logo', 'Logo' ),
                Field::make('text', 'coach_upload_shortcode', 'Shortcode')
                    ->set_help_text('(Shortcode for the upload form)')
        ));

        Modules::make('coach-upload-form', 'Coach Upload Form', 
            array(
                Components::add_fields('image', 'coach_upload_logo'),
                Components::add_fields('text', 'coach_upload_shortcode')
            ), 
            #make new view file - for pages this is true
            true
        );
        
    }

};

\sorce\admin\AddFields::run();