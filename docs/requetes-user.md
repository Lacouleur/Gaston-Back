### Modèles de données à envoyer dans les requètes POST/PUT


# User


## Créer un utilisateur

|URL|Methode|Type de données|
|-|-|-|
|http://http//alexis-le-trionnaire.vpnuser.lan/projet-Gaston/website-skeleton/public/user-new |POST|Json|

```
{
    "username": "test",
    "email": "test@test.com",
    "password": "test",
    "addressLabel": "99, place de Ramos\n42 759 Chretienboeuf",
    "lat": 47.896236,
    "lng": 13.632601
}
```
Toutes ces propriétés sont obligatoires.


## Editer un utilisateur

|URL|Methode|Type de données|
|-|-|-|
|http://http//alexis-le-trionnaire.vpnuser.lan/projet-Gaston/website-skeleton/public/api/user/{id}/edit |GET,PUT|Json|

```
{
    "email": "test@test.fr",
    "addressLabel": "97, place de Test\n42 759 Chretienboeuf",
    "lat": 47.123456,
    "lng": 13.123456,
    "description": "Je suis un utilisateur",
    "firstname": "Gérard",
    "lastname": "Baste",
    "Organisation": "Association 2 gens normal",
    "phoneNumber": "0650651535"
}
```
Le user à modifier est indiqué dans l'URL. Aucune des propriétés n'est obligatoire, si pas de modification la valeur par défaut sera conservée. On ne modifie pas les identifiants de connexion ici.


## Ajouter une image sur un utilisateur

|URL|Methode|Type de données|
|-|-|-|
|http://http//alexis-le-trionnaire.vpnuser.lan/projet-Gaston/website-skeleton/public/api/user/{id}/new-picture |GET,POST|Multipart|

```
{"image": "123456.jpg"}
```
L'utilisateur à modifier est indiqué dans l'URL.
