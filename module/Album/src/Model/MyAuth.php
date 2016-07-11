<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Album\Model;

use Zend\Db\Adapter\Adapter as DbAdapter;
use Zend\Authentication\Adapter\DbTable as AuthAdapter;
use Zend\Authentication\AuthenticationService;

class MyAuth {

    protected $adapter;

    public function __construct() {
        $this->adapter = new DbAdapter(array(
            'driver' => 'Pdo_Mysql',
            'database' => 'zend',
            'host' => 'localhost',
            'username' => 'root',
            'password' => 'rootadmin'
        ));
    }
    
    // 进行认证
    public function auth() {

        $authAdapter = new AuthAdapter($this->adapter);

        $authAdapter
                ->setTableName('user')             // 认证的数据表
                ->setIdentityColumn('username')     // 认证字段
                ->setCredentialColumn('password');  // 校验字段

        $authAdapter
                ->setIdentity('admin')  // 认证值
                ->setCredential('test1234'); // 校验值

        $auth = new AuthenticationService();

        $result = $auth->authenticate($authAdapter);

        if ($result->isValid()) {
            $auth->getStorage()->write($authAdapter->getResultRowObject());
            return true;
        }

        return false;
    }
    
    // 通过持久性认证判断是否已经通过认证
    public function isAuth() {

        $auth = new AuthenticationService();
        if ($auth->hasIdentity()) {
            return true;
        } else {
            return false;
        }

    }

}
