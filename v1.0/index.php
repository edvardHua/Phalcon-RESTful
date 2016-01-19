<?php
/**
 * Class index
 * @author Edvard
 * @time 2015.12.14 12:13
 */
use Phalcon\Mvc\Micro;
use Phalcon\Loader;

try {

    /**
     * 加载配置文件，db，memcache，debug，charset
     */
    include __DIR__ . '/config/config.php';

    /**
     * 加载公共的代码
     */
    include __DIR__ . '/config/common.lib.php';

    // 注册模块
    $loader = new Loader();
    $loader->registerDirs(
        array(
            __DIR__ . '/models/',
            __DIR__ . '/controller/'
        )
    )->register();

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
    if (true == $_CONFIG['debug']) {
        echo var_dump($e);
    } else {
        echo "Exception: ", $e->getMessage();
    }
}

