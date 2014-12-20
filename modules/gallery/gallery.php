<?php

class ModuleGallery extends Module {

    public $module_name = 'gallery';

    function __construct() {
        parent::__construct();

        $this->render();
    }

    public function render() {
        return <<<EOT
            <div class="{$this->module_name} module">
                <script type="text/javascript" src="{$this->script_path}"></script>
                <h2 class="{$this->module_name}-title">Фотогаллерея</h2><br>
                <span class="{$this->module_name}-image-wrap">
                    <input type="button" class="{$this->module_name}-ajax-button" value="Загрузить фото (ajax)">
                </span>
                <br><br>
                <a href='/index2.php?mod=gallery&action=getImage' target='_blank'>Вывод изображений в браузер</a>
            </div>
EOT;
    }

    public function action_getImageTag() {
        echo "<img src='/images/dubai.jpg' class='{$this->module_name}-image' alt='cat'>";
    }

    public function action_getImage() {
        $im = imagecreatefromjpeg('images/dubai.jpg');

        header('Content-Type: image/jpeg');

        imagejpeg($im, null, 100);
        imagedestroy($im);
    }

}
