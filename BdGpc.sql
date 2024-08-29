CREATE DATABASE GestionProjetCollaboratif;

USE GestionProjetCollaboratif;

-- Création de la table Utilisateurs
CREATE TABLE Utilisateurs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255),
    prenom VARCHAR(255),
    email VARCHAR(255) UNIQUE,
    password VARCHAR(255),
    profession VARCHAR(255)
);

-- Création de la table Profils Utilisateurs
CREATE TABLE Profils_Utilisateurs (
    utilisateur_id INT PRIMARY KEY,
    image_profil VARCHAR(255),
    bio TEXT,
    autres_infos TEXT,
    FOREIGN KEY (utilisateur_id) REFERENCES Utilisateurs(id)
);

-- Création de la table Workspace
CREATE TABLE Workspace (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255),
    createur_id INT,
    FOREIGN KEY (createur_id) REFERENCES Utilisateurs(id)
);

-- Création de la table Paramètres Workspace
CREATE TABLE Parametres_Workspace (
    workspace_id INT PRIMARY KEY,
    couleur_fond VARCHAR(7),
    image_fond VARCHAR(255),
    ordre_cards TEXT,
    FOREIGN KEY (workspace_id) REFERENCES Workspace(id)
);

-- Création de la table Membres
CREATE TABLE Membres (
    workspace_id INT,
    utilisateur_id INT,
    role VARCHAR(255),
    PRIMARY KEY (workspace_id, utilisateur_id),
    FOREIGN KEY (workspace_id) REFERENCES Workspace(id),
    FOREIGN KEY (utilisateur_id) REFERENCES Utilisateurs(id)
);

-- Création de la table Cards
CREATE TABLE Cards (
    id INT AUTO_INCREMENT PRIMARY KEY,
    workspace_id INT,
    nom VARCHAR(255),
    description TEXT,
    FOREIGN KEY (workspace_id) REFERENCES Workspace(id)
);

-- Création de la table Ordre Taches dans Cards
CREATE TABLE Ordre_Taches_dans_Cards (
    card_id INT PRIMARY KEY,
    ordre_taches TEXT,
    FOREIGN KEY (card_id) REFERENCES Cards(id)
);

-- Création de la table Taches
CREATE TABLE Taches (
    id INT AUTO_INCREMENT PRIMARY KEY,
    card_id INT,
    titre VARCHAR(255),
    description TEXT,
    date_debut DATE,
    date_fin DATE,
    statut VARCHAR(255),
    FOREIGN KEY (card_id) REFERENCES Cards(id)
);

-- Création de la table Tags pour les Tâches
CREATE TABLE Tags_Taches (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tache_id INT,
    nom_tag VARCHAR(255),
    FOREIGN KEY (tache_id) REFERENCES Taches(id)
);

-- Création de la table Commentaires
CREATE TABLE Commentaires (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tache_id INT,
    utilisateur_id INT,
    texte TEXT,
    date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (tache_id) REFERENCES Taches(id),
    FOREIGN KEY (utilisateur_id) REFERENCES Utilisateurs(id)
);

-- Création de la table Messages
CREATE TABLE Messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    expediteur_id INT,
    destinataire_id INT,
    texte TEXT,
    date_envoi TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (expediteur_id) REFERENCES Utilisateurs(id),
    FOREIGN KEY (destinataire_id) REFERENCES Utilisateurs(id)
);

ALTER TABLE Messages
ADD COLUMN is_read BOOLEAN DEFAULT 0;

-- Création de la table Notifications
CREATE TABLE Notifications (
    id INT AUTO_INCREMENT PRIMARY KEY,
    utilisateur_id INT,
    type VARCHAR(255),
    contenu TEXT,
    date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    vue BOOLEAN DEFAULT FALSE,
    FOREIGN KEY (utilisateur_id) REFERENCES Utilisateurs(id)
);

-- Création de la table Événements et Historique des Modifications
CREATE TABLE Evenements_Historique (
    id INT AUTO_INCREMENT PRIMARY KEY,
    type_element VARCHAR(255),
    element_id INT,
    action VARCHAR(255),
    utilisateur_id INT,
    description TEXT,
    date_modification TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (utilisateur_id) REFERENCES Utilisateurs(id)
);

