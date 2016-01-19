<?php

$host = $_SERVER["HTTP_HOST"];
if('127.0.0.1' == $host)
    $db = array(
        'host' => 'localhost',
        'username' => 'root',
        'password' => '',
        'dbname' => 'online-encounter',
        'charset' => 'utf8',
    );
else if('test.singou.mo' == $host)
    $db = array(
        'host' => 'localhost',
        'username' => 'weben',
        'password' => 'weben@singou',
        'dbname' => 'weben',
        'charset' => 'utf8',
    );

else if('encounter.singou.mo' == $host)
    $db = array(
        'host' => 'localhost',
        'username' => 'encounter',
        'password' => 'singou,2015',
        'dbname' => 'encounter',
        'charset' => 'utf8',
    );
else // 这里可以放c9的数据库链接
    $db = array(
        'host' => 'localhost',
        'username' => 'edvardhua',
        'password' => '',
        'dbname' => 'weben',
        'charset' => 'utf8',
    );


// 设置为GMT0
date_default_timezone_set("Etc/GMT");
$_CONFIG = array(
    'db' => $db,
    'memcache' => array(
        'host' => 'localhost',
        'port' => 11211,
        'lifeTime' => 7200,
    ),
    'debug' => true
);
