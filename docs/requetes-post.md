### Modèles de données à envoyer dans les requètes POST/PUT


# Post


## Créer un post

|URL|Methode|Type de données|
|-|-|-|
|http://http//alexis-le-trionnaire.vpnuser.lan/projet-Gaston/website-skeleton/public/api/post-new |POST|Json|

```
{
    "title": "Nouveau titre",
    "description": "Test pour créer un post.",
    "addressLabel": "62, impasse du test 35000 Rennes",
    "lat": -20.20274,
    "lng": 47.213832,
    "user": {
      "id": 991
    },
    "postStatus": {
      "id": 104
    },
    "visibility": {
      "id": 103
    },
    "wearCondition": {
      "id": 105
    },
    "category": {
      "id": 175
    }
}
```
Toutes ces propriétés sont obligatoires.


## Editer un post

|URL|Methode|Type de données|
|-|-|-|
|http://http//alexis-le-trionnaire.vpnuser.lan/projet-Gaston/website-skeleton/public/api/post/{id}/edit |GET,PUT|Json|

```
{
    "title": "Nouveau titre",
    "description": "Test pour modifier un post.",
    "addressLabel": "62, impasse du test 35000 Rennes",
    "lat": -20.20274,
    "lng": 47.213832,
    "postStatus": {
      "id": 103
    },
    "visibility": {
      "id": 104
    },
    "wearCondition": {
      "id": 105
    },
    "category": {
      "id": 175
    }
}
```
Le post à modifier est indiqué dans l'URL. Aucune des propriétés n'est obligatoire, si pas de modification la valeur par défaut sera conservée.


## Ajouter une image sur un post

|URL|Methode|Type de données|
|-|-|-|
|http://http//alexis-le-trionnaire.vpnuser.lan/projet-Gaston/website-skeleton/public/api/post/{id}/new-picture |GET,POST|Multipart|

```
{"image": "123456.jpg"}
```
Le post à modifier est indiqué dans l'URL.


## Ajouter un commentaire sur un post

|URL|Methode|Type de données|
|-|-|-|
|http://http//alexis-le-trionnaire.vpnuser.lan/projet-Gaston/website-skeleton/public/api/post/{id}/new-commentary |GET,POST|Json|

```
{
	"body": "Nouveau commentaire",
	"user": 991
}
```
Le post à modifier est indiqué dans l'URL. Toutes ces propriétés sont obligatoires.

