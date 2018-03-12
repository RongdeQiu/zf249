<?php

namespace KpServiceManager;
use Zend\ServiceManager\ServiceManager;
include '../init_autoloader.php';
$serviceManager  = new ServiceManager();


class Web{
    public $url = 'http://complearn.ddns.net';
    //这种带参数的构造函数, 在新版里面也可以用setInvokableClass来实现延迟加载
    //如果没有给$param传递任何值, 也没有给出默认值, 那么就会赋予null值
    public function __construct($param="Hello, world!")
    {
        $this->url = $param;
    }
}
/**
 * 如果要加载的类构造函数带有参数, 一般是通过setFactory来注册类
 * 注册的类也是延迟加载的
 */
$serviceManager->setFactory('kp',function(){
    $web = new Web('http://www.google.com');
    return $web;
});
//产生一个Web 的instance
echo $serviceManager->get('kp')->url;
echo "<hr>";
if ($serviceManager->get('kp') === $serviceManager->get('kp')){
    echo 'Only one class instance generated.<hr>';
}
else{
    echo 'Multiple class instances are generated.<hr>';
}
