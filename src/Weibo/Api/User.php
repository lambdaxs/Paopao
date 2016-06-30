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