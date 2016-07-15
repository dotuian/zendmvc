<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */


return array(
    
    // router 此数组块为路由配置信息段
    'router' => array(

        // 表示此模块的中路由，路由至少1条以上
        'routes' => array(
            'home' => array(

                // 表示路由模式，可选 segment 或 literal，
                // 区别在于 segment 已经处理好了结尾的斜杠，而literal 会把结尾带与不带斜杠表示不同的路由进行处理; 
                // 如果使用literal 时需要特别注意这一点。
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Index',
                        'action'     => 'index',
                    ),
                ),
            ),
            
            // The following is a route to simplify getting started creating
            // new controllers and actions without needing to create a new
            // module. Simply drop new controllers in, and you can access them
            // using the path /application/:controller/:action
            // 表示你的模块名称,在此以下的信息为具体配置信息
            'application' => array(
                // 表示路由模式，可选 segment 或 literal，区别在于 segment 已经处理好了结尾的斜杠，
                // 而literal 会把结尾带与不带斜杠表示不同的路由进行处理; 如果使用literal 时需要特别注意这一点。
                'type'    => 'Literal',
                
                // 路由具体选项信息区块
                'options' => array(
                    // 路由规则，此处规则将最终决定此模块的路由访问格式
                    'route'    => '/application',
                    
                    // 默认路由处理规则
                    'defaults' => array(
                        '__NAMESPACE__' => 'Application\Controller',
                        'controller'    => 'Index',
                        'action'        => 'index',
                    ),
                ),
                
                
                // 'may_terminate' => false 时，只有 child_routes 可以被匹配，父路径不不可用
                'may_terminate' => true,
                
                'child_routes' => array(
                    'default' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/[:controller[/:action]]',
                            
                            // 路由匹配规则
                            'constraints' => array(
                                // 控制器的路由正规匹配规则
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                // action(动作)的路由正规匹配规则
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                            ),
                        ),
                    ),
                ),
            ),

            'news' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/news[/:action][/:id][/page/:page]',
                    'constraints'=>array(
                        'action'=>'[a-zA-Z]*',
                        // 路由中 id 的匹配规则，只匹配数字类型的id
                        'id'=>'[0-9]+',
                        // 路由中 page 的匹配规则
                        'page'=>'[0-9]+',
                    ),
                    'defaults' => array(
                        'controller'    => 'Application\Controller\News',
                        'action'        => 'index',
                    ),
                ),
            ),

            'post' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/post[/:action][/:id][/page/:page]',
                    'constraints'=>array(
                        'action'=>'[a-zA-Z]*',
                        // 路由中 id 的匹配规则，只匹配数字类型的id
                        'id'=>'[0-9]+',
                        // 路由中 page 的匹配规则
                        'page'=>'[0-9]+',
                    ),
                    'defaults' => array(
                        'controller'    => 'Application\Controller\Post',
                        'action'        => 'index',
                    ),
                ),
            ),



        ),
    ),
    
    // 服务器管理器
    // 服务管理器主要负责一些工厂类的配置，使用系统能够在运行时自动的加载运行某些服务性功能。
    'service_manager' => array(
        'abstract_factories' => array(
            'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
            'Zend\Log\LoggerAbstractServiceFactory',
        ),
        'aliases' => array(
            // 语言转换工厂，主要功能是实现多国语言的支持，语言文件需要自已编写；
            // ZF2框架本身并不提供语言包，但提供对语言包的解析功能，通过语言包通过指定的语言进行转换；
            // 同时语言之间的转换及格式的变化比较而随意性也比较大，
            // 所以语言包可以根据项目的实现需求来进行订制，如果实际的项目开发中并不使用到国际化的功能时，
            // 可以将多国语言国际功能删除。
            'translator' => 'MvcTranslator',
            
            // Using ZfcRbac and ZfcUser
//            'Zend\Authentication\AuthenticationService' => 'zfcuser_auth_service'
        ),
        'factories' => array(
            'navigation' => 'Zend\Navigation\Service\DefaultNavigationFactory', // 导航管理器
            
//            'Auth\Model\MyAuthStorage' => function($sm) {
//                return new \Auth\Model\MyAuthStorage('zf_tutorial');
//            },
//            'Zend\Authentication\AuthenticationService' => function($sm) {
//                // Create your authentication service!
//    
//                $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
//                $dbTableAuthAdapter = new DbTableAuthAdapter($dbAdapter, 'user', 'username', 'password');
//
//                $authService = new AuthenticationService();
//                $authService->setAdapter($dbTableAuthAdapter);
//                $authService->setStorage($sm->get('Auth\Model\MyAuthStorage'));
//
//                return $authService;
//            }
            
        ),
        
    ),

    // translator 翻译器
    // 翻译器的主要工作是负责对各种支持语言的转换以此为目的，从而实现网站应用程序的多国化甚至全球化。
    // mo文件可以通过 poedit 软件来生成，也可能过poedit 来修改po文件
    'translator' => array(
        // 指明应用程序的本地使用语言，或是应用程序使用的默认语言
        'locale' => 'en_US', //ja_JP
        // 翻译文件的配置设置
        'translation_file_patterns' => array(
            array(
                // 翻译文件类型
                'type'     => 'gettext',
                // 指定语言文件目录
                'base_dir' => __DIR__ . '/../language',
                // 语言文件的匹配规则
                'pattern'  => '%s.mo',
            ),
        ),
    ),
    
    
    // controllers控制器配置
    // 控制器的配置将决定哪些控制器类能够被访问及使用，在此配置后ZF2自动加载厂可以很快的定位到控制所在的位置，对资源进行快速访问、使用。
    // 链：controllers--->invokables--->控制器
    'controllers' => array(
        // 这个是控制器区块的固定表示方法，表示此区块下的控制器为可用控制器
        'invokables' => array(
            // Application\Controller\Index  表示一个控制器，数组的键表示DI注入的引用，
            // 数组值则表示对应控制器所在的具体路径控制器的配置不局限于某一个控制器，可以把所有已经存在并且有效控制器加入到此区块来进行使用。
            'Application\Controller\Index' => 'Application\Controller\IndexController',
            'Application\Controller\News'  => 'Application\Controller\NewsController',
            'Application\Controller\Post'  => 'Application\Controller\PostController',
        ),
        
        'factories' => [
//            'PostController' => function ($sm) {
//                // We assume a Service key 'PostService' here that returns the PostService Class
//                return new PostController(
//                    $sm->getServiceLocator()->get('PostService')
////                    $sm->get('ZfcRbac\Service\AuthorizationService')
//                );
//            },
//            'PostService' => function($sm) {
//                return new PostService(
//                    $sm->get('doctrine.entitymanager.orm_default')
//                );
//            }
        ],

        
    ),
    
    // 视图管理器
    // 视图管理器主要负责视图信息的配置，如：错误显示、页面类型、布局文件、视图文件位置、404页面等。
    'view_manager' => array(
        // 是否显示404原因
        'display_not_found_reason' => true,
        // 是否显示异常信息
        'display_exceptions'       => true,
        // 指定视图页面类型
        'doctype'                  => 'HTML5',
        // 指定404的视图模板
        'not_found_template'       => 'error/404',
        // 指定异常模板文件
        'exception_template'       => 'error/index',
        // 视图模块地图
        'template_map' => array(
            // 指定布局文件
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            // 指定 application 模块的视图文件
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            // 指定404页面的视图文件
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            // 指定错误异常页面的视图文件
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ),
        // 视图模板堆栈路径
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
    
    // Placeholder for console routes
    'console' => array(
        'router' => array(
            'routes' => array(
            ),
        ),
    ),
    
    // 页面导航
    'navigation' => array(
        'default' => array(
            array(
                'label' => 'Home',
                'route' => 'home',
            ),
        ),
    ),
    
);
