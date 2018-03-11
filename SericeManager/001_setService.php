<?php
/**
 * Created by PhpStorm.
 * User: liyv
 * Date: 10/31/16
 * Time: 12:10 AM
 */
namespace KpServiceManager;
use Zend\ServiceManager\ServiceManager;
include '../init_autoloader.php';
$serviceManager  = new ServiceManager();


class Web{
    public $url = 'http://complearn.ddns.net';
}
/**
 * name => 服务名
 */
$serviceManager->setService('kp', new Web());
echo $serviceManager->get('kp')->url;