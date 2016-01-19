<?php
/**
 * 统一管理路由规则
 * User: Edvard
 * Date: 2016/1/3
 * Time: 16:34
 */

use Phalcon\Mvc\Micro\Collection as MicroCollection;

router($app, 'User', array(
    array(
        'method' => 'post',
        'path' => '/token',
        'action' => 'login'
    ),
    array(
        'method' => 'delete',
        'path' => '/token',
        'action' => 'logout'
    ),
    array(
        'method' => 'get',
        'path' => '/user',
        'action' => 'getDetail'
    )
), false);

function router($app, $controllerName, $requests, $lazyLoad = true)
{
    $class_name = $controllerName . 'Controller';
    $handler = new $class_name;
    $collections = new MicroCollection();
    $collections->setHandler($handler, $lazyLoad);
    foreach ($requests as $action) {
        switch ($action['method']) {
            case 'get':
                $collections->get($action['path'], $action['action']);
                break;
            case 'post':
                $collections->post($action['path'], $action['action']);
                break;
            case 'delete':
                $collections->delete($action['path'], $action['action']);
                break;
            case 'put':
                $collections->put($action['path'], $action['action']);
                break;
        }
    }
    $app->mount($collections);
}
