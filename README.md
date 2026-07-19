# Groupe Industriel

Application web CRUD pour la gestion des departements d'un groupe industriel.

## Departements

- **Achat** - Gestion des charges d'achat et fournisseurs
- **Production** - Gestion des employes de production et produits (groupes A-E)
- **Commercial & Marketing** - Gestion des charges marketing et clients
- **Administratif** - Gestion des charges administratives

## Technologies

- HTML5 / CSS3 / JavaScript
- PHP (mysqli)
- MySQL (XAMPP)

## Installation

1. Installer XAMPP et demarrer Apache + MySQL
2. Copier le dossier `Projet` dans `C:\xampp\htdocs\`
3. Importer la base de donnees `ma_base.sql` dans phpMyAdmin
4. Acceder a `http://localhost/Projet/`

## Structure

```
Projet/
├── index.html              # Page d'accueil
├── achat.php               # Departement achat
├── production.php           # Departement production
├── cometmkg.php             # Departement commercial & marketing
├── administratif.php        # Departement administratif
├── tableau_*.php            # Tableaux de donnees
├── edit_*.php               # Pages de modification
├── remove_*.php             # Pages de suppression
├── clients.php              # Liste des clients
├── producteurs.php          # Liste des producteurs
├── devis.php                # Ajout de devis
├── *.css                    # Styles (syncronises depuis index.css)
├── ma_base.sql              # Schema de la base de donnees
└── logo.png                 # Logo du groupe
```
