-- Création de la base de données compatible avec tout les caractères 
DROP DATABASE IF EXISTS checkvoyages;
CREATE DATABASE checkvoyages CHARSET utf8mb4;

USE checkvoyages;

-- Création des tables 
CREATE TABLE IF NOT EXISTS `user`(
	id_user INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    lastname VARCHAR(50) NOT NULL,
    firstname VARCHAR(50) NOT NULL,
    thumbnail VARCHAR(255),
    psswrd VARCHAR(100) NOT NULL,
    email VARCHAR(50) NOT NULL UNIQUE,
    login VARCHAR(50) NOT NULL UNIQUE
)ENGINE=innoDB;

CREATE TABLE IF NOT EXISTS destinationGroup (
    id_destinationGroup INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    name VARCHAR(50) NOT NULL UNIQUE
)ENGINE=innoDB;

CREATE TABLE IF NOT EXISTS destination(
	id_destination INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    id_destinationGroup INT NOT NULL,
    title VARCHAR(100) NOT NULL UNIQUE,
    content TEXT NOT NULL,
    thumbnail VARCHAR(255),
    publication_date DATETIME NOT NULL
)ENGINE=innoDB;

CREATE TABLE IF NOT EXISTS article(
	id_article INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    title VARCHAR(100) NOT NULL,
    thumbnail VARCHAR(255),
    content TEXT NOT NULL,
    creation_date DATETIME NOT NULL,
    id_user INT,-- devient null pour le on delete set null 
    id_destination INT NOT NULL-- not null toujours=avec une valeur, vu que je veux que si je supprime une destination, l'article aussi
)ENGINE=innoDB;

CREATE TABLE IF NOT EXISTS `comment`(
	id_comments INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    content TEXT NOT NULL,
    date_comment DATETIME NOT NULL,
    id_user INT,-- null vu que je fais on delete set null , si je supprime un user je ne supprime pas ses commentaires
    id_article INT NOT NULL
)ENGINE=innoDB;

CREATE TABLE IF NOT EXISTS user_like_article(
	id_user INT NOT NULL, -- 1 like est toujours donné par 1 user, du coup ça ne peut pas etre null
    id_article INT NOT NULL, -- 1 like est toujours pour 1 article, du coup ça ne peut pas etre null
    PRIMARY KEY (id_user, id_article)
)ENGINE=innoDB;

-- Création de contraintes des clés étrangères
-- Je commence par créer les tables avec ON DELETE CASCADE, ça veut dire avec 1 comme minimum dans une des cardinalités

ALTER TABLE article
ADD CONSTRAINT fk_user_article
FOREIGN KEY (id_user)
REFERENCES `user`(id_user)
ON DELETE SET NULL; -- quand je supprime un user mon id_user prend la vamleur null et l'article reste

ALTER TABLE article
ADD CONSTRAINT fk_article_destination
FOREIGN KEY (id_destination)
REFERENCES destination(id_destination)
ON DELETE CASCADE;

ALTER TABLE `comment`
ADD CONSTRAINT fk_user_comment
FOREIGN KEY (id_user)
REFERENCES `user`(id_user)
ON DELETE SET NULL;

ALTER TABLE `comment`
ADD CONSTRAINT fk_comment_article
FOREIGN KEY (id_article)
REFERENCES article(id_article)
ON DELETE CASCADE; -- si je supprime un article je fais la suppression en cascade sur le commentaire

ALTER TABLE user_like_article
ADD CONSTRAINT fk_liker_article
FOREIGN KEY (id_article)
REFERENCES article(id_article)
ON DELETE CASCADE;

ALTER TABLE user_like_article
ADD CONSTRAINT fk_liker_user
FOREIGN KEY (id_user)
REFERENCES `user`(id_user)
ON DELETE CASCADE
;

ALTER TABLE destination
ADD CONSTRAINT fk_destinationGroup_destination
FOREIGN KEY (id_destinationGroup)
REFERENCES destinationGroup(id_destinationGroup)
ON DELETE RESTRICT; -- je ne peux pas supprimer un groupe de destination si des destinations y sont rattachées






