<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Application\Model;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\Sql\Select;
use Zend\Paginator\Paginator;
use Zend\Paginator\Adapter\DbSelect;

use Application\Model\News;

/**
 * NewsTable 类的主要是通过TableGateway 数据网关来实现对数据库操作。
 */
class NewsTable {

    protected $tableGateway;

    // 构造函数
    public function __construct(TableGateway $tg) {
        $this->tableGateway = $tg;
    }

    // 获取数据表的数据
    public function fetchAll($paginated = false) {
        // 判断是否使用分页
        if ($paginated) {
            // 实例化一个 select ,对指定表进行操作
            $select = new Select('news');
            // 实例化一个结果集，用来保存查询结果
            $rs = new ResultSet();
            // 设置结果集的操作属性
            $rs->setArrayObjectPrototype(new News());
            // 实例化一个DbSelect，并通过数据网关及select来对数据库进行操作，
            // 并将最终结果传递到$rs结果集中
            $pageAdapter = new DbSelect($select, $this->tableGateway->getAdapter(), $rs);
            // 实例化一个分页导航，并将DbSelect 传递过去
            $paginator = new Paginator($pageAdapter);
            // 返回分页导航实例
            return $paginator;
        }

        $resultSet = $this->tableGateway->select();
        return $resultSet;
    }

    public function saveNews(News $news) {
        // 将传递过来的数据保存到数组中
        // 因为在ZF2中对数据的操作很多是通过数组来传递的
        $data = array(
            'content' => $news->content,
            'title' => $news->title
        );

        $id = (int) $news->id;

        if ($id == 0) {
            // 如果id不存在的时候将数据里的数据插入到数据库，此处实现插入功能
            $this->tableGateway->insert($data);
        } else {
            // 如果id存在的时候，对数据库里指定id的数据行进行更新
            if ($this->getNews($id)) {
                $this->tableGateway->update($data, array('id' => $id));
            } else {
                throw new \Exception("Could not find row {$id}");
            }
        }
    }
    
    public function getNews($id) {
        // 将传递过来的id强制转换为整形
        $id = (int) $id;
        // 根据id查询新闻结果集
        $rowset = $this->tableGateway->select(array('id' => $id));
        // 取出结果集的第一行记录
        $row = $rowset->current();
        // 判断是否存在指定id 的新闻记录行，如果不存在则抛出一个异常
        if (!$row) {
            throw new \Exception("Could not find row {$id}");
        }

        return $row;
    }
    
    public function deleteNews($id) {
        // 根据传递过来的id删除新闻记录
        $this->tableGateway->delete(array('id' => $id));
    }

}
