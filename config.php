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
    ),
    'server' => array(
        'xmlrpc' => array(
            'server' => 'localhost'
        )
    )
);

if ($_COOKIE['site_layout']) {
    $config['sections'] = array_merge($config['sections'], json_decode($_COOKIE['site_layout'], true));
}
