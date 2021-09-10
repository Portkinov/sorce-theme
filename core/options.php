<?php
namespace sorce\options;
use sorce\Theme as Theme;
use \Carbon_Fields\Container;
use \Carbon_Fields\Field;

/**
 * Customizer settings for this theme.
 *
 * @package sorce
 * 
 * https://wordpress.stackexchange.com/questions/71404/creating-a-rotating-header-image-slider-using-theme-customization 
 * 
 * 


 */

if ( ! class_exists( '\sorce\options\Sorce_Options' ) ) {
    
	class Sorce_Options extends Theme {
        private static $instance = null;
        private $options;
        public static function get_instance(){
            if (self::$instance == null){
                self::$instance = new self;
            }
            return self::$instance;
        }
        
      /* CONTRUCTOR */
		public function __construct() {
           # No theme options for this theme
           # \add_action( 'carbon_fields_register_fields', array( get_class(), 'add_options_page' ) );
        }
        
        public static function add_options_page() {
            $basic_options_container = Container::make( 'theme_options',  Theme::nicename .' Theme Options' )
            ->add_fields( array(
                Field::make( 'checkbox', 'is_bootstrap', 'Is this a Bootstrap Theme' )
                    ->set_option_value( 'yes' ),
                Field::make( 'checkbox', 'is_cdn', 'Load From CDN?' )
                    ->set_option_value( 'yes' ),
            ) );
        
            // Add second options page under 'Basic Options'
            Container::make( 'theme_options', 'Social Links' )
                ->set_page_parent( $basic_options_container ) // reference to a top level container
                ->add_fields( array(
                    Field::make( 'image', 'crb_facebook_logo')
                    ->set_value_type( 'url' ),
                    Field::make( 'image', 'crb_twitter_logo')
                    ->set_value_type( 'url' ),
                    Field::make( 'image', 'crb_instagram_logo')
                    ->set_value_type( 'url' ), 
                    Field::make( 'image', 'crb_youtube_logo')
                    ->set_value_type( 'url' ), 
                    Field::make( 'text', 'crb_facebook_link' ),
                    Field::make( 'text', 'crb_twitter_link' ),
                    Field::make( 'text', 'crb_instagram_link'),
                    Field::make( 'text', 'crb_youtube_link')
                ) );
        
            
        }
	}
    \sorce\options\Sorce_Options::get_instance();
}