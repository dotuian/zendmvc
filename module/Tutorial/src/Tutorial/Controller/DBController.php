<?php

namespace Tutorial\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Select;
use Zend\Db\ResultSet\ResultSet;

class DBController extends AbstractActionController {

    /**
     * https://framework.zend.com/manual/2.2/en/modules/zend.db.table-gateway.html
     * 
     * @return ViewModel
     */
    public function indexAction() {

        $sm = $this->getServiceLocator();
        $adapter = $sm->get('Zend\Db\Adapter\Adapter');
//        var_dump($adapter);

        $newsTable = new TableGateway('news', $adapter);
        $rowset = $newsTable->select();

        foreach ($rowset as $news) {
//            var_dump($news['title']);
        }

        // 
        $albumTable = new TableGateway('album', $adapter, new \Zend\Db\TableGateway\Feature\RowGatewayFeature('id'));
        
        // 查询select
        $rowset = $albumTable->select(['id' => 3]);
        $news = $rowset->current();
//        var_dump($news);
        
        // 更新update
        $news->title = date('Y-m-d H:i:s');
        $news->save();
        
        // 添加insert
        $insert = array(
            'title'=>'test insert',
            'artist'=>'test content',
        );
//        $albumTable->insert($insert);


//        $resultSet = $adapter->query('select * from news');
//        $rowData = $resultSet->current()->getArrayCopy();
//        var_dump($rowData);
//        foreach ($rowData as $value) {
//            var_dump($value);
//        }
        
        
        //$this->metadata($adapter);
        
        
        $this->multiTables($adapter);

        return new ViewModel(array(
                #'data' => $data,
        ));
    }
    
    private function multiTables($dbAdapter) {
        $select = new Select();
        $select->from('user')->columns(array('*', 'news_id' => 'id'))->join('news', 'user.id=news.id');

        $statement = $dbAdapter->createStatement();
        $select->prepareStatement($dbAdapter, $statement);
        $driverResult = $statement->execute();

        $resultset = new ResultSet();
        $resultset->initialize($driverResult); // can use setDataSource() for older ZF2 versions.

        foreach ($resultset as $row) {
            var_dump($row);
        }
    }

    private function metadata($adapter){
        $metadata = new \Zend\Db\Metadata\Metadata($adapter);

        // get the table names
        $tableNames = $metadata->getTableNames();

        foreach ($tableNames as $tableName) {
            echo 'In Table ' . $tableName . PHP_EOL;

            $table = $metadata->getTable($tableName);


            echo '    With columns: ' . PHP_EOL;
            foreach ($table->getColumns() as $column) {
                echo '        ' . $column->getName()
                    . ' -> ' . $column->getDataType()
                    . PHP_EOL;
            }

            echo PHP_EOL;
            echo '    With constraints: ' . PHP_EOL;

            foreach ($metadata->getConstraints($tableName) as $constraint) {
                /** @var $constraint Zend\Db\Metadata\Object\ConstraintObject */
                echo '        ' . $constraint->getName()
                    . ' -> ' . $constraint->getType()
                    . PHP_EOL;
                if (!$constraint->hasColumns()) {
                    continue;
                }
                echo '            column: ' . implode(', ', $constraint->getColumns());
                if ($constraint->isForeignKey()) {
                    $fkCols = array();
                    foreach ($constraint->getReferencedColumns() as $refColumn) {
                        $fkCols[] = $constraint->getReferencedTableName() . '.' . $refColumn;
                    }
                    echo ' => ' . implode(', ', $fkCols);
                }
                echo PHP_EOL;

            }

            echo '----' . PHP_EOL;
        }

    }

}
