<?php

namespace KpServiceManager;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ServiceManager\AbstractFactoryInterface;
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
 * 定义抽象工厂类
 * Class KpAbstractFactory
 * @package KpServiceManager
 */
class KpAbstractFactory implements AbstractFactoryInterface{
    //$name 服务名, 会自动转换为小写
    //$requestname, 区分大小写
    public function canCreateServiceWithName(ServiceLocatorInterface $serviceLocator, $name, $requestedName){
        if ($name === 'abc')
        //如果返回true, 那会接着执行createServiceWithName这个方法
        return true;
    }

    public function createServiceWithName(ServiceLocatorInterface $serviceLocator, $name, $requestedName)
    {
        $obj = new \stdClass();
        $obj->name = $requestedName;
        // 一定要返回一个instance
        return $obj;
    }
}
//当去请求一个不存在的服务的时候, 会去调用这些注册过的Abstract Factory
$serviceManager->addAbstractFactory('KpServiceManager\KpAbstractFactory');
echo $serviceManager->get('Abc')->name;




