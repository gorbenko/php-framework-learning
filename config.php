<?php defined('SITE') or die('No direct script access.');

    $config = array(
        'site' => array(
            'title' => 'Сайтик',
            'lang'  => 'ru',
            'modules_path' => 'modules'
        ),
        'sections' => array(
            'top'   => array('header'),
            'left'  => array('guestbook'),
            'right' => array('gallery')
        )
    );
