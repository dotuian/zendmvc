<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;

use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Application\Model\News;
use Application\Model\NewsTable;

class Module
{   
    //启动模块，onBootstrap() 将调用每个已经实现此功能的模块，
    //并且用于执行轻量级任务和注册事件监听器等
    public function onBootstrap(MvcEvent $e)
    {
        // 多国语言支持，这个语言文件需要自已添加
        $application = $e->getApplication()->getServiceManager()->get('translator');

        // 获取当前已经有事件管理器
        $eventManager        = $e->getApplication()->getEventManager();
        
        // 新建一个路由模块监听器
        $moduleRouteListener = new ModuleRouteListener();
        
        // 附加事件管理器
        $moduleRouteListener->attach($eventManager);
        
        
//        $t = $e->getTarget();
//        $t->getEventManager()->attach(
//            $t->getServiceManager()->get('ZfcRbac\View\Strategy\RedirectStrategy')
//        );
        
    }

    // 获取此模块中的配置信息，返回一个符合ZF2自动加载工厂规则的数组
    public function getConfig()
    {
        // 引入模块配置文件
        return include __DIR__ . '/config/module.config.php';
    }

    // 此模块中自动加载配置信息
    public function getAutoloaderConfig()
    {   
        // 导入自动加载空间
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
    
    //模块配置
    //ZF2会在运行的时候自动调用 Module 中的全部方法。
    public function getServiceConfig() {
        // 函数本身只返回一个关联数组，这个关联数据的 键-值 都将在后续中被引用；
        // 同时也可以看出我们目录的配置是针对news 表的操作
        return array(
            'factories' => array(
                'Application\Model\NewsTable' => function($sm) {
                    $tg = $sm->get('NewsTableGateway');
                    $table = new NewsTable($tg);
                    return $table;
                },
                'NewsTableGateway' => function($sm) {
                    $adapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $rs = new ResultSet();
                    $rs->setArrayObjectPrototype(new News());
                    return new TableGateway('news', $adapter, null, $rs);
                }
            ),
        );
    }

}
