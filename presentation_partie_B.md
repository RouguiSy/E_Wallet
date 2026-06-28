# Projet E-Wallet - Partie B

## Présentation

Cette seconde partie consiste à améliorer l'application développée lors de la Partie A en appliquant des pratiques modernes de développement PHP.

L'objectif est d'optimiser le code existant tout en conservant les mêmes fonctionnalités.

## Améliorations

La Partie B apporte les améliorations suivantes :

- Refactorisation du code
- Utilisation des fonctions natives de manipulation des tableaux
- Utilisation des namespaces
- Amélioration de l'organisation du projet

## Architecture

Le projet conserve la même architecture.

```
index.php
controller.php
services.php
repository.php
validator.php
```

Les namespaces sont ajoutés afin de mieux organiser les différentes parties de l'application.

## Fonctionnalités

Toutes les fonctionnalités de la Partie A sont conservées.

- Création d'un wallet
- Dépôt
- Retrait
- Consultation des transactions

## Nouveautés

### Fonctions natives PHP

Le code est simplifié grâce à l'utilisation de fonctions telles que :

- array_filter
- array_map
- array_search
- in_array

lorsque cela est pertinent.

### Namespaces

Les différents fichiers utilisent des namespaces afin de faciliter l'organisation du projet.

### Bonnes pratiques

Le code est rendu plus lisible et plus facilement maintenable.

## Lancement

Depuis le terminal :

```bash
php index.php
```

## Git

Branches utilisées :

- main
- develop-partB
- feature/*

Les commits respectent la convention :

- feat
- fix
- refactor
- docs

## Concepts étudiés

Cette partie couvre également les notions suivantes :

- Fonctions anonymes
- Fonctions fléchées
- Closures
- Fonctions natives de tableaux
- Composer
- Packagist

