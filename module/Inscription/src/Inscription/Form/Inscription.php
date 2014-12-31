<?php

namespace Inscription\Form;

use Zend\Form\Form,
    Zend\Form\Element,
    Zend\Validate\Db\NoRecordExists,
    Zend\InputFilter\Factory as InputFactory,
    Zend\Validate\Identical,
    Zend\InputFilter\InputFilter;

class Inscription extends Form {

    public function __construct($name = null) {
        parent::__construct('inscription');
        $this->setAttribute('method', 'post');

        $login = new Element\Text("username", array('size' => 32));
        //$loginDoesntExist = new NoRecordExists('user', 'userName');
        $login->setLabel('User name');
      
        $inputFilter = new InputFilter();
        $factory = new InputFactory();
        $inputFilter->add($factory->createInput(array(
                    'name' => 'username',
                    'required' => true,
                    'filters' => array(
                        array('name' => 'StringTrim'),
                        array('name' => 'StripTags'),
                    ),
                    'validators' => array(
                        array('name' => 'StringLength', 'options' => array('min' => 3))
                    )
        )));

        
        
        $password = new Element\Password("password", array('size' => 10));
        $password->setLabel('Password');

        $inputFilter->add($factory->createInput(array(
                    'name' => 'password',
                    'required' => true,
                    'validators' => array(
                        array(
                            'name' => 'StringLength',
                            'options' => array(
                                'min' => 5
                            )
                        )
                    )
        )));
        $repassword = new Element\Password("repassword", array('size' => 10));
        $repassword->setLabel('Retype password');
     
        $inputFilter->add($factory->createInput(array(
                    'name' => 'repassword',
                    'required' => true,
                    'validators' => array(
                        array(
                            'name' => 'StringLength',
                            'options' => array(
                                'min' => 5
                            )
                        ),
                        
                        //C'est ici que sa bloque, si tu decommente et que tu esaaye de t'inscrire
                        // sa met une erreur comme quoi Indentical n'existe pas
                       /* array(
                            'Identical', false, array('token' =>
	                     'password', 'messages' =>
	                     array(Identical::NOT_SAME =>
	                     'Passwords does not match'))
                        )*/
           
                    )
        )));
        

        $submit = new Element\Submit('submit');
        $submit->setValue('Send');
        $this->add($submit);
        /*  $pubKey = 'clef publique';
          $privKey = 'clef privée';
          $recaptcha = new Zend_Service_ReCaptcha($pubKey, $privKey);

          $adapter = new Zend_Captcha_ReCaptcha();
          $adapter->setService($recaptcha);

          $captcha = new Element\Captcha('recaptcha', array('label' => "Captcha", 'captcha' => $adapter));
          $captcha->removeDecorator('label')->removeDecorator('errors'); */
        $this->add($login);
        $this->add($password);
        $this->add($repassword);
        //$this->addElement($captcha);
        $this->setInputFilter($inputFilter);
    }

    /*  public function isValid($data)
      {
      $password = $this->getElement('password');
      $password->addValidator(new App_Validate_PasswordMatch($data['repassword']));

      return parent::isValid($data);
      } */
}
