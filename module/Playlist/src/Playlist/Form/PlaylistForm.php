<?php
 
namespace Playlist\Form;

 use Zend\Form\Form;

 class PlaylistForm extends Form
 {
     public function __construct($name = null)
     {
         parent::__construct('playlist');

         $this->add(array(
             'name' => 'id',
             'type' => 'Hidden',
         ));
         $this->add(array(
             'name' => 'title',
             'type' => 'Text',
             'options' => array(
                 'label' => 'Title',
             ),
         ));
         $this->add(array(
             'name' => 'artist',
             'type' => 'Text',
             'options' => array(
                 'label' => 'Artist',
             ),
         ));
        
         $this->add(array(
             'name' => 'id_user',
             'type' => 'Hidden',
         ));
         
         
         $this->add(array(
             'name' => 'id_album',
             'type' => 'Hidden',
         ));
         
          $this->add(array(
             'name' => 'submit',
             'type' => 'Submit',
             'attributes' => array(
                 'value' => 'Go',
                 'id' => 'submitbutton',
             ),
         ));
         
     }
 }
 