<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
return array(
    // 该行为 RouteManager 打开配置
    'router' => array(
        // 打开所有可能路径的配置O
        'routes' => array(
            
            'tutorial' => array(
                'type' => 'literal',
                'options' => array(
                    'route' => '/tutorial',
                    'defaults' => array(
                        'controller' => 'Tutorial\Controller\DB',
                        'action' => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'detail' => array(
                        'type' => 'segment',
                        'options' => array(
                            'route' => '/:id',
                            'defaults' => array(
                                'action' => 'detail'
                            ),
                            'constraints' => array(
                                'id' => '[1-9]\d*'
                            )
                        )
                    ),
//                    'add' => array(
//                        'type' => 'literal',
//                        'options' => array(
//                            'route' => '/add',
//                            'defaults' => array(
//                                'controller' => 'Blog\Controller\Write',
//                                'action' => 'add'
//                            )
//                        )
//                    ),
//                    'edit' => array(
//                        'type' => 'segment',
//                        'options' => array(
//                            'route' => '/edit/:id',
//                            'defaults' => array(
//                                'controller' => 'Blog\Controller\Write',
//                                'action' => 'edit'
//                            ),
//                            'constraints' => array(
//                                'id' => '\d+'
//                            )
//                        )
//                    ),
//                    'delete' => array(
//                        'type' => 'segment',
//                        'options' => array(
//                            'route' => '/delete/:id',
//                            'defaults' => array(
//                                'controller' => 'Blog\Controller\Delete',
//                                'action' => 'delete'
//                            ),
//                            'constraints' => array(
//                                'id' => '\d+'
//                            )
//                        )
//                    ),
                ),
            )
        )
    ),
    'controllers' => array(
         'invokables' => array(
             'Tutorial\Controller\DB' => 'Tutorial\Controller\DBController'
         )
//        'factories' => array(
//            'Blog\Controller\List' => 'Blog\Factory\ListControllerFactory',
//            'Blog\Controller\Write' => 'Blog\Factory\WriteControllerFactory',
//        )
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
    'service_manager' => array(
//        'invokables' => array(
//        #'Blog\Service\PostServiceInterface' => 'Blog\Service\PostService'
//        ),
//        'factories' => array(
//            'Blog\Mapper\PostMapperInterface' => 'Blog\Factory\ZendDbSqlMapperFactory',
//            'Blog\Service\PostServiceInterface' => 'Blog\Factory\PostServiceFactory',
//            'Zend\Db\Adapter\Adapter' => 'Zend\Db\Adapter\AdapterServiceFactory',
//        ),
    ),
    'db' => array(
        'driver' => 'Pdo',
        'username' => 'root', //edit this
        'password' => 'rootadmin', //edit this
        'dsn' => 'mysql:dbname=zend;host=localhost',
        'driver_options' => array(
            \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''
        )
    ),
);
