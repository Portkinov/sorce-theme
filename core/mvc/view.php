<?php
namespace friendlyrobot\core\mvc;


//spin it up
#\nv_dailyvibe\theme\Template::get_instance();

class View {
    private $file;
    private $args = array();

    public function __construct( $args, $file ) {//template only renders files in the modules filetree
        $this->args = $args;
        $this->doesfileexist = $this->isfile( $file );
        $this->file = ($this->doesfileexist) ? \get_template_directory() . '/theme/views/'.$file : false;
    }
    public function __set( $key, $val) {
        $this->args[$key] = $val;
    }
    public function __get( $key ){
        return (isset($this->args[$key]) ) ? $this->args[$key] : null;
    }
    private function isfile( $file ){
        return file_exists( \get_template_directory() . '/theme/views/'.$file );
    }
    public function render(){
        //buff
        ob_start();
        //bring params into local variables
        foreach($this->args as $k => $v) {
            $$k = $v;
        }
        //get template for view
        if($this->file) include( $this->file );

        $output_str = ob_get_contents();
        ob_end_clean();
        return $output_str;
    }
      
}