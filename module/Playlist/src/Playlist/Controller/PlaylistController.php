<?php

namespace Playlist\Controller;

use Zend\Mvc\Controller\AbstractActionController,
    Zend\View\Model\ViewModel,
    Playlist\Model\Playlist,
    Zend\Session\Container;

class PlaylistController extends AbstractActionController {

    protected $playlistTable;
    protected $albumTable;
    protected $tableGatewayAlbum;
    protected $idUser; //récupérer avec l'authentification
    protected $idAlbum;

    public function indexAction() {
        //récupération de l'id de l'user 
        $userIdContainer = new Container('utilisateur');
        $this->idUser = $userIdContainer->offSetGet(idUtilisateur);

        return new ViewModel(array(
            'playlists' => $this->getPlaylistTable()->fetchByIdUser($this->idUser),
        ));
    }

    public function getAlbumTable() {
        if (!$this->albumTable) {
            $sm = $this->getServiceLocator();
            $this->albumTable = $sm->get('Album\Model\AlbumTable');
        }
        return $this->albumTable;
    }

    public function addAction() {//ici on récupère ID music et ID User --> insertion dans playlist
        $userIdContainer = new Container('utilisateur');
        $this->idUser = $userIdContainer->offSetGet(idUtilisateur);
        $albums = $this->getAlbumTable()->fetchAll();

        $this->idAlbum = (int) $this->params()->fromRoute('id', 0); //permet de récupérer l'id de l'album sur lequel on a cliqué
        if ($this->idAlbum) { //pour savoir si c'est la première fois que nous sommes sur la page
            try {
                $album = $this->getAlbumTable()->getAlbum($this->idAlbum);
                $playlist = new Playlist();
                $id_play = $this->getPlaylistTable()->fetchLastPlaylist(1) + 1;
                $data = array(
                    'id' => $id_play,
                    'artist' => $album->artist,
                    'title' => $album->title,
                    'id_album' => $album->id,
                    'id_user' => $this->idUser
                );
                $playlist->exchangeArray($data);
                $this->getPlaylistTable()->savePlaylist($playlist);
            } catch (\Exception $ex) {
            }
        }
        return array('albums' => $albums);
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

    public function getAlbum($idA) {
        $idA = (int) $idA;
        $rowset = $this->tableGatewayAlbum->select(array('id' => $idA));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $idA");
        }
        return $row;
    }

    public function retourAction() {
        return $this->redirect()->toRoute('playlist');
    }

}
