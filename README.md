
# Projet Laravel - Gestion des Personnes

Ce projet Laravel permet de gérer des informations sur des personnes, avec la possibilité de créer des personnes, afficher la liste des personnes, et visualiser les relations familiales (parents et enfants). Les fonctionnalités sont basées sur une gestion de base de données et une interface utilisateur conviviale.

## Fonctionnalités

1. **Index des personnes** : 
   - Affiche la liste des personnes enregistrées dans la base de données.
   - Affiche également le nom de l'utilisateur qui a créé chaque personne.
   
2. **Afficher une personne** : 
   - Affiche les détails d'une personne spécifique (prénom, nom, etc.).
   - Affiche les parents et enfants de la personne, avec la possibilité de calculer les relations de parenté.

3. **Créer une personne** :
   - Permet de créer une nouvelle personne via un formulaire.
   - La personne créée est enregistrée dans la base de données avec l'utilisateur connecté comme créateur.

4. **Stocker la personne** :
   - Après la validation des données du formulaire de création, les informations sont enregistrées en base de données et l'utilisateur est redirigé vers la liste des personnes avec un message de succès.

# Schéma de la base de données
Consultez le schéma ici : [Voir le schéma](https://dbdiagram.io/d/67fec4d39cea640381d99c1e)


#### Structure du projet
Controllers : Contient les contrôleurs qui gèrent la logique de l'application.

PersonController.php : Contrôleur pour gérer les personnes (création, affichage, liste).

Models : Contient les modèles Eloquent pour interagir avec la base de données.

Person.php : Modèle représentant une personne.

User.php : Modèle représentant un utilisateur (lié à chaque personne via created_by).

Views : Contient les vues Blade qui affichent l'interface utilisateur.

people/index.blade.php : Vue pour afficher la liste des personnes.

people/show.blade.php : Vue pour afficher les détails d'une personne.

people/create.blade.php : Vue pour le formulaire de création d'une personne.

Database : Structure de la base de données.

Table people : Contient les informations sur chaque personne.

Table users : Contient les informations des utilisateurs (les créateurs).

Table relationships : Table pivot pour gérer les relations entre parents et enfants.



## Prérequis

- PHP >= 7.4
- Composer
- MySQL ou une autre base de données compatible avec Laravel
- Node.js et NPM pour la gestion des assets frontend

## Installation

1. Clonez ce repository sur votre machine locale :

```bash
git clone  https://github.com/Anaismarthe12/projet_laravel.git
cd yourprojectname

2. Installez les dépendances PHP avec Composer :

composer install

3.Configurez votre fichier .env :
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nom_de_la_base
DB_USERNAME=root
DB_PASSWORD=

---

### Résumé des étapes :
1. Le fichier `README.md` décrit la configuration du projet, les prérequis et les instructions d'installation.
2. Il fournit une vue d'ensemble des routes et du flux de travail, ainsi que des informations sur la structure de base de données et les exemples de données.
3. Il contient aussi une section pour la contribution et le suivi de licence.

Vous pouvez ajuster le fichier pour qu'il soit parfaitement adapté à votre projet. Si vous avez déjà un compte GitHub, n'oubliez pas de faire un `git push` vers le repository GitHub pour publier ce fichier et partager votre projet avec la communauté.

---

Si vous avez besoin de plus d'aide pour le push sur GitHub ou d'autres ajustements dans le projet, n'hésitez pas à demander !

