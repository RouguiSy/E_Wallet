# Projet E-Wallet

## Présentation

Le projet E-Wallet consiste à développer une application de gestion de portefeuilles électroniques en PHP procédural. L'application fonctionne en mode console et permet de simuler les principales opérations d'un portefeuille électronique.

Le projet est réalisé en deux parties :

- Partie A : Développement en PHP procédural sans fonctions natives de manipulation des tableaux et sans namespaces.
- Partie B : Refactorisation du projet avec les fonctions natives PHP, les namespaces et les bonnes pratiques de développement.

---

## Objectifs

L'application permet de :

- Créer un wallet
- Effectuer un dépôt
- Effectuer un retrait
- Consulter l'historique des transactions
- Quitter l'application

---

## Architecture du projet

Le projet est composé des fichiers suivants :

```
index.php
controller.php
services.php
repository.php
validator.php
```

### Description des fichiers

**index.php**

Point d'entrée de l'application.

- Affiche le menu principal
- Gère la boucle d'exécution
- Récupère le choix de l'utilisateur

**controller.php**

Intermédiaire entre l'interface utilisateur et la logique métier.

- Récupère les informations saisies
- Appelle les services appropriés

**services.php**

Contient la logique métier.

- Création des wallets
- Dépôts
- Retraits
- Calcul des frais
- Gestion des transactions

**repository.php**

Gère les données de l'application.

- Stockage des wallets
- Stockage des transactions
- Recherche des données
- Mise à jour des soldes

**validator.php**

Regroupe toutes les fonctions de validation.

- Validation des téléphones
- Validation des montants
- Validation des soldes
- Vérification de l'unicité
- Vérification des champs obligatoires

---

## Fonctionnalités

### Création d'un wallet

- Enregistrement d'un nouveau client
- Vérification de l'unicité du numéro de téléphone
- Vérification de l'unicité du code secret
- Initialisation du solde

### Dépôt

- Vérification de l'existence du wallet
- Validation du montant
- Mise à jour du solde
- Enregistrement de la transaction

### Retrait

- Vérification de l'existence du wallet
- Calcul automatique des frais
- Vérification du solde disponible
- Mise à jour du solde
- Enregistrement de la transaction

### Consultation des transactions

- Affichage de l'historique des opérations effectuées.

---

## Règles de gestion

- Le numéro de téléphone est obligatoire et unique.
- Le code secret est obligatoire et unique.
- Le solde initial doit être supérieur ou égal à zéro.
- Les montants des dépôts doivent être strictement positifs.
- Les montants des retraits doivent être strictement positifs.
- Un retrait est autorisé uniquement si le solde est suffisant pour couvrir le montant ainsi que les frais.

Les frais de retrait sont calculés selon les règles suivantes :

| Montant | Frais |
|----------|--------|
| 0 à 10 000 CFA | 200 CFA |
| 10 001 à 100 000 CFA | 500 CFA |
| Plus de 100 000 CFA | 1 % du montant (plafonné à 5 000 CFA) |

---

## Contraintes techniques

### Partie A

- PHP procédural
- Aucune classe
- Aucun namespace
- Aucune fonction native de manipulation des tableaux
- Utilisation de tableaux en mémoire

### Partie B

- Utilisation des fonctions natives PHP
- Utilisation des namespaces
- Refactorisation du code
- Présentation des concepts demandés (fonctions anonymes, closures, Composer, Packagist, etc.)

---

## Organisation du projet

Le projet est développé selon une approche progressive.

1. Mise en place de l'architecture
2. Développement du menu
3. Création des wallets
4. Dépôts
5. Retraits
6. Gestion des transactions
7. Refactorisation (Partie B)

---

## Gestion de projet

Le suivi du projet est assuré avec Trello selon la méthode Kanban.

Colonnes utilisées :

- Backlog
- À Faire
- En Cours
- Relecture / Test
- Terminé

Chaque fonctionnalité est développée sur une branche Git dédiée avant d'être fusionnée.

---

## Gestion des versions

Le projet suit le versionnement sémantique.

- v0.X.Y : Développement de la Partie A
- v1.0.0 : Livraison finale de la Partie A
- v1.X.Y : Développement de la Partie B
- v2.0.0 : Livraison finale de la Partie B

---

## Conventions de commits

Les commits suivent les conventions suivantes :

- feat
- fix
- refactor
- docs

---

## Exécution

Lancer l'application depuis le terminal :

```bash
php index.php
```

---
