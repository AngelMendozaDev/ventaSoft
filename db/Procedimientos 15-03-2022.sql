use ventasoft;
INSERT INTO `sucursal` (`id_suc`, `nombre_suc`, `telefono`, `rfc`, `logo`) VALUES (NULL, 'LUMEGA-MX', '5564477055', 'MEGL970802RJ0', '1.PNG');

INSERT INTO `direccion_s` (`id_dirS`, `calle`, `cp`, `alcaldia`, `colonia`) VALUES ('1', 'GUADALUPE VICTORIA #267', '13450', 'TLAHUAC', 'GUADALUPE TLALTENCO');

INSERT INTO `persona` (`id_p`, `nombre`, `app`, `apm`, `sexo` , `telefono`) VALUES (NULL, 'LUIS ANGEL', 'MENDOZA', 'GARCIA','H','5564477055');

INSERT INTO `direccion_p` (`id_dirP`, `calle`, `cp`, `alcaldia`, `colonia`) VALUES ('1', 'GUADALUPE VICTORIA #267', '13450', 'TLAHUAC', 'GUADALUPE TLALTENCO');

INSERT INTO `tipo_us` (`id_tipo`, `tipo`) VALUES (NULL, 'ADMIN');
INSERT INTO `tipo_us` (`id_tipo`, `tipo`) VALUES (NULL, 'CAJA');

INSERT INTO `usuarios` (`id_us`, `tipo`, `persona`, `usuario`, `contra`) VALUES (NULL, '1', '1', 'ANGEL', '0510');
/************VIEWS (VISTAS)**************/
create view getAllProd as  select p.*, m.preciomay, m.cantMay from producto as p left join prod_may as m on m.codigo = p.codigo;

create view getAllProv as select * from proveedores where estatus > 0;

create view getAlmacen as select * from Producto;

create view getAllNotes as select * from notas;

create view lastNote as select max(id_nota) from notas;

create view getFaltantes as select * from producto where cantidad < 3;

create view getAllPersonal as select p.id_p, p.nombre, p.app, p.apm, p.telefono, u.tipo from persona as p inner join usuarios as u on p.id_p = u.id_us;

create view getAllCajas as select p.id_p, p.nombre, p.app, p.sexo, u.tipo, u.usuario from persona as p inner join usuarios as u on p.id_p = u.id_us;

/*******PROCEDURES*******/
DELIMITER $$
	CREATE PROCEDURE newProd(
		in codeBars varchar(15),
		in nombreU varchar(20),
		in unidadU varchar(5),
		in precioU decimal(7,2),
		in id_user int
    )
    BEGIN
		INSERT INTO producto (codigo, nombre, unidad, precio, cantidad) VALUES (codeBars, nombreU, unidadU, precioU, '0');
        INSERT INTO bitacora(usuario, movimiento,coment) VALUES (id_user,"NEW PRODUCTO",codeBars);
    END
$$ DELIMITER;

DELIMITER $$
	CREATE PROCEDURE newProdMay(
		in p_code varchar(15),
        in priceMay decimal(7,2),
        in cantMay decimal(7,2)
    )
    BEGIN
		INSERT INTO prod_may (codigo, precioMay, cantMay) VALUES (p_code, priceMay, cantMay);
    END
    $$
    DELIMITER;
    
DELIMITER $$
	CREATE PROCEDURE updateProd(
		in codeBars varchar(15),
		in nombreU varchar(20),
		in unidadU varchar(5),
		in precioU decimal(7,2),
		in priceMay decimal(7,2),
        in cantiMay decimal(7,2),
        in id_user int
    ) 
    BEGIN
		update producto set nombre = nombreU, unidad = unidadU, precio = precioU where codigo = codeBars;
        if priceMay != -1 then
			update prod_may set precioMay = priceMay, cantMay = cantiMay where codigo = codeBars;
        end if;
        insert into bitacora(usuario, movimiento,coment) values (id_user,"MOD. DE PRODUCTO",codeBars);
    END
    $$
    DELIMITER;
    
    /*****Alta de Proveedor***/
