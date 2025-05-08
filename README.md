# Mini Jeu - Tamagotchi

Ce projet est un jeu de type **Tamagotchi**, où vous pouvez créer et interagir avec des animaux virtuels. Le but est de nourrir, soigner, 
câliner et surveiller la santé de vos animaux tout en faisant face à des éléments aléatoires comme la faim, la soif, l'humeur et l'âge. 
Le jeu prend également en compte les saisons, ce qui affecte l'état de vos animaux.

## Table des matières

1. Description
2. Prérequis
3. Installation
4. Utilisation
5. Fonctionnalités
6. Changement de saison
7. Structure du projet
8. Contribuer
9. License

---

## Description

Le jeu permet de créer des animaux virtuels, de les nourrir, de les soigner, de les caresser, et de gérer leurs besoins comme la faim, la soif, et l'humeur.
Le joueur a un nombre limité de **points d'action** qu'il peut dépenser pour effectuer ces actions. 
En outre, le jeu inclut un système de saisons, où chaque saison (printemps, été, automne, hiver) affecte différemment les animaux.

### Fonctionnalités principales :

- **Création d'animaux** : Le joueur peut créer de nouveaux animaux avec des icônes et des noms personnalisés.
- **Interactions avec les animaux** : Nourrir, soigner, et câliner les animaux.
- **Gestion des points d'action** : Les actions consomment des points d'action qui sont régénérés chaque jour.
- **Système de saisons** : La saison change tous les X jours, affectant la santé et l'humeur des animaux.
- **Provisions aléatoires** : Le joueur peut chercher des provisions pour nourrir et soigner ses animaux.

---

## Prérequis

Avant de commencer, assure-toi d'avoir les éléments suivants installés sur ton système :

- **PHP 7.4+** : Le projet est développé en PHP.
- **Serveur local** : Utilise un serveur comme [XAMPP](https://www.apachefriends.org/fr/index.html) ou [MAMP](https://www.mamp.info/fr/) pour exécuter le jeu localement.
- **Navigateur web** : Utilise un navigateur comme Chrome, Firefox, ou Safari pour accéder à l'interface du jeu.

---

## Installation

1. **Clonez le repository** : Si tu n'as pas encore téléchargé le projet, commence par cloner le repository.

    ```bash
    git clone https://github.com/ton-utilisateur/ton-projet.git
    cd ton-projet
    ```

2. **Installez les dépendances** : Si tu utilises un autoloader (comme `composer`), assure-toi d'installer toutes les dépendances nécessaires.

    ```bash
    composer install
    ```

3. **Configurez le serveur local** : Si tu utilises un serveur comme XAMPP ou MAMP, assure-toi que ton dossier `ton-projet` se trouve dans
4. le répertoire approprié (par exemple `htdocs` pour XAMPP). Ensuite, démarre le serveur Apache et accédez à l'application via `localhost/ton-projet`.

---

## Utilisation

1. **Démarrer le jeu** : Une fois l'application installée, ouvre le fichier `index.php` via ton serveur local pour démarrer le jeu.

2. **Créer un animal** : Sur l'interface du jeu, tu peux créer un animal en remplissant son nom et en sélectionnant une icône.

3. **Interactions avec l'animal** : Tu peux nourrir, soigner, et caresser tes animaux pour améliorer leur santé et humeur. Assure-toi de gérer tes points d'action judicieusement.

4. **Suivi des saisons** : Le jeu simule les saisons qui affectent la faim, la soif et l'humeur des animaux. La saison change automatiquement tous les X jours (géré par la méthode `changerSaison()`).

5. **Réinitialisation du jeu** : Tu peux également réinitialiser le jeu pour recommencer depuis le début.

---

## Fonctionnalités

### Changement de saison

Dans le jeu, les saisons changent tous les X jours (actuellement configuré pour chaque 5 jours). Le changement de saison affecte l'état de chaque animal en modifiant des attributs comme la faim, la soif, la santé, et l'humeur. Par exemple :

- **Printemps** : La faim diminue légèrement, la soif augmente modérément.
- **Été** : La faim diminue considérablement, la soif augmente fortement, les animaux deviennent plus fatigués.
- **Automne** : La faim augmente, la soif diminue légèrement.
- **Hiver** : La faim et la soif augmentent, les animaux sont plus fatigués.

#### Explication de la fonction `changerSaison()` dans `Game.php`

La fonction `changerSaison()` choisit aléatoirement une saison parmi les quatre (printemps, été, automne, hiver) et applique les effets de cette saison à tous les animaux dans le jeu. 
Cela est effectué dans la méthode `adjustForSeason()` de chaque animal. Par exemple :

```php
// Changer la saison de manière aléatoire
private function changerSaison() {
    $saisons = ["printemps", "été", "automne", "hiver"];
    $this->season = $saisons[array_rand($saisons)];
    $this->addMessage("On est en : " . $this->season);

    // Appliquer les effets de la saison sur chaque animal
    foreach ($this->animals as $animal) {
        $animal->adjustForSeason($this->season);
    }
}
