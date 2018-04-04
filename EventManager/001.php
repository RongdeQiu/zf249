<?php
/**
 * Created by PhpStorm.
 * User: Qiu
 * Date: 4/3/2018
 * Time: 10:21 PM
 */

namespace KpEventManager;

use Zend\EventManager\Event;
use Zend\EventManager\EventManager;

include "../init_autoloader.php";

$eventManager = new EventManager();

// 添加事件Event
// $event包含事件trigger时传递的参数和target对象
// 可以通过var_dump($event) 来查看具体情况
$eventManager->attach('click', function (Event $event) {
    //获取event trigger时的target对象
    $object = $event->getTarget();

    //获取event trigger时传递给target的参数(数组)
    $params = $event->getParams();


    $object->name = $params['name'];
    $object->age = (int)$params['age'];
    $object->sayHi();
}, 1);


// 添加事件Event
$eventManager->attach('click', function () {
    echo 'Button clicked second times.\t';
}, 2);

// 触发事件Event
// $hello是target 对象
// 其后是传递的参数数组
$hello = new SayHi();
$eventManager->trigger('click', $hello, ['name' => 'Mason', 'age' => 6], function () {
    echo 'After event triggered.';
});


class SayHi
{
    public $name;
    public $age;

    public function sayHi()
    {
        echo 'Hi, ' . $this->name . '. You are ' . $this->age . ' now.';
    }
}

