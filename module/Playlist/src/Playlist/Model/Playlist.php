<?php

namespace Playlist\Model;

class Playlist {

    public $id;
    public $artist;
    public $title;
    public $id_ablum;
    public $id_user;

    public function exchangeArray($data) {
        //id en auto-incrément
        $this->id = $data['id'];
        $this->artist = $data['artist'];
        $this->title = $data['title'];
        $this->id_user = $data['id_user'];
        $this->id_album = $data['id_album'];
    }

    public function getArrayCopy() {
        return get_object_vars($this);
    }

}
