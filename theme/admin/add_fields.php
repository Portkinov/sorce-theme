<?php
namespace friendlyrobot\admin;
use \Carbon_Fields\Container as Container;
use \Carbon_Fields\Field as Field;
use \friendlyrobot\core\mvc\Control as Control;

require_once( get_template_directory() .  '/core/mvc/control/modules.php');
require_once( get_template_directory() .  '/core/mvc/control/components.php');

use \friendlyrobot\core\mvc\control\Modules as Modules;
use \friendlyrobot\core\mvc\control\Components as Components;

use \friendlyrobot\Theme as Theme;

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

            \add_action('carbon_fields_register_fields', array(get_class(), 'crb_add_term_meta' ) );
           # \add_action('carbon_fields_register_fields', array(get_class(), 'crb_services_page' ) );

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
        /*
        Container::make( 'post_meta', 'Custom Data' )
            ->where( 'post_id', '=', get_option( 'page_on_front' ) )
            ->add_fields( array( 
                Field::make( 'file', 'home_video', 'Home Page Video' )
                ->set_type( 'video' )
                ->set_value_type( 'url' ),
            ) );
            */
    }
    public static function crb_services_page(){
       #example function showing both Container:: fields for Model and Modules:: for View
        $services_templates = array();

        Container::make('post_meta', 'Mission Statement')
            ->show_on_page('services')
            ->add_fields( array(
                Field::make( 'image', 'services_mssn_img', 'Mission Statement Image' ),
                Field::make('textarea', 'services_mssn_text', 'Mission Statement Text')
                    ->set_rows( 2 )
                #       ->set_attribute( 'maxLength', 250 )
                    ->set_help_text('(Mission Statement in 250 characters or less)')
        ));

        Modules::make('services', 'Mission Statement', 
            array(
                Components::add_fields('image', 'services_mssn_img'),
                Components::add_fields('textarea', 'services_mssn_text')
        ));
        Container::make('post_meta', 'Video One')
            ->show_on_page('services')
            ->add_fields( array(   
                Field::make('textarea', 'services_one_videoembed', 'Video Embed Code')
                    ->set_rows( 2 )                 
                    ->set_help_text('(copy/paste the full embed code here)'),
                Field::make('text', 'services_one_title', 'Title'),
                Field::make('textarea', 'services_one_text', 'Text'),
        ));
        Modules::make('services', 'Video One',
            array(
                Components::add_fields('textarea', 'services_one_videoembed'),
                Components::add_fields('text', 'services_one_title'),
                Components::add_fields('textarea', 'services_one_text')
        ));
        
    }

};

\friendlyrobot\admin\AddFields::run();