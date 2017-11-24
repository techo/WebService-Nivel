CREATE TABLE area (
   id INT(10) NOT NULL AUTO_INCREMENT,
   nombre VARCHAR(100) NOT NULL COLLATE utf8_general_ci COMMENT 'Nombre da Area',
   codigo VARCHAR(100) NOT NULL COLLATE utf8_general_ci COMMENT 'Codigo da Area',
   status INT(1) NOT NULL COMMENT 'Activo ou Inactivo',
   id_criador INT(10) UNSIGNED NOT NULL COMMENT 'Id do Criador',
   id_alterador INT(10) UNSIGNED NOT NULL COMMENT 'Id do Alterador',
   fecha_inc DATETIME NOT NULL COMMENT 'Fecha de inclusao do registro',
   fecha_alt DATETIME NOT NULL COMMENT 'Fecha de alteracao do registro',
  PRIMARY KEY (id)
) ENGINE=INNODB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='Table de Area'