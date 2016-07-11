<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Application\Model;

use Zend\Db\Adapter\Adapter;
use Zend\Db\Sql\Sql;
use Zend\Db\ResultSet\ResultSet;

class NewsModel {

    protected $adapter;

    /**
     * 构造函数
     * @param Array $config 数据库连接配置
     */
    public function __construct($config = null) {
        if ($config == null) {
            $this->adapter = new Adapter(array(
                'driver' => 'Pdo_Mysql',
                'database' => 'zend',
                'hostname' => 'localhost',
                'username' => 'root',
                'password' => 'rootadmin'
            ));
        } else {
            $this->adapter = new Adapter($config);
        }
    }

    /**
     * 返回查询结果的第一行数据
     * @param String $table  操作的数据表名
     * @param String $where   查询条件
     * @return  Array
     */
    public function fetchRow($table, $where = null) {
        $sql = "SELECT * FROM {$table}";
        if ($where != null) {
            $sql .= "WHERE {$where}";
        }

        $statement = $this->adapter->createStatement($sql);
        $result = $statement->execute();

        return $result->current();
    }

    /**
     * 返回查询的所有结果
     * @param String $table 数据表名
     * @param String $where 查询条件
     * @return  Array
     */
    public function fetchAll($table, $where = null) {
        $sql = "SELECT * FROM {$table}";
        if ($where != null) {
            $sql .= "WHERE {$where}";
        }

        $stmt = $this->adapter->createStatement($sql);
        $stmt->prepare();
        $result = $stmt->execute();

        $resultset = new ResultSet;
        $resultset->initialize($result);
        $rows = array();
        $rows = $resultset->toArray();
        return $rows;
    }

    /**
     * 返回指定表的所有数据
     * @param String $table 表名
     * @return  Array
     */
    public function getTableRecords($table) {
        $sql = new Sql($this->adapter);
        $select = $sql->select();
        $select->from($table);
        $stmt = $sql->prepareStatementForSqlObject($select);

        $result = $stmt->execute();
        $resultSet = new ResultSet();
        $resultSet->initialize($result);

        return $resultSet->toArray();
    }

    /**
     * 插入数据到数据表
     * @param String $table
     * @param Array $data
     * @return  Int 返回受影响的行数
     */
    public function insert($table, $data) {
        $sql = new Sql($this->adapter);
        $insert = $sql->insert($table);
        $insert->values($data);

        return $sql->prepareStatementForSqlObject($insert)->execute()->getAffectedRows();
    }

    /**
     * 更新数据表
     * @param String $table  数据表名
     * @param String $data   需要更新的数据
     * @param String|Array $where  更新条件
     * @return  Int 返回受影响的行数
     */
    public function update($table, $data, $where) {
        $sql = new Sql($this->adapter);
        $update = $sql->update($table);
        $update->set($data);
        $update->where($where);

        return $sql->prepareStatementForSqlObject($update)->execute()->getAffectedRows();
    }

    /**
     * 删除数据
     * @param String $table 数据表名
     * @param String|Array $where 删除条件
     * @return  Int 返回受影响的行数
     */
    public function delete($table, $where) {
        $sql = new Sql($this->adapter);
        $delete = $sql->delete($table)->where($where);
        return $sql->prepareStatementForSqlObject($delete)->execute()->getAffectedRows();
    }

    /**
     * 返回最后插入的主键值
     * @return  Int
     */
    public function lastInsertId() {
        return $this->adapter->getDriver()->getLastGeneratedValue();
    }

}
