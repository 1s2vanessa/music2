<?php

namespace Inscription\Model;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface,
    Zend\Validator\Identical;

class User implements InputFilterAwareInterface {

    public $id;
    public $username;
    public $password;
    protected $inputFilter;

    public function exchangeArray($data) {
        $this->id = (isset($data['id'])) ? $data['id'] : null;
        $this->username = (isset($data['username'])) ? $data['username'] : null;
        $this->password = (isset($data['password'])) ? $data['password'] : null;
    }

    // Add the following method:
    public function getArrayCopy() {
        return get_object_vars($this);
    }

    // Add content to these methods:
    public function setInputFilter(InputFilterInterface $inputFilter) {
        throw new \Exception("Not used");
    }

    public function getInputFilter() {
        if (!$this->inputFilter) {
            $inputFilter = new InputFilter();

            $inputFilter->add(array(
                'name' => 'id',
                'required' => true,
                'filters' => array(
                    array('name' => 'Int'),
                ),
            ));

            $inputFilter->add(array(
                'name' => 'username',
                'required' => true,
                'filters' => array(
                    array('name' => 'StringTrim'),
                    array('name' => 'StripTags'),
                ),
                'validators' => array(
                    array('name' => 'StringLength', 'options' => array('min' => 5))
                )
            ));

            $inputFilter->add(array(
                'name' => 'password',
                'required' => true,
                'filters' => array(
                    array('name' => 'StringTrim'),
                    array('name' => 'StripTags'),
                ),
                'validators' => array(
                    array('name' => 'StringLength', 'options' => array('min' => 5))
                )
            ));


            $inputFilter->add(array(
                'name' => 'repassword',
                'required' => true,
                'filters' => array(
                    array('name' => 'StringTrim'),
                    array('name' => 'StripTags'),
                ), 'validators' => array(
                    array('name' => 'StringLength', 'options' => array('min' => 5))
                ),
                //C'est ici que sa bloque, si tu decommente et que tu esaaye de t'inscrire
                // sa met une erreur comme quoi Indentical n'existe pas
//                array(
//                    'Identical', false, array('token' =>
//                        'password', 'messages' =>
//                        array(Identical::NOT_SAME =>
//                            'Passwords does not match'))
//                )
                    )
            );


            $this->inputFilter = $inputFilter;
        }

        return $this->inputFilter;
    }

}
