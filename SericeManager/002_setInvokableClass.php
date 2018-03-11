<?php
/**
 * Created by PhpStorm.
 * User: liyv
 * Date: 11/2/2016
 * Time: 11:39 PM
 */

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
 * setInvokableClass 用来注册特定命名空间下面的类名,
 * 好处是可以延迟加载类 (第一次使用的时候再实例化)
 * 第三个bool参数用来选择是否只产生一个实例, 默认是true
 */
$serviceManager->setInvokableClass('kp', 'KpServiceManager\Web',false);
//产生一个Web 的instance
echo $serviceManager->get('kp')->url;
echo "<hr>";
if ($serviceManager->get('kp') === $serviceManager->get('kp')){
    echo 'Only one class instance generated.<hr>';
}
else{
    echo 'Multiple class instances are generated.<hr>';
}
