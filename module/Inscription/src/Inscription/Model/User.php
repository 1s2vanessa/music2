<?php

namespace Inscription\Model;

use Zend\InputFilter\InputFilter,
    Zend\InputFilter\InputFilterAwareInterface,
    Zend\InputFilter\InputFilterInterface;

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

    public function getArrayCopy() {
        return get_object_vars($this);
    }

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
                    )
            );


            $this->inputFilter = $inputFilter;
        }

        return $this->inputFilter;
    }

}
