<?php
namespace sorce\admin;
use \Carbon_Fields\Container as Container;
use \Carbon_Fields\Field as Field;
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
        /*
        Container::make('term_meta', 'Term Properties')
        ->show_on_taxonomy('term_name')
        ->add_fields(array(
            Field::make('text', 'crb_branch_color', 'Color (In Hex Format)'),
            Field::make('image', 'crb_branch_thumb', 'Featured Image'),
            Field::make('text', 'crb_contact_form', 'Form Shortcode'),
            Field::make('text', 'crb_contact_email', 'Contact Email Address'),
            Field::make('text', 'crb_phone_number', 'Phone Number')
        ));
        */
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