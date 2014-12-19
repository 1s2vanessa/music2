<?php

namespace Playlist;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Playlist\Model\Playlist;
use Playlist\Model\PlaylistTable;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;

class Module implements AutoloaderProviderInterface, ConfigProviderInterface {

    public function getAutoloaderConfig() {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getConfig() {
        return include __DIR__ . '../config/module.config.php';
    }

    public function getServiceConfig() {
        return array(
            'factories' => array(
                'Playlist\Model\PlaylistTable' => function($sm) {
                    $tableGateway = $sm->get('PlaylistTableGateway');
                    $table = new PlaylistTable($tableGateway);
                    return $table;
                },
                'PlaylistTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Playlist());
                    return new TableGateway('playlist', $dbAdapter, null, $resultSetPrototype);
                },
            ),
        );
    }

}
