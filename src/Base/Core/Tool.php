<?php


namespace Paopao\Base\Core;

use Paopao\Base\Response;
use  Paopao\Base\Request;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

use Paopao\Base\Exception\PaopaoException;

/**
 * Created by PhpStorm.
 * User: xiaos
 * Date: 16/7/19
 * Time: 18:02
 * @property Response\Response $response
 */

class Tool
{

    public static $response;
    public static $requestBody;



    public static function addHeader($key,$value){
        self::$response->addHeaders($key,$value);
    }


    //将数组转为可插入sql的散列 ['name','age'] ---> ['name'=>$this->name,'age'=>$this->age];
    public static function formatSQL($obj,$cols)
    {
        $newArray = [];
        foreach ($cols as $value) {
            $newArray[$value] = $obj->$value;
        }
        return $newArray;
    }

    //打印info日志
    public static function logInfo($name,$content){
        $logger = self::logger($name,'info');
        $logger->addInfo($content);
    }

    public static function logWarning($name,$content){
        $logger = self::logger($name,'warning');
        $logger->addWarning($content);
    }

    public static function logNotice($name,$content){
        $logger = self::logger($name,'notice');
        $logger->addNotice($content);
    }

    public static function logDebug($name,$content){
        $logger = self::logger($name,'debug');
        $logger->addDebug($content);
    }

    public static function logError($name,$content){
        $logger = self::logger($name,'error');
        $logger->addError($content);
    }

    private static function logger($name,$type){
        $logger = new Logger($name);
        $logger->pushHandler(new StreamHandler(PAOPAO_LOG_DIR.'/'.$type.'.log', Logger::DEBUG));
        return $logger;
    }


    //抛出错误信息
    public static function showErrorMessage($msg,$code){
        throw new PaopaoException($msg,$code);
    }
}