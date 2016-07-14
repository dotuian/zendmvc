<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Blog\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Blog\Controller\ListController;

class ListControllerFactory implements FactoryInterface {

    public function createService(ServiceLocatorInterface $serviceLocator) {
        $serviceLocator = $serviceLocator->getServiceLocator();
        $postService = $serviceLocator->get('Blog\Service\PostServiceInterface');
        return new ListController($postService);
    }

}
