<?php

namespace Playlist\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Album\Model\Album ;

class PlaylistController extends AbstractActionController {

    protected $playlistTable;
    protected $albumTable;
     protected $tableGateway;
     protected $tableGatewayAlbum;
     protected $idUser; //récupérer avec l'authentification

    public function indexAction() {
        $this->idUser=2;
       // echo $this->idUser;
        return new ViewModel(array(
      'playlists' => $this->getPlaylistTable()->fetchByIdUser($this->idUser),
     //    'playlists' => $this->getPlaylistTable()->fetchAll(),
     
        ));
       
    }

    public function getAlbumTable() {
        if (!$this->albumTable) {
            $sm = $this->getServiceLocator();
            $this->albumTable = $sm->get('Album\Model\AlbumTable');
        }
        return $this->albumTable;
    }

    public function addAction() {
        //ici on récupère ID music et ID User --> insertion dans playlist
//        return new ViewModel(array(
        $albums = $this->getAlbumTable()->fetchAll();
        $this->idUser=2;
         $id = (int) $this->params()->fromRoute('id', 0);
         if ($id){ //pour savoir si c'est la première fois que nous sommes sur la page
             
         try {
            //$playlist= new Playlist();
             
            $album=$this->getAlbumTable()->getAlbum($id);
            var_dump($album);
           
            $this->getPlaylistTable()->savePlaylist($this->idUser, $album);
              
        } catch (\Exception $ex) {
            echo "erreur";
        }
            
         }
        return array(/*'form' => $form,*/'albums'=>$albums);
    }

    public function deleteAction() {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('playlist');
        }

        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost('del', 'No');

            if ($del == 'Yes') {
                $id = (int) $request->getPost('id');
                $this->getPlaylistTable()->deletePlaylist($id);
            }

            // Redirect to list of playlists
            return $this->redirect()->toRoute('playlist');
        }

        return array(
            'id' => $id,
            'playlist' => $this->getPlaylistTable()->getPlaylist($id)
        );
    }

    public function getPlaylistTable() {
        if (!$this->playlistTable) {
            $sm = $this->getServiceLocator();
            $this->playlistTable = $sm->get('Playlist\Model\PlaylistTable');
        }
        return $this->playlistTable;
    }

      public function getAlbum($idA)
     {
         $idA  = (int) $idA;
         $rowset = $this->tableGatewayAlbum->select(array('id' => $idA));
         $row = $rowset->current();
         if (!$row) {
             throw new \Exception("Could not find row $idA");
         }
         return $row;
     }
     
     public function retourAction(){
          return $this->redirect()->toRoute('playlist');
     }
}
