<?php

namespace Paopao\ios\Api;

/**
 * Created by PhpStorm.
 * User: xiaos
 * Date: 16/7/6
 * Time: 16:32
 */

use Paopao\Base\Core\Api;
use Paopao\ios\Model;

class Count extends Api
{
    public function getApis()
    {
        $appId =   ['desc' => '应用ID','required'=>true];
        $appName =   ['desc' => '应用名字','required'=>true];
        $appVersion = ['desc' => '操作系统版本','required'=>true];
        $province =   ['desc' => '应用归属省份','required'=>true];

        $machineModel =    ['desc' => '设备型号','required'=>true];
        $systemVersion = ['desc' => '操作系统版本','required'=>true];
        $machineUUID =    ['desc' => '设备的uuid','required'=>true];

        

        $name = ['desc' => '姓名','required'=>true];
        $age = ['desc'=>'年龄','required'=>true];
        
        return [
            'test' => [
                // 'name' => $name,
                // 'age' => $age,
            ],
            
            'appInstallInfo' => [
                'appId' => $appId,
                'appName' => $appName,
                'appVersion' => $appVersion,
                'province' => $province,
                'systemVersion' => $systemVersion,
                'machineModel' => $machineModel,
                'machineUUID' => $machineUUID,
            ],
            
        ];
    }
    
    public function test(){
        return ['body' => $this->requestBody];
        // return ['key1' => $this->name,'key2' => $this->age];
    }

    //统计应用安装信息
    public function appInstallInfo(){
        $model = new Model\Count();
        return $model->getTable('bonc_ios_install')->insert([
            'appId' => $this->appId,
                'appName' => $this->appName,
                'appVersion' => $this->appVersion,
                'province' => $this->province,
                'systemVersion' => $this->systemVersion,
                'machineModel' => $this->machineModel,
                'machineUUID' => $this->machineUUID,
        ]);
    }



    //统计设备信息
    public function deviceInfo(){
        $model = new Model\Count();
        return $model->insert([
            'appId' => $this->appId,
            'type' => $this->type,
            'version'=>$this->version,
            'uuid'=>$this->uuid]);
    }

    //统计应用使用信息
    public function appUseInfo(){
        $model = new Model\Count();
        return $model->getTable('bonc_ios_use')->insert([
            'appId' => $this->appId,
            'uuid' => $this->uuid,
        ]);
    }
}