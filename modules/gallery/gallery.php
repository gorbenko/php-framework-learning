<?php

class ModuleGallery extends Module {

    public $module_name = 'gallery';

    function __construct() {
        parent::__construct();

        $this->render();
    }

    public function render() {
        return $this->template->render(array(
            'title' => 'Фотогаллерея',
            'module_name' => $this->module_name,
            'script_path' => $this->script_path
        ));
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
