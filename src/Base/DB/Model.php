<?php
/**
 * Created by PhpStorm.
 * User: xiaos
 * Date: 16/6/29
 * Time: 16:23
 */

namespace Paopao\Base\DB;


interface Model {

    /**
     * 根据主键读取纪录
     *
     * @param long $id 纪录主键
     * @param string/array $fields 需要获取的表字段，可以为字符串(如：name,from)或数组(如：array('name', 'from'))
     * @return array 数据库表纪录
     */
    public function get($id, $fields = '*');

    /**
     * 插入新纪录
     * 这里看起来有点奇怪，但如果我们需要进行分表存储，这里的参考主键是需要的
     *
     * @param array $data 待插入的数据，可以包括ext_data字段
     * @param $id 分表参考主键
     * @return long 新插入纪录的主键值
     */
    public function insert($data, $id = NULL);

    /**
     * 根据主键更新纪录
     *
     * @param long $id 主键
     * @param array $data 待更新的数据，可以包括ext_data字段
     * @return TRUE/FALSE
     */
    public function update($id, $data);

    /**
     * 根据主键删除纪录
     */
    public function delete($id);
}