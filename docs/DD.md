# Dictionnaire de données

<!-- il y a des points d'interrogation pour les incertitudes -->
## Profil utilisateur (`user`)

|Champ|Type|Spécificités|Description|
|-|-|-|-|
|id|INT|PRIMARY KEY, NOT NULL, UNSIGNED, AUTO_INCREMENT|L'identifiant du profil utilisateur|
|username|VARCHAR(32)|NOT NULL|Le pseudo de l'utilisateur|
|email|VARCHAR(32)|NOT NULL|L'adresse email de l'utilisateur|
|password|VARCHAR(32)|NOT NULL|L'adresse email de l'utilisateur|
|address_label|VARCHAR(128)|NOT NULL|addresse de l'adresse|
|lat|FLOAT|NOT NULL|latitude en degrés décimaux de l'adresse|
|lng|FLOAT|NOT NULL|longitude en degrés décimaux de l'adresse|
|firstname|VARCHAR(32)|NULL|Le prénom de l'utilisateur|
|lastname|VARCHAR(32)|NULL|Le nom de l'utilisateur|
|description|TEXT|NULL|La description de l'utilisateur|
|picture|VARCHAR(128)|NULL|Nom du fichier image|
|phone _number|VARCHAR(32)|NULL|numéro de téléphone de d'utilisateur|
|organisation|VARCHAR(32)|NULL|entité d'appartenance de l'utilisateur (association,etc.)|
|status|TINYINT(1)|NOT NULL|statut de l'utilisateur (actif/suspendu)|
|created_at|TIMESTAMP|NOT NULL, DEFAULT CURRENT_TIMESTAMP|La date de création du profil|
|updated_at||TIMESTAMP|NULL|La date de la dernière mise à jour du profil|


## Publication (`post`)

|Champ|Type|Spécificités|Description|
|-|-|-|-|
|id|INT|PRIMARY KEY, NOT NULL, UNSIGNED, AUTO_INCREMENT|L'identifiant de la publication|
|title|VARCHAR(32)|NOT NULL|titre de la publication|
|description|TEXT|NOT NULL| texte descriptif de la publication|
|picture|VARCHAR(128)|NULL|Nom de l'image|
|nb_likes|INT|NULL|nombre de likes de la publication|
|created_at|TIMESTAMP|NOT NULL, DEFAULT CURRENT_TIMESTAMP|La date de création de la publication|
|updated_at||TIMESTAMP|NULL|La date de la dernière mise à jour de la publication|


## Statut de la publication (`post_status`)

|Champ|Type|Spécificités|Description|
|-|-|-|-|
|id|INT|PRIMARY KEY, NOT NULL, UNSIGNED, AUTO_INCREMENT|L'identifiant du statut|
|label|VARCHAR(32)|NOT NULL|Label du statut de la publication (disponible/indisponible)|
|created_at|TIMESTAMP|NOT NULL, DEFAULT CURRENT_TIMESTAMP|La date de création du statut|
|updated_at||TIMESTAMP|NULL|La date de la dernière mise à jour du statut|


## Catégorie (`category`)

|Champ|Type|Spécificités|Description|
|-|-|-|-|
|id|INT|PRIMARY KEY, NOT NULL, UNSIGNED, AUTO_INCREMENT|L'identifiant de la catégorie|
|label|VARCHAR(32)|NOT NULL|Label de la catégorie|
|created_at|TIMESTAMP|NOT NULL, DEFAULT CURRENT_TIMESTAMP|La date de création de la catégorie|
|updated_at||TIMESTAMP|NULL|La date de la dernière mise à jour de la catégorie|


## Visibilité(`visibility `)

|Champ|Type|Spécificités|Description|
|-|-|-|-|
|id|INT|PRIMARY KEY, NOT NULL, UNSIGNED, AUTO_INCREMENT|L'identifiant de la visibilité|
|label|VARCHAR(32)|NOT NULL|Label de la visibilité|
|created_at|TIMESTAMP|NOT NULL, DEFAULT CURRENT_TIMESTAMP|La date de création de la visibilité|
|updated_at||TIMESTAMP|NULL|La date de la dernière mise à jour de la visibilité|


##  Statut de l'objet (`condition`) 

|Champ|Type|Spécificités|Description|
|-|-|-|-|
|id|INT|PRIMARY KEY, NOT NULL, UNSIGNED, AUTO_INCREMENT|L'identifiant de l'état|
|label|VARCHAR(32)|NOT NULL|Label de l'état|
|created_at|TIMESTAMP|NOT NULL, DEFAULT CURRENT_TIMESTAMP|La date de création de l'état|
|updated_at||TIMESTAMP|NULL|La date de la dernière mise à jour de l'état|