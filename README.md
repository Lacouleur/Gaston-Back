# Dumpster

## Conception

### Présentation du projet

Le Dumpsters lutte contre le gaspillage matériel et alimentaire, le but est de rapprocher les communautés dans les villes et de favoriser le recyclage plutôt que l’achat de neuf.

Il s’agit d’un projet de réseau social «instagram style» permettant aux communautés de s'organiser autour de l’échange et la récupération d’objet, ou de nourriture. Comme l’Europe et l’Amérique du Nord connaissent une recrudescence des associations de Dumpster’s. Ainsi cette application viendrait combler un réel besoin.

### Définition de ses objectifs

1. Construction d’un "réseau social" favorisant le recyclage des objets et la redistribution de la nourriture invendue.
2. Fournir un outils basé sur les réels besoins des acteurs de ces échanges.
    2.1 Profiter du travail remote pour faire du lien avec les associations de dumpster dans nos régions.
4. Valoriser les structures de distribution qui s'engagent à lutter contre le gaspillage et la pollution.
    4.1 Sensibiliser les particuliers à la réutilisation et à l'esprit communautaire du Dumpster (Stats...)

### Définition du MVP (Minimum Viable Product)

1. Carte.
2. Géolocalisation.
3. Calendrier.
4. Liens vers Facebook.
5. Import de photos.
6. système de statut des Trésors.
7. Un fil d'actualités 
8. Indentité/Design
9. Messagerie

### Décrire les fonctionnalités (spécifications fonctionnelles)

1. Création d'un profil.
2. Avoir un mur de profil.
3. Une fonction de commentaires.
4. Une fontion "récupéré".
5. Une fonction de like.
6. Une carte pour localiser le trésor.
7. Avoir une alerte quand c'est dans un périmètre que j'ai definis.
8. Messagerie

### Créer les User Stories

| En tant que | Je veux | Afin de (optionnel) |
|--|--|--|
| visiteur | ajouter des produits à mon panier | pouvoir passer une commande contenant plusieurs produits |
| ... | ... | ... |

### Lister les technos utilisées

Interface : React Native Expo -(https://facebook.github.io/react-native/ (https://expo.io/)
v  API  ^
Back : Symfo 


### Décrire les rôles de chacun

Product Owner

Associations + 1 de nous (Damien)

Scrum master

(Cassandra)


Lead dev front (Laurent) / Lead dev back (Alex)

Effectue les choix techniques côté front/back
S'assure du bon fonctionnement de sa facette du projet



Git master

(Axel)


### Décrire le public visé (la cible)


### Décrire aussi les potentielles évolutions


### Arborescence de l'appli (pour montrer les workflows)



### RESSOURCES


https://github.com/O-clock-Universe/Projects/blob/master/feuille-de-route.md

https://github.com/O-clock-Universe/Recap
https://github.com/O-clock-Alumni/fiches-recap/blob/master/gestion-projet/user-stories.md

https://www.facebook.com/groups/2237688776507578/     ->  Les Robin.e.s des bennes (lutte contre le gaspillage Amiens)
https://www.facebook.com/groups/490655937641190/  -> Dumpster Diving Montréal



### RECHERCHE INFORMATIONS TECHNO :

# Marier React et Symfony
https://jolicode.com/blog/marier-react-et-symfony

##LES API? application programming interface


# Créer une API REST avec Symfony	
A verifier si c'est bien :
https://atomrace.com/creer-une-api-rest-avec-symfony/

# Quel API ? y en a plein ...
https://blog.vsoftconsulting.com/blog/how-to-choose-the-best-api-for-your-project

#Un système de messagerie interne pour Symfony2
https://openclassrooms.com/forum/sujet/un-systeme-de-messagerie-interne-pour-symfony2

Alors il y a un bunde que j'utilise qui fait de la messagerie classique : https://github.com/FriendsOfSymfony/FOSMessageBundle

Je suis en 2.6.6 et il fonctionne.

Pour le chat (messagerie instantanée), j'ai utilisé le système suivant : https://github.com/voryx/ThruwayBundle

J'avais auparavant utilisé node.js que j'avais intégré avec Symfony au niveau de la partie cliente.


#tchat react avec socket.io

https://socket.io/

# APPLICATION MOBILE :

2 solutions possible :
Demande des configurations pour les outils (geocalisation ... interactivité appareil photo utilisateur dans l'appli)
https://facebook.github.io/react-native/ 
Demande moins de  configurations mais moins de libertés dans la customization.(apres cas extreme je pense compliqué)
(https://expo.io/)

//INTERACTION MOBILE AVEC FACEBOOK Synchronisation.API
A RECHERCHER 

Recherche a FAIRE  : 