-- Création de la table Documents et Fichiers
CREATE TABLE Documents_Fichiers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tache_id INT,
    message_id INT,
    nom_fichier VARCHAR(255),
    chemin_fichier VARCHAR(255),
    type_fichier VARCHAR(255),
    date_upload TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (tache_id) REFERENCES Taches(id),
    FOREIGN KEY (message_id) REFERENCES Messages(id)
);

-- Création de la table Professions
CREATE TABLE professions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL
);

-- insertion des professions
INSERT INTO professions (name) VALUES ('Développeur'), ('Designer'), ('Chef de projet'), ('Community Manager'), ('Data Scientist'), ('Développeur Web'), ('Développeur Mobile'), ('Développeur Front-End'), ('Développeur Back-End'), ('Développeur Full-Stack'), ('Développeur Java'), ('Développeur Python'), ('Développeur PHP'), ('Développeur C++'), ('Développeur C#'), ('Développeur Ruby'), ('Développeur Swift'), ('Développeur Kotlin'), ('Développeur JavaScript'), ('Développeur TypeScript'), ('Développeur Angular'), ('Développeur React'), ('Développeur Vue.js'), ('Développeur Node.js'), ('Développeur Express.js'), ('Développeur Laravel'), ('Développeur Symfony'), ('Développeur Django'), ('Développeur Flask'), ('Développeur Spring'), ('Développeur Hibernate'), ('Développeur JPA'), ('Développeur JDBC'), ('Développeur JSP'), ('Développeur JSF'), ('Développeur Struts'), ('Développeur Spring Boot'), ('Développeur Spring MVC'), ('Développeur Spring Security'), ('Développeur Spring Data JPA'), ('Développeur Spring Cloud'), ('Développeur Spring Batch'), ('Développeur Spring Integration'), ('Développeur Spring Web Services'), ('Développeur Spring WebFlux'), ('Développeur Spring HATEOAS'), ('Développeur Spring REST Docs'), ('Développeur Spring Session'), ('Développeur Spring Boot Admin'), ('Développeur Spring Boot Actuator'), ('Développeur Spring Boot DevTools'), ('Développeur Spring Boot Flyway'), ('Développeur Spring Boot Liquibase'), ('Développeur Spring Boot Thymeleaf'), ('Développeur Spring Boot FreeMarker'), ('Développeur Spring Boot Mustache'), ('Développeur Spring Boot Groovy Templates'), ('Développeur Spring Boot JSP'), ('Développeur Spring Boot Apache Tiles'), ('Développeur Spring Boot Vaadin'), ('Développeur Spring Boot WebFlow'), ('proffesseur'), ('étudiant'), ('ingénieur'), ('médecin'), ('avocat'), ('architecte'), ('comptable'), ('économiste'), ('journaliste'), ('photographe'), ('peintre'), ('sculpteur'), ('écrivain'), ('musicien'), ('chanteur'), ('acteur'), ('danseur'), ('sportif'), ('policier'), ('pompier'), ('militaire'), ('politicien'), ('diplomate'), ('chercheur'), ('astronome'), ('mathématicien'), ('physicien'), ('chimiste'), ('biologiste'), ('géologue'), ('archéologue'), ('historien'), ('géographe'), ('sociologue'), ('psychologue'), ('philosophe'), ('théologien'), ('éthicien'), ('logicien'), ('linguiste'), ('traducteur'), ('interprète'), ('professeur de langues'), ('professeur de musique'), ('professeur de sport'), ('professeur de danse'), ('professeur de théâtre'), ('professeur de dessin'), ('professeur de peinture'), ('professeur de sculpture'), ('professeur de photographie'), ('professeur de cinéma'), ('professeur de journalisme'), ('professeur de droit'), ('professeur de médecine'), ('professeur d''architecture'), ('professeur d''économie'), ('professeur de comptabilité'), ('professeur de philosophie'), ('professeur de sociologie'), ('professeur de psychologie'), ('professeur de géographie'), ('professeur d''histoire'), ('professeur de mathématiques'), ('professeur de physique'), ('professeur de chimie'), ('professeur de biologie'), ('professeur de géologie'), ('professeur d''archéologie'), ('professeur de musique'), ('professeur de danse'), ('professeur de sport'), ('professeur de langue'), ('professeur de littérature'), ('professeur de philosophie'), ('professeur de théologie'), ('professeur de logique'), ('professeur de programmation'), ('professeur de développement web'), ('professeur de développement mobile'), ('professeur de développement logiciel'), ('professeur de développement informatique'), ('professeur de développement d''applications'), ('professeur de développement de jeux vidéo'), ('professeur de développement de logiciels embarqués'), ('professeur de développement de systèmes embarqués'), ('professeur de développement de systèmes d''exploitation'), ('professeur de développement de systèmes de gestion de bases de données'), ('professeur de développement de systèmes de gestion de contenu'), ('professeur de développement de systèmes de gestion de versions'), ('professeur de développement de systèmes de gestion de projets'), ('professeur de développement de systèmes de gestion de tâches'), ('professeur de développement de systèmes de gestion de fichiers'), ('professeur de développement de systèmes de gestion de documents'), ('professeur de développement de systèmes de gestion de connaissances'), ('professeur de développement de systèmes de gestion de ressources humaines'), ('professeur de développement de systèmes de gestion de ressources matérielles'), ('professeur de développement de systèmes de gestion de ressources financières'), ('professeur de développement de systèmes de gestion de ressources logicielles'), ('professeur de développement de systèmes de gestion de ressources matérielles et logicielles'), ('professeur de développement de systèmes de gestion de ressources humaines et financières'), ('professeur de développement de systèmes de gestion de ressources humaines et matérielles'), ('professeur de développement de systèmes de gestion de ressources financières et logicielles'), ('professeur de développement de systèmes de gestion de ressources humaines, financières et matérielles'), ('professeur de développement de systèmes de gestion de ressources humaines, financières et logicielles'), ('professeur de développement de systèmes de gestion de ressources humaines, matérielles et logicielles'), ('professeur de développement de systèmes de gestion de ressources financières, matérielles et logicielles'), ('professeur de développement de systèmes de gestion de ressources humaines, financières, matérielles et logicielles'), ('enseignant'), ('professeur'), ('formateur'), ('coach'), ('consultant'), ('expert'), ('analyste'), ('conseiller'), ('spécialiste'), ('expert-comptable'), ('expert en finance'), ('expert en économie'), ('expert en droit'), ('expert en informatique'), ('expert en programmation'), ('expert en développement web'), ('expert en développement mobile'), ('expert en développement logiciel'), ('expert en développement informatique'), ('expert en développement d''applications'), ('expert en développement de jeux vidéo'), ('expert en développement de logiciels embarqués'), ('expert en développement de systèmes embarqués'), ('expert en développement de systèmes d''exploitation'), ('expert en développement de systèmes de gestion de bases de données'), ('expert en développement de systèmes de gestion de contenu'), ('expert en développement de systèmes de gestion de versions'), ('expert en développement de systèmes de gestion de projets'), ('expert en développement de systèmes de gestion de tâches'), ('expert en développement de systèmes de gestion de fichiers'), ('expert en développement de systèmes de gestion de documents'), ('expert en développement de systèmes de gestion de connaissances'), ('expert en développement de systèmes de gestion de ressources humaines'), ('expert en développement de systèmes de gestion de ressources matérielles'), ('expert en développement de systèmes de gestion de ressources financières'), ('expert en développement de systèmes de gestion de ressources logicielles'), ('expert en développement de systèmes de gestion de ressources matérielles et logicielles'), ('expert en développement de systèmes de gestion de ressources humaines et financières'), ('expert en développement de systèmes de gestion de ressources humaines et matérielles'), ('expert en développement de systèmes de gestion de ressources financières et logicielles'), ('expert en développement de systèmes de gestion de ressources humaines, financières et matérielles'), ('expert en développement de systèmes de gestion de ressources humaines, financières et logicielles'), ('expert en développement de systèmes de gestion de ressources humaines, matérielles et logicielles'), ('expert en développement de systèmes de gestion de ressources financières, matérielles et logicielles');
