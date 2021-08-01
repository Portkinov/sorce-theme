<?php
namespace friendlyrobot\customizer;
use friendlyrobot\Theme as Theme;
/**
 * Customizer settings for this theme.
 *
 * @package friendlyrobot
 * 
 * https://wordpress.stackexchange.com/questions/71404/creating-a-rotating-header-image-slider-using-theme-customization 
 * 
 * 

 */

if ( ! class_exists( '\friendlyrobot\customizer\Theme_Customizer' ) ) {
    add_action( 'init', array('\friendlyrobot\customizer\Theme_Customizer', 'get_instance'), 10 );

	class Theme_Customizer extends Theme  {
        private static $instance = null;
        public static function get_instance(){
            if (self::$instance == null){
                self::$instance = new self;
            }
            return self::$instance;
        }
        
      /* CONTRUCTOR */
		public function __construct() {
			add_action( 'customize_register', array( get_class(), 'register' ) );
		}

		/**
		 * Register customizer options.
		 *
		 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
		 *
		 * De-facto this extends the WP_Customizer object
		 */
		public static function register( $wp_customize ) {

			/* REMOVE THE STUFF WE DON'T NEED */

			$wp_customize->remove_section("colors");
			$wp_customize->remove_section("background_image");
			$wp_customize->remove_section("custom_css");

            /* HOME PAGE SLIDER */

            $wp_customize->add_panel( 'slides', array(
                'title'          => 'Home Page Carousel',
				'priority'       => 20,
				'description'	=>		__('Home Page Carousel Slides and Options.', self::textdomain ),
			) );

				/* sections */
				$wp_customize->add_section('slides_one', array(
					'title'          => 'Slide One',
					'priority'       => 30,
					'panel'			 => 'slides'
				));
	
				$wp_customize->add_section('slides_two', array(
					'title'          => 'Slide Two',
					'priority'       => 30,
					'panel'			 => 'slides'
				));
	
				$wp_customize->add_section('slides_three', array(
					'title'          => 'Slide Three',
					'priority'       => 30,
					'panel'			 => 'slides'
				));

				/* settings */
				$wp_customize->add_setting( 'first_slide', array(
					'default'        => '',
				) );
				$wp_customize->add_setting( 'second_slide', array(
					'default'        => '',
				) );
				$wp_customize->add_setting( 'third_slide', array(
					'default'        => '',
				) );

				$wp_customize->add_setting( 'first_slide_headline', array(
					'default'        => '',
					'sanitize_callback' => 'sanitize_text_field',
				) );
				$wp_customize->add_setting( 'second_slide_headline', array(
					'default'        => '',
					'sanitize_callback' => 'sanitize_text_field',
				) );
				$wp_customize->add_setting( 'third_slide_headline', array(
					'default'        => '',
					'sanitize_callback' => 'sanitize_text_field',
				) );
				$wp_customize->add_setting( 'first_slide_subhead', array(
					'default'        => '',
					'sanitize_callback' => 'sanitize_text_field',
				) );
				$wp_customize->add_setting( 'second_slide_subhead', array(
					'default'        => '',
					'sanitize_callback' => 'sanitize_text_field',
				) );
				$wp_customize->add_setting( 'third_slide_subhead', array(
					'default'        => '',
					'sanitize_callback' => 'sanitize_text_field',
				) );
				$wp_customize->add_setting( 'first_slide_cta_url', array(
					'default'        => '',
					'sanitize_callback' => 'sanitize_text_field',
				) );
				$wp_customize->add_setting( 'second_slide_cta_url', array(
					'default'        => '',
					'sanitize_callback' => 'sanitize_text_field',
				) );
				$wp_customize->add_setting( 'third_slide_cta_url', array(
					'default'        => '',
					'sanitize_callback' => 'sanitize_text_field',
				) );
				$wp_customize->add_setting( 'first_slide_cta_text', array(
					'default'        => '',
					'sanitize_callback' => 'sanitize_text_field',
				) );
				$wp_customize->add_setting( 'second_slide_cta_text', array(
					'default'        => '',
					'sanitize_callback' => 'sanitize_text_field',
				) );
				$wp_customize->add_setting( 'third_slide_cta_text', array(
					'default'        => '',
					'sanitize_callback' => 'sanitize_text_field',
				) );

				/* controls */

				$wp_customize->add_control( new \WP_Customize_Image_Control( $wp_customize, 'first_slide', array(
					'label'   => 'Slide Image',
					'section' => 'slides_one',
					'settings'   => 'first_slide',
				) ) );
				
				$wp_customize->add_control( new \WP_Customize_Image_Control( $wp_customize, 'second_slide', array(
					'label'   => 'Slide Image',
					'section' => 'slides_two',
					'settings'   => 'second_slide',
				) ) );
				$wp_customize->add_control( new \WP_Customize_Image_Control( $wp_customize, 'third_slide', array(
					'label'   => 'Slide Image',
					'section' => 'slides_three',
					'settings'   => 'third_slide',
				) ) );

				$wp_customize->add_control( new \WP_Customize_Control( $wp_customize, 'first_slide_headline', array(
					'type'    => 'text',
					'section' => 'slides_one',
					'label'   => esc_html__( 'Slide Headline', self::textdomain ),
	
				))
				);
				$wp_customize->add_control( new \WP_Customize_Control( $wp_customize, 'second_slide_headline', array(
	
					'type'    => 'text',
					'section' => 'slides_two',
					'label'   => esc_html__( 'Slide Headline', self::textdomain ),
				))
				);
				$wp_customize->add_control( new \WP_Customize_Control( $wp_customize, 'third_slide_headline', array(
	
					'type'    => 'text',
					'section' => 'slides_three',
					'label'   => esc_html__( 'Slide Headline', self::textdomain ),
				))
				);
				$wp_customize->add_control( new \WP_Customize_Control( $wp_customize, 'first_slide_subhead', array(
	
					'type'    => 'text',
					'section' => 'slides_one',
					'label'   => esc_html__( 'Slide Sub Headline', self::textdomain ),
				))
				);
				$wp_customize->add_control( new \WP_Customize_Control( $wp_customize, 'second_slide_subhead', array(
	
					'type'    => 'text',
					'section' => 'slides_two',
					'label'   => esc_html__( 'Slide Sub Headline', self::textdomain ),
				))
				);
				$wp_customize->add_control( new \WP_Customize_Control( $wp_customize, 'third_slide_subhead', array(
					'type'    => 'text',
					'section' => 'slides_three',
					'label'   => esc_html__( 'Slide Sub Headline', self::textdomain ),
				))
				);
				$wp_customize->add_control( new \WP_Customize_Control( $wp_customize, 'first_slide_cta_url', array(
					'type'    => 'text',
					'section' => 'slides_one',
					'label'   => esc_html__( 'Call To Action - URL or javascript function on Button click', self::textdomain ),
				) )
				);
				$wp_customize->add_control( new \WP_Customize_Control( $wp_customize, 'second_slide_cta_url', array(
					'type'    => 'text',
					'section' => 'slides_two',
					'label'   => esc_html__( 'Call To Action - URL or javascript function on Button click', self::textdomain ),
				))
				);
				$wp_customize->add_control( new \WP_Customize_Control( $wp_customize, 'third_slide_cta_url', array(
					'type'    => 'text',
					'section' => 'slides_three',
					'label'   => esc_html__( 'Call To Action - URL or javascript function on Button click', self::textdomain ),
				))
				);
				$wp_customize->add_control( new \WP_Customize_Control( $wp_customize, 'first_slide_cta_text', array(
					'type'    => 'text',
					'section' => 'slides_one',
					'label'   => esc_html__( 'Slide Button Text', self::textdomain ),
				))
				);
				$wp_customize->add_control( new \WP_Customize_Control( $wp_customize, 'second_slide_cta_text', array(
					'type'    => 'text',
					'section' => 'slides_two',
					'label'   => esc_html__( 'Slide Button Text', self::textdomain ),
				))
				);
				$wp_customize->add_control( new \WP_Customize_Control( $wp_customize, 'third_slide_cta_text', array(
					'type'    => 'text',
					'section' => 'slides_three',
					'label'   => esc_html__( 'Slide Button Text', self::textdomain ),
				))
				);
			/* END HOME PAGE CAROUSEL */

			/* HOME PAGE Modules */
			$wp_customize->add_panel( 'modules', array(
				'title'          => 'Home Page Modules',
				'priority'       => 25,
				'description'	=>		__('Home Page Modules.', self::textdomain ),
			) );

				/* sections */
				$wp_customize->add_section( 'tiles', array(
					'title'          => 'Home Page Double Tiles',
					'priority'       => 20,
					'panel'			 => 'modules'
				) );

				$wp_customize->add_section( 'contactform', array(
					'title'          => 'Contact Form',
					'priority'       => 20,
					'panel'			 => 'modules'
				) );


				

				/* settings */

				$wp_customize->add_setting( 'tile_one_image', array(
					'default'        => '',
					
				) );

				$wp_customize->add_setting( 'tile_one_title', array(
					'default'        => '',
					'sanitize_callback' => 'sanitize_text_field',
				) );

				$wp_customize->add_setting( 'tile_one_text', array(
					'default'        => '',
					'sanitize_callback' => 'sanitize_text_field',
				) );

				$wp_customize->add_setting( 'tile_one_shortcode', array(
					'default'        => '',
					'sanitize_callback' => 'sanitize_text_field',
				) );

				$wp_customize->add_setting( 'tile_two_image', array(
					'default'        => '',
					
				) );
				$wp_customize->add_setting( 'tile_two_title', array(
					'default'        => '',
					'sanitize_callback' => 'sanitize_text_field',
				) );

				$wp_customize->add_setting( 'tile_two_text', array(
					'default'        => '',
					'sanitize_callback' => 'sanitize_text_field',
				) );

				$wp_customize->add_setting( 'tile_two_shortcode', array(
					'default'        => '',
					'sanitize_callback' => 'sanitize_text_field',
				) );

				$wp_customize->add_setting( 'contactform_title', array(
					'default'        => '',
					'sanitize_callback' => 'sanitize_text_field',
				) );

				$wp_customize->add_setting( 'contactform_shortcode', array(
					'default'        => '',
					'sanitize_callback' => 'sanitize_text_field',
				) );

				/* controls */

				$wp_customize->add_control( new \WP_Customize_Image_Control( $wp_customize, 'tile_one_image', array(
					'label'   => 'Left Tile Image',
					'section' => 'tiles',
					'settings'   => 'tile_one_image',
				) ) );

				$wp_customize->add_control( new \WP_Customize_Control( $wp_customize, 'tile_one_title', array(
					'type'    => 'text',
					'section' => 'tiles',
					'settings' => 'tile_one_title',
					'label'   => esc_html__( 'Left Tile Title', self::textdomain ),

				))
				);

				$wp_customize->add_control( new \WP_Customize_Control( $wp_customize, 'tile_one_text', array(
					'type'    => 'textarea',
					'section' => 'tiles',
					'settings' => 'tile_one_text',
					'label'   => esc_html__( 'Left Tile Text', self::textdomain ),

				))
				);


				$wp_customize->add_control( new \WP_Customize_Control( $wp_customize, 'tile_one_shortcode', array(
	
					'type'    => 'text',
					'section' => 'tiles',
					'settings'=> 'tile_one_shortcode',
					'label'   => esc_html__( 'Monthly Newsletter Form Shortcode', self::textdomain ),
				))
				);

				$wp_customize->add_control( new \WP_Customize_Image_Control( $wp_customize, 'modules', array(
					'label'   => 'Right Tile Image',
					'section' => 'tiles',
					'settings'   => 'tile_two_image',
				) ) );

				$wp_customize->add_control( new \WP_Customize_Control( $wp_customize, 'tile_two_title', array(
					'type'    => 'text',
					'section' => 'tiles',
					'settings' => 'tile_two_title',
					'label'   => esc_html__( 'Right Tile Title', self::textdomain ),

				))
				);

				$wp_customize->add_control( new \WP_Customize_Control( $wp_customize, 'tile_two_text', array(
					'type'    => 'textarea',
					'section' => 'tiles',
					'settings' => 'tile_two_text',
					'label'   => esc_html__( 'Right Tile Text', self::textdomain ),

				))
				);


				$wp_customize->add_control( new \WP_Customize_Control( $wp_customize, 'tile_one_shortcode', array(
	
					'type'    => 'text',
					'section' => 'tiles',
					'settings'=> 'tile_two_shortcode',
					'label'   => esc_html__( 'Tell Us About Your Project Form Shortcode', self::textdomain ),
				))
				);

				/* END TILES START SHORTCODE */

				$wp_customize->add_control( new \WP_Customize_Control( $wp_customize, 'contactform_shortcode', array(
	
					'type'    => 'text',
					'section' => 'contactform',
					'settings'=> 'contactform_shortcode',
					'label'   => esc_html__( 'Contact Form Shortcode', self::textdomain ),
				))
				);

				$wp_customize->add_control( new \WP_Customize_Control( $wp_customize, 'contactform_shortcode', array(
	
					'type'    => 'text',
					'section' => 'contactform',
					'settings'=> 'contactform_shortcode',
					'label'   => esc_html__( 'Contact Form Shortcode', self::textdomain ),
				))
				);


			/* END HOME PAGE MODULES SECTION */


			/* HOME PAGE FEATURED CARDS */

			$wp_customize->add_panel( 'featurecards', array(
				'title'			=>		'Featured Items Cards',
				'priority' 		=>		30,
				'description'	=>		__('Four Image Cards linking Featured Collections of your services.', self::textdomain ),

			));
			

				/* sections */
			
				$wp_customize->add_section( 'featurecards_one', array(
					'title'          => 'Card One',
					'priority'       => 30,
					'panel'			 => 'featurecards'
				) );
				$wp_customize->add_section( 'featurecards_two', array(
					'title'          => 'Card Two',
					'priority'       => 30,
					'panel'			 => 'featurecards'
				) );
				$wp_customize->add_section( 'featurecards_three', array(
					'title'          => 'Card Three',
					'priority'       => 30,
					'panel'			 => 'featurecards'
				) );
				$wp_customize->add_section( 'featurecards_three', array(
					'title'          => 'Card Four',
					'priority'       => 30,
					'panel'			 => 'featurecards'
				) );

				/* settings */

			
				$wp_customize->add_setting( 'first_featurecard', array(
					'default'        => '',
				) );

				$wp_customize->add_setting( 'second_featurecard', array(
					'default'        => '',
				) );
				
				$wp_customize->add_setting( 'third_featurecard', array(
					'default'        => '',
				) );

				$wp_customize->add_setting( 'fourth_featurecard', array(
					'default'        => '',
				) );

				$wp_customize->add_setting( 'first_featurecard_title', array(
					'default'        => '',
					'sanitize_callback' => 'sanitize_text_field',
				) );

				$wp_customize->add_setting( 'second_featurecard_title', array(
					'default'        => '',
					'sanitize_callback' => 'sanitize_text_field',
				) );
				
				$wp_customize->add_setting( 'third_featurecard_title', array(
					'default'        => '',
					'sanitize_callback' => 'sanitize_text_field',
				) );
				$wp_customize->add_setting( 'fourth_featurecard_title', array(
					'default'        => '',
					'sanitize_callback' => 'sanitize_text_field',
				) );
				
				
				$wp_customize->add_setting( 'first_featurecard_url', array(
					'default'        => '',
					'sanitize_callback' => 'sanitize_text_field',
				) );

				$wp_customize->add_setting( 'second_featurecard_url', array(
					'default'        => '',
					'sanitize_callback' => 'sanitize_text_field',
				) );
				
				$wp_customize->add_setting( 'third_featurecard_url', array(
					'default'        => '',
					'sanitize_callback' => 'sanitize_text_field',
				) );
				$wp_customize->add_setting( 'fourthfeaturecard_url', array(
					'default'        => '',
					'sanitize_callback' => 'sanitize_text_field',
				) );
				$wp_customize->add_setting( 'first_featurecard_buttontext', array(
					'default'        => 'Learn More',
					'sanitize_callback' => 'sanitize_text_field',
				) );

				$wp_customize->add_setting( 'second_featurecard_buttontext', array(
					'default'        => 'Learn More',
					'sanitize_callback' => 'sanitize_text_field',
				) );
				
				$wp_customize->add_setting( 'third_featurecard_buttontext', array(
					'default'        => 'Learn More',
					'sanitize_callback' => 'sanitize_text_field',
				) );
				
				$wp_customize->add_setting( 'first_featurecard_description', array(
					'default'        => '',
					'sanitize_callback' => 'sanitize_text_field',
				) );

				$wp_customize->add_setting( 'second_featurecard_description', array(
					'default'        => '',
					'sanitize_callback' => 'sanitize_text_field',
				) );
				
				$wp_customize->add_setting( 'third_featurecard_description', array(
					'default'        => '',
					'sanitize_callback' => 'sanitize_text_field',
				) );
				$wp_customize->add_setting( 'fourth_featurecard_description', array(
					'default'        => '',
					'sanitize_callback' => 'sanitize_text_field',
				) );


				/* controls */	

				$wp_customize->add_control( new \WP_Customize_Image_Control( $wp_customize, 'first_featurecard', array(
					'label'   => 'Card Image',
					'section' => 'featurecards_one',
					'settings'   => 'first_featurecard',
				) ) );
				
				$wp_customize->add_control( new \WP_Customize_Image_Control( $wp_customize, 'second_featurecard', array(
					'label'   => 'Card Image',
					'section' => 'featurecards_two',
					'settings'   => 'second_featurecard',
				) ) );
				$wp_customize->add_control( new \WP_Customize_Image_Control( $wp_customize, 'third_featurecard', array(
					'label'   => 'Card Image',
					'section' => 'featurecards_three',
					'settings'   => 'third_featurecard',
				) ) );
				$wp_customize->add_control( new \WP_Customize_Image_Control( $wp_customize, 'fourth_featurecard', array(
					'label'   => 'Card Image',
					'section' => 'featurecards_four',
					'settings'   => 'fourth_featurecard',
				) ) );

				$wp_customize->add_control( new \WP_Customize_Control( $wp_customize, 'first_featurecard_title', array(
					'type'    => 'text',
					'section' => 'featurecards_one',
					'label'   => esc_html__( 'Card Title', self::textdomain ),

				))
				);

				$wp_customize->add_control( new \WP_Customize_Control( $wp_customize, 'second_featurecard_title', array(
					'type'    => 'text',
					'section' => 'featurecards_two',
					'label'   => esc_html__( 'Card Title', self::textdomain ),

				))
				);

				$wp_customize->add_control( new \WP_Customize_Control( $wp_customize, 'third_featurecard_title', array(
					'type'    => 'text',
					'section' => 'featurecards_three',
					'label'   => esc_html__( 'Card Title', self::textdomain ),

				))
				);

				$wp_customize->add_control( new \WP_Customize_Control( $wp_customize, 'fourth_featurecard_title', array(
					'type'    => 'text',
					'section' => 'featurecards_four',
					'label'   => esc_html__( 'Card Title', self::textdomain ),

				))
				);



				$wp_customize->add_control( new \WP_Customize_Control( $wp_customize, 'first_featurecard_description', array(
					'type'    => 'textarea',
					'section' => 'featurecards_one',
					'label'   => esc_html__( 'Description', self::textdomain ),

				))
				);

				$wp_customize->add_control( new \WP_Customize_Control( $wp_customize, 'second_featurecard_description', array(
					'type'    => 'textarea',
					'section' => 'featurecards_two',
					'label'   => esc_html__( 'Description', self::textdomain ),

				))
				);

				$wp_customize->add_control( new \WP_Customize_Control( $wp_customize, 'third_featurecard_description', array(
					'type'    => 'textarea',
					'section' => 'featurecards_three',
					'label'   => esc_html__( 'Description', self::textdomain ),

				))
				);

				$wp_customize->add_control( new \WP_Customize_Control( $wp_customize, 'fourth_featurecard_description', array(
					'type'    => 'textarea',
					'section' => 'featurecards_four',
					'label'   => esc_html__( 'Description', self::textdomain ),

				))
				);

				$wp_customize->add_control( new \WP_Customize_Control( $wp_customize, 'first_featurecard_buttontext', array(
					'type'    => 'text',
					'section' => 'featurecards_one',
					'label'   => esc_html__( 'Button Text', self::textdomain ),

				))
				);

				$wp_customize->add_control( new \WP_Customize_Control( $wp_customize, 'second_featurecard_buttontext', array(
					'type'    => 'text',
					'section' => 'featurecards_two',
					'label'   => esc_html__( 'Button Text', self::textdomain ),

				))
				);

				$wp_customize->add_control( new \WP_Customize_Control( $wp_customize, 'third_featurecard_buttontext', array(
					'type'    => 'text',
					'section' => 'featurecards_three',
					'label'   => esc_html__( 'Button Text', self::textdomain ),

				))
				);
				$wp_customize->add_control( new \WP_Customize_Control( $wp_customize, 'fourth_featurecard_buttontext', array(
					'type'    => 'text',
					'section' => 'featurecards_four',
					'label'   => esc_html__( 'Button Text', self::textdomain ),

				))
				);

				$wp_customize->add_control( new \WP_Customize_Control( $wp_customize, 'first_featurecard_url', array(
					'type'    => 'text',
					'section' => 'featurecards_one',
					'label'   => esc_html__( 'Button URL', self::textdomain ),

				))
				);

				$wp_customize->add_control( new \WP_Customize_Control( $wp_customize, 'second_featurecard_url', array(
					'type'    => 'text',
					'section' => 'featurecards_two',
					'label'   => esc_html__( 'Button URL', self::textdomain ),

				))
				);

				$wp_customize->add_control( new \WP_Customize_Control( $wp_customize, 'third_featurecard_url', array(
					'type'    => 'text',
					'section' => 'featurecards_three',
					'label'   => esc_html__( 'Button URL', self::textdomain ),

				))
				);

				$wp_customize->add_control( new \WP_Customize_Control( $wp_customize, 'fourth_featurecard_url', array(
					'type'    => 'text',
					'section' => 'featurecards_four',
					'label'   => esc_html__( 'Button URL', self::textdomain ),

				))
				);

			/* END HOME PAGE FEATURED CARDS */

			
			// Add "display_title_and_tagline" setting for displaying the site-title & tagline.
			$wp_customize->add_setting(
				'display_title_and_tagline',
				array(
					'capability'        => 'edit_theme_options',
					'default'           => true,
					'sanitize_callback' => array( get_class(), 'sanitize_checkbox' ),
				)
			);

			// t&t control
			$wp_customize->add_control(
				'display_title_and_tagline',
				array(
					'type'    => 'checkbox',
					'section' => 'title_tagline',
					'label'   => esc_html__( 'Display Site Title & Tagline', self::textdomain ),
				)
			);

			//Add excerpt or full text for indexes
			$wp_customize->add_section(
				'excerpt_settings',
				array(
					'title'    => esc_html__( 'Excerpt Settings', self::textdomain ),
					'priority' => 120,
				)
			);
            //excerpt setting
			$wp_customize->add_setting(
				'display_excerpt_or_full_post',
				array(
					'capability'        => 'edit_theme_options',
					'default'           => 'excerpt',
					'sanitize_callback' => function( $value ) {
						return ('excerpt' === $value || 'full' === $value) ? $value : 'excerpt';
					},
				)
			);
            //excerpt control
			$wp_customize->add_control(
				'display_excerpt_or_full_post',
				array(
					'type'    => 'radio',
					'section' => 'excerpt_settings',
					'label'   => esc_html__( 'On Archive Pages, posts show:', self::textdomain ),
					'choices' => array(
						'excerpt' => esc_html__( 'Summary', self::textdomain ),
						'full'    => esc_html__( 'Full text', self::textdomain ),
					),
				)
			);
		/* Global Footer SECTION */
		$wp_customize->add_panel( 'footer', array(
			'title'          => ucfirst(self::nicename).' Footer',
			'priority'       => 65,
			'description'	=>		__('Footer options for the '.ucfirst(self::nicename).' theme.', self::textdomain ),
		) );

			/* sections */
			$wp_customize->add_section( 'footer_one', array(
				'title'          => 'Donate Now Footer',
				'priority'       => 30,
				'panel'			 => 'footer'
			) );
			$wp_customize->add_section( 'footer_two', array(
				'title'          => 'Footer Middle',
				'priority'       => 30,
				'panel'			 => 'footer'
			) );
			$wp_customize->add_section( 'footer_three', array(
				'title'          => 'Footer Bottom',
				'priority'       => 30,
				'panel'			 => 'footer'
			) );

			/* settings */

			$wp_customize->add_setting( 'footer_img', array(
				'default'        => '',
			) );

			$wp_customize->add_setting( 'footer_shortcode', array(
				'default'		=> '',
			));

			$wp_customize->add_setting( 'footer_add_logo', array(
				'default'		=> '',
			));

			$wp_customize->add_setting( 'footer_signup_shortcode', array(
				'default'		=> '',
			));

			$wp_customize->add_setting( 'footer_add_copyright', array(
				'default'        => '',
			) );

			$wp_customize->add_setting( 'footer_social_fb', array(
				'default'        => '',
			) );
			$wp_customize->add_setting( 'footer_social_ig', array(
				'default'        => '',
			) );
			$wp_customize->add_setting( 'footer_social_tw', array(
				'default'        => '',
			) );

			/* controls */

			$wp_customize->add_control( new \WP_Customize_Image_Control( $wp_customize, 'footer_img', array(
				'label'   => 'Background Image for Donate Now',
				'section' => 'footer_one',
				'settings'   => 'footer_img',
			) ) );

			$wp_customize->add_control( new \WP_Customize_Control( $wp_customize, 'footer_shortcode', array(
				'type'    => 'text',
				'section' => 'footer_one',
				'label'   => esc_html__( 'Button Shortcode', self::textdomain ),
				'settings'   => 'footer_shortcode',

			))
			);
			$wp_customize->add_control( new \WP_Customize_Image_Control( $wp_customize, 'footer_add_logo', array(
				'label'   => 'Logo Image for Footer (leaving blank tries top menu logo)',
				'section' => 'footer_two',
				'settings'   => 'footer_add_logo',
			) ) );
			$wp_customize->add_control( new \WP_Customize_Control( $wp_customize, 'footer_signup_shortcode', array(
				'type'    => 'text',
				'section' => 'footer_two',
				'label'   => esc_html__( 'Sign-up Form Shortcode', self::textdomain ),
				'settings'   => 'footer_signup_shortcode',

			))
			);

			$wp_customize->add_control(
				'footer_add_copyright',
				array(
					'type'    => 'checkbox',
					'section' => 'footer_three',
					'label'   => esc_html__( 'Add a Copyright notice?', self::textdomain ),
					'description' => 'Example: ' . '©' . Date('Y') . ' ' . \get_bloginfo( 'name' ) . ', all rights reserved.'
				)
			);



		/* END HOME PAGE MISC SECTION */

		}

		public static function sanitize_checkbox( $checked = null ) {
			return (bool) isset( $checked ) && true === $checked;
		}

		/**
		 * Render the site title for the selective refresh partial.
		 *
		 * @access public
		 *
		 * @since 1.0.0
		 *
		 * @return void
		 */
		public function partial_blogname() {
			bloginfo( 'name' );
		}

		/**
		 * Render the site tagline for the selective refresh partial.
		 *
		 * @access public
		 *
		 * @since 1.0.0
		 *
		 * @return void
		 */
		public function partial_blogdescription() {
			bloginfo( 'description' );
		}
	}
};