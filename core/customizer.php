<?php
namespace sorce\customizer;
use sorce\Theme as Theme;
/**
 * Customizer settings for this theme.
 *
 * @package friendlyrobot
 * 
 * https://wordpress.stackexchange.com/questions/71404/creating-a-rotating-header-image-slider-using-theme-customization 
 * 
 * 

 */

if ( ! class_exists( '\sorce\customizer\Theme_Customizer' ) ) {
    add_action( 'init', array('\sorce\customizer\Theme_Customizer', 'get_instance'), 10 );

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
			$wp_customize->remove_section("header_image");
			$wp_customize->remove_section("custom_css");


			/* HOME PAGE Modules */
			$wp_customize->add_panel( 'modules', array(
				'title'          => 'Home Page Modules',
				'priority'       => 15,
				'description'	=>		__('Home Page Modules.', self::textdomain ),
			) );

				/* sections */
				$wp_customize->add_section( 'box1', array(
					'title'          => 'Box One',
					'priority'       => 20,
					'panel'			 => 'modules'
				) );

				$wp_customize->add_section( 'box2', array(
					'title'          => 'Box Two',
					'priority'       => 20,
					'panel'			 => 'modules'
				) );
								$wp_customize->add_section( 'box3', array(
					'title'          => 'Box Three',
					'priority'       => 20,
					'panel'			 => 'modules'
				) );
				$wp_customize->add_section( 'box4', array(
					'title'          => 'Box Four',
					'priority'       => 20,
					'panel'			 => 'modules'
				) );
				$wp_customize->add_section( 'box5', array(
					'title'          => 'Box Five',
					'priority'       => 20,
					'panel'			 => 'modules'
				) );
				$wp_customize->add_section( 'box6', array(
					'title'          => 'Box Six',
					'priority'       => 20,
					'panel'			 => 'modules'
				) );
				$wp_customize->add_section( 'box7', array(
					'title'          => 'Box Seven',
					'priority'       => 20,
					'panel'			 => 'modules'
				) );
				$wp_customize->add_section( 'box8', array(
					'title'          => 'Box Eight',
					'priority'       => 20,
					'panel'			 => 'modules'
				) );

				

				/* settings */

				$wp_customize->add_setting( 'box_one_image', array(
					'default'        => '',
					
				) );

				$wp_customize->add_setting( 'box_one_title', array(
					'default'        => '',
					'sanitize_callback' => 'sanitize_text_field',
				) );

				$wp_customize->add_setting( 'box_one_text', array(
					'default'        => '',
					'sanitize_callback' => 'sanitize_text_field',
				) );

				$wp_customize->add_setting( 'box_one_video', array(
					'default'        => '',
				) );

				$wp_customize->add_setting( 'box_two_image', array(
					'default'        => '',
					
				) );
				$wp_customize->add_setting( 'box_two_title', array(
					'default'        => '',
					'sanitize_callback' => 'sanitize_text_field',
				) );

				$wp_customize->add_setting( 'box_two_description', array(
					'default'        => '',
					'sanitize_callback' => 'sanitize_text_field',
				) );

				$wp_customize->add_setting( 'box_two_list_one', array(
					'default'        => '',
					'sanitize_callback' => 'sanitize_text_field',
				) );
				$wp_customize->add_setting( 'box_two_list_two', array(
					'default'        => '',
					'sanitize_callback' => 'sanitize_text_field',
				) );
				$wp_customize->add_setting( 'box_two_list_three', array(
					'default'        => '',
					'sanitize_callback' => 'sanitize_text_field',
				) );

				$wp_customize->add_setting( 'box_two_video', array(
					'default'        => '',
				) );
				$wp_customize->add_setting( 'box_three_image', array(
					'default'        => '',
				) );
				$wp_customize->add_setting( 'box_three_title', array(
					'default'        => '',
					'sanitize_callback' => 'sanitize_text_field',
				) );

				$wp_customize->add_setting( 'box_three_text', array(
					'default'        => '',
					'sanitize_callback' => 'sanitize_text_field',
				) );
				$wp_customize->add_setting( 'box_four_image', array(
					'default'        => '',
					'sanitize_callback' => 'sanitize_text_field',
				) );
				$wp_customize->add_setting( 'box_four_title', array(
					'default'        => '',
					'sanitize_callback' => 'sanitize_text_field',
				) );
				$wp_customize->add_setting( 'box_four_text', array(
					'default'        => '',
					'sanitize_callback' => 'sanitize_text_field',
				) );
				$wp_customize->add_setting( 'box_four_video', array(
					'default'        => '',
					'sanitize_callback' => 'sanitize_text_field',
				) );
				$wp_customize->add_setting( 'box_four_overlay_title', array(
					'default'        => '',
					'sanitize_callback' => 'sanitize_text_field',
				) );
				$wp_customize->add_setting( 'box_four_overlay_buttontext', array(
					'default'        => '',
					'sanitize_callback' => 'sanitize_text_field',
				) );
				$wp_customize->add_setting( 'box_four_overlay_buttonurl', array(
					'default'        => '',
					'sanitize_callback' => 'sanitize_text_field',
				) );
				$wp_customize->add_setting( 'box_five_cards_title', array(
					'default'        => '',
					'sanitize_callback' => 'sanitize_text_field',
				) );
				$wp_customize->add_setting( 'box_five_cards_one_image', array(
					'default'        => '',
					'sanitize_callback' => 'sanitize_text_field',
				) );
				$wp_customize->add_setting( 'box_five_cards_one_title', array(
					'default'        => '',
					'sanitize_callback' => 'sanitize_text_field',
				) );
				$wp_customize->add_setting( 'box_five_cards_one_text', array(
					'default'        => '',
					'sanitize_callback' => 'sanitize_text_field',
				) );
				$wp_customize->add_setting( 'box_five_cards_two_image', array(
					'default'        => '',
				) );
				$wp_customize->add_setting( 'box_five_cards_two_title', array(
					'default'        => '',
					'sanitize_callback' => 'sanitize_text_field',
				) );
				$wp_customize->add_setting( 'box_five_cards_two_text', array(
					'default'        => '',
					'sanitize_callback' => 'sanitize_text_field',
				) );
				$wp_customize->add_setting( 'box_five_cards_three_image', array(
					'default'        => '',
				) );
				$wp_customize->add_setting( 'box_five_cards_three_title', array(
					'default'        => '',
					'sanitize_callback' => 'sanitize_text_field',
				) );
				$wp_customize->add_setting( 'box_five_cards_three_text', array(
					'default'        => '',
					'sanitize_callback' => 'sanitize_text_field',
				) );
				$wp_customize->add_setting( 'box_six_quote', array(
					'default'        => '',
					'sanitize_callback' => 'sanitize_text_field',
				) );
				$wp_customize->add_setting( 'box_six_attribution', array(
					'default'        => '',
					'sanitize_callback' => 'sanitize_text_field',
				) );
				$wp_customize->add_setting( 'box_seven_title', array(
					'default'        => '',
					'sanitize_callback' => 'sanitize_text_field',
				) );
				$wp_customize->add_setting( 'box_seven_logo_one', array(
					'default'        => '',
				) );
				$wp_customize->add_setting( 'box_seven_logo_two', array(
					'default'        => '',
				) );
				$wp_customize->add_setting( 'box_seven_logo_three', array(
					'default'        => '',
				) );
				$wp_customize->add_setting( 'box_seven_logo_four', array(
					'default'        => '',
				) );
				$wp_customize->add_setting( 'box_seven_logo_five', array(
					'default'        => '',
				) );
				$wp_customize->add_setting( 'box_seven_quote_one_headshot', array(
					'default'        => '',
				) );
				$wp_customize->add_setting( 'box_seven_quote_one_name', array(
					'default'        => '',
					'sanitize_callback' => 'sanitize_text_field',
				) );
				$wp_customize->add_setting( 'box_seven_quote_one_jobtitle', array(
					'default'        => '',
					'sanitize_callback' => 'sanitize_text_field',
				) );
				$wp_customize->add_setting( 'box_seven_quote_one_quote', array(
					'default'        => '',
					'sanitize_callback' => 'sanitize_text_field',
				) );
				$wp_customize->add_setting( 'box_seven_quote_two_headshot', array(
					'default'        => '',
				) );
				$wp_customize->add_setting( 'box_seven_quote_two_name', array(
					'default'        => '',
					'sanitize_callback' => 'sanitize_text_field',
				) );
				$wp_customize->add_setting( 'box_seven_quote_two_jobtitle', array(
					'default'        => '',
					'sanitize_callback' => 'sanitize_text_field',
				) );
				$wp_customize->add_setting( 'box_seven_quote_two_quote', array(
					'default'        => '',
					'sanitize_callback' => 'sanitize_text_field',
				) );
				$wp_customize->add_setting( 'box_seven_quote_three_headshot', array(
					'default'        => '',
				) );
				$wp_customize->add_setting( 'box_seven_quote_three_name', array(
					'default'        => '',
					'sanitize_callback' => 'sanitize_text_field',
				) );
				$wp_customize->add_setting( 'box_seven_quote_three_jobtitle', array(
					'default'        => '',
					'sanitize_callback' => 'sanitize_text_field',
				) );
				$wp_customize->add_setting( 'box_seven_quote_three_quote', array(
					'default'        => '',
					'sanitize_callback' => 'sanitize_text_field',
				) );
				$wp_customize->add_setting( 'box_seven_quote_four_headshot', array(
					'default'        => '',
				) );
				$wp_customize->add_setting( 'box_seven_quote_four_name', array(
					'default'        => '',
					'sanitize_callback' => 'sanitize_text_field',
				) );
				$wp_customize->add_setting( 'box_seven_quote_four_jobtitle', array(
					'default'        => '',
					'sanitize_callback' => 'sanitize_text_field',
				) );
				$wp_customize->add_setting( 'box_seven_quote_four_quote', array(
					'default'        => '',
					'sanitize_callback' => 'sanitize_text_field',
				) );

				$wp_customize->add_setting( 'box_eight_title', array(
					'default'        => '',
					'sanitize_callback' => 'sanitize_text_field',
				) );
				$wp_customize->add_setting( 'box_eight_buttontext', array(
					'default'        => '',
					'sanitize_callback' => 'sanitize_text_field',
				) );
				$wp_customize->add_setting( 'box_eight_buttonurl', array(
					'default'        => '',
					'sanitize_callback' => 'sanitize_text_field',
				) );

				/* controls */

				$wp_customize->add_control( new \WP_Customize_Image_Control( $wp_customize, 'box_one_image', array(
					'label'   => 'Box One Right Image',
					'section' => 'box1',
					'settings'   => 'box_one_image',
				) ) );

				$wp_customize->add_control( new \WP_Customize_Control( $wp_customize, 'box_one_title', array(
					'type'    => 'text',
					'section' => 'box1',
					'settings' => 'box_one_title',
					'label'   => esc_html__( 'Box One Title', self::textdomain ),

				))
				);

				$wp_customize->add_control( new \WP_Customize_Control( $wp_customize, 'box_one_text', array(
					'type'    => 'textarea',
					'section' => 'box1',
					'settings' => 'box_one_text',
					'label'   => esc_html__( 'Left Tile Text', self::textdomain ),

				))
				);


				$wp_customize->add_control( new \WP_Customize_Control( $wp_customize, 'box_one_video', array(
	
					'type'    => 'text',
					'section' => 'box1',
					'settings'=> 'box_one_video',
					'label'   => esc_html__( 'URL of the Video', self::textdomain ),
				))
				);

				/* END BOX ONE */

				$wp_customize->add_control( new \WP_Customize_Image_Control( $wp_customize, 'box_two_image', array(
					'label'   => 'Box Two Left Image',
					'section' => 'box2',
					'settings'   => 'box_two_image',
				) ) );

				$wp_customize->add_control( new \WP_Customize_Control( $wp_customize, 'box_two_title', array(
					'type'    => 'text',
					'section' => 'box2',
					'settings' => 'box_two_title',
					'label'   => esc_html__( 'Box Two Title', self::textdomain ),

				))
				);

				$wp_customize->add_control( new \WP_Customize_Control( $wp_customize, 'box_two_description', array(
					'type'    => 'textarea',
					'section' => 'box2',
					'settings' => 'box_two_description',
					'label'   => esc_html__( 'Box Two Description', self::textdomain ),

				))
				);

				$wp_customize->add_control( new \WP_Customize_Control( $wp_customize, 'box_two_list_one', array(
					'type'    => 'textarea',
					'section' => 'box2',
					'settings' => 'box_two_list_one',
					'label'   => esc_html__( 'Box Two First Bullet Point', self::textdomain ),

				))
				);
				$wp_customize->add_control( new \WP_Customize_Control( $wp_customize, 'box_two_list_two', array(
					'type'    => 'textarea',
					'section' => 'box2',
					'settings' => 'box_two_list_two',
					'label'   => esc_html__( 'Box Two Second Bullet Point', self::textdomain ),

				))
				);
				$wp_customize->add_control( new \WP_Customize_Control( $wp_customize, 'box_two_list_three', array(
					'type'    => 'textarea',
					'section' => 'box2',
					'settings' => 'box_two_list_three',
					'label'   => esc_html__( 'Box Two Third Bullet Point', self::textdomain ),

				))
				);
				

				$wp_customize->add_control( new \WP_Customize_Control( $wp_customize, 'box_two_video', array(
	
					'type'    => 'text',
					'section' => 'box2',
					'settings'=> 'box_two_video',
					'label'   => esc_html__( 'URL of the Video', self::textdomain ),
				))
				);

				/* END BOX TWO */

				$wp_customize->add_control( new \WP_Customize_Image_Control( $wp_customize, 'box_three_image', array(
					'label'   => 'Box Three Left Image',
					'section' => 'box3',
					'settings'   => 'box_three_image',
				) ) );

				$wp_customize->add_control( new \WP_Customize_Control( $wp_customize, 'box_three_title', array(
					'type'    => 'text',
					'section' => 'box3',
					'settings' => 'box_three_title',
					'label'   => esc_html__( 'Box Three Title', self::textdomain ),

				))
				);

				$wp_customize->add_control( new \WP_Customize_Control( $wp_customize, 'box_three_text', array(
					'type'    => 'textarea',
					'section' => 'box3',
					'settings' => 'box_three_text',
					'label'   => esc_html__( 'Box Three Text', self::textdomain ),

				))
				);
				/* END BOX THREE */

				$wp_customize->add_control( new \WP_Customize_Image_Control( $wp_customize, 'box_four_image', array(
					'label'   => 'Box Four Right Image',
					'section' => 'box4',
					'settings'   => 'box_four_image',
				) ) );

				$wp_customize->add_control( new \WP_Customize_Control( $wp_customize, 'box_four_title', array(
					'type'    => 'text',
					'section' => 'box4',
					'settings' => 'box_four_title',
					'label'   => esc_html__( 'Box Four Title', self::textdomain ),

				))
				);

				$wp_customize->add_control( new \WP_Customize_Control( $wp_customize, 'box_four_text', array(
					'type'    => 'textarea',
					'section' => 'box4',
					'settings' => 'box_four_text',
					'label'   => esc_html__( 'Box Four Text', self::textdomain ),

				))
				);
				$wp_customize->add_control( new \WP_Customize_Control( $wp_customize, 'box_four_video', array(
					'type'    => 'text',
					'section' => 'box4',
					'settings' => 'box_four_video',
					'label'   => esc_html__( 'URL of the Video', self::textdomain ),

				))
				);
				$wp_customize->add_control( new \WP_Customize_Control( $wp_customize, 'box_four_overlay_title', array(
					'type'    => 'text',
					'section' => 'box4',
					'settings' => 'box_four_overlay_title',
					'label'   => esc_html__( 'Bottom Overlay Call to Action', self::textdomain ),

				))
				);
				$wp_customize->add_control( new \WP_Customize_Control( $wp_customize, 'box_four_overlay_buttontext', array(
					'type'    => 'text',
					'section' => 'box4',
					'settings' => 'box_four_overlay_buttontext',
					'label'   => esc_html__( 'Bottom Overlay Button Text', self::textdomain ),

				))
				);
				$wp_customize->add_control( new \WP_Customize_Control( $wp_customize, 'box_four_overlay_buttonurl', array(
					'type'    => 'text',
					'section' => 'box4',
					'settings' => 'box_four_overlay_buttonurl',
					'label'   => esc_html__( 'Bottom Overlay URL', self::textdomain ),

				))
				);
				

				/* END BOX Four */

				$wp_customize->add_control( new \WP_Customize_Control( $wp_customize, 'box_five_cards_title', array(
					'type'    => 'text',
					'section' => 'box5',
					'settings' => 'box_five_cards_title',
					'label'   => esc_html__( 'Box Five Title', self::textdomain ),

				))
				);
				$wp_customize->add_control( new \WP_Customize_Image_Control( $wp_customize, 'box_five_cards_one_image', array(
					'label'   => 'Card One Image',
					'section' => 'box5',
					'settings'   => 'box_five_cards_one_image',
				) ) );
				$wp_customize->add_control( new \WP_Customize_Control( $wp_customize, 'box_five_cards_one_title', array(
					'type'    => 'text',
					'section' => 'box5',
					'settings' => 'box_five_cards_one_title',
					'label'   => esc_html__( 'Card One Title', self::textdomain ),

				))
				);
				$wp_customize->add_control( new \WP_Customize_Control( $wp_customize, 'box_five_cards_one_text', array(
					'type'    => 'textarea',
					'section' => 'box5',
					'settings' => 'box_five_cards_one_text',
					'label'   => esc_html__( 'Card One Text', self::textdomain ),

				))
				);
				$wp_customize->add_control( new \WP_Customize_Image_Control( $wp_customize, 'box_five_cards_two_image', array(
					'label'   => 'Card Two Image',
					'section' => 'box5',
					'settings'   => 'box_five_cards_two_image',
				) ) );
				$wp_customize->add_control( new \WP_Customize_Control( $wp_customize, 'box_five_cards_two_title', array(
					'type'    => 'text',
					'section' => 'box5',
					'settings' => 'box_five_cards_two_title',
					'label'   => esc_html__( 'Card Two Title', self::textdomain ),

				))
				);
				$wp_customize->add_control( new \WP_Customize_Control( $wp_customize, 'box_five_cards_two_text', array(
					'type'    => 'textarea',
					'section' => 'box5',
					'settings' => 'box_five_cards_two_text',
					'label'   => esc_html__( 'Card Two Text', self::textdomain ),

				))
				);
				$wp_customize->add_control( new \WP_Customize_Image_Control( $wp_customize, 'box_five_cards_three_image', array(
					'label'   => 'Card Three Image',
					'section' => 'box5',
					'settings'   => 'box_five_cards_three_image',
				) ) );
				$wp_customize->add_control( new \WP_Customize_Control( $wp_customize, 'box_five_cards_three_title', array(
					'type'    => 'text',
					'section' => 'box5',
					'settings' => 'box_five_cards_three_title',
					'label'   => esc_html__( 'Card Three Title', self::textdomain ),

				))
				);
				$wp_customize->add_control( new \WP_Customize_Control( $wp_customize, 'box_five_cards_three_text', array(
					'type'    => 'textarea',
					'section' => 'box5',
					'settings' => 'box_five_cards_three_text',
					'label'   => esc_html__( 'Card One Text', self::textdomain ),

				))
				);
				/* END BOX FIVE */

				$wp_customize->add_control( new \WP_Customize_Control( $wp_customize, 'box_six_quote', array(
					'type'    => 'textarea',
					'section' => 'box6',
					'settings' => 'box_six_quote',
					'label'   => esc_html__( 'Quote/Testimonial', self::textdomain ),

				))
				);
				$wp_customize->add_control( new \WP_Customize_Control( $wp_customize, 'box_six_attribution', array(
					'type'    => 'text',
					'section' => 'box6',
					'settings' => 'box_six_attribution',
					'label'   => esc_html__( 'Attribution/Author (Name, title, etc)', self::textdomain ),

				))
				);

				/* END BOX SIX */

				$wp_customize->add_control( new \WP_Customize_Control( $wp_customize, 'box_seven_title', array(
					'type'    => 'text',
					'section' => 'box7',
					'settings' => 'box_seven_title',
					'label'   => esc_html__( 'Box Seven Title', self::textdomain ),

				))
				);

				$wp_customize->add_control( new \WP_Customize_Image_Control( $wp_customize, 'box_seven_logo_one', array(
					'label'   => 'Logo One',
					'section' => 'box7',
					'settings'   => 'box_seven_logo_one',
				) ) );
				$wp_customize->add_control( new \WP_Customize_Image_Control( $wp_customize, 'box_seven_logo_two', array(
					'label'   => 'Logo Two',
					'section' => 'box7',
					'settings'   => 'box_seven_logo_two',
				) ) );
				$wp_customize->add_control( new \WP_Customize_Image_Control( $wp_customize, 'box_seven_logo_three', array(
					'label'   => 'Logo Three',
					'section' => 'box7',
					'settings'   => 'box_seven_logo_three',
				) ) );
				$wp_customize->add_control( new \WP_Customize_Image_Control( $wp_customize, 'box_seven_logo_four', array(
					'label'   => 'Logo Four',
					'section' => 'box7',
					'settings'   => 'box_seven_logo_four',
				) ) );
				$wp_customize->add_control( new \WP_Customize_Image_Control( $wp_customize, 'box_seven_logo_five', array(
					'label'   => 'Logo Five',
					'section' => 'box7',
					'settings'   => 'box_seven_logo_five',
				) ) );
				$wp_customize->add_control( new \WP_Customize_Image_Control( $wp_customize, 'box_seven_quote_one_headshot', array(
					'label'   => 'Quote One Headshot',
					'section' => 'box7',
					'settings'   => 'box_seven_quote_one_headshot',
				) ) );
				$wp_customize->add_control( new \WP_Customize_Control( $wp_customize, 'box_seven_quote_one_name', array(
					'type'    => 'text',
					'section' => 'box7',
					'settings' => 'box_seven_quote_one_name',
					'label'   => esc_html__( 'Quote One Name', self::textdomain ),

				))
				);
				$wp_customize->add_control( new \WP_Customize_Control( $wp_customize, 'box_seven_quote_one_jobtitle', array(
					'type'    => 'text',
					'section' => 'box7',
					'settings' => 'box_seven_quote_one_jobtitle',
					'label'   => esc_html__( 'Quote One Job Title', self::textdomain ),

				))
				);
				$wp_customize->add_control( new \WP_Customize_Control( $wp_customize, 'box_seven_quote_one_quote', array(
					'type'    => 'textarea',
					'section' => 'box7',
					'settings' => 'box_seven_quote_one_quote',
					'label'   => esc_html__( 'Quote One Full Quote', self::textdomain ),

				))
				);
				$wp_customize->add_control( new \WP_Customize_Image_Control( $wp_customize, 'box_seven_quote_two_headshot', array(
					'label'   => 'Quote Two Headshot',
					'section' => 'box7',
					'settings'   => 'box_seven_quote_two_headshot',
				) ) );
				$wp_customize->add_control( new \WP_Customize_Control( $wp_customize, 'box_seven_quote_two_name', array(
					'type'    => 'text',
					'section' => 'box7',
					'settings' => 'box_seven_quote_two_name',
					'label'   => esc_html__( 'Quote Two Name', self::textdomain ),

				))
				);
				$wp_customize->add_control( new \WP_Customize_Control( $wp_customize, 'box_seven_quote_two_jobtitle', array(
					'type'    => 'text',
					'section' => 'box7',
					'settings' => 'box_seven_quote_two_jobtitle',
					'label'   => esc_html__( 'Quote Two Job Title', self::textdomain ),

				))
				);
				$wp_customize->add_control( new \WP_Customize_Control( $wp_customize, 'box_seven_quote_two_quote', array(
					'type'    => 'textarea',
					'section' => 'box7',
					'settings' => 'box_seven_quote_two_quote',
					'label'   => esc_html__( 'Quote Two Full Quote', self::textdomain ),

				))
				);
				$wp_customize->add_control( new \WP_Customize_Image_Control( $wp_customize, 'box_seven_quote_three_headshot', array(
					'label'   => 'Quote Three Headshot',
					'section' => 'box7',
					'settings'   => 'box_seven_quote_three_headshot',
				) ) );
				$wp_customize->add_control( new \WP_Customize_Control( $wp_customize, 'box_seven_quote_three_name', array(
					'type'    => 'text',
					'section' => 'box7',
					'settings' => 'box_seven_quote_three_name',
					'label'   => esc_html__( 'Quote Three Name', self::textdomain ),

				))
				);
				$wp_customize->add_control( new \WP_Customize_Control( $wp_customize, 'box_seven_quote_three_jobtitle', array(
					'type'    => 'text',
					'section' => 'box7',
					'settings' => 'box_seven_quote_three_jobtitle',
					'label'   => esc_html__( 'Quote Three Job Title', self::textdomain ),

				))
				);
				$wp_customize->add_control( new \WP_Customize_Control( $wp_customize, 'box_seven_quote_three_quote', array(
					'type'    => 'textarea',
					'section' => 'box7',
					'settings' => 'box_seven_quote_three_quote',
					'label'   => esc_html__( 'Quote Three Full Quote', self::textdomain ),

				))
				);
				$wp_customize->add_control( new \WP_Customize_Image_Control( $wp_customize, 'box_seven_quote_four_headshot', array(
					'label'   => 'Quote Four Headshot',
					'section' => 'box7',
					'settings'   => 'box_seven_quote_four_headshot',
				) ) );
				$wp_customize->add_control( new \WP_Customize_Control( $wp_customize, 'box_seven_quote_four_name', array(
					'type'    => 'text',
					'section' => 'box7',
					'settings' => 'box_seven_quote_four_name',
					'label'   => esc_html__( 'Quote Four Name', self::textdomain ),

				))
				);
				$wp_customize->add_control( new \WP_Customize_Control( $wp_customize, 'box_seven_quote_four_jobtitle', array(
					'type'    => 'text',
					'section' => 'box7',
					'settings' => 'box_seven_quote_four_jobtitle',
					'label'   => esc_html__( 'Quote Four Job Title', self::textdomain ),

				))
				);
				$wp_customize->add_control( new \WP_Customize_Control( $wp_customize, 'box_seven_quote_four_quote', array(
					'type'    => 'textarea',
					'section' => 'box7',
					'settings' => 'box_seven_quote_four_quote',
					'label'   => esc_html__( 'Quote Four Full Quote', self::textdomain ),

				))
				);
				/* END BOX SEVEN */
				$wp_customize->add_control( new \WP_Customize_Control( $wp_customize, 'box_eight_title', array(
					'type'    => 'text',
					'section' => 'box8',
					'settings' => 'box_eight_title',
					'label'   => esc_html__( 'Box Eight Title', self::textdomain ),

				))
				);
				$wp_customize->add_control( new \WP_Customize_Control( $wp_customize, 'box_eight_buttontext', array(
					'type'    => 'text',
					'section' => 'box8',
					'settings' => 'box_eight_buttontext',
					'label'   => esc_html__( 'Box Eight Button Text', self::textdomain ),

				))
				);
				$wp_customize->add_control( new \WP_Customize_Control( $wp_customize, 'box_eight_buttonurl', array(
					'type'    => 'text',
					'section' => 'box8',
					'settings' => 'box_eight_buttonurl',
					'label'   => esc_html__( 'Box Eight Button URL', self::textdomain ),

				))
				);




			/* END HOME PAGE MODULES SECTION */

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