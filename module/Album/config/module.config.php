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
    
];
