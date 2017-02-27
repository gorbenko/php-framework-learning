<?php defined('SITE') or die('No direct script access.');

require 'core.php';
$site = new Site();

require 'section.php';

function request() {
    global $site;

    if (count($_REQUEST) > 0) {
        $module      = $_REQUEST['mod'];
        $action      = $_REQUEST['action'];
        $module_path = Site::buildModulePath($module);
        $method_name = 'action' . '_' . $action;

        if (file_exists($module_path)) {
            $site->loadModule($module);
            $class_name    = 'Module' . ucfirst($module);
            $class_methods = get_class_methods($class_name);

            if (in_array($method_name, $class_methods)) {
                $module = new $class_name;

                if (in_array('before', $class_methods)) {
                    $module->before();
                }

                $module->$method_name();

                if (in_array('after', $class_methods)) {
                    $module->after();
                }
            } else {
                Site::printMessage("Action $action not exist!", MESSAGE_FAIL);
            }
        } else {
            Site::printMessage("Module $module not found!", MESSAGE_FAIL);
        }
    }
}

request();
