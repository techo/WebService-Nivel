CREATE TABLE pais (
   id INT(10) NOT NULL AUTO_INCREMENT,
   nombre VARCHAR(100) NOT NULL COLLATE utf8_general_ci COMMENT 'Nombre do Pais',
   codigo VARCHAR(100) NOT NULL COLLATE utf8_general_ci COMMENT 'Codigo do Pais',
   id_aff INT(10) NOT NULL COMMENT 'Id do AFF',
   id_cont INT(10) NOT NULL COMMENT 'Id do CONT',
   STATUS INT(1) NOT NULL COMMENT 'Activo ou Inactivo',
   id_criador INT(10) UNSIGNED NOT NULL COMMENT 'Id do Criador',
   id_alterador INT(10) UNSIGNED NOT NULL COMMENT 'Id do Alterador',
   fecha_inc DATETIME NOT NULL COMMENT 'Fecha de inclusao do registro',
   fecha_alt DATETIME NOT NULL COMMENT 'Fecha de alteracao do registro',
  PRIMARY KEY (id)
) ENGINE=INNODB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='Table de Pais'