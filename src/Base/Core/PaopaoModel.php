<?php
namespace Paopao\Base\Core;

use Paopao\Base\DB\Model;
use Paopao\Base\DB\PaopaoORM;

/**
 * Created by PhpStorm.
 * User: xiaos
 * Date: 16/6/29
 * Time: 14:14
 */


/**
 * 方法声明
 * @method select($id,...)
 * @method insert($id,...)
 * @method update($id,...)
 * @method delete($d,...)
 */
abstract class PaopaoModel implements Model
{

    /**
     * 快速获取id实体对象
     * @param string $id
     * @param string/array $fields
     */
    public function get($id, $fields = '*') {
        $needFields = is_array($fields) ? implode(',', $fields) : $fields;
        $notorm = $this->getORM($id);

        $rs = $notorm->select($needFields)
            ->where('id', $id)->fetch();

        $this->parseExtData($rs);

        return $rs;
    }

    public function insert($data, $id = NULL) {
        $this->formatExtData($data);

        $notorm = $this->getORM($id);
        $notorm->insert($data);

        return $notorm->insert_id();
    }

    public function update($id, $data) {
        $this->formatExtData($data);

        $notorm = $this->getORM($id);
        return $notorm->where('id', $id)->update($data);
    }

    public function delete($id) {
        $notorm = $this->getORM($id);

        return $notorm->where('id', $id)->delete();
    }

    /**
     * 对LOB的ext_data字段进行格式化(序列化)
     */
    protected function formatExtData(&$data) {
        if (isset($data['ext_data'])) {
            $data['ext_data'] = json_encode($data['ext_data']);
        }
    }

    /**
     * 对LOB的ext_data字段进行解析(反序列化)
     */
    protected function parseExtData(&$data) {
        if (isset($data['ext_data'])) {
            $data['ext_data'] = json_decode($data['ext_data'], true);
        }
    }

    /**
     * 根据主键值返回对应的表名，注意分表的情况
     */
    abstract protected function getTableName($id);



    /**
     * 快速获取ORM实例，注意每次获取都是新的实例
     * @param string/int $id
     * @return PaopaoModel
     */
    public function getORM($id = NULL) {
        $table = $this->getTableName($id);
        $orm = PaopaoORM::getInstance();
        return $orm->$table;
    }

    
    public function getTable($tableName){
        return $this->getPaopaoORM($tableName);
    }

    /**
     * 返回可操作的notorm对象
     * @param string $tableName 表名
     * @return PaopaoModel
     */
    protected function getPaopaoORM($tableName){
        $orm = PaopaoORM::getInstance();
        $table = $tableName;
        return $orm->$table;
    }
}