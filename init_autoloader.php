<?php
/**
 * Created by PhpStorm.
 * User: liyv
 * Date: 10/30/16
 * Time: 11:37 PM
 */

//1. 使用Zend提供的Loader方法去注册自动加载
include 'Zend/Loader/AutoloaderFactory.php';
\Zend\Loader\AutoloaderFactory::factory(array(
    'Zend\Loader\StandardAutoloader'=>array(
        'autoregister_zf'=>true
    )
));
$serviceManager = new \Zend\ServiceManager\ServiceManager();


