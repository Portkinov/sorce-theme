<?php
namespace starter\core\mvc\control;

use \starter\core\mvc\control\Modules as Modules;

class Components extends Modules {

    public static function add_fields( $value, $key){ #switched up to keep syntax with Carbon Fields
        return array($key => $value);
    }
}