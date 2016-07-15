<?php
namespace Album;

use Zend\ServiceManager\Factory\InvokableFactory;

return [

    // 路径配置区块，可以包括有多条路由
    'router' => [
        'routes' => [
            'album' => [
                'type'    => 'segment', #Literal
                'options' => [
                    'route'    => '/album[/:action][/:id]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller' => 'Album\Controller\Album',
                        'action'     => 'index',
                    ],
                ],
            ],
        ],
    ],

    // 控制器配置区块，此处可以配置控制的使用情况
    'controllers' => [
        'invokables' => array(
            'Album\Controller\Album' => 'Album\Controller\AlbumController'
        ),
    ],
    
    // 视图配置区块，此处配置视图存放路径；Album 模块没有再单独使用layout配置，与之前 的Application共用同一们layout布局
    'view_manager' => [
        'template_path_stack' => [
            'album' => __DIR__ . '/../view',
        ],
    ],
    
    // 服务管理器
    'service_manager' => array(
        'invokables' => array(
            // 定义事件监听器
            'AlbumListener' => 'Album\Listener\AlbumListener',
        ),
        
        'factories' => array(
            'LogListener' => function($sm){
                $logger = $sm->get('Zend\Log\Logger');
                return new Listener\LogListener($logger);
            },
        ),
    ),

    // 事件监听器
    'listeners' => array(
        'LogListener',
    ),
    
    // 
    'navigation' => array(
        'default' => array(
            array(
                'label' => 'Album',
                'route' => 'album',
                'pages' => array(
                    array(
                        'label' => 'Add',
                        'route' => 'album',
                        'action' => 'add',
                    ),
                    array(
                        'label' => 'List',
                        'route' => 'album',
                        'action' => 'list',
                        'pages' => array(
                            array(
                                'label' => 'Edit',
                                'route' => 'album',
                                'action' => 'edit',
                            ),
                            array(
                                'label' => 'Delete',
                                'route' => 'album',
                                'action' => 'delete',
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),

];
