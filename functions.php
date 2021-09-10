<?php
namespace sorce; #should be same as textdomain
use \Carbon_Fields\Container as Container;
use \Carbon_Fields\Field as Field;
//Config
#@ini_set( 'upload_max_size' , '24M' );
#@ini_set( 'post_max_size', '24M');
#@ini_set( 'max_execution_time', '300' );
/* 
 * Sorce Theme Base Class
 *
 * @package         sorce
 * @author          Ben Toth
 * @license         Commercial
 * @link            https://ben-toth.com
 * @copyright       2021 Sorce
 *
 * @wordpress-theme Functions File
 * @BitBucketLink:  Add BitBucket address here
 * fopen('_filename.scss', 'w') (w for writing, a for appending)
 * $file = fopen('_filename.scss', 'w');
 * 
 * fwrite("text", $file);
 * fclose($file);
 * 
*/

defined( 'ABSPATH' ) OR exit;

if ( ! class_exists( '\sorce\Theme' ) ) {
    /**
    * Theme instantiated using the singleton pattern
    */
   
    \add_action( 'after_setup_theme', array ( '\sorce\Theme', 'get_instance' ), 1 );
    
    class Theme {
 
        private static $instance = null;

        // Theme Settings Generic
        const version = '1.0.0';
        static $mode = 'development'; //accepts "development" and "production" arguments
        const textdomain = 'sorce'; // name of the theme ##
        const nicename = 'Sorce'; // Nice Name with caps & spaces for menus etc.
        static $logo_dimensions = array('width'=> 200, 'height' => 34 );
        //Instance
        public static function get_instance() 
        {

            if ( null == self::$instance ) {

                self::$instance = new self;

            }

            return self::$instance;
        }
        
        private function __construct() {
            
            // load libraries ##
            self::load_classes();
            // enqueue scripts & styles
            \add_action ('wp_enqueue_scripts', array(get_class(), 'theme_enqueue'));

            //add theme support
            \add_action( 'after_setup_theme', array(get_class(), 'add_theme_support'), 2);

            //add theme menus & pages
            \add_action( 'after_setup_theme', array(get_class(), 'add_theme_pages'), 5);
            \add_action( 'after_setup_theme', array(get_class(), 'add_theme_menus'), 5);

            //add post types
            \add_action( 'after_setup_theme', array(get_class(), 'add_post_types'), 5);

            //add taxonomies
            #\add_action( 'init', array(get_class(), 'add_theme_taxonomies') );
            
            //add endpoints to the theme REST API
           # \add_action( 'after_setup_theme', array(get_class(), 'add_theme_endpoints'));

            //add vendors & dependencies
            require_once get_template_directory() . '/admin/add_fields.php';
            #require_once( 'vendor/autoload.php' );
            require_once get_template_directory() . '/admin/form_integration.php';

            \add_filter( 'show_admin_bar', '__return_false' );

            //add actions & filters
            \add_filter( 'wpcf7_autop_or_not', '__return_false' );

            //utilities 
            \add_filter('upload_mimes', array(get_class(), 'allow_svg_uploads'));

        }

        public static function add_theme_endpoints(){

            \add_action( 'rest_api_init', function () {
                register_rest_route( self::textdomain.'/v1', '/themeversion/', array(
                  'methods' => 'GET',
                  'callback' => array('\sorce\Theme', 'return_version'),
                  'args' => array(
                    ),
                  ),
                );
            });
        }

        public static function return_version(){
            #Example function for theme REST endpoints
            return self::version;
        }
        
        public static function nicename( $name ){
            $conjunctions = array(
                'for','and','or','nor','but','yet', 'so'
            );
            $prepositions = array(
                'above', 'across', 'against', 'along', 'among', 'around', 
                'at', 'before', 'behind', 'below', 'beneath', 'beside', 
                'between', 'by', 'down', 'from', 'in', 'into', 'near', 'of', 
                'off', 'on', 'to', 'toward', 'under', 'upon', 'with', 'within'
            );
            $return_name = '';
            $name = str_replace('_', ' ', $name);
            $name = str_replace('-', ' ', $name);
            $wordarray = explode(' ', $name);
            
            foreach($wordarray as $word){
                if(!in_array($word, $conjunctions, true) && !in_array($word, $prepositions, true ) ){
                    $word = ucfirst($word);
                } 
                $return_name.=$word . ' ';
            }
            $return_name = trim($return_name);
            return $return_name;
        }




        public static function add_theme_page( $slug, $name ){
            $new_page_id = false;
            $title = self::nicename($name);
            $content = '';
            //check if page currently exists
            $page_check = \get_page_by_path($slug, OBJECT, 'page');
            $page = array(
                    'post_type' => 'page',
                    'post_title' => $title,
                    'post_content' => $content,
                    'post_status' => 'publish',
                    'post_name' => $slug
            );
            //if not, add it
            if( !isset($page_check->ID) ){
                $new_page_id = \wp_insert_post($page);
            }
            return $new_page_id;
        }
        public static function assign_home_page( $id ){
            //have we already made this assignment once?
            $assigned = \get_option(self::textdomain . '_home_page_assigned');
            if($assigned) {
                return false;
            }
            //is there already a static home page?
            if('page' == \get_option('show_on_front')){
                return false;
            } else {
                //if our home page is the current one
                if($id == \get_option( 'page_on_front' )){
                    return false;
                } else {
                    \update_option( 'page_on_front', $id);
                    \update_option( 'show_on_front', 'page' );
                    \update_option(self::textdomain . '_home_page_assigned', 1);
                    return true;
                }
            }
        }
        
        public static function add_theme_pages(){
            //add pages
            $frontpage = self::add_theme_page('front-page', ucfirst(self::textdomain) . ' home');
            $coachform = self::add_theme_page('coach-upload', 'Coach Upload Form' );

            //assign static home page to homepage
            if($frontpage) self::assign_home_page($frontpage);
        }

        public static function theme_add_li_class( $classes, $item, $args, $depth ){
            if(isset($args->add_li_class)) {
                $classes[] = $args->add_li_class;
            }
            return $classes;
        }

        public static function add_theme_menus(){
            //register theme menu locations
            \register_nav_menu(self::textdomain . '_main_nav',__( ucfirst(self::textdomain) . ' Theme Main Menu', self::textdomain ));
            \register_nav_menu(self::textdomain . '_footer_left_nav',__( 'Footer Menu Left', self::textdomain ));
            \register_nav_menu(self::textdomain . '_footer_right_nav',__( 'Footer Menu Right', self::textdomain ));

            //register our Bootstrap Navwalker walker class
            require_once get_template_directory() . '/core/wp-bootstrap-navwalker.php';

            $menus = array(
                ucfirst(self::textdomain) . ' Main Menu' => self::textdomain . '_main',
                ucfirst(self::textdomain) . ' Footer Menu Left' => self::textdomain . '_footer_left',
                ucfirst(self::textdomain) . ' Footer Menu Right' => self::textdomain . '_footer_right',
            );
            # \set_theme_mod( 'nav_menu_locations', $locations ); 
            $theme_navs = \get_theme_mod( 'nav_menu_locations' );
           foreach($menus as $menu => $slug ){

                $menu_exists = \wp_get_nav_menu_object( $slug );
                if( !$menu_exists && !is_wp_error($menu_exists) ){
                    $menu_id = \wp_create_nav_menu($slug);
                    
                } else { $menu_id = $menu_exists->term_id; }
                if(!array_key_exists( $slug .'_nav', $theme_navs) ){
                    $theme_navs[$slug .'_nav'] = $menu_id;
                } 

           }
           \set_theme_mod('nav_menu_locations', $theme_navs);

                      

            //add a filter to 
            \add_filter('nav_menu_css_class', array(get_class(), 'theme_add_li_class'), 10, 4);
        }

        public static function add_theme_support(){

            \add_theme_support( 'title-tag' );
            \add_theme_support( 'post-thumbnails' );
            \add_theme_support( 'custom-header', array('upload' => true, 'header_image' => true) );
            \add_theme_support( 'custom-logo',  array(
                'height'=>self::$logo_dimensions['height'], 
                'width'=> self::$logo_dimensions['width'],
                'flex-height' => true,
                'flex-width'  => true,
             ));
            \add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption', 'style', 'script' ) );
            \add_theme_support( 'wp-block-styles' );

        }
        
        private static function load_classes() {

            #Load the Main Theme Classes
            require_once \get_template_directory().'/core/customizer.php';   
            require_once \get_template_directory().'/core/options.php';  

            #Load utility classes
            require_once \get_template_directory(). '/core/template-helpers.php';


            #Load Footer widget area and insert sub widgets
            #require_once \get_template_directory(). '/classes/widgets.php';

            #Model View Control files
            require_once \get_template_directory().'/core/mvc/model.php';
            require_once \get_template_directory().'/core/mvc/view.php';
            require_once \get_template_directory().'/core/mvc/control/modules.php';
            require_once \get_template_directory().'/core/mvc/control/components.php';

            #Load the Components 
            #require_once \get_template_directory().'/template-parts/components/featurecard.php'; 

        }
        public static function allow_svg_uploads( $mimes ){
            if(!isset($mimes['svg'])){
                $mimes['svg'] = 'image/svg+xml';
            }
            return $mimes;
        }
        public static function theme_enqueue(){
            #set bootstrap version if bootstrap
            $bs_version = '5.1.0';
            $is_bootstrap = \carbon_get_theme_option('is_bootstrap');
            
            $theme_js_deps = array('runtime');
           # $theme_css_deps = array('bootstrap-css');
           $theme_css_deps = array();
    
            if($is_bootstrap == 'yes') {
                
                if(self::$mode = 'development'){
                    \wp_enqueue_style(
                        'bootstrap-css',
                        \get_template_directory_uri().'/theme/dist/css/'.'bootstrap.css',
                        array(),
                        $bs_version, 
                        'all'
                    );
                    \wp_enqueue_style(
                        'bootstrap-css-map',
                        \get_template_directory_uri().'/theme/dist/css/'.'bootstrap.css.map',
                        array(),
                        $bs_version, 
                        'all'
                    );
                    
                    
                } else {
                    \wp_enqueue_style(
                        'bootstrap-css',
                        \get_template_directory_uri().'/theme/dist/css/'.'bootstrap.min.css',
                        array(),
                        $bs_version, 
                        'all'
                    );
                    \wp_enqueue_style(
                        'bootstrap-css-map',
                        \get_template_directory_uri().'/theme/dist/css/'.'bootstrap.min.css.map',
                        array(),
                        $bs_version, 
                        'all'
                    );  
                }
                array_push($theme_js_deps, "bootstrap-js");
               # array_push($theme_css_deps, "bootstrap-css");
                
                /*
                \wp_enqueue_script(
                    'popper',
                    'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js',
                    array('jquery'),
                    '1.12.9',
                    false
                );
                */
                \wp_enqueue_script(
                    'bootstrap-js', 
                    'https://stackpath.bootstrapcdn.com/bootstrap/'.$bs_version.'/js/bootstrap.min.js',
                    array(),
                    $bs_version,
                    false
                );

                
            }
            \wp_enqueue_script('theme-js',\get_template_directory_uri().'/theme/dist/js/'.self::textdomain.'_js.js', $theme_js_deps, self::version, false);
            \wp_enqueue_script('themefooter-js',\get_template_directory_uri().'/theme/dist/js/'.self::textdomain.'_footer.js', $theme_js_deps, self::version, true);
            \wp_enqueue_style('theme-css',\get_template_directory_uri().'/theme/dist/css/'.self::textdomain.'.css', $theme_css_deps, self::version, 'all');  
           # \wp_enqueue_style('bootstrap-overwrites',\get_template_directory_uri().'/theme/dist/css/'.self::textdomain.'.css', $theme_css_deps, self::version, 'all');  
            \wp_enqueue_script('runtime', 'https://unpkg.com/regenerator-runtime@0.12.1/runtime.js', array(), '12.1', false);
            #vendors

            #localizations
            \wp_localize_script('theme-js', self::textdomain, 
                array(
                    'ajaxurl' => \admin_url('admin-ajax.php'),
                    'mode'   => self::$mode,
                    self::textdomain.'_nonce'   => \wp_create_nonce( self::textdomain )
                )
            );
        }
        /* Adds the Post Type as a class in the #content div
        * further nested into the DOM than wp_head functions
        */
        public static function add_post_baseclass() {
            if( get_the_ID() ) {
                if( get_post_type( get_the_ID() ) ){
                    echo ' '.get_post_type( get_the_ID());
                }
            }
        }
        /* Adds the Post Type as a class in the #content div
        * further nested into the DOM than wp_head functions
        */
        public static function add_post_types(){
            #Add post types here
            # $example_args = array( 'taxonomies' => array( 'example-taxonomy' ) );
            # $new_post_type = self::add_posttype('movies', 'movie', $example_args );


        }

        public static function add_posttype( $plural, $singular, $args = null ){


            $labels = array(
                'name'               => _x( ucfirst($plural), 'post type general name', self::textdomain ),
                'singular_name'      => _x( ucfirst($singular), 'post type singular name', self::textdomain ),
                'menu_name'          => _x( ucfirst($plural), 'admin menu', self::textdomain ),
                'name_admin_bar'     => _x( ucfirst($plural), 'add new on admin bar', self::textdomain ),
                'add_new'            => _x( 'New', ucfirst($singular), self::textdomain ),
                'add_new_item'       => __( 'New ' . ucfirst($singular), self::textdomain ),
                'new_item'           => __( 'New ' . ucfirst($singular), self::textdomain ),
                'edit_item'          => __( 'Edit '. ucfirst($singular), self::textdomain ),
                'view_item'          => __( 'View '. ucfirst($singular), self::textdomain ),
                'all_items'          => __( 'All ' . ucfirst($plural), self::textdomain ),
                'search_items'       => __( 'Search '. ucfirst($plural), self::textdomain ),
                'not_found'          => __( 'No '.ucfirst($plural).' found.', self::textdomain ),
                'not_found_in_trash' => __( 'No '.ucfirst($plural).' found in Trash.', self::textdomain )
            );
            
            $default = array(
                'labels'             => $labels,
                'description'        => __( ucfirst(self::nicename) .' '. ucfirst($plural), self::textdomain ),
                'public'             => true,
                'publicly_queryable' => true,
                'show_ui'            => true,
                'show_in_menu'       => true,
                'query_var'          => true,
                'rewrite'            => array( 'slug' => trim(strtolower($plural)) ),
                'capability_type'    => 'post',
                'has_archive'        => true,
                'hierarchical'       => false,
                'show_in_menu'       => true,
                'menu_icon'          => 'dashicons-pressthis',
                'menu_position'      => 5,
                'show_in_rest'       => true,
                'rest_base'          => trim(strtolower($plural)),
                'rest_controller_class' => 'WP_REST_Posts_Controller',
                'supports'           => array( 'editor','title', 'custom-fields', 'page-attributes','thumbnail'),
                'taxonomies'         => array()       
            );
            if(is_array($args)){
                #merge the defaults
                $default = array_merge($default, $args);
            }
        
            \register_post_type( $plural, $default );
        }

        public static function add_branches_taxonomy(){
            #first add taxonomy
            $firstrun_pages = \get_option('southport_firstrun');
            
            self::add_theme_taxonomy('branch', 'branches', self::$apply_theme_taxonomies );
            #then add terms
            if(!$firstrun_pages) self::add_taxonomy_terms( 'branches' );
            

        }

        public static function add_theme_taxonomy( $singular, $plural, $applies_to_content ) {
            $nicesingular = ucwords(str_replace('_', ' ', $singular));
            $niceplural = ucwords(str_replace('_', ' ', $plural));
            \register_taxonomy( $plural, $applies_to_content, array(
            'hierarchical' => true,
            'labels' => array(
                'name' => _x( ucwords($plural), 'taxonomy general name' ),
                'singular_name' => _x( $nicesingular, 'taxonomy singular name' ),
                'search_items' =>  __( 'Search ' . $niceplural ),
                'all_items' => __( 'All ' . $niceplural ),
                'edit_item' => __( 'Edit '. $nicesingular ),
                'update_item' => __( 'Update '. $nicesingular),
                'add_new_item' => __( 'Add New '. $nicesingular ),
                'new_item_name' => __( 'New '. $nicesingular ),
                'menu_name' => __( $niceplural ),
            ),
            // Control the slugs used for this taxonomy
            'rewrite' => array(
                'slug' => $plural, // This controls the base slug that will display before each term
                'with_front' => false,
                'hierarchical' => false
                
            ),
            'show_in_rest' => true,
            'query_var' => true,
            'public' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'show_admin_column' => true
            ));
        } 
    }
}