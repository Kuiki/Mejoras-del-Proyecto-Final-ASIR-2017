CREATE TABLE CATEGORIAS (
  CodCategoria char(6) NOT NULL,
  NombreCategoria varchar(20) DEFAULT NULL,
  PRIMARY KEY (CodCategoria)
);
CREATE TABLE USUARIOS (
  CodUsuario char(7) NOT NULL,
  Usuario varchar(25) DEFAULT NULL,
  ImgUsuario varchar(50) DEFAULT 'user.png',
  Nombre varchar(25) DEFAULT NULL,
  Apellidos varchar(50) DEFAULT NULL,
  Sexo char(1) DEFAULT 'M',
  FechaNacimiento date DEFAULT NULL,
  CorreoElectronico varchar(100) DEFAULT NULL,
  TipoUsuario varchar(13) DEFAULT 'Estandar',
  Contraseña varchar(32) DEFAULT NULL,
  Tema  varchar(50) DEFAULT 'default',
  PRIMARY KEY (CodUsuario)
);
CREATE TABLE ENTRADAS (
  IdEntrada char(7) NOT NULL,
  Titulo varchar(100) DEFAULT 'SIN TITULO',
  ImagenEntrada varchar(100) DEFAULT 'sinimagen.png',
  FechaCreacion timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  Contenido blob,
  Publicado char(1) DEFAULT 'N',
  FechaPublicacion datetime DEFAULT NULL,
  UltimaModificacion timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  CodUsuario char(7) NOT NULL,
  PRIMARY KEY (IdEntrada,CodUsuario),
  KEY us_en (CodUsuario),
  CONSTRAINT us_en FOREIGN KEY (CodUsuario) REFERENCES USUARIOS (CodUsuario) ON DELETE CASCADE ON UPDATE CASCADE
);
CREATE TABLE COMENTARIOS (
  IdComentario int(11) NOT NULL AUTO_INCREMENT,
  CodUsuario char(7) NOT NULL,
  IdEntrada char(7) NOT NULL,
  Comentario varchar(3000) DEFAULT NULL,
  PRIMARY KEY (IdComentario,CodUsuario,IdEntrada),
  KEY en_co (IdEntrada),
  KEY us_co (CodUsuario),
  CONSTRAINT en_co FOREIGN KEY (IdEntrada) REFERENCES ENTRADAS (IdEntrada) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT us_co FOREIGN KEY (CodUsuario) REFERENCES USUARIOS (CodUsuario) ON DELETE CASCADE ON UPDATE CASCADE
);
CREATE TABLE PERTENECE (
  IdEntrada char(7) NOT NULL,
  CodCategoria char(6) NOT NULL,
  PRIMARY KEY (IdEntrada,CodCategoria),
  KEY ca_pe (CodCategoria),
  CONSTRAINT ca_pe FOREIGN KEY (CodCategoria) REFERENCES CATEGORIAS (CodCategoria) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT en_pe FOREIGN KEY (IdEntrada) REFERENCES ENTRADAS (IdEntrada) ON DELETE CASCADE ON UPDATE CASCADE
);
INSERT INTO CATEGORIAS VALUES ('AND004','Android'),('LIN001','GNU/Linux'),('PCS005','PCs'),('RAS003','Raspberry'),('SIN000','Sin Categoria'),('WIN002','Windows');
ALTER DATABASE blog DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
ALTER table USUARIOS DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;