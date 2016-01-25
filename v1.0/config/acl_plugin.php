<?php
/**
 * User: Edvard
 * Date: 2016/1/15
 * Time: 12:31
 */

$acl = new Phalcon\Acl\Adapter\Memory(); // 加载内存，提高访问速度

$acl->setDefaultAction(Phalcon\Acl::DENY); // 默认不允许访问

$acl->addRole(new Phalcon\Acl\Role('User'));
$acl->addRole(new Phalcon\Acl\Role('Admin'));

// 这里是继承，第一个参数是儿子，第二个参数是父亲
//$acl->addInherit('User','Guest');

/*
 * 资源，定义访问的接口
 * */
$arrResources = [
    'User' => [
        'UserController' => ['login', 'logout'],
    ],
    'Admin' => [
    ]
];

foreach ($arrResources as $arrResource) {
    foreach ($arrResource as $controller => $arrMethods) {
        $acl->addResource(new Phalcon\Acl\Resource($controller), $arrMethods);
    }
}

foreach ($acl->getRoles() as $objRole) {
    $roleName = $objRole->getName();

    if ($roleName == 'Admin') {
        foreach ($arrResources['Admin'] as $resource => $method) {
            $acl->allow($roleName, $resource, $method);
        }
    }

    if ($roleName == 'User') {
        foreach ($arrResources['User'] as $resource => $method) {
            $acl->allow($roleName, $resource, $method);
        }
    }
}

$app->before(function () use ($app, $acl) {
    $arrHandler = $app->getActiveHandler();
    $controller = str_replace('Controller\\', '', get_class($arrHandler[0]));
    $baseController = new BaseController();
    $cacheToken = $baseController->verifyToken();
    if (false == $cacheToken){
        $auth = 'User';
    }
    else{
        $auth = $cacheToken->auth;
    }
    $allowed = $acl->isAllowed($auth, $controller, $arrHandler[1]);
    if(false == $allowed){
        $app->response = $baseController->tokenError(); // 返回无权限，提示信息和token错误一致
        $app->response->send();
        return false;
    }
    return true;
});
