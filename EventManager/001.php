<?php
/**
 * Created by PhpStorm.
 * User: Qiu
 * Date: 4/3/2018
 * Time: 10:21 PM
 */

namespace KpEventManager;

use Zend\EventManager\EventManager;

include "../init_autoloader.php";

$eventManager = new EventManager();

// 添加事件Event
$eventManager->attach('click',function(){
    echo 'Button clicked.\t';
}, 1);

// 触发事件Event

