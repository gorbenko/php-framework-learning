<?php defined('SITE') or die('No direct script access.');

require 'core.php';
$site = new Site();

require 'section.php';

function request() {
    global $site;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $module_name = $_REQUEST['mod'];
        $action      = 'action' . '_' . $_REQUEST['action'];
        $module_path = Site::buildModulePath($module_name);

        if (file_exists($module_path)) {
            $site->loadModule($module_name);
            $class_name    = 'Module' . ucfirst($module_name);
            $class_methods = get_class_methods($class_name);

            if (in_array($action, $class_methods)) {
                $module = new $class_name;

                if (in_array('before', $class_methods)) {
                    $module->before();
                }

                $module->$action();

                if (in_array('after', $class_methods)) {
                    $module->after();
                }
            } else {
                Site::printMessage("Action $action not exist!", MESSAGE_FAIL);
            }
        } else {
            Site::printMessage("Module $module_name not found!", MESSAGE_FAIL);
        }
    }
}

request();
