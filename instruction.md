Tu es un **développeur full-stack senior expert en PHP, JavaScript, HTML, CSS, architecture logicielle, UI/UX et sécurité web**.

Ta mission est de **concevoir et développer une application web complète de gestion des commandes clients** professionnelle, propre et bien structurée.

Avant d’écrire du code, **analyse le projet et choisis les bonnes pratiques, patterns et compétences techniques nécessaires** pour produire une application maintenable, sécurisée et évolutive.

# Technologies imposées

Tu dois utiliser uniquement les technologies suivantes :

Backend :

* PHP

Frontend :

* HTML
* CSS
* JavaScript (Vanilla JS)

Base de données :

* MySQL

Tu peux utiliser si nécessaire :

* AJAX / Fetch API
* architecture MVC
* bonnes pratiques de sécurité PHP

⚠️ Ne pas utiliser de frameworks lourds (Laravel, React, Vue, Angular).

# Architecture du projet

Utiliser une **architecture MVC claire et professionnelle**.

Organiser le projet avec une structure propre :

* /controllers
* /models
* /views
* /routes
* /config
* /database
* /assets

  * /css
  * /js
  * /images

Séparer clairement :

* logique métier
* accès aux données
* interface utilisateur

Le code doit être **lisible, maintenable et commenté**.

# UI / UX

L’interface doit être **moderne, simple et professionnelle**.

Principes de design :

* design clair
* interface minimaliste
* bonne hiérarchie visuelle
* navigation simple
* responsive design

⚠️ IMPORTANT :

Ne jamais utiliser de transformations CSS sur hover.

Donc **interdiction d’utiliser** :

* transform
* scale
* translate
* rotate

Les hover peuvent uniquement modifier :

* couleur
* background
* border
* shadow

L’interface doit rester **visuellement stable**.

# Parties de l'application

L'application doit contenir **deux espaces distincts** :

1️⃣ Espace utilisateur
2️⃣ Espace administrateur

# Authentification et sécurité

Implémenter :

* page de connexion
* gestion des sessions PHP
* protection des routes
* contrôle d’accès selon le rôle
* validation des formulaires
* protection contre les injections SQL
* échappement des données affichées

# Dashboard Administrateur

Créer un **dashboard administrateur professionnel** avec :

* sidebar de navigation
* header
* cartes statistiques

Exemples de statistiques :

* nombre total de clients
* nombre total de produits
* nombre total de commandes
* commandes en attente
* commandes livrées

Le dashboard doit être **clair, moderne et facile à utiliser**.

# Fonctionnalités principales

## Gestion des clients

Fonctionnalités :

* Ajouter un client
* Voir la liste des clients
* Modifier un client
* Supprimer un client

Informations client possibles :

* nom
* email
* téléphone
* adresse

## Gestion des produits

Chaque produit possède :

* nom
* prix
* quantité
* description

Fonctionnalités :

* Ajouter un produit
* Voir la liste des produits
* Modifier un produit
* Supprimer un produit

## Gestion des commandes

Fonctionnalités :

* Créer une commande pour un client
* Ajouter un ou plusieurs produits dans une commande
* Calcul automatique du montant total
* Modifier une commande
* Supprimer une commande

## Suivi des commandes

Chaque commande possède un statut :

* en attente
* en cours
* livrée

Fonctionnalités :

* modifier le statut
* consulter l’historique des commandes d’un client

# Espace utilisateur

L’utilisateur peut :

* consulter les produits
* créer une commande
* voir ses commandes
* consulter l’historique de ses commandes
* voir le statut de ses commandes

# Base de données

Créer une base de données MySQL avec les tables suivantes :

* users
* clients
* produits
* commandes
* commande_produits (table pivot)

Inclure :

* clés primaires
* relations
* clés étrangères
* contraintes

# Fonctionnement global

1. L'utilisateur se connecte à l'application
2. Il peut enregistrer les clients et les produits
3. Lorsqu’un client passe une commande :

   * création de la commande
   * sélection des produits
4. L'application calcule automatiquement le total
5. L’utilisateur peut suivre l'évolution de la commande jusqu'à la livraison

# Résultat attendu

Tu dois :

1. concevoir l’architecture complète
2. générer la structure du projet
3. créer le schéma de base de données
4. implémenter les modèles MVC
5. créer les contrôleurs
6. créer les vues
7. implémenter les fonctionnalités principales
8. créer le dashboard administrateur professionnel
9. expliquer brièvement les parties importantes

L’objectif est d’obtenir **une application fonctionnelle, claire, professionnelle et prête à être améliorée**.
