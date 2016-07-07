<?php
namespace Paopao\Base\Core;

use Paopao\Base\Response;
use  Paopao\Base\Request;
use  Paopao\Base\Core\Domain;
/**
 * Created by PhpStorm.
 * User: xiaos
 * Date: 16/6/29
 * Time: 14:14
 * @property Response\JsonResponse $response
 * @property mixed $requestBody
 */
abstract class Api
{

    //请求体中的内容 使用时注意过滤
    protected $requestBody;
    //返回响应的对象 可以添加请求头
    protected $response;


    public function __set($name, $value)
    {
        $this->$name = $value;
    }

    public function __get($name)
    {
        return $this->$name;
    }

    abstract public function getApis();
}