<?php

require_once '../vendor/autoload.php';

use Paopao\Base\Request\Request;


$request = new Request('Weibo');
$respones = $request->getResponse();
$respones->output();

