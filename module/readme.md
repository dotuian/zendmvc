
ZF2 使用模块系统将应用程序的主要代码集成到各个模块中去。同时应用模块还应提供用于引导、错误异常、路由等全部的配置信息。
在模块文件里可以根据自已的需要去调整关于 实图、路由、模型等一系列应用程序级的设置，同时Module不单起到配置信息的作用，
同时也是应用程序的必需中间件或桥梁，因为程序从前端控制器的分配及引导下进入的下层级就是Module类，通过解析Module类到达指定资源位置。



控制器是ZF2的核心功能，其实现了前端控制器所需的全部接口。
如：路由分发、视图渲染、助手、请求、响应等一系列的功能。同时也可以利用继承来设计自已的助手类或一些实用性较的插件等，来加强自已的系统功能。


ZF2 视图类主要有 Zend\View 包，
其主要功能简单的说包括：变量传递，数据转换、视图渲染、请求映射、渲染策略、响应策略等。
此外ZF2还通过 Zend\MVC\View 提供了事件侦听的一系列包，在进行项目开发的时候可以根据需求加入侦听事件。

模板：布局模板、错误异常模板、控制器模板

建立布局目录路径：/module/Application/view/layout
建立错误异常目录路径：/module/Application/view/error


5.1.7 视图中常用函数
$this->doctype()   指定文件的文档类型
$this->headTitle()->appendName() 输出文件标题
$this->headMeta() 设置并输出文件的Meta 属性
$this->headLink() ->prependStylesheet() 加载格式表文件
$this->headScript()->prependFile() 加载 js 文件
$this->basePath()    获取网站根路径
$this->navigation()->menu() 输出导航菜单
$this->url()            设置超链接
$this->content        输出页面内容(其实就是将其他页面的内容输出到布局页面上来)
$this->escapeHmtl()  过滤HTML标签
$this->translate()   进行语言转换(如果有设置多国语言支持)

以上是一些相对较为常用的函数功能，其他的函数可以查看Zend\View\Renderer\PhpRenderer.php 文件中的相关描述

