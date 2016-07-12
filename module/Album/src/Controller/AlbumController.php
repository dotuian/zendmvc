<?php
namespace Album\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use Album\Model\Album;
use Album\Form\AlbumForm;

class AlbumController extends AbstractActionController
{
    // Add this property:
    protected $albumTable;

    public function __construct() {
    }

    // 完成对 TableGateway 的实例化
    public function getAlbumTable() {
        
        if (!$this->albumTable) {
            // 获取本地已经初化的服务管理器及服务
            $sm = $this->getServiceLocator();
            // 获取在模块文件中的相关函数
            $this->albumTable = $sm->get('Album\Model\AlbumTable');
        }
        return $this->albumTable;
    }
    
    public function listAction(){
        $view = $this->indexAction();
        $view->setTemplate('album/album/index');
        return $view;
    }
    
    public function indexAction() {
        
        $paginator = $this->getAlbumTable()->fetchAll(true);

        $paginator->setCurrentPageNumber((int) $this->params()->fromQuery('page', 1));
        $paginator->setItemCountPerPage(5);

        return new ViewModel(array('paginator' => $paginator));
    }

    public function addAction()
    {
        $form = new AlbumForm();
        $form->get('submit')->setValue('Add');

        $request = $this->getRequest();

        if (! $request->isPost()) {
            return ['form' => $form];
        }

        $album = new Album();
        $form->setInputFilter($album->getInputFilter());
        $form->setData($request->getPost());

        if (!$form->isValid()) {
            return ['form' => $form];
        }

        $album->exchangeArray($form->getData());
        var_dump($this->getAlbumTable());
        
        $this->getAlbumTable()->saveAlbum($album);
        return $this->redirect()->toRoute('album');
    }


    public function editAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);

        if (0 === $id) {
            return $this->redirect()->toRoute('album', ['action' => 'add']);
        }

        // Retrieve the album with the specified id. Doing so raises
        // an exception if the album is not found, which should result
        // in redirecting to the landing page.
        try {
            $album = $this->getAlbumTable()->getAlbum($id);
        } catch (\Exception $e) {
            return $this->redirect()->toRoute('album', ['action' => 'index']);
        }

        $form = new AlbumForm();
        $form->bind($album);
        $form->get('submit')->setAttribute('value', 'Edit');

        $request = $this->getRequest();
        $viewData = ['id' => $id, 'form' => $form];

        if (! $request->isPost()) {
            return $viewData;
        }

        $form->setInputFilter($album->getInputFilter());
        $form->setData($request->getPost());

        if (! $form->isValid()) {
            return $viewData;
        }

        $this->getAlbumTable()->saveAlbum($album);

        // Redirect to album list
        return $this->redirect()->toRoute('album', ['action' => 'index']);
    }


    public function deleteAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('album');
        }

        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost('del', 'No');

            if ($del == 'Yes') {
                $id = (int) $request->getPost('id');
                $this->getAlbumTable()->deleteAlbum($id);
            }

            // Redirect to list of albums
            return $this->redirect()->toRoute('album');
        }

        return array(
            'id'    => $id,
            'album' => $this->getAlbumTable()->getAlbum($id)
        );
    }
    
    
    // 验证是否可能对指定的用户名与密码进行认证
    public function authAction() {

        $auth = new \Album\Model\MyAuth();

        if ($auth->auth()) {
            echo "Authentication Success";
        } else {
            echo "Authentication Failure";
        }
        exit;
    }

    // 验证持久性验证是否有效
    public function isauthAction() {

        $auth = new \Album\Model\MyAuth();

        if ($auth->isAuth()) {
            echo "Already Authentication Success";
        } else {
            echo "Authentication Failure";
        }
        exit;
    }

}


