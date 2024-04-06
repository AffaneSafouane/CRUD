-- Active: 1712390982303@@127.0.0.1@3306@eleves
-- Relation de table un à plusieurs --

-- Création de la BDD Eleves --
CREATE DATABASE IF NOT EXISTS Eleves;
use Eleves;

-- Création de la table Diplomes -- 
CREATE TABLE IF NOT EXISTS Diplomes (
    diplome_id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    diplome varchar(20) NOT NULL
);

-- Insertion des donénes dans la table Diplomes --
INSERT INTO Diplomes (diplome) VALUES ('Brevet');
INSERT INTO Diplomes (diplome) VALUES ('Bac Generale');
INSERT INTO Diplomes (diplome) VALUES ('Bac Technologique');
INSERT INTO Diplomes (diplome) VALUES ('Bac Professionnel');
INSERT INTO Diplomes (diplome) VALUES ('Sans diplôme');

-- Création de la table Classes --
CREATE TABLE IF NOT EXISTS Classes (
    classe_id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    classe varchar(10) NOT NULL
);

-- Insertion des donénes dans la table Classes --
INSERT INTO Classes (classe) VALUES ('BTS SIO');
INSERT INTO Classes (classe) VALUES ('Terminal');
INSERT INTO Classes (classe) VALUES ('Premiere');
INSERT INTO Classes (classe) VALUES ('Seconde');

-- Création de la table Eleve lié à Diplomes et Classes --
CREATE TABLE IF NOT EXISTS Eleve (
    eleve_id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nom varchar(64) NOT NULL,
    prenom varchar(64) NOT NULL,
    ville varchar(64) NOT NULL,
    sexe char(1) NOT NULL,
    naissance date NOT NULL,  
    classe_id int NOT NULL,
    diplome_id int NOT NULL,
    CONSTRAINT FK_EleveClasses FOREIGN KEY (classe_id) REFERENCES Classes(classe_id) ON DELETE CASCADE ON UPDATE CASCADE
);

-- Insertion des donénes dans la table Eleve --
INSERT INTO Eleve (nom, prenom, ville, sexe, naissance, classe_id, diplome_id) VALUES ('Parker', 'Peter', 'New York', 'H', '2005-06-13', '2', '1');
INSERT INTO Eleve (nom, prenom, ville, sexe, naissance, classe_id, diplome_id) VALUES ('Carter', 'Diana', 'Metropolis', 'F', '2004-02-13', '1', '2');
INSERT INTO Eleve (nom, prenom, ville, sexe, naissance, classe_id, diplome_id) VALUES ('Queen', 'Oliver', 'Starling City', 'H', '2003-12-27', '4', '5');
INSERT INTO Eleve (nom, prenom, ville, sexe, naissance, classe_id, diplome_id) VALUES ('Drake', 'Nathan', 'Santa Monica', 'H', '2004-03-13', '1', '3');
INSERT INTO Eleve (nom, prenom, ville, sexe, naissance, classe_id, diplome_id) VALUES ('McFly', 'Marty', 'Hill Valley', 'H', '2003-10-25', '1', '4'); 

SELECT * FROM eleve;

CREATE TABLE IF NOT EXISTS Eleve_Diplomes (
    eleve_id INT NOT NULL,
    diplome_id INT NOT NULL, 
    CONSTRAINT FK_EleveDiplomes FOREIGN KEY (eleve_id) REFERENCES Eleve(eleve_id) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT FK_DiplomesEleve FOREIGN KEY (diplome_id) REFERENCES Diplomes(diplome_id) ON DELETE CASCADE ON UPDATE CASCADE,
    PRIMARY KEY (eleve_id, diplome_id)
);

ALTER TABLE Eleve_Diplomes RENAME Possede;

INSERT INTO Possede (eleve_id, diplome_id) VALUES ('1', '1');
INSERT INTO Possede (eleve_id, diplome_id) VALUES ('1', '2');

-- Affichage des infos --
SELECT e.nom, e.prenom, e.ville, e.sexe, e.naissance, d.diplome, cl.classe
FROM Eleve e
JOIN Possede po ON e.eleve_id = po.eleve_id
JOIN Diplomes d ON d.diplome_id = po.diplome_id
JOIN Classes cl ON e.classe_id = cl.classe_id; 

