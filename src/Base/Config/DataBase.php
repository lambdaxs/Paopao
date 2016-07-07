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
            'password' => 'xs1994',
            'port' => '3306',
            'charset' => 'UTF8'
        ];
        return $result;
    }

}