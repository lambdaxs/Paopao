<?php

namespace Paopao\ios\Model;

/**
 * Created by PhpStorm.
 * User: xiaos
 * Date: 16/7/6
 * Time: 16:32
 */

use Paopao\Base\Core\PaopaoModel;

class Count extends PaopaoModel
{
    public function getAppTabel(){
        return $this->getPaopaoORM('bonc_ios_app');
    }

    public function getTableName($id)
    {
        return 'bonc_ios_device';
    }
}