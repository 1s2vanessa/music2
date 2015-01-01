<?php

namespace Inscription\Form;

 use Zend\Form\Form;

class Inscription extends Form {

    public function __construct($name = null) {
    parent::__construct('inscription');

         $this->add(array(
             'name' => 'id',
             'type' => 'Hidden',
         ));
         $this->add(array(
             'name' => 'username',
             'type' => 'Text',
             'options' => array(
                 'label' => 'User name * : ',
             ),
         ));
         $this->add(array(
             'name' => 'password',
             'type' => 'Password',
             'options' => array(
                 'label' => 'Password * :',
             ),
         ));
         $this->add(array(
             'name' => 'repassword',
             'type' => 'Password',
             'options' => array(
                 'label' => 'Confirm password * :',
             ),
         ));
         
         $this->add(array(
             'name' => 'submit',
             'type' => 'Submit',
             'attributes' => array(
                 'value' => 'Send',
                 'id' => 'submitbutton',
             ),
         ));
    }

    /*  public function isValid($data)
      {
      $password = $this->getElement('password');
      $password->addValidator(new App_Validate_PasswordMatch($data['repassword']));

      return parent::isValid($data);
      } */
}
