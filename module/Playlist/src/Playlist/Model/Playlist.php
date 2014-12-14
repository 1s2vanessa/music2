<?php

namespace Playlist\Model;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class Playlist implements InputFilterAwareInterface {

    public $id;
    public $artist;
    public $title;
    public $id_ablum;
    public $id_user;
    protected $inputFilter;                       // <-- Add this variable
   
    
    
    public function exchangeArray($data)
     {
         $this->id     = (isset($data['id']))     ? $data['id']     : null;
         $this->artist = (isset($data['artist'])) ? $data['artist'] : null;
         $this->title  = (isset($data['title']))  ? $data['title']  : null;
     }

     // Add the following method:
     public function getArrayCopy()
     {
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
                'name' => 'artist',
                'required' => true,
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name' => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min' => 1,
                            'max' => 100,
                        ),
                    ),
                ),
            ));

            $inputFilter->add(array(
                'name' => 'title',
                'required' => true,
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name' => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min' => 1,
                            'max' => 100,
                        ),
                    ),
                ),
            ));
            
             $inputFilter->add(array(
                'name' => 'id_album',
                'required' => true,
                'filters' => array(
                    array('name' => 'Int'),
                ),
            ));

             
//              $inputFilter->add(array(
//                'name' => 'id_user',
//                'required' => true,
//                'filters' => array(
//                    array('name' => 'Int'),
//                ),
//            ));


            $this->inputFilter = $inputFilter;
        }

        return $this->inputFilter;
    }

}
