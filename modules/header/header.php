<?php defined('SITE') or die('No direct script access.');

class ModuleHeader extends Module {

    private $module_name = 'header';

    function __construct() {
        $this->render();
    }

    public function render() {
        return <<<EOT
            <header class="{$this->module_name}">
                <h1 class="header-title"><a class="header-link" href="/">Сайтик</a></h1>
            </header>
EOT;
    }

}
