<?php
/**
 * Created by PhpStorm.
 * User: xiaos
 * Date: 16/6/29
 * Time: 14:39
 */

namespace Paopao\Base\Response;


class JsonResponse extends Response {


    //添加响应头
    public function __construct()
    {
        $this->addHeaders("Content-Type","text/html;charset=utf-8");
    }

    //json格式化输出
    protected function formatResult($result)
    {
        return json_encode($result);
    }

}