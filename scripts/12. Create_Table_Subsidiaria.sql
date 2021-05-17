CREATE TABLE subsidiaria (
   id INT(10) NOT NULL AUTO_INCREMENT,
   subsidiaria VARCHAR(200) NOT NULL COLLATE utf8_general_ci COMMENT 'Nombre de la subsidiaria',
   subsidiaria_id_netsuite VARCHAR(100) NOT NULL COLLATE utf8_general_ci COMMENT 'Codigo de la subsidiaria',
   STATUS INT(1) NOT NULL COMMENT 'Activo ou Inactivo',
   id_criador INT(10) UNSIGNED NOT NULL COMMENT 'Id do Criador',
   id_alterador INT(10) UNSIGNED NOT NULL COMMENT 'Id do Alterador',
   fecha_inc DATETIME NOT NULL COMMENT 'Fecha de inclusao do registro',
   fecha_alt DATETIME NOT NULL COMMENT 'Fecha de alteracao do registro',
  PRIMARY KEY (id)
) ENGINE=INNODB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='Table de Pais'