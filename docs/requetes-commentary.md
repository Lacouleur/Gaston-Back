### Modèles de données à envoyer dans les requètes POST/PUT


# Commentary


## Créer un commentaire

Cf. requetes-post.md

Toutes ces propriétés sont obligatoires.


## Editer un commentaire

|URL|Methode|Type de données|
|-|-|-|
|http://http//alexis-le-trionnaire.vpnuser.lan/projet-Gaston/website-skeleton/public/api/commentary/{id}/edit |GET,PUT|Json|

```
{
	"body": "Commentaire modifié"
}
```
Le commentaire à modifier est indiqué dans l'URL.

