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


    public function showTitles($name ,$age){
        return $this->getORM()->select($name,$age)->where('id','2')->fetch();
    }

    public function showTitles1(){
        return $this->get('3',['title','type']);
    }

    public function showOther(){
        $notorm = $this->getPaopaoORM('Courses');
        return $notorm->select('*')->fetchAll();
    }

    protected function getTableName($id)
    {
        return 'blog';
    }
}