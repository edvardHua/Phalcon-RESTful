## Phalcon-RESTful-Server

Phalcon 框架的 RESTful Server 最佳实践

#### 依赖

> Apache 需要开启 rewrite_module 

> Phalcon (http://phalconphp.com)

> Memcached

> Chrome 上的 Postman插件 

> apiDoc (https://github.com/apidoc/apidoc)

#### 该Demo包含

* 接口权限控制ACL
* 基本RESTful方法的例子
* 接口版本控制，使用.htaccess实现
* 常用方法封装
* apiDoc自动生成文档

#### 使用

* git clone https://github.com/edvardHua/Phalcon-RESTful-Server.git
* 将schema文件夹的sql文件数据库中，并修改v1.0/config/config.ini的连接信息
* 导入postman_collection内的脚本，即可在postman上进行请求和测试
* 项目使用apiDoc生成文档，若要查看示例api，进入doc文件夹，双击打开index.html即可

#### 项目框架
![image](https://github.com/edvardHua/Phalcon-RESTful-Server/raw/master/img/framework.png)