DELIMITER $$
create procedure newProv(
	in nombre varchar(60),
    in empresa varchar(50),
    in phone varchar(10),
    in id_user int
    )
	begin
		declare last_id int;
		insert into proveedores (nombre_prov, empresa, numero) values (nombre, empresa, phone);
        SET last_id = LAST_INSERT_ID();
        insert into bitacora(usuario, movimiento,coment) values (id_user,"ALTA DE PROVEEDOR",last_id);
    end
    $$
DELIMITER ;

/********Modificacion de Provedor*****************************/
DELIMITER $$
create procedure updateProv(
	in id_provU int,
	in nombreU varchar(60),
    in empresaU varchar(50),
    in phoneU varchar(10),
    in id_user int
    )
	begin
		update proveedores set nombre_prov = nombreU, empresa = empresaU, numero = phoneU where id_prov = id_provU;
        insert into bitacora(usuario, movimiento,coment) values (id_user,"MOD. DE PROVEDOR",id_provU);
    end
    $$
DELIMITER ;
/********Modificacion de Producto*****************************/
DELIMITER $$
create procedure deleteProv(
	in id_provD int,
    in id_user int
    )
	begin
		update proveedores set estatus = 0 where id_prov = id_provD;
        insert into bitacora(usuario, movimiento,coment) values (id_user,"ELIMINO PROVEDOR",id_provD);
    end
    $$
DELIMITER ;

/************************************************************************************************************************
*************Notes**
*******/

/*****Alta de Nota***/
DELIMITER $$
create procedure newNote(
    in id_user int,
    in nota varchar(20),
    in proveedor int
    )
	begin
		insert into notas(usuario, n_nota,prov) values(id_user, nota, proveedor);
        insert into bitacora(usuario, movimiento,coment) values (id_user,"ALTA DE NOTA",nota);
    end
    $$
DELIMITER ;

DELIMITER $$
create procedure newNoteProd(
    in n_nota int,
    in prod varchar(15),
    in costo decimal(7,2),
    in cant decimal(7,2),
    in id_user int
    )
	begin
		declare act decimal (7,2) default 0;
        declare listo decimal(7,2) default 0;
		insert into prod_nota(nota, producto, costo, cantidad) values(n_nota, prod, costo ,cant);
        set act = (select cantidad from producto where codigo = prod);
        set listo = act + cant;
        update producto set cantidad = listo where codigo = prod; 
        insert into bitacora(usuario, movimiento,coment) values (id_user,n_nota,prod);
        
    end
    $$
DELIMITER ;

/**************************************************************************************
****** PERSONAL
******************************************/
DELIMITER $$
create procedure newPersona(
	in namep varchar(20),
    in myApp varchar(25),
    in myApm varchar(25),
    in sexo char(1),
    in phone varchar(10),
    in myUser varchar(15),
    in tipo int,
    in id_user int
    )
	begin
		declare last_id int default 0;
		insert into persona(nombre, app,apm,sexo,telefono) values (namep,myApp, myApm, sexo, phone);
        SET last_id = LAST_INSERT_ID();
        insert into usuarios(tipo, persona, usuario,contra) values (tipo, last_id, myUser,'123');
        insert into bitacora(usuario, movimiento,coment) values (id_user,"NEW USER",last_id);
    end
    $$
DELIMITER ;

DELIMITER $$
create procedure updatePersona(
	in namep varchar(20),
    in myApp varchar(25),
    in myApm varchar(25),
    in sexo char(1),
    in phone varchar(10),
    in myUser varchar(15),
    in tipo int,
    in idp int,
    in id_user int
    )
	begin
		update persona set nombre = namep, app = myApp, apm = myApm, sexo = sexo, telefono = phone where id_p = idp;
        update usuarios set tipo = tipo, usuario = myUser where persona = idp;
        insert into bitacora(usuario, movimiento,coment) values (id_user,"UPDATE USER",idp);
    end
    $$
DELIMITER ;

DELIMITER $$
create procedure updatePass(
	in myPass varchar(15),
    in idp int,
    in id_user int
    )
	begin
        update usuarios set contra = myPass where persona = idp;
        insert into bitacora(usuario, movimiento,coment) values (id_user,"UPDATE PASS",idp);
    end
    $$
DELIMITER ;