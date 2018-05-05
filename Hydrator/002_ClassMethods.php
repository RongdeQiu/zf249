<?php
/**
 * Created by PhpStorm.
 * User: Qiu
 * Date: 3/24/2018
 * Time: 12:00 AM
 */


//使用/zend/Stdlib/Hydrator来实现数组和对象之间的转换
//使用ClassMethods不需要在类中编写exchangeArray()和getArrayCopy()方法
//属性的getters和setters方法可以自动生成
namespace KpHydrator;

include "../init_autoloader.php";

use Zend\Stdlib\Hydrator\ClassMethods;
use Zend\Stdlib\Hydrator\Strategy\ClosureStrategy;

$studentArr = array(
    'id' => 10,
    'name' => 'Mikael',
);

class Student
{
    protected $id;
    protected $name;

    //使用code generator自动生成 属性的getters和setters

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

}

$hydrator = new ClassMethods();
$studentObj = $hydrator->hydrate($studentArr, new Student());
print_r($studentObj);

print_r($hydrator->extract($studentObj));


//Hydrator类提供一些策略可以在hydrate或者extract完成之后做附加处理
$hydrator->addStrategy('name', new ClosureStrategy(
    function ($var) {
        return $var . ".extractFunc";
    }, function ($var) {
    return $var . ".hydrateFunc";
}));

echo "<br>\n";
$studentObj = $hydrator->hydrate($studentArr, new Student());
print_r($studentObj);

print_r($hydrator->extract($studentObj));