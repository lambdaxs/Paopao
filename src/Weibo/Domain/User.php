<?php
/**
 * Created by PhpStorm.
 * User: xiaos
 * Date: 16/6/30
 * Time: 10:52
 */

namespace Paopao\Weibo\Domain;

use Paopao\Base\Core\Domain;
use Paopao\Weibo\Model;

class User extends Domain
{
    public function getName($name){
        if ($name == 'xiaos'){
            $this->showErrorMessage('姓名是xiaos',300);
        }
        return "hi,love u!!!";
    }
}