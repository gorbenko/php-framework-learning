<?php defined('SITE') or die('No direct script access.');

class Section {

    private static $stack = array();

    public static function pushStack($module_name, $content) {
        self::$stack[$module_name][] = $content;
    }

    public static function _($section_name) {
        global $config, $site;

        $result = '';

        foreach ($config['sections'][$section_name] as $module) {
            if (array_key_exists($module, self::$stack)) {
                foreach(self::$stack[$module] as $content) {
                    $result .= $content;
                }
            }  else {
                $site->loadModule($module);
                $class_name = 'Module' . ucfirst($module);

                $module = new $class_name;
                $result .= $module->render();
            }
        }

        echo $result;
    }
}
