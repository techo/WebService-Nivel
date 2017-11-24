CREATE TABLE usuario (
   id INT(10) NOT NULL AUTO_INCREMENT,
   mail VARCHAR(100) NOT NULL COLLATE utf8_general_ci COMMENT 'mail',
   PASSWORD VARCHAR(100) NOT NULL COLLATE utf8_general_ci COMMENT 'Password',
   nombre VARCHAR(100) NOT NULL COLLATE utf8_general_ci COMMENT 'Nombre',
   apellido_paterno VARCHAR(100) NULL COLLATE utf8_general_ci COMMENT 'Apellido Paterno',
   apellido_materno VARCHAR(100) NULL COLLATE utf8_general_ci COMMENT 'Apellido Materno',
   id_area INT(10) NOT NULL COMMENT 'Id da Area',
   id_cargo INT(10) NOT NULL COMMENT 'Id do Cargo',
   id_pais INT(10) NOT NULL COMMENT 'Id do Pais',
   id_jefe INT(10) NULL COMMENT 'Id do Jefe Directo',
   status INT(1) NOT NULL COMMENT 'Activo ou Inactivo',
   id_criador INT(10) UNSIGNED NOT NULL COMMENT 'Id do Criador',
   id_alterador INT(10) UNSIGNED NOT NULL COMMENT 'Id do Alterador',
   fecha_inc DATETIME NOT NULL COMMENT 'Fecha de inclusao do registro',
   fecha_alt DATETIME NOT NULL COMMENT 'Fecha de alteracao do registro',
  PRIMARY KEY (id)
) ENGINE=INNODB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='Table de Usuarios';