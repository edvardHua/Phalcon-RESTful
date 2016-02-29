## Phalcon-RESTful-Server

Phalcon 框架的 RESTful Server 最佳实践

#### 依赖

> Apache 需开启 rewrite_module 

> Phalcon (http://phalconphp.com)

> Memcached

> Chrome Postman 

> apiDoc (https://github.com/apidoc/apidoc)

#### 该Demo包含


* 接口版本控制，使用.htaccess实现
* 接口权限控制ACL
* RESTful范例
* 常用方法
* apiDoc

#### 使用

* git clone https://github.com/edvardHua/Phalcon-RESTful-Server.git
* 导入schema文件夹的sql，并修改v1.0/config/config.ini的连接信息
* 导入postman_collection内的脚本，即可在postman上进行请求和测试
* 项目使用apiDoc生成文档，若要查看示例api，进入doc文件夹，双击打开index.html即可

#### 项目文件结构

    ├── doc  文档
    ├── postman_collection 
    │   └── Phalcon-RESTful-Server.json.postman_collection
    ├── schema  
    │   └── db.sql
    └── v1.0 
        ├── config
        │   ├── acl_plugin.php  权限控制
        │   ├── common.lib.php  
        │   ├── config.ini  项目数据库及其他配置
        │   ├── routes.php  路由配置
        │   └── service.php  加载服务
        ├── controllers  控制器
        │   └── apidoc.json  apiDoc配置
        ├── index.php
        ├── libs
        │   └── MemcacheSessionHandle.class.php
        ├── logs  记录运行时产生的SQL
        └── models  模型
            ├── behaviors  配置软删除，时间戳等
            └── validators  数据插入校验

#### 项目框架
![image](https://github.com/edvardHua/Phalcon-RESTful-Server/raw/master/img/framework.png)
