# Dictionnaire de données

<!-- il y a des points d'interrogation pour les incertitudes -->
## Profil utilisateur (`User profile`)

|Champ|Type|Spécificités|Description|
|-|-|-|-|
|id|INT|PRIMARY KEY, NOT NULL, UNSIGNED, AUTO_INCREMENT|L'identifiant du profil utilisateur|
|username|VARCHAR(32)|NOT NULL|Le pseudo de l'utilisateur|
|firstname|VARCHAR(32)|NOT NULL|Le prénom de l'utilisateur |
|lastname|VARCHAR(32)|NOT NULL|Le nom de l'utilisateur |
|description|TEXT|NULL|La description de l'utilisateur|
|email|VARCHAR(32)|NOT NULL|L'adresse email de l'utilisateur |
|password|VARCHAR(32)|NOT NULL|L'adresse email de l'utilisateur |

|picture|VARCHAR(128)|NULL|L'URL de l'image du profil,???|

|status|VARCHAR(32)|NOT NULL, DEFAULT 0|statut de l'objet|

|phone _number|VARCHAR(32)??)|NOT NULL, DEFAULT 0|numéro de téléphone de d'utilisateur|

|organisation|VARCHAR(32)|NOT NULL, DEFAULT 0|entité d'appartenance de l'utilisateur (association,etc.)???|

|created_at|TIMESTAMP|NOT NULL, DEFAULT CURRENT_TIMESTAMP|La date de création du profil|

|updated_at||TIMESTAMP|NULL|La date de la dernière mise à jour du profil|



## Publication (`Post`)

|Champ|Type|Spécificités|Description|
|-|-|-|-|
|id|INT|PRIMARY KEY, NOT NULL, UNSIGNED, AUTO_INCREMENT|L'identifiant de la publication|

|title|VARCHAR(32)|NOT NULL|titre de la publication|
|description|TEXT|NOT NULL| texte descriptif de la publication|

|picture|VARCHAR(128)|NULL|L'URL de l'image de la publication,???|

|weight|DECIMAL(10,2)|NULL|le poids de l'objet (trésor)|


|dimensions|DECIMAL(10,2)|NULL|les dimensions de l'objet???|

|volume|DECIMAL(10,2)|NULL|le volume de l'objet|

|quantity|INT |NULL|quantité d'objets|

|nb_likes|INT|NULL|nombre de likes de la publication|

|created_at|DECIMAL(10,2)|NULL|La date de création de la publication|

|updated_at|DECIMAL(10,2)|NOT NULL, DEFAULT 0|La date de la dernière mise à jour de la publication|


## Carte (`Map`)

|Champ|Type|Spécificités|Description|
|-|-|-|-|

|address|VARCHAR(128)|NOT NULL|addresse de l'objet|
|locality|VARCHAR(32)|NOT NULL|région de l'objet|
|county|VARCHAR(32)|NOT NULL|pays de l'objet|

 <!-- les types de données pour la lat et la long sont peut être à revoir... -->
|lat|DECIMAL(10,N)??|NOT NULL|latitude en degrés décimaux de l'objet|
|lng|DECIMAL(10,N)??|NOT NULL|longitude en degrés décimaux de l'objet|


## Statut de la publication (`Post-status`)

|Champ|Type|Spécificités|Description|
|-|-|-|-|

|title|VARCHAR(32)|NOT NULL|titre du statut de la publication|

|created_at|TIMESTAMP|NOT NULL, DEFAULT CURRENT_TIMESTAMP|La date de création du satut de la publication??|

|updated_at||TIMESTAMP|NULL|La date de la dernière mise à jour du statut de la publication??|

## Catégorie (`category`)



|Champ|Type|Spécificités|Description|
|-|-|-|-|

|id|INT|PRIMARY KEY, NOT NULL, UNSIGNED, AUTO_INCREMENT|L'identifiant de la catégorie|
|title|VARCHAR(32)|NOT NULL|titre de la catégorie|

|created_at|TIMESTAMP|NOT NULL, DEFAULT CURRENT_TIMESTAMP|La date de création de la  catégorie|

|updated_at||TIMESTAMP|NULL|La date de la dernière mise à jour de la catégorie|

## Visibilité(`visibility `)

<!-- id à rajouter? -->

|Champ|Type|Spécificités|Description|
|-|-|-|-|

|title|VARCHAR(32)|NOT NULL|statut de la visibilité du post |

|created_at|TIMESTAMP|NOT NULL, DEFAULT CURRENT_TIMESTAMP|La date à laquelle le post est rendu visible|

|updated_at||TIMESTAMP|NULL|La date de la dernière mise à jour de la visibilité du post|

##  Statut de l'objet (`Wear-condition`) 

<!-- id à rajouter? -->

|Champ|Type|Spécificités|Description|
|-|-|-|-|
|title|VARCHAR(32)|NOT NULL|titre du statut de l'objet (récupéré/non récupéré) |

|created_at|TIMESTAMP|NOT NULL, DEFAULT CURRENT_TIMESTAMP|La date de création de du statut de l'objet|

|updated_at||TIMESTAMP|NULL|La date de la dernière mise à jour du statut de l'objet|