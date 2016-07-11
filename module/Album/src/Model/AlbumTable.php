<?php
namespace Album\Model;

use Zend\Db\TableGateway\TableGateway;
//use Zend\Db\TableGateway\TableGatewayInterface;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\Sql\Select;

use Zend\Paginator\Paginator;
use Zend\Paginator\Adapter\DbSelect;

use Album\Model\Album;

class AlbumTable
{
    protected $tableGateway;

    // 构造函数
    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function fetchAll($paginated = false) {
        if ($paginated) {
            $select = new Select('album');
            $rs = new ResultSet();
            $rs->setArrayObjectPrototype(new Album());

            $pageAdapter = new DbSelect($select, $this->tableGateway->getAdapter(), $rs);
            $paginator = new Paginator($pageAdapter);
            return $paginator;
        }

        $resultSet = $this->tableGateway->select();
        return $resultSet;
    }

    public function getAlbum($id)
    {
        $id = (int) $id;
        $rowset = $this->tableGateway->select(['id' => $id]);
        $row = $rowset->current();
        if (! $row) {
            throw new RuntimeException(sprintf(
                'Could not find row with identifier %d',
                $id
            ));
        }

        return $row;
    }

    public function saveAlbum(Album $album)
    {
        $data = [
            'artist' => $album->artist,
            'title'  => $album->title,
        ];

        $id = (int) $album->id;

        if ($id === 0) {
            $this->tableGateway->insert($data);
            return;
        }

        if (! $this->getAlbum($id)) {
            throw new RuntimeException(sprintf(
                'Cannot update album with identifier %d; does not exist',
                $id
            ));
        }

        $this->tableGateway->update($data, ['id' => $id]);
    }

    public function deleteAlbum($id)
    {
        $this->tableGateway->delete(['id' => (int) $id]);
    }
}
