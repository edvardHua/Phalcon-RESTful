<?php
/**
 * User: Edvard
 * Date: 2016/1/15
 * Time: 12:31
 */
use Phalcon\DI\FactoryDefault;

use Phalcon\Db\Profiler as ProfilerDb;
use Phalcon\Logger;
use Phalcon\Session\Adapter\Files as Session;
use Phalcon\Events\Manager as EventsManager;
use Phalcon\Logger\Adapter\File as FileLogger;
use Phalcon\Db\Adapter\Pdo\Mysql as Connection;

$di = new FactoryDefault();

/**
 * 用来DEBUG SQL代码性能
 */
if (true == $config->other->debug) {
    $di->set('profiler', function () {
        return new ProfilerDb();
    }, true);
}

/**
 * 设置db
 */
$di->set('db', function () use ($di, $config) {

    $dbConfig = array(
        'host' => strval($config->database->host),
        'username' => strval($config->database->username),
        'password' => strval($config->database->password),
        'dbname' => strval($config->database->name),
        'charset' => strval($config->database->charset),
    );

    if (false == $config->other->debug) {
        return new Connection($dbConfig);
    }

    /**
     * 下面的为开发配置，会将执行的所有sql语句写入debug.log
     * 文件夹，在生产环境下，使用上面的连接数据库语句
     */
    $eventsManager = new EventsManager();
    $logger = new FileLogger("logs/debug.log");
    $eventsManager->attach('db', function ($event, $connection) use ($logger) {
        if ($event->getType() == 'beforeQuery') {
            $logger->log($connection->getSQLStatement(), Logger::INFO);
        }
    });
    $profiler = $di->getProfiler();
    $eventsManager->attach('db', function ($event, $connection) use ($profiler) {
        if ($event->getType() == 'beforeQuery') {
            $profiler->startProfile($connection->getSQLStatement());
        }

        if ($event->getType() == 'afterQuery') {
            $profiler->stopProfile();
        }
    });

    $connection = new Connection($dbConfig);
    $connection->setEventsManager($eventsManager);
    return $connection;
});

// 设置cache
$di->set('modelsCache', function () use($config) {
    //默认缓存时间为一天
    $frontCache = new \Phalcon\Cache\Frontend\Data(array(
        'lifetime' => 86400
    ));

    //Memcached连接配置 这里使用的是Memcache适配器
    $cache = new \Phalcon\Cache\Backend\Memcache($frontCache, array(
        'host' => $config->memcache->host,
        'port' => $config->memcache->port
    ));

    return $cache;
});

// 开启session
$di->setShared('session', function () {
    $session = new Session();
    $session->start();
    return $session;
});