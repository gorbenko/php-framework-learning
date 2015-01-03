<?php
    define('SITE', true);

    require_once 'config.php';
    require 'application.php';

    require_once __DIR__ . '/vendor/autoload.php';

    $loader = new Twig_Loader_Filesystem(__DIR__);
    $twig = new Twig_Environment($loader);
    $template = $twig->loadTemplate('main.html');

    echo $template->render(array(
        'lang'  => $config['site']['lang'],
        'title' => $config['site']['title'],
        'sections' => array(
            'top' => Section::_('top'),
            'left' => Section::_('left'),
            'right' => Section::_('right')
        )
    ));
