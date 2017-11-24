CREATE TABLE token (
   id INT(10) NOT NULL AUTO_INCREMENT,
   token VARCHAR(100) NOT NULL COLLATE utf8_general_ci COMMENT 'Token',
   ip_request VARCHAR(100) NOT NULL COLLATE utf8_general_ci COMMENT 'ip',
   id_usuario INT(10) NOT NULL COMMENT 'Id do usuario',
   start_session DATETIME NOT NULL COMMENT 'Start Token',
   timeout_session DATETIME NOT NULL COMMENT 'End Token',
  PRIMARY KEY (id)
) ENGINE=INNODB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='Table de Token'