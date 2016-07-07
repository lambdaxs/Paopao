<?php

namespace Paopao\Weibo\Model;

use Paopao\Base\Core\PaopaoModel;

/**
 * Created by PhpStorm.
 * User: xiaos
 * Date: 16/6/30
 * Time: 10:47
 */
class BlogModel extends PaopaoModel {


    public function showAll(){
        return $this->getORM()->select('*')->fetchAll();
    }

    protected function getTableName($id)
    {
        return 'fzq';
    }
}