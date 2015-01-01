<?php

namespace Inscription;

use Zend\Db\ResultSet\ResultSet,
    Zend\Db\TableGateway\TableGateway,
    Zend\Http\Client as HTTPClient,
    Inscription\Model\User,
    Inscription\Model\UserTable;

class Module {

    public function getConfig() {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig() {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getServiceConfig() {
        return array(
            'factories' => array(
                 'Inscription\Model\UserTable' =>  function($sm) {
                     $tableGateway = $sm->get('InscriptionTableGateway');
                     $table = new UserTable($tableGateway);
                     return $table;
                 },
               'InscriptionTableGateway' => function ($sm) {
                     $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                     $resultSetPrototype = new ResultSet();
                     $resultSetPrototype->setArrayObjectPrototype(new User());
                     return new TableGateway('user', $dbAdapter, null, $resultSetPrototype);
                 },
             ),
         );
     }
}
