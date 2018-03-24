<?php
/**
 * Created by PhpStorm.
 * User: Rongde Qiu
 * Date: 3/12/2018
 * Time: 3:34 PM
 */

namespace KpServiceManager;

use Zend\ServiceManager\InitializerInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ServiceManager\ServiceManager;
//use Zend\Stdlib\InitializableInterface;

include '../init_autoloader.php';
$serviceManager = new ServiceManager();


class Web
{
    public $url = 'http://complearn.ddns.net';
    public $debug_message ='default.';
    //这种带参数的构造函数, 在新版里面也可以用setInvokableClass来实现延迟加载
    //如果没有给$param传递任何值, 也没有给出默认值, 那么就会赋予null值
    public function __construct($param = "Hello, world!")
    {
        $this->url = $param;
    }
}

/**
 * Class ClassInitializer 对每一个服务类, 在实例化之前, 会先将实例化的instance, 作为参数传递到这个类
 * 进行适当的操作以后, 再返回
 * @package KpServiceManager
 */
class ClassInitializer implements InitializerInterface
{
    public function initialize($instance, ServiceLocatorInterface $serviceLocator)
    {
        if ($instance instanceof Web) {
            $instance->url = "Class instance initialized by InitializerInteface...";
        }
    }
}

/**
 * setInvokableClass 用来注册特定命名空间下面的类名,
 * 好处是可以延迟加载类 (第一次使用的时候再实例化)
 * 第三个bool参数用来选择是否只产生一个实例, 默认是true
 */
$serviceManager->setInvokableClass('kp', 'KpServiceManager\Web', true);


//使用initializer前需要调用
$serviceManager->addInitializer('KpServiceManager\ClassInitializer');
echo "After initializing...." . $serviceManager->get('kp')->url.$serviceManager->get('kp')->debug_message;


//产生一个Web 的instance
echo $serviceManager->get('kp')->url;
echo "<hr>";
if ($serviceManager->get('kp') === $serviceManager->get('kp')) {
    echo 'Only one class instance generated.<hr>';
} else {
    echo 'Multiple class instances are generated.<hr>';
}

$serviceManager->get('kp')->debug_message = "Changing url after class initializer...";

echo "<br>Execute the servicemanager second time...". $serviceManager->get('kp')->debug_message;


