<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Auth;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;

use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\Authentication\Storage;
use Zend\Authentication\AuthenticationService;
use Zend\Authentication\Adapter\DbTable as DbTableAuthAdapter;

class Module implements AutoloaderProviderInterface {

    public function onBootstrap(MvcEvent $e) {
        $eventManager = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
    }

    public function getAutoloaderConfig() {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getConfig() {
        return include __DIR__ . '/config/module.config.php';
    }

//    public function getServiceConfig() {
//        return array(
//            'factories' => array(
//                'Auth\Model\MyAuthStorage' => function($sm) {
//                    return new \Auth\Model\MyAuthStorage('zf_tutorial');
//                },
//
//                'AuthService' => function($sm) {
//                    //My assumption, you've alredy set dbAdapter
//                    //and has users table with columns : user_name and pass_word
//                    //that password hashed with md5
//                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
//                    $dbTableAuthAdapter = new DbTableAuthAdapter($dbAdapter, 'user', 'username', 'password');
//
//                    $authService = new AuthenticationService();
//                    $authService->setAdapter($dbTableAuthAdapter);
//                    $authService->setStorage($sm->get('Auth\Model\MyAuthStorage'));
//
//                    return $authService;
//                },
//            ),
//        );
//    }

}
