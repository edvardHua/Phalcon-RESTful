<?php
/**
 * Class index
 * @author Edvard
 * @time 2015.12.14 12:13
 */

use Phalcon\Config\Adapter\Ini as ConfigIni;
use Phalcon\Mvc\Micro;
use Phalcon\Loader;

try {

    /**
     * 加载配置文件，db，memcache，debug，charset
     */
    $config = new ConfigIni(__DIR__ . '/config/config.ini');
    // 设置为GMT0
    date_default_timezone_set($config->other->gmt);

    /**
     * 加载公共的代码
     */
    include __DIR__ . '/config/common.lib.php';

    // 注册模块
    $loader = new Loader();
    $loader->registerDirs(
        array(
            __DIR__ . $config->application->modelsDir,
            __DIR__ . $config->application->formsDir,
            __DIR__ . $config->application->behaviorsDir,
            __DIR__ . $config->application->controllersDir
        )
    )->register();

    // 方便使用自定义组件
    $loader->registerNamespaces(array(
            "Custom\\Models"  => __DIR__ . $config->application->modelsDir,
            "Custom\\Models\\Behaviors"  => __DIR__ . $config->application->behaviorsDir,
            "Custom\\Controllers"  => __DIR__ . $config->application->controllersDir
        )
    );
    /**
     * 注册di，db服务
     */
    include __DIR__ . "/config/service.php";

    $app = new Micro($di);

    /**
     * 路由配置
     */
    include __DIR__ . "/config/routes.php";

    /**
     * 配置access control list
     */
    include __DIR__ . "/config/acl_plugin.php";

    $app->handle();

} catch (Exception $e) {
    if (true == $config->other->debug) {
        echo var_dump($e);
    } else {
        echo "Exception: ", $e->getMessage();
    }
}

