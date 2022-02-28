use ventaSoft;

INSERT INTO `sucursal` (`id_suc`, `nombre_suc`, `telefono`, `rfc`, `logo`) VALUES (NULL, 'LUMEGA-MX', '5564477055', 'MEGL970802RJ0', '1.PNG');

INSERT INTO `direccion_s` (`id_dirS`, `calle`, `cp`, `alcaldia`, `colonia`) VALUES ('1', 'GUADALUPE VICTORIA #267', '13450', 'TLAHUAC', 'GUADALUPE TLALTENCO');

INSERT INTO `persona` (`id_p`, `nombre`, `app`, `apm`, `telefono`) VALUES (NULL, 'LUIS ANGEL', 'MENDOZA', 'GARCIA', '5564477055');

INSERT INTO `direccion_p` (`id_dirP`, `calle`, `cp`, `alcaldia`, `colonia`) VALUES ('1', 'GUADALUPE VICTORIA #267', '13450', 'TLAHUAC', 'GUADALUPE TLALTENCO');

INSERT INTO `tipo_us` (`id_tipo`, `tipo`) VALUES (NULL, 'ADMIN');
INSERT INTO `tipo_us` (`id_tipo`, `tipo`) VALUES (NULL, 'CAJA');

INSERT INTO `usuarios` (`id_us`, `tipo`, `persona`, `usuario`, `contra`) VALUES (NULL, '1', '1', 'ANGEL', '0510');