<?php
/**
 * Created by PhpStorm.
 * User: Qiu
 * Date: 4/4/2018
 * Time: 8:49 PM
 */

namespace KpEventManager;

use Zend\EventManager\EventManager;
use Zend\EventManager\SharedEventManager;

include "../init_autoloader.php";

$eventManager = new EventManager();
$eventManager->attach('click', function () {
    echo 'clicked' . "\n";
}, 1);


// Shared event manager 需要一个ID来创建事件event
// 其实质是静态的调用,比如在整个MVC框架里只有一个sharedEventManager
// 这样方便数据的传递
// 但是MVC框架内可能会有多个eventManager
$sharedEventManager = new SharedEventManager();
$sharedEventManager->attach(__NAMESPACE__, 'click', function () {
    echo 'From shared Event Manager' . "\n";
}, 99);

// Shared event manager 不会直接被eventManager触发
$eventManager->trigger('click');

// 正确的触发sharedEventManager的方法如下
$eventManager->setSharedManager($sharedEventManager);
$eventManager->setIdentifiers(__NAMESPACE__);
$eventManager->trigger('click');

var_dump($eventManager->getSharedManager());