<?php
/**
 * Created by PhpStorm.
 * User: xiaos
 * Date: 16/7/6
 * Time: 16:28
 */

require_once '../vendor/autoload.php';

use Paopao\Base\Request\Request;

$request = new Request('ios');
$respones = $request->getResponse();
$respones->output();
