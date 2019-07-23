# Navi.go

# Présentation de notre projet 


Dans le cadre d'un projet étudiant, nous avons réalisé un site permettant de à l'utilisateur de trouver un chemin selon un départ et une arrivée. Ce projet à était réalisé en 2 semaines.


# DESCRIPTIF DES FONCTIONNALITÉS


Priorité
---

La création d’un profil utilisateur, avec la possibilité d’enregistrer des adresses et des trajets préférés

Partie Mysql
Création de la base de données composée de 2 tables (Membre et Trajet). Membre regroupera le profil utilisateur, et trajet regroupera les statistiques des utilisateurs. Un membre peut faire plusieurs trajets, un trajet ne peut être fait que par un membre (la date précise empêchera les doublons). 

Partie PHP 
Formulaire de connexion et d’inscription avec des informations basiques (email, mdp, nom, prenom). 
Bouton déconnexion.
Le fait d’être connectée permet d’avoir accès des favoris.
Dans le menu il y aura un onglet profil, qui donnera accès aux informations déjà remplis, l’utilisateur pourra les modifier (requêtes sql). Il pourra aussi fournir d’autres informations comme sa station préférée via un formulaire complémentaire. 

Dans l'objectif de faire des statistiques, nous devons respecter l’orthographe
Pour les champs de la station préférée de départ et d'arrivé, ils seront vérifiés par l’auto complétion de l’API Algolia Places.
Le champ ligne préféré sera fourni par une liste à puce écrite en brute. 


Statistiques utilisateur et les perturbation annoncées sur l’ensemble du réseau

Lorsque l’utilisateur est connecté il peut avoir accès aux statistiques de son compte. 
On pourra alors utiliser des requêtes sql qui chercheront des informations dans la table Trajet, que l’on pourra afficher avec une librairie graphique.

google:
https://developers.google.com/chart/

highcharts
https://www.highcharts.com/

Les informations ne sont pas données en temps réel mais on va faire comme si. 
On clique sur l’onglet “trafic” présent dans le menu.
On va faire une requête sur l’API pour avoir les informations trafic. Nous allons donc avoir une page qui présentera toutes les perturbations du réseau RATP.
l’option d’alimenter les statistiques réelles de voyage en fonction de l’utilisateur connecté

A chaque recherche de trajet, les informations seront enregistrer en base (statio depart, station arrivé, heure départ, heure arrivée, durée du trajet)
L’utilisateur connecté pourra alors visualiser ses stat dans la page de son profil

Relayer instantané les fils twitter d’info trafic concernant le voyageur et ses parcours habituels

Dans le menu il y aura un onglet “twitter” qui donnera accès à un page, l’usager pourra alors choisir la ligne de métro qu’il souhaite via un bouton. Cela l’amenera sur une page qui affichera les post twitter de la ligne en question, grâce à une API. 
https://publish.twitter.com/#
Itinéraire depuis un point de départ, jusqu’à un point d’arrivé
Nous aurons deux inputs, où l’utilisateur pourra renseigner son point de départ et son point d’arrivé.
Ces deux inputs utilisent une autocomplétion grâce à l’API Algolia Places, ce qui nous permet d’éviter les fautes de frappe, et récupérer la latitude et longitude du point sélectionné par l’utilisateur. Il sera obligé de choisir parmis les suggestions proposé par cet API.
Ou alors si l’utilisateur est connecté, il pourra cliquer sur le bouton favoris qui ira chercher dans la base de données son adresse favorite.
Une fois les deux points choisis via les suggestions, un bouton de recherche permettra de récupérer les coordonnées des deux points, les insérer dans l’url de l’API Navitia.io, et faire un appelle à celle-ci, qui nous renverra un objet JSON avec le détail du trajet demandé.
Il ne nous restera plus qu’à extraire les données qui nous sont nécessaires (Heure de départ/arrivé , moyens de transport utilisés, temps de trajet, coordonnées geoJSON, …) et afficher celles-ci de manière ergonomique.
Nous ajouterons également un bouton permettant d’afficher la carte du trajet, dont la fonctionnalité sera décrite ci-après.



Secondaire
---
Prévisualisation du trajet sur une carte
    Nous récupérons les données issues du trajet choisi par l’utilisateur.
Dans ces données, il y a une catégorie geojson, constituée de coordonnées, de longueur … 
    Nous utiliserons l’API Leaflet pour récupérer une carte, l’initialiser, et rajouter les     points du geojson (type changement, etc…).
Nous afficherons ensuite la carte

Trajet toujours disponible, même lors d’une perte de connexion

Nous utiliserons des Service Workers afin de mettre en cache nos assets, ainsi que les données du trajet, pour que si l’utilisateur n’a plus de réseaux, son trajet lui soit toujours disponible.
On mettra donc en place plusieurs fonction liées aux services workers (initialisation, mise en cache, restitution, …)

