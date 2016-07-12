<?php

namespace Auth;

return array(
    'controllers' => [
        'invokables' => array(
            'Auth\Controller\Auth' => 'Auth\Controller\AuthController',
            'Auth\Controller\Success' => 'Auth\Controller\SuccessController',
            'Auth\Controller\Index' => 'Auth\Controller\IndexController',
        ),
    ],
    
    'router' => array(
        'routes' => array(

            'auth' => [
                'type'    => 'segment', #Literal
                'options' => [
                    'route'    => '/auth[/:action]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ],
                    'defaults' => [
                        'controller' => 'Auth\Controller\Auth',
                        'action'     => 'login',
                    ],
                ],
            ],

            
            'success' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/success',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Auth\Controller',
                        'controller' => 'Success',
                        'action' => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/[:action]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z0-9]*',
                                'action' => '[a-zA-Z0-9]*',
                            ),
                            'defaults' => array(
                            ),
                        ),
                    ),
                ),
            ),
            
            
        ),
    ),
    
    
    'view_manager' => array(
        'template_path_stack' => array(
            'Auth' => __DIR__ . '/../view',
        ),
    ),
    
    
);
