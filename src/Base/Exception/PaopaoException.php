<?php

namespace Paopao\Base\Exception;
use Paopao\Base\Core\Tool;

/**
 * Created by PhpStorm.
 * User: xiaos
 * Date: 16/6/29
 * Time: 14:46
 */
class PaopaoException extends \Exception
{

    public function setCode($code)
    {
        Tool::logError('code',$code);
        $this->code = $code;
    }

    public function setMessage($message)
    {
        Tool::logError('message',$message);
        $this->message = $message;
    }
}