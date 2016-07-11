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

//定义 IndexController 类库，同时此类必需继承 AbstractActionController 类，
//这是ZF2 的硬性要求，除非你重写此类的实现。
class IndexController extends AbstractActionController
{   
    //控制器的一个响应动作，其中indexAction 这个名称为ZF默认动作
    public function indexAction()
    {
        return new ViewModel();
    }

    public function testAction(){
        echo date('Y-m-d');
        return new ViewModel();
    }
}
