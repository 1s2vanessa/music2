<?php

class App_Validate_PasswordMatch extends Zend_Validate_Abstract
{
    const PASSWORD_MISMATCH = 'passwordMismatch';

     protected $_compare;

    public function __construct($compare)
    {
        $this->_compare = $compare;
    }

    protected $_messageTemplates = array(
        self::PASSWORD_MISMATCH => "Password doesn't match confirmation"
    );

public function isValid($data)
{
	$password 	= $this->getElement('password');
	$password->addValidator(new App_Validate_PasswordMatch($data['repassword']));

	return parent::isValid($data);
}
}