<?php

/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
// 指定命名空间

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;

//定义 IndexController 类库，同时此类必需继承 AbstractActionController 类，
//这是ZF2 的硬性要求，除非你重写此类的实现。
class IndexController extends AbstractActionController {

    //控制器的一个响应动作，其中indexAction 这个名称为ZF默认动作
    public function indexAction() {
        $this->getLogger()->debug('debug...');
        $this->getLogger()->info('info...');
        $this->getLogger()->warn($_GET);

        return new ViewModel();
    }

    public function testAction() {
        echo date('Y-m-d');
        return new ViewModel();
    }

    // 获取服务器管理器中注册的Logger实例
    protected function getLogger() {
        return $this->getServiceLocator()->get('Zend\Log\Logger');
    }

    public function jsonAction() {

        $result = false;
        $response = array('result' => $result);
        if ($result == false) {
            $response['error_message'] = 'Failed to update.';
        }

//        $jsonModel = new JsonModel($response);
//        $jsonModel->setTerminal(true);
//        return $jsonModel;

        echo \Zend\Json\Json::encode($response);
        exit;
    }

}
