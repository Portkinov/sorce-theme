<?php
namespace sorce\core\mvc\control;
use sorce\Theme as Theme;


#abstract class Modules {
    class Modules {
    public static $good_field_types = array(
        'text', 'textarea', 'conditional', 'bullet', 'image', 'rich_text'
    );

    public static function make($pagename = '', $modulename = '', $fieldarray, $newview = false){
        $pagefilename = self::filename($pagename);
        $modfilename = self::filename($modulename);
        $modclassname = self::camelCase($modulename);
        $fields = self::checkfields($fieldarray);
        self::register_templates($pagefilename, $fields);
        self::build_php_component($modfilename, $modclassname, $fields);
        if($newview) self::build_php_view($modfilename, $modclassname, $fields);
        self::build_css_file($modfilename, $fields );
        self::build_css_page($pagefilename);
    }
    private static function register_templates($pagename, $fields){

        $optionkey = $pagename . '_template_fields';
        $oldoptions = maybe_unserialize( \get_option($optionkey));
        if($oldoptions){
            $all_options = array_merge($fields, $oldoptions);
        } else {
            $all_options = $fields;
        }
        \update_option($optionkey, $all_options);

    }
    private static function build_php_view( $modfilename, $modclassname, $fields ){
        #checks for unique && arguments
        $code = self::build_php_view_code($modfilename, $modclassname, $fields );

        if($code){

            $new_module_php = fopen( \get_template_directory() . '/theme/views/'. $modfilename .'.php', 'w' );
            fwrite( $new_module_php, $code );
            fclose($new_module_php);
            chmod(\get_template_directory() . '/theme/views/'. $modfilename .'.php', 0775);
            return true;
        } else {
            return false;
        }
    }
    private static function build_php_component( $modfilename, $modclassname, $fields ){
        #checks for unique && arguments
        $code = self::build_php_code($modfilename, $modclassname, $fields );

        if($code){
            $new_module_php = fopen( \get_template_directory() . '/template-parts/components/'. $modfilename .'.php', 'w' );
            fwrite( $new_module_php, $code );
            fclose($new_module_php);
            chmod(\get_template_directory() . '/template-parts/components/'. $modfilename .'.php', 0775);
            return true;
        } else {
            return false;
        }
    }

    private static function build_css_file( $modname, $fields ){
        #checks for unique && arguments
        $code = self::build_css_code($modname, $fields );
        if($code){
            $new_module_css = fopen( \get_template_directory() . '/theme/src/scss/modules/components/_'.$modname.'.scss', 'w' );
            if($new_module_css){
                fwrite( $new_module_css, $code );
                fclose($new_module_css);
                chmod(\get_template_directory() . '/theme/src/scss/modules/components/_'.$modname.'.scss', 0775);
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    private static function build_css_page( $modname ){
        #checks for unique && arguments
        $code = self::build_css_page_code($modname );
        if($code){
            $new_module_css = fopen( \get_template_directory() . '/theme/src/scss/pages/_'.$modname.'.scss', 'w' );
            if($new_module_css){
                fwrite( $new_module_css, $code );
                fclose($new_module_css);
                chmod(\get_template_directory() . '/theme/src/scss/pages/_'.$modname.'.scss', 0775);
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    private static function build_css_code( $modname, $fields){
        if(Theme::$mode === 'development'){
            if(!self::does_css_exist($modname)){
                $markup = '.' . Theme::textdomain . '-modules .' . $modname . '{ '. PHP_EOL;
                $markup.= ''. PHP_EOL;
                $markup.= ''. PHP_EOL;
                $markup.= '/* Fields:'. PHP_EOL;
                foreach($fields as $key => $value){                    
                    $markup.= $key . ' : '.$value . PHP_EOL;
                }
                $markup.= '*/'. PHP_EOL;
                $markup.= ''. PHP_EOL;
                $markup.= ''. PHP_EOL;
                $markup.= '}'. PHP_EOL; 
                return $markup;
            }
        }
    }
    private static function build_css_page_code($page){
        if(Theme::$mode === 'development'){
            if(!self::does_css_page_exist($page)){
                $markup = '#page-' . $page . '{ '. PHP_EOL;
                $markup.= ''. PHP_EOL;
                $markup.= ''. PHP_EOL;
                $markup.= ''. PHP_EOL;
                $markup.= ''. PHP_EOL;
                $markup.= '}'. PHP_EOL; 
                $markup.= ''. PHP_EOL;
                $markup.= ''. PHP_EOL;
                $markup.= '@media screen and (max-width:991px){'. PHP_EOL;
                $markup.= '    #page-' . $page . '{ '. PHP_EOL;
                $markup.= ''. PHP_EOL;
                $markup.= ''. PHP_EOL;
                $markup.= '    }';
                $markup.= '}';

                return $markup;
            }
        }
    }
    private static function build_php_view_code( $modfilename, $modclassname, $fields ){
        if(Theme::$mode === 'development'){
            $varname = str_replace('-','_',$modfilename);
            if(!self::does_view_exist( $modfilename)){
                $markup = '<?php ' . PHP_EOL;
                $markup.= 'require_once \get_template_directory().\'/template-parts/components/'.$modfilename.'.php\';  ';
                $markup.= ''. PHP_EOL;
                $markup.= ''. PHP_EOL;
                $markup.= 'use \\'.Theme::textdomain .'\core\TemplateHelpers as TemplateHelpers;';
                $markup.= ''. PHP_EOL;
                $markup.= 'use \\'.Theme::textdomain .'\components\\'.$modclassname.' as '.$modclassname.';';
                $markup.= ''. PHP_EOL;
                $markup.= ''. PHP_EOL;
                $markup.= '$'. $varname . ' = new ' . $modclassname . '(';
                $markup.= ''. PHP_EOL;
                foreach($fields as $name => $type){
                    $markup.='        $this->'.$name.', '. PHP_EOL;
                }
                $markup.= ');'. PHP_EOL;
                $markup.= '$'.$varname . '->render();' . PHP_EOL;
                $markup.= ''. PHP_EOL;
                $markup.= ''. PHP_EOL;

                $markup.= "TemplateHelpers::Spacer('padding-top:10vw;');" . PHP_EOL;
                $markup.= ''. PHP_EOL;
                return $markup;
            } else {
                return false;
            }
        }
    }

    private static function build_php_code( $modfilename, $modclassname, $fields ){
        if(Theme::$mode === 'development'){
            if(!self::does_module_exist( $modfilename)){
                $markup = '<?php ' . PHP_EOL;
                $markup.= 'namespace ' . Theme::textdomain . '\\components;'. PHP_EOL;
                $markup.= ''. PHP_EOL;
                $markup.= 'class ' . $modclassname . '{ '. PHP_EOL;
                $markup.= ''. PHP_EOL;
                $markup.= '    public $html; '. PHP_EOL;
                $markup.= ''. PHP_EOL;
                $markup.= '    public function __construct( ';
                foreach ($fields as $name => $type){
                    $markup.='$'.$name.' = "", ';
                }
                $markup = rtrim($markup);
                $markup = rtrim($markup,',');
                $markup.= '){ '. PHP_EOL;
                foreach($fields as $name => $type){
                    $markup.='        $this->'.$name.' = $'.$name.' ? $'.$name.' : false; '. PHP_EOL;
                }
                $markup.= '        $this->html = $this->get_html( ';
                foreach($fields as $name => $type){
                    $markup.='$this->'.$name.', ';
                }
                $markup = rtrim($markup);
                $markup = rtrim($markup,',');
                $markup.= '); '. PHP_EOL;
                $markup.= '    }' . PHP_EOL;
                $markup.= ''. PHP_EOL;
                $markup.= ''. PHP_EOL;
                $markup.= '    private function get_html( ';
                foreach($fields as $name => $type){
                    $markup.='$'.$name.', ';
                }
                $markup = rtrim($markup);
                $markup = rtrim($markup,',');
                $markup.= '){ '. PHP_EOL;
                $markup.= '        #add your gatekeeping logic here '. PHP_EOL;
                $markup.= '        $markup =\'<div class="containerwrap '.strtolower($modclassname).'">\';'. PHP_EOL;
                $markup.= '        $markup.=\'<div class="container-fluid component p-0 m-0">\';'. PHP_EOL;
                $markup.= ''. PHP_EOL;
                $markup.= ''. PHP_EOL;
                $markup.= ''. PHP_EOL;
                $markup.= ''. PHP_EOL;
                $markup.= '        $markup .=\'</div></div>\'; '. PHP_EOL;
                $markup.= '        return $markup; '. PHP_EOL;
                $markup.= '    }'. PHP_EOL;
                $markup.= '    public function render(){ echo $this->html; }'. PHP_EOL;
                $markup.= '}';
                return $markup;
            }
        }
    }

    /* utility functions */
    private static function is_zero_based($fields){
        foreach($fields as $key => $value ){
            if($key === 0 ){
                return true;
            } else {
                return false;
            }
        }
    }
    private static function destructure_fields($fields){
        $main = array();
        foreach($fields as $index => $array){
            foreach($array as $key => $value){
                $main[$key] = $value;
            }
        }
        return $main;
    }
    private static function checkfields( $fields ){
        #if we get array in [0] => array( 'key' => 'value'), format we need to destructure
        if( self::is_zero_based( $fields )) $fields = self::destructure_fields( $fields);

        $sanitized_fields = array();

        foreach($fields as $key => $value){

            if(in_array($value, self::$good_field_types)) $sanitized_fields[$key] = $value;
        }
        return $sanitized_fields;
    }
    private static function filename($modname){
        return strtolower( str_replace(' ', '-', $modname));
    }
    private static function camelCase( $name ){
        $camel = '';
        $nameArray = explode(' ', $name);
        foreach($nameArray as $name){
            $camel.=(ucfirst(strtolower($name)));
        }
        return $camel;
    }

    private function does_page_exist( $page_name ){
        return file_exists( \get_template_directory() . '/theme/views/'.strtolower($page_name).'.php');
    }
    private static function does_css_exist($module_name){
        return file_exists( \get_template_directory() . '/theme/src/scss/modules/components/_'.$module_name.'.scss');
    }
    private static function does_css_page_exist($module_name){
        return file_exists( \get_template_directory() . '/theme/src/scss/pages/_'.$module_name.'.scss');
    }
    private static function does_module_exist( $module_name ){
        return file_exists( \get_template_directory() . '/template-parts/components/'.$module_name.'.php');
    }
    private static function does_view_exist( $module_name ){
        return file_exists( \get_template_directory() . '/theme/views/'.$module_name.'.php');
    }

}