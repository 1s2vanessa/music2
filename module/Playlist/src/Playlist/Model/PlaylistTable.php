<?php

namespace Playlist\Model;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Select;

class PlaylistTable {

    protected $tableGateway;
protected $tableGatewayAlbum;

    public function __construct(TableGateway $tableGateway) {
        $this->tableGateway = $tableGateway;
    }

    public function fetchAll() {
        $resultSet = $this->tableGateway->select();
       // var_dump($resultSet->current());
         var_dump($resultSet->buffer());
        return $resultSet;
        
    }

    public function fetchByIdUser($idUser) {
        $resultSet = $this->tableGateway->select(array('id_user' => $idUser));
         return $resultSet;
        //$resultSet=$select->from( $this->tableGateway->getTable())
          //                ->where(array('id_user = ?' => (int) $idUser)
        //);
        
     //  $resultSet = new \Zend\Db\Sql\Select();
      //  $resultSet->from($this->tableGateway->getTable())->where(
      //          array('id_user = ?' => (int) $idUser)
      //  );
  //var_dump($resultSet->getSqlString () );
   //   var_dump($resultSet->buffer());
        
    }

    public function getPlaylist($id) {
        $id = (int) $id;
        $rowset = $this->tableGateway->select(array('id' => $id));
        $row = $rowset->current();
        var_dump($row);
        var_dump($rowset);
        if (!$row) {
            throw new \Exception("Could not find row $id");
        }
        
        return $row;
    }

    public function savePlaylist($idUser, Album $album) {
        
        //requete SQL
        //
        var_dump($album);
//        $table='album'; 
//         $adapter = \Zend\Db\TableGateway\Feature\GlobalAdapterFeature::getStaticAdapter();
//
//        $this->tableGatewayAlbum=new TableGateway($table,$adapter);
//        $rowset = $this->tableGatewayAlbum->select(array('id' => $idAlbum));
//       // var_dump($resultSet->current());
//       var_dump ($this->tableGatewayAlbum->getColumns());
//       
//        $row=$rowset->current();
//        $playlist=new Playlist();
//       // $playlist->artist=$row->__toString();
//        $playlist->artist='bhjb';
//        $playlist->title='bjbk';
        $data = array(
            'artist' => $album->artist,
            'title' => $album->title,
            'id_album' => $album->id,
            'id_user' => $idUser
        );
        if (!$this->getPlaylist($album->id)) {
            $this->tableGateway->insert($data);
            echo "ajout effectué";
        } else {
            echo "Déjà dans votre playlist";
            
        }
    }

    public function deletePlaylist($id) {
        $this->tableGateway->delete(array('id' => (int) $id));
    }
 
    
      public function getAlbum($id)
     {
         $id  = (int) $id;
         $rowset = $this->tableGatewayAlbum->select(array('id' => $id));
         $row = $rowset->current();
         if (!$row) {
             throw new \Exception("Could not find row $id");
         }
         return $row;
     }

}
