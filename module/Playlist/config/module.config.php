<?php

return array(
     'controllers' => array(
         'invokables' => array(
             'Playlist\Controller\Playlist' => 'Playlist\Controller\PlaylistController',
         ),
     ),

     // The following section is new and should be added to your file
     'router' => array(
         'routes' => array(
             'playlist' => array(
                 'type'    => 'segment',
                 'options' => array(
                     'route'    => '/playlist[/][:action][/:id]',
                     'constraints' => array(
                         'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                         'id'     => '[0-9]+',
                     ),
                     'defaults' => array(
                         'controller' => 'Playlist\Controller\Playlist',
                         'action'     => 'index',
                     ),
                 ),
             ),
         ),
     ),

     'view_manager' => array(
         'template_path_stack' => array(
             'playlist' => __DIR__ . '/../view',
         ),
     ),
 );