<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Album\Listener;

use Zend\EventManager\EventInterface;
use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\AbstractListenerAggregate;
use Zend\Mvc\MvcEvent;
use Zend\Log\Logger;

/**
 * 通过事件管理器来添加log的实例
 */
class LogListener extends AbstractListenerAggregate {

    protected $logger = null;

    function __construct(Logger $logger) {
        $this->logger = $logger;
    }

    public function attach(EventManagerInterface $eventManager) {
        $eventManager->attach(MvcEvent::EVENT_DISPATCH, array($this, 'preDispatchLog'), 2);
        $eventManager->attach(MvcEvent::EVENT_DISPATCH, array($this, 'postDispatchLog'), 0);
    }

    public function preDispatchLog(EventInterface $e) {
        $event = $e->getName();
        $params = $e->getParams();
        $this->logger->info(sprintf('BEFORE EVENT_DISPATCH %s: %s', $event, json_encode($params)));
//        var_dump(__METHOD__);
    }

    public function postDispatchLog(EventInterface $e) {
        $event = $e->getName();
        $params = $e->getParams();
        $this->logger->info(sprintf('AFTER EVENT_DISPATCH%s: %s', $event, json_encode($params)));
//        var_dump(__METHOD__);
    }

}
