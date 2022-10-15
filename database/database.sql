DROP DATABASE IF EXISTS COCHES;

CREATE DATABASE COCHES;

USE COCHES;

DROP TABLE IF EXISTS USUARIOS;

CREATE TABLE USUARIOS (
  Nombre varchar(30) DEFAULT NULL,
  Apellido varchar(30) DEFAULT NULL,
  DNI char(8) NOT NULL,
  Telefono int DEFAULT NULL,
  FechaNcto date DEFAULT NULL,
  email varchar(80) NOT NULL,
  pswd varchar(20) DEFAULT NULL,
  usuario varchar(20) NOT NULL,
  imagen varchar(120),
  PRIMARY KEY (DNI),
  UNIQUE KEY ClaveUnica (email),
  UNIQUE KEY usuario (usuario)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

LOCK TABLES USUARIOS WRITE;

UNLOCK TABLES;

DROP TABLE IF EXISTS COCHES;

CREATE TABLE COCHES (
  matricula varchar(10) NOT NULL,
  modelo varchar(25) DEFAULT NULL,
  usuario varchar(20) DEFAULT NULL,
  estado enum('nuevo','seminuevo') DEFAULT NULL,
  kilometraje int DEFAULT NULL,
  precio decimal(10,2) DEFAULT NULL,
  imagen varchar(120) DEFAULT NULL,
  PRIMARY KEY (matricula),
  KEY usuario (usuario),
  CONSTRAINT COCHES_ibfk_1 FOREIGN KEY (usuario) REFERENCES USUARIOS (usuario) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

LOCK TABLES COCHES WRITE;

UNLOCK TABLES;

INSERT INTO USUARIOS VALUES('Nombre','Apel','6777777k','988988988','2002-11-28','emailol','passswd','usuario2', 'link.png');
