<?php

/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Inscription\Controller;

use Zend\Mvc\Controller\AbstractActionController,
    Zend\View\Model\ViewModel,
    Inscription\Model\User,
    Inscription\Form\Inscription;

class InscriptionController extends AbstractActionController {
    protected $userTable;
    
    
    function inscriptionAction() {
         $form = new Inscription();
      

        $request = $this->getRequest();
       
        if ($request->isPost()) {
            $user = new User();
            $form->setInputFilter($user->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid() && ($form->getAttribute('password')==$form->getAttribute('repassword'))){
               $user->exchangeArray($form->getData());
            
                $this->getUserTable()->saveUser($user);

                // Redirect to home page
                return $this->redirect()->toRoute('home');
                
                
            }else{
                 echo "Erreur dans la longueur de l'identifiant ou password ou les mots de passe ne sont pas identiques";
                return new ViewModel(array('title' => 'Register',
                    'form' => $form
                ));
            }
        }



        return new ViewModel(array('title' => 'Register',
            'form' => $form
        ));
    }

     public function getUserTable() {
        if (!$this->userTable) {
            $sm = $this->getServiceLocator();
            $this->userTable = $sm->get('Inscription\Model\UserTable');
        }

        return $this->userTable;
    }
}
