<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
return array(
//    'router' => array(
//        'routes' => array(
//            'blog' => array(
//                'type'    => 'Literal',
//                'options' => array(
//                    'route'    => '/blog',
//                    'defaults' => array(
//                        '__NAMESPACE__' => 'Blog\Controller',
//                        'controller'    => 'Blog',
//                        'action'        => 'index',
//                    ),
//                ),
//                'may_terminate' => true,
//                'child_routes' => array(
//                    'default' => array(
//                        'type'    => 'Segment',
//                        'options' => array(
//                            'route'    => '/[:controller[/:action]]',
//                            'constraints' => array(
//                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
//                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
//                            ),
//                            'defaults' => array(
//                            ),
//                        ),
//                    ),
//                ),
//            ),
//
//        ),
//    ),
    
    
    'router' => [
        'routes' => [
            'blog' => [
                'type'    => 'segment', #Literal
                'options' => [
                    'route'    => '/blog[/:action][/:id]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller' => 'Blog\Controller\Blog',
                        'action'     => 'index',
                    ],
                ],
                'may_terminate' => true,
                'child_routes' => [
                    
                ],
            ],
        ],
    ],
    
    'controllers' => array(
//         'invokables' => array(
//             'Blog\Controller\List' => 'Blog\Controller\ListController'
//         )
        'factories' => array(
            'Blog\Controller\List' => 'Blog\Factory\ListControllerFactory',
            'Blog\Controller\Write' => 'Blog\Factory\WriteControllerFactory',
            'Blog\Controller\Blog' => function($sm) {
    
                $realServiceLocator = $sm->getServiceLocator();
                $postService = $realServiceLocator->get('Blog\Service\PostServiceInterface');
                $postInsertForm = $realServiceLocator->get('FormElementManager')->get('Blog\Form\PostForm');

                return new \Blog\Controller\BlogController(
                        $postService, $postInsertForm
                );
            }
        )
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
    'service_manager' => array(
        'invokables' => array(
        #'Blog\Service\PostServiceInterface' => 'Blog\Service\PostService'
        ),
        'factories' => array(
            'Blog\Mapper\PostMapperInterface' => 'Blog\Factory\ZendDbSqlMapperFactory',
            'Blog\Service\PostServiceInterface' => 'Blog\Factory\PostServiceFactory',
            'Zend\Db\Adapter\Adapter' => 'Zend\Db\Adapter\AdapterServiceFactory',
        ),
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
    
    
    'navigation' => array(
        'default' => array(
            array(
                'label' => 'Blog',
                'route' => 'blog',
                'pages' => array(
                    array(
                        'label' => 'Add',
                        'route' => 'blog',
                        'action' => 'add',
                    ),
                    array(
                        'label' => 'List',
                        'route' => 'blog',
                        'action' => 'list',
                        'pages' => array(
                            array(
                                'label' => 'Edit',
                                'route' => 'blog',
                                'action' => 'edit',
                            ),
                            array(
                                'label' => 'Delete',
                                'route' => 'blog',
                                'action' => 'delete',
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
    
    
    
);
