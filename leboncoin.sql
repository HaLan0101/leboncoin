-- ============================================================
--   Nom de la base   :  LEBONCOIN
--   Nom de créateur  :  DANG Ngoc Ha Lan, DJ Everson PELENIO
--   Date de creation :  04/06/2020  
-- ============================================================


-- ============================================================
--   Table : Profil                                          
-- ===========================================================


 CREATE TABLE membre (  
	id_membre int(3) NOT NULL AUTO_INCREMENT,  
	pseudo varchar(30) NOT NULL,  
	mdp varchar(20) NOT NULL,  
	nom varchar(20) NOT NULL,  
	prenom varchar(20) NOT NULL,  
	email varchar(100) NOT NULL,
	photo varchar(300) NULL,   
	PRIMARY KEY (id_membre),  
	UNIQUE KEY email (email) ) ; 


INSERT INTO membre (pseudo, mdp, nom, prenom, email,photo) VALUES ('Yaya', '123456', 'DANG', 'Ngoc Ha Lan', 'ngochalan.dang@ynov.com','');

-- ============================================================
--   Table : Annonce                                          
-- ============================================================
CREATE TABLE IF NOT EXISTS annonce ( 

  id_annonce int(10) NOT NULL AUTO_INCREMENT,
	
  photo varchar(200) DEFAULT NULL,  

  type_article varchar(50) DEFAULT NULL, 

  statut enum('actif','inactif') NOT NULL,

  titre varchar(200) NOT NULL, 

  prix float DEFAULT NULL,

  lieu varchar(100) DEFAULT NULL, 
 
  description_article varchar(10000) DEFAULT NULL, 

  date_publication date DEFAULT NULL, 

  auteur varchar(100) NOT NULL, 

  PRIMARY KEY (id_annonce) 

); 

