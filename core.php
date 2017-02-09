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

    static function buildModulePath($module_name, $onlyPath = false) {
        global $config;

        $result = $config['site']['modules_path'] .
            DIRECTORY_SEPARATOR .
            $module_name .
            DIRECTORY_SEPARATOR;

        if (!$onlyPath) {
            $result .= $module_name . '.php';
        }

        return $result;
    }

    static function printMessage($message, $theme, $onlyReturn = false) {
        $loader = new Twig_Loader_Filesystem(__DIR__ . DIRECTORY_SEPARATOR . 'views');
        $twig = new Twig_Environment($loader);

        $template = $twig->loadTemplate('message.html');

        $result = $template->render(array(
            'message' => $message,
            'theme' => $theme
        ));

        if (!$onlyReturn) {
            echo $result;
        } else {
            return $result;
        }
    }

}
