<?php

namespace Playlist\Model;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Select;

class PlaylistTable {

    protected $tableGateway;

    public function __construct(TableGateway $tableGateway) {
        $this->tableGateway = $tableGateway;
    }

    public function fetchAll() {
        $resultSet = $this->tableGateway->select();
        return $resultSet;
    }

    public function fetchByIdUser($idUser) {
        $resultSet = $this->tableGateway->select(array('id_user' => $idUser));
        return $resultSet;
    }

    public function fetchLastPlaylist($limit)
    {
    	$select = new Select();
    	$select->from('playlist')
    	       ->order('id DESC')
    	       ->limit($limit);
        
    	$rowset = $this->tableGateway->selectWith($select);
        $row=$rowset->current();
    	return $row->id;
    }
    
    public function count() {
        $resultSet = $this->tableGateway->select('id');
        return count($resultSet);
    }

    public function getPlaylist($id) {
        $id = (int) $id;
        $rowset = $this->tableGateway->select(array('id' => $id));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $id");
        }

        return $row;
    }

    public function savePlaylist(Playlist $playlist) {
      
        $data = array(
            'id' => (int) $playlist->id,
            'artist' => $playlist->artist,
            'title' => $playlist->title,
            'id_album' => $playlist->id_album,
            'id_user' => $playlist->id_user
        );
        // var_dump($data['id_album']);
        //var_dump( $this->tableGateway);
        //$id_play = (int) $playlist->id;
        //var_dump($data);

           // var_dump($playlist->id);
        /* if ($this->getAlbum($playlist->id_album)) {
          echo "Déjà dans votre playlist";
          } else { */
        // var_dump( $this->tableGateway);
        ////$album = $this->tableGateway->select(array('id_album' => $playlist->id_album));
       // var_dump($album);
        // if ( )==null) {
        echo "Added";


        $this->tableGateway->insert($data);
        //}else{
        //    echo "Dejà dans votre playlist";
        // }
        //   var_dump($this->tableGateway);
        // }
        // }
        // var_dump($this->getPlaylist($id));
        // if ($this->getPlaylist($id)) {
        //     echo "Déjà dans votre playlist";
        //  } else {
        //      $this->tableGateway->insert($data);
        // throw new \Exception('Album id does not exist');
        //}
    }

    public function deletePlaylist($id) {
        $this->tableGateway->delete(array('id' => (int) $id));
    }

    public function getAlbumTable() {
        if (!$this->albumTable) {
            $sm = $this->getServiceLocator();
            $this->albumTable = $sm->get('Album\Model\AlbumTable');
        }
        return $this->albumTable;
    }

}
