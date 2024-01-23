#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


#------------------------------------------------------------
# Table: camion
#------------------------------------------------------------

CREATE TABLE camion(
        immatriculation Varchar (50) NOT NULL ,
        localisation    Varchar (50) NOT NULL ,
        tempe           Varchar (50) NOT NULL
	,CONSTRAINT camion_PK PRIMARY KEY (immatriculation)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: gateway
#------------------------------------------------------------

CREATE TABLE gateway(
        id_GATEWAY Int  Auto_increment  NOT NULL ,
        MAC        Varchar (50) NOT NULL
	,CONSTRAINT gateway_PK PRIMARY KEY (id_GATEWAY)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: zone
#------------------------------------------------------------

CREATE TABLE zone(
        id_ZONE    Int  Auto_increment  NOT NULL ,
        nom        Varchar (50) NOT NULL ,
        id_GATEWAY Int NOT NULL
	,CONSTRAINT zone_PK PRIMARY KEY (id_ZONE)

	,CONSTRAINT zone_gateway_FK FOREIGN KEY (id_GATEWAY) REFERENCES gateway(id_GATEWAY)
	,CONSTRAINT zone_gateway_AK UNIQUE (id_GATEWAY)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: beacon
#------------------------------------------------------------

CREATE TABLE beacon(
        id_BEACON       Int  Auto_increment  NOT NULL ,
        major           Varchar (50) NOT NULL ,
        minor           Varchar (50) NOT NULL ,
        DateHeure       Varchar (50) NOT NULL ,
        CamionOuZone    Bool NOT NULL ,
        immatriculation Varchar (50) ,
        id_ZONE         Int
	,CONSTRAINT beacon_PK PRIMARY KEY (id_BEACON)

	,CONSTRAINT beacon_camion_FK FOREIGN KEY (immatriculation) REFERENCES camion(immatriculation)
	,CONSTRAINT beacon_zone0_FK FOREIGN KEY (id_ZONE) REFERENCES zone(id_ZONE)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: actif
#------------------------------------------------------------

CREATE TABLE actif(
        id_ACTIF  Int  Auto_increment  NOT NULL ,
        nom       Varchar (50) NOT NULL ,
        id_BEACON Int NOT NULL
	,CONSTRAINT actif_PK PRIMARY KEY (id_ACTIF)

	,CONSTRAINT actif_beacon_FK FOREIGN KEY (id_BEACON) REFERENCES beacon(id_BEACON)
	,CONSTRAINT actif_beacon_AK UNIQUE (id_BEACON)
)ENGINE=InnoDB;
