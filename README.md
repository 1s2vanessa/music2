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


Dans le dossier config puis dans le dossier autoload il faut copier le fichier "local.php.dist"
puis le renommer en "local.php". Puis il faut modifier les paramètres en fonction de vos identifiants
et mot de passe pour vous connecter à votre votre base de données.
