<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use Application\Form\NewsForm;
use Application\Model\News;


class NewsController extends AbstractActionController {
    
    protected $newsTable;

    public function __construct() {
    }

    // 完成对 TableGateway 的实例化
    public function getNewsTable() {
        
        if (!$this->newsTable) {
            // 获取本地已经初化的服务管理器及服务
            $sm = $this->getServiceLocator();
            // 获取在模块文件中的相关函数
            $this->newsTable = $sm->get('Application\Model\NewsTable');
        }
        return $this->newsTable;
    }
    
    
    public function indexAction() {
        // 默认模板搜索机制就是直接查找对应模块下的视图目录，然后再根据模块配置信息(module.config.php)来搜索相关目录。
        //①先到达模块下的视图目录
        //②根据控制器名称在视图目录找与控制器名称相同的视图子目录
        //③根据action名称最终在视图子目录下找到与action名相同的模板文件

        
        // 实例化一个视图模型，视图模型前面已经讲解，主要是用来解析模板
        $view = new ViewModel();
        
        // 将视图模型返回给前端控制器
        return $view;
    }

    public function listAction() {
        
        //=================================
        // 没有分页
        //=================================
        // 通过模型(数据网关)访问数据库
//        $paginator = $this->getNewsTable()->fetchAll();
//        $view = new ViewModel();
//        $view->setTemplate('application\news\list.phtml');
//        $view->setVariable('paginator', $paginator);
//        return $view;
        
        
        //=================================
        // 分页
        //=================================
        $paginator = $this->getNewsTable()->fetchAll(true);
        $paginator->setCurrentPageNumber((int) $this->params()->fromRoute('page', 1));
        // 设置每个分页将显示的记录行数
        $paginator->setItemCountPerPage(2);
        // 将分页导航对象返回给模板调用
        return new ViewModel(array('paginator' => $paginator));
    }

    public function addAction() {
        // 实例化一个新闻表单
        $form = new NewsForm();
        // 修改新闻表单的提交按钮名称
        $form->get('submit')->setValue('Add');
        
        // 获取用户请求
        $request = $this->getRequest();
        // 判断是否为POST请求
        if ($request->isPost()) {
            $news = new News();
            // 为表单添加过滤器
            $form->setInputFilter($news->getInputFilter());
            // 设置表单数据
            $form->setData($request->getPost());
            // 判断表单是否通过校验
            if ($form->isValid()) {
                // 表单数据进行转换
                $news->exchangeArray($form->getData());
                // 通过模型将表单提交的数据保存到数据库里
                $this->getNewsTable()->saveNews($news);
                // 实现路由跳转
                return $this->redirect()->toRoute('news', array('action' => 'list'));
            }
        }
        
        // 返回一个表单对象
        return array('form' => $form);
    }

    public function editAction() {
        // 从路由中分离id,也就是获取新闻id
        $id = (Int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            // 如果id 不存在则直接跳转到添加新闻页面
            return $this->redirect()->toRoute('news', array('action' => 'add'));
        }
        
        // 如果在获取新闻记录中出现异常则直接跳转到列表页
        try {
            $news = $this->getNewsTable()->getNews($id);
        } catch (\Exception $e) {
            return $this->redirect()->toRoute('news', array('action' => 'list'));
        }
        
//        var_dump($news);
        
        // 实例化一个新闻表单
        $form = new NewsForm();
        // 给表单绑定数据
        $form->bind($news);
        // 设置表单提交按钮名称
        $form->get('submit')->setAttribute('value', 'Edit');
        
        // 获取用户请求
        $request = $this->getRequest();
        // 判断是否通过post提交的请求
        if ($request->isPost()) {
            // 为表单添加过滤器
            $form->setInputFilter($news->getInputFilter());
            // 为表单附加数据
            $form->setData($request->getPost());
            // 判断表单数据是否通过校验
            if ($form->isValid()) {
                // 将编辑后的数据更新到数据库
                $this->getNewsTable()->saveNews($news);
                // 跳转到新闻列表
                $this->redirect()->toRoute('news', array('action' => 'list'));
            }
        }
        
        //返回一个表单对象和新闻id到模板，此处的表单对象与前面章节中插入数据的表单有所区别，
        //此表单里面的标签都已经有数据的了，而之前插入新闻的表单只是一个空的表单。
        return array('id' => $id, 'form' => $form);
    }

    public function deleteAction() {
        // 获取新闻记录id
        $id = (Int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            $this->redirect()->toUrl('/news/list');
        }

        $request = $this->getRequest();
        if ($request->isPost()) {
            // 获取用户处理动作{Yes或No}
            $del = $request->getPost('del', 'No');

            if ($del == 'Yes') {
                $id = (Int) $request->getPost('id');
                
                // 删除指定的新闻记录
                $this->getNewsTable()->deleteNews($id);
            }

            //$this->redirect()->toUrl('/news/list');
            $this->redirect()->toRoute('news', array('action' => 'list'));
        }

        return array('id' => $id, 'news' => $this->getNewsTable()->getNews($id));
    }

}
