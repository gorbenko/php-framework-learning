<?php

class ModuleGallery extends Module {

    private $module_name = 'gallery';

    function __construct() {
        $this->render();
    }

    public function render() {
        return <<<EOT
            <div class="{$this->module_name}">
                <h2 class="{$this->module_name}-title">Фотогаллерея</h2>
                <form>
                    <input type="file">
                </form>
            </div>
EOT;
    }

}
