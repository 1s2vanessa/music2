<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Form_Inscription extends Zend_Form
{
	public function __construct($options = null)
	{
		parent::__construct($options);
                $login = new Zend_Form_Element_Text("login", array('size' => 25));
		$loginDoesntExist = new Zend_Validate_Db_NoRecordExists('membres', 'login');
		$login ->setLabel('Login')
		  ->addFilter('StripTags')
		  ->addFilter('StringTrim')
		  ->addValidator('NotEmpty')
		  ->addValidator($loginDoesntExist)
		  ->addValidator('StringLength', false, 3, 20)
		  ->setDescription("Login between 3 and 20 alphanumerics characters.");
                
                $emailDoesntExist = new Zend_Validate_Db_NoRecordExists('membres', 'email');
                $email = new Zend_Form_Element_Text("email", array('size' => 25));
                $email ->setLabel('Email address')
                  ->addFilter('StripTags')
                  ->addFilter('StringTrim')
                  ->addValidator('NotEmpty')
                  ->addValidator($emailDoesntExist)
                  ->addValidator('EmailAddress')
                  ->setDescription("Require a valid email address.");
                
                $password = new Zend_Form_Element_Password("password", array('size' => 25));
                $password ->setLabel('Password')
                  ->addFilter('StringTrim')
                  ->addValidator('NotEmpty');

                $repassword = new Zend_Form_Element_Password("repassword", array('size' => 25));
                $repassword ->setLabel('Retype password')
                  ->addFilter('StringTrim')
                  ->addValidator('NotEmpty');
                $repassword->setDescription("Retype the previous password to prevent errors.");
                
                $pays = new  Zend_Form_Element_Select("pays");
                $pays ->setLabel('Country')
                 ->addMultiOptions(Zend_Locale::getCountryTranslationList(Zend_Registry::get('Zend_Locale')))
                  ->addValidator('NotEmpty');

                $pubKey = 'clef publique';
                $privKey = 'clef privée';
                $recaptcha = new Zend_Service_ReCaptcha($pubKey, $privKey);

                $adapter = new Zend_Captcha_ReCaptcha();
                $adapter->setService($recaptcha);

                $captcha = new Zend_Form_Element_Captcha('recaptcha', array( 'label' => "Captcha", 'captcha' => $adapter));
                $captcha->removeDecorator('label')->removeDecorator('errors');
                $this->addElements(array($login,$email, $password, $repassword, $pays, $captcha));

    }
}