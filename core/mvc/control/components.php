<?php
namespace friendlrobot\core\mvc\control;

use \friendlyrobot\core\mvc\control\Modules as Modules;

class Components extends Modules {

    public static function add_fields( $value, $key){ #switched up to keep syntax with Carbon Fields
        return array($key => $value);
    }
}