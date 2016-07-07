<?php
namespace Paopao\Base\Core;

use Paopao\Base\Exception\PaopaoException;
/**
 * Created by PhpStorm.
 * User: xiaos
 * Date: 16/6/29
 * Time: 14:14
 */
class Domain
{

   protected function showErrorMessage($msg,$code){
        throw new PaopaoException($msg,$code);
   }
    
}