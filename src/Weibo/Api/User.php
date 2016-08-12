<?php

namespace Paopao\Weibo\Api;

use Paopao\Base\Core\Api;
use Paopao\Base\Core\Tool;
use Paopao\Weibo\Domain;
use Paopao\Weibo\Model;

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
        $age =  ['desc' => '用户年龄 范围0-100','required' => true];

        return [
            'getInfo' => [
                'name' => $name,
                'age' => $age
            ],
            'getHeader' => [

            ],
        ];
    }

    public function getInfo(){
        $domain = new Domain\User();
        return $domain->getName($this->name);
    }

    public function getHeader(){
        Tool::logInfo('getHeader','this is info');
        return $_SERVER;
    }

    
}