-- Active: 1712390982303@@127.0.0.1@3306@eleves
-- Relation de table un à plusieurs --

-- Création de la BDD Eleves --
CREATE DATABASE IF NOT EXISTS Etudiants;
use Etudiants;

-- Création de la table Classes --
CREATE TABLE IF NOT EXISTS Classes (
    classe_id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    classe varchar(100) NOT NULL UNIQUE
);
 
-- Insertion des donénes dans la table Classes --
INSERT INTO Classes (classe) VALUES ('BTS');
INSERT INTO Classes (classe) VALUES ('License');
INSERT INTO Classes (classe) VALUES ('Master');
INSERT INTO Classes (classe) VALUES ('Doctorat');

-- Création de la table Eleve lié à Diplomes et Classes --
CREATE TABLE IF NOT EXISTS etudiant (
    etudiant_id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nom varchar(150) NOT NULL,
    prenom varchar(150) NOT NULL,
    ville varchar(150) NOT NULL,
    sexe char(1) NOT NULL,
    naissance date NOT NULL,  
    email varchar(250) NULL UNIQUE,
    phone char(10) NULL UNIQUE, 
    classe_id int NOT NULL,
    CONSTRAINT FK_etudiantClasses FOREIGN KEY (classe_id) REFERENCES Classes(classe_id)
);

-- Insertion des donénes dans la table Etudiant --
INSERT INTO etudiant (nom, prenom, ville, sexe, naissance, classe_id) VALUES ('Parker', 'Peter', 'New York', 'H', '2005-06-13', '2');
INSERT INTO etudiant (nom, prenom, ville, sexe, naissance, classe_id) VALUES ('Carter', 'Diana', 'Metropolis', 'F', '2004-02-13', '1');
INSERT INTO etudiant (nom, prenom, ville, sexe, naissance, classe_id) VALUES ('Queen', 'Oliver', 'Starling City', 'H', '2003-12-27', '4');
INSERT INTO etudiant (nom, prenom, ville, sexe, naissance, classe_id) VALUES ('Drake', 'Nathan', 'Santa Monica', 'H', '2004-03-13', '1');
INSERT INTO etudiant (nom, prenom, ville, sexe, naissance, classe_id) VALUES ('McFly', 'Marty', 'Hill Valley', 'H', '2003-10-25', '1'); 

-- Création de la table Diplomes -- 
CREATE TABLE IF NOT EXISTS Diplomes (
    diplome_id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    diplome varchar(100) NOT NULL UNIQUE
);

-- Insertion des donénes dans la table Diplomes --
INSERT INTO Diplomes (diplome) VALUES ('Sans diplôme');
INSERT INTO Diplomes (diplome) VALUES ('Brevet');
INSERT INTO Diplomes (diplome) VALUES ('CAP');
INSERT INTO Diplomes (diplome) VALUES ('Baccalauréat Général');
INSERT INTO Diplomes (diplome) VALUES ('Baccalauréat Technologique');
INSERT INTO Diplomes (diplome) VALUES ('Baccalauréat Professionnel');

CREATE TABLE IF NOT EXISTS Possede (
    etudiant_id INT NOT NULL,
    diplome_id INT NOT NULL, 
    CONSTRAINT FK_EtudiantDiplomes FOREIGN KEY (etudiant_id) REFERENCES etudiant(etudiant_id),
    CONSTRAINT FK_DiplomesEtudiant FOREIGN KEY (diplome_id) REFERENCES Diplomes(diplome_id),
    PRIMARY KEY (etudiant_id, diplome_id) 
);

INSERT INTO Possede (etudiant_id, diplome_id) VALUES ('2', '2');
INSERT INTO Possede (etudiant_id, diplome_id) VALUES ('2', '3');
INSERT INTO Possede (etudiant_id, diplome_id) VALUES ('3', '5');
INSERT INTO Possede (etudiant_id, diplome_id) VALUES ('4', '1'); 
INSERT INTO Possede (etudiant_id, diplome_id) VALUES ('5', '4');
INSERT INTO Possede (etudiant_id, diplome_id) VALUES ('1', '1'); 
