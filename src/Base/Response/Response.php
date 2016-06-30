<?php

/**
 * Created by PhpStorm.
 * User: xiaos
 * Date: 16/6/29
 * Time: 14:12
 */
namespace Paopao\Base\Response;

abstract class Response {

    //状态码
    protected $ret = 200;
    //实体数据
    protected $data = array();
    //说明
    protected $msg = '';
    //响应头
    protected $headers = array();

    public function setRet($ret) {
        $this->ret = $ret;
        return $this;
    }

    public function setData($data) {
        $this->data = $data;
        return $this;
    }

    public function setMsg($msg) {
        $this->msg = $msg;
        return $this;
    }

    public function addHeaders($key, $content) {
        $this->headers[$key] = $content;
    }

    /** ------------------ 结果输出 ------------------ **/

    /**
     * 结果输出
     */
    public function output() {
        $this->handleHeaders($this->headers);

        $rs = $this->getResult();

        echo $this->formatResult($rs);
    }

    /** ------------------ getter ------------------ **/

    public function getResult() {
        $rs = array(
            'ret' => $this->ret,
            'data' => $this->data,
            'msg' => $this->msg,
        );

        return $rs;
    }


    public function getHeaders($key = NULL) {
        if ($key === NULL) {
            return $this->headers;
        }

        return isset($this->headers[$key]) ? $this->headers[$key] : NULL;
    }

    /** ------------------ 内部方法 ------------------ **/

    protected function handleHeaders($headers) {
        foreach ($headers as $key => $content) {
            @header($key . ': ' . $content);
        }
    }

    abstract protected function formatResult($result);
}