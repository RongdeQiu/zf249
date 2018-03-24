<?php
/**
 * Created by PhpStorm.
 * User: Qiu
 * Date: 3/23/2018
 * Time: 11:33 PM
 */

//使用/zend/Stdlib/Hydrator来实现数组和对象之间的转换
namespace KpHydrator;

use Zend\Stdlib\Hydrator\ArraySerializable;

include '../init_autoloader.php';

$studentArr = array(
    'id' => 10,
    'name' => 'Mikael',
);

class Student
{
    public $id;
    public $name;

    // ArraySerializable需要调用到exchangeArray()或者populate()方法来实现Hydrate()
    public function exchangeArray($data)
    {
        $this->id = isset($data['id']) ? $data['id'] : null;
        $this->name = isset($data['name']) ? $data['name'] : null;
    }

    //ArraySerializable需要调用到getArrayCopy()来实现extract()方法
    public function getArrayCopy(){
        return array(
            'id'=>$this->id,
            'name'=>$this->name,
        );
    }

}

$hydrator = new ArraySerializable();

$studentObj = $hydrator->hydrate($studentArr, new Student());

echo $studentObj->id."\t".$studentObj->name."\n";

var_dump($hydrator->extract($studentObj));

