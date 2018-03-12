<?php
/**
 * Created by PhpStorm.
 * User: Rongde Qiu
 * Date: 03/12/2018
 * Time: 12:10 AM
 */

namespace KpServiceManager;

use Zend\ServiceManager\ServiceManager;

include '../init_autoloader.php';
$serviceManager = new ServiceManager();


class Web
{
    public $url = 'http://complearn.ddns.net';
}

/**
 * name => 服务名
 */
$serviceManager->setService("kp", new Web());
echo $serviceManager->get("kp")->url;

class Demo
{
    private $message = "Initial contents by default.";

    /**
     * Demo constructor.
     * @param string $message
     */
    public function __construct(string $message)
    {
        $this->message = $message;
    }


    public function setMessage(string $message)
    {
        $this->message = $message;
        return;
    }

    public function getMessage(){
        return $this->message;
    }

}

/*
 * 测试带参数的serviceManager调用
 * 注意setService的name不能重复已经使用过的
 */
$serviceManager->setService("kp2",new Demo("Message from service manager"));
echo "<br>";
echo $serviceManager->get("kp2")->getMessage();
echo "<br>".$serviceManager->get("kp")->url."\t".$serviceManager->get("kp2")->getMessage();