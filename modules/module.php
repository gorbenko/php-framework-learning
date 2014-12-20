<?php defined('SITE') or die('No direct script access.');

class Module {

    public $script_path;

    function __construct() {
        $this->script_path = Site::buildModulePath($this->module_name, true) . $this->module_name . '.js';
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
