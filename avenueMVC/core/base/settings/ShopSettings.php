<?php

namespace core\base\settings;

use core\base\controllers\Singleton;
use core\base\settings\Settings;

/**
 * Настройки плагина
 */

Class ShopSettings{


    use BaseSettings;

    private $routes = [
        'plugins' => [
            'dir' => false,
            'routes' => [

            ]
        ],
    ];

    private $templateArr = [
        'text' => ['price', 'short', 'name'],
        'textarea' => ['goods_content']
    ];

    private $expansion = 'core/plugin/expansion/';

}