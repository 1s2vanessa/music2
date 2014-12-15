<?php

namespace Playlist\Model;

//use Zend\InputFilter\InputFilter;
//use Zend\InputFilter\InputFilterAwareInterface;
//use Zend\InputFilter\InputFilterInterface;

class Playlist /*implements InputFilterAwareInterface*/ {

    public $id;
    public $artist;
    public $title;
    public $id_ablum;
    public $id_user;

    public function exchangeArray($data)
     {
         $this->id = $data['id'];
        // $this->id     = $this->getPlaylistTable()->count() + 1;
         $this->artist = $data['artist'];
         $this->title  = $data['title'];
         $this->id_user  = $data['id_user'];
            $this->id_ablum = $data['id_album'];
        // var_dump($data);
     }

     public function getArrayCopy()
     {
         return get_object_vars($this);
     }
}
