CREATE DATABASE ma_bd;

USE ma_bd;

-- Table departement_achat
CREATE TABLE departement_achat (
    id_charge_achat INT(3) AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(60) NOT NULL,
    prenom VARCHAR(60) NOT NULL,
    age INT(2) CHECK (age >= 18),
    email VARCHAR(80) UNIQUE NOT NULL,
    adresse VARCHAR(100),
    date_recrutement DATE NOT NULL,
    nombre_des_fournisseurs INT(2) DEFAULT 0,
    salaire INT(5) CHECK (salaire >= 0)
);

-- Table fournisseurs
CREATE TABLE fournisseurs (
    id_fournisseur INT(3) AUTO_INCREMENT PRIMARY KEY,
    nom_fournisseur VARCHAR(60) NOT NULL,
    email_fournisseur VARCHAR(60) UNIQUE NOT NULL,
    id_charge_achat INT(3),
    FOREIGN KEY (id_charge_achat) REFERENCES departement_achat(id_charge_achat) ON DELETE SET NULL
);

-- Table departement_production
CREATE TABLE departement_production (
    id_employee_production INT(3) AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(60) NOT NULL,
    prenom VARCHAR(60) NOT NULL,
    age INT(2) CHECK (age >= 18),
    email VARCHAR(80) UNIQUE NOT NULL,
    adresse VARCHAR(100),
    date_recrutement DATE NOT NULL,
    groupe VARCHAR(1) NOT NULL UNIQUE, 
    salaire INT(5) CHECK (salaire >= 0) 
);

-- Table produits
CREATE TABLE produits (
    id_produit INT(3) AUTO_INCREMENT PRIMARY KEY,
    nom_produit VARCHAR(60) NOT NULL,
    model VARCHAR(60),
    cout INT(10) CHECK (cout >= 0),
    prix_de_vente INT(10) CHECK (prix_de_vente >= 0),
    groupe VARCHAR(1) NOT NULL,
    quantite_en_stock INT(5) DEFAULT 0,
    quantite_vendue INT(5) DEFAULT 0,
    FOREIGN KEY (groupe) REFERENCES departement_production(groupe) ON DELETE SET NULL
);

-- Table departement_mkg
CREATE TABLE departement_mkg (
    id_charge_mkg INT(3) AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(60) NOT NULL,
    prenom VARCHAR(60) NOT NULL,
    age INT(2) CHECK (age >= 18),
    email VARCHAR(80) UNIQUE NOT NULL,
    adresse VARCHAR(100),
    date_recrutement DATE NOT NULL,
    nombre_des_clients INT(2) DEFAULT 0,
    salaire INT(5) CHECK (salaire >= 0)
);

-- Table clients
CREATE TABLE clients (
    id_client INT(3) AUTO_INCREMENT PRIMARY KEY,
    nom_client VARCHAR(60) NOT NULL,
    email_client VARCHAR(80) UNIQUE NOT NULL,
    nombre_de_commandes INT(3) DEFAULT 0,
    id_charge_mkg INT(3),
    FOREIGN KEY (id_charge_mkg) REFERENCES departement_mkg(id_charge_mkg) ON DELETE SET NULL
);

-- Table departement_administratif
CREATE TABLE departement_administratif (
    id_charge_admin INT(3) AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(60) NOT NULL,
    prenom VARCHAR(60) NOT NULL,
    age INT(2) CHECK (age >= 18),
    email VARCHAR(80) UNIQUE NOT NULL,
    adresse VARCHAR(100),
    date_recrutement DATE NOT NULL,
    salaire INT(5) CHECK (salaire >= 0)
);
