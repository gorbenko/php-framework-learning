<?php defined('SITE') or die('No direct script access.');

require 'modules/module.php';

define('MESSAGE_SUCCESS', 'success');
define('MESSAGE_FAIL',    'fail');
define('MESSAGE_NORMAL',  'normal');

class Site {

    function __construct() {
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
    }

    public function loadModule($module_name) {
        $module_path = $this->buildModulePath($module_name);

        if (file_exists($module_path)) {
            require_once $module_path;
        }

        return $this;
    }

    static function buildModulePath($module_name, $dir = false) {
        global $config;

        $result = $config['site']['modules_path'] .
            DIRECTORY_SEPARATOR .
            $module_name .
            DIRECTORY_SEPARATOR;

        if (!$dir) {
            $result .= $module_name . '.php';
        }

        return $result;
    }

    static function printMessage($message, $theme, $onlyReturn = false) {
        $result = "<div class='message message-{$theme}'>{$message}</div>";

        if (!$onlyReturn) {
            echo $result;
        } else {
            return $result;
        }
    }

}
