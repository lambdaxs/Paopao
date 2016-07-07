<?php

namespace Paopao\Base\Request;

use Paopao\Base\Exception\PaopaoException;
use Paopao\Base\Response\JsonResponse;
use Paopao\Base\Core;

/**
 * Created by PhpStorm.
 * User: xiaos
 * Date: 16/6/29
 * Time: 14:11
 * @property Core\Api $classInstance
 */


class Request
{


    private $request;
    private $preName;
    private $className;
    private $functionName;
    private $params;

    private $classInstance;

    public function __construct($projectName)
    {
        $this->request = $_REQUEST;
        $this->preName = 'Paopao\\'.$projectName.'\\Api\\';
        $this->getAction();
        $this->getParams();

    }


    private function getAction(){
        $action = array_shift($this->request);
        list($this->className,$this->functionName) = explode('/',$action);
        $this->className = $this->preName . $this->className;
    }

    private function getParams(){
        $this->params = $this->request;

        if (!empty($_POST)){
            $this->params = $_POST;
        }
    }

    
    /**
     * 获取响应
     * @return JsonResponse
     */
    public function getResponse(){
        $rs = new JsonResponse();

        try {
            if (!class_exists($this->className)) {
                throw new PaopaoException($this->className . '类不存在', 400);
            }

            $this->classInstance = new $this->className();

            //将请求体赋值给api对象的requestBody属性
            $this->classInstance->requestBody = @file_get_contents('php://input');
            //将响应对象赋值给api对象的response属性
            $this->classInstance->response = $rs;

            //获取接口文档数据
            $apiDocs = $this->classInstance->getApis();


            //判断接口方法是否存在于检查对象和文档中
            if (!method_exists($this->classInstance,$this->functionName) || !array_key_exists($this->functionName,$apiDocs)){
                throw new PaopaoException($this->className.'.'.$this->functionName.'方法不存在',400);
            }

            //获取方法中的参数数据 自省抛错
            $paramDocs = $apiDocs[$this->functionName];

            foreach ($paramDocs as $key => $value){
                if (array_key_exists($key,$this->params)){
                    $this->classInstance->$key = $this->params[$key];
                }else {
                    if (!$value['required']){
                        $this->classInstance->$key = $value['default'];
                    }else {
                        throw new PaopaoException('缺少参数:'.$key,400);
                    }
                }
            }

            $func = $this->functionName;
            $rs->setData($this->classInstance->$func());
            $rs->setMsg('success');

        }catch (PaopaoException $e){
            $rs->setRet($e->getCode());
            $rs->setMsg($e->getMessage());
        }catch (\Exception $e){
            $rs->setRet(500);
            $rs->setMsg($e->getMessage());
        }
        return $rs;
    }

}