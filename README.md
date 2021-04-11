Versions utilisées:
==================

PHP Version: 7.4 ([La SEULE version 7.x encore maintenue](https://www.php.net/supported-versions))

Symfony Version: 4.4 (LTS)


Installation:
=============

`make install` suffit à :
- builder les images
- lancer les containeurs
- faire un composer install
- lancer les migrations doctrine

Raccourcis:
===========

- `make up` permet de lancer le projet
- `make down` stop et détruit les containers
- `make php` permet de rentrer dans le container php


Exemples d'utilisation:
=======================

*Création d'un lien (sans mots-clés):*
![Image](./examples/exemple-1.png)

*Création d'un lien (avec mots-clés):*
![Image](./examples/exemple-2.png)

*Modification d'un lien (propriétés et mots-clés):*
![Image](./examples/exemple-3.png)

*Message d'erreur si JSON mal formatté:*
![Image](./examples/exemple-4.png)

*Message d'erreur si la validation ne passe pas:*
![Image](./examples/exemple-5.png)

*Suppression d'un lien:*
![Image](./examples/exemple-6.png)

*Création d'un lien (flickr):*
![Image](./examples/exemple-7.png)

*Récupération de la liste:*
![Image](./examples/exemple-8.png)
