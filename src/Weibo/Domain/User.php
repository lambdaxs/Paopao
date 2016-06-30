<?php
/**
 * Created by PhpStorm.
 * User: xiaos
 * Date: 16/6/30
 * Time: 10:52
 */

namespace Paopao\Weibo\Domain;

use Paopao\Weibo\Model;

class User
{
    public function getName($name, $age){
        $model = new Model\BlogModel();
        return $model->showTitles($name, $age);
    }
}