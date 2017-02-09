<?php defined('SITE') or die('No direct script access.');

class Module {

    public $script_path;
    public $template;

    function __construct() {
        $this->script_path = Site::buildModulePath($this->module_name, true) . $this->module_name . '.js';

        $template_path = Site::buildModulePath($this->module_name, true) . $this->module_name . '.html';

        if (file_exists($template_path)) {
            $loader = new Twig_Loader_Filesystem(__DIR__ . DIRECTORY_SEPARATOR . $this->module_name);
            $twig = new Twig_Environment($loader);
            $this->template = $twig->loadTemplate($this->module_name . '.html');
        }
    }

    /**
     * Method is called before any action
     */
    function before() {}

    /**
     * Render view
     *
     */
    public function render() {}

    /**
     * Method is called after any action
     */
    function after() {}
}
