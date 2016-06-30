# Paopao
轻量级PHP服务端接口框架

首先要感谢PhalApi提供的灵感，在使用PhalApi的时候，我觉得有必要亲自动手实现一个轻量级的接口开发框架。这个框架应该是更符合现代PHP开发模式的，所以我引入了namespace，遵循PSR-4规范，也全面兼容PHP7版本。

	第一个版本着重解决了各个类的模块划分、路由和请求的解析、以及和notORM库的整合。
	
以新建一个weibo项目为例子。

一、配置数据库
在Base/Config/DataBase.php中配置数据库。

```php
<?php
namespace Paopao\Base\Config;
/**
 * Created by PhpStorm.
 * User: xiaos
 * Date: 16/6/29
 * Time: 14:48
 */
class DataBase
{
    public static function getDBConfig(){
        $result = [
            'host' => 'localhost',
            'name' => 'xiaos',
            'user' => 'root',
            'password' => 'root',
            'port' => '8889',
            'charset' => 'UTF8'
        ];
        return $result;
    }

}
```

二、在src目录下新建如下目录和文件

```js
|____Weibo
	|____Api
		|____User.php
```
User.php

```php
<?php

namespace Paopao\Weibo\Api;

use Paopao\Base\Core\Api;
use Paopao\Weibo\Domain;


/**
 * Created by PhpStorm.
 * User: xiaos
 * Date: 16/6/30
 * Time: 10:50
 */
class User extends Api{

    public function getApis()
    {
        $name = ['desc' => '用户名','required' => false, 'default' => 'xiaos'];
        $age = ['desc' => '用户年龄 范围0-100','required' => true];

        return [
            'getInfo' => [
                'name' => $name,
                'age' => $age
            ],
        ];
    }

    public function getInfo(){
        return ['name' => $this->name, 'age' => $this->age];
//        $domain = new Domain\User();
//        return $domain->getName($this->name, $this->age);
    }

    
}
```
三、在入口文件init.php中配置项目

```php
<?php
require_once '../vendor/autoload.php';

use Paopao\Base\Request\Request;

$request = new Request('Weibo');
$respones = $request->getResponse();
$respones->output();
```	

四、发送请求
http://localhost:port/src/init.php?action=User/getInfo&name=xiaos&age=20

响应结果：

```json
{
  "ret": 200,
  "data": {
    "name": "xiaos",
    "age": "20"
  },
  "msg": ""
}
```
	
	
	


