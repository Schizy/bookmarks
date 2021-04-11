# INSTRUCTIONS

Vous devrez réaliser une application gestion de bookmarks.

Vous implémenterez l'ajout de deux types de liens :

* vidéo (provenant de Vimeo)
* photo (provenant de Flickr)

Les propriétés communes d’un lien référencé sont :

* URL
* titre
* auteur
* date d'ajout

Les liens de type video auront les propriétés spécifiques suivantes :

* largeur
* hauteur
* durée

Idem pour les liens de type image :

* largeur
* hauteur

Il est possible d’associer des mots-clés pour chaque lien référencé.

La récupération des propriétés d’un lien référencé se fait en utilisant le protocole ouvert [oEmbed](http://oembed.com/). Exemple de librairie qui implémente oembed: https://github.com/oscarotero/Embed

Il faut faire une API REST au format JSON pour gérer les bookmarks: lister les liens, ajouter un lien, modifier les mots clés d’un lien, gérer les mots clés d’un lien, supprimer un lien...
