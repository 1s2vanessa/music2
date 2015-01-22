Music Play 
=======================

L'application Music Play permet de stocker des titres de musiques, d'albums

Il y a un module authentification qui permet à une personne de se connecter 
et d'être redirigée en  fonction de ses droits (admin/user):

 --> si cette personne est un admin alors elle est redirigée sur la page 'album' dont le
module reprend le tutorial : http://framework.zend.com/manual/current/en/user-guide/overview.html


--> sinon c'est un user alors elle est redirigée sur la page 'playlist'

La playlist permet de stocker les titres choisis par un user.

Enfin il y a un module Inscription pour ajouter des users

Installation
=======================

Premièrement : 

Sous NetBeans : cloner le dossier à l'aide du lien récupérer sous github ou (https://github.com/1s2vanessa/music2)
Puis copier la Base de données (music.sql)


Deuxièmement : 

Dans le dossier config puis dans le dossier autoload il faut copier le fichier "local.php.dist"
puis le renommer en "local.php". Puis il faut modifier les paramètres en fonction de vos identifiants
et mot de passe pour vous connecter à votre votre base de données.

--> return array(
     'db' => array(
         'username' => 'votre identifiant',
         'password' => 'votre mot de passe',
     ),
 );



Accès index JSON
=======================


Pour aller sur la page de l'index JSON : 
http://localhost/music2/public/album/indexbis



Utilisation de l'application
=============================

Reporter vous au manuel d'utilisation de l'application : "Manuel d'utilisation.pdf"