<?php

class ModuleGallery extends Module {

    private $module_name = 'gallery';

    function __construct() {
        $this->render();
    }

    public function render() {
        $script_path = Site::buildModulePath($this->module_name, true) . $this->module_name . '.js';

        return <<<EOT
            <div class="{$this->module_name}">
                <script type="text/javascript" src="{$script_path}"></script>
                <h2 class="{$this->module_name}-title">Фотогаллерея</h2><br>
                <input type="button" class="{$this->module_name}-ajax-button" value="Получить фото (ajax)">
            </div>
EOT;
    }

    public function action_getImage() {
        echo "<img src='/images/cat.jpg' class='{$this->module_name}-image' alt='cat'>";
    }
}
