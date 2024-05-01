# Site dynamique ZenMasters

## Membres du groupe et repartition du travail
- Youness Tahiri El Alaoui
- Julien Pheng
- Eloi Masduraud
- Mohammed Hadj-hamdri
- Liâm Rouet | 35%
  
## Technologies utilisées
- Docker
- PHP
- Apache
- PostgreSQL
- PGADMIN
- HTML, CSS, JavaScript
- TWIG

## Installation
1. Cloner le projet
2. Lancer la commande docker-compose up -d --build
3. Acceder à l'URL : 'http://localhost:50180/' via votre navigateur web pour le site Web
4. Acceder à l'URL : 'http://localhost:50181/' via votre navigateur web pour PGADMIN
   

## Fonctionnalités en plus
Nous avons choisi de rajouter une page magasin permettant aux utilisateurs d'ajouter des produits dans leur panier. 
Cette page n'est accessible qu'une fois l'utilisateur connecté. 

Les produits sont déjà stockés dans une nouvelle table dans la base de données. 

Les pages d'inscription et de connexion sont fonctionnelles. 

Nous souhaitions aussi ajouter un système de recommandation des produits en fonction de la pathologie recherchée. Nous avons créé les tables de jointure mais n'avons pas fini de réaliser l'affichage des produits recommandés.

Ce projet a pour but de créer un site web dynamique. Il s'agit d'un site spécialisé dans l'acupunture. Il permet de consulter les différentes pathologies traitées par l'acupunture, les produits disponibles à la vente et de les ajouter au panier. Il permet également de s'inscrire et de se connecter pour passer une commande.