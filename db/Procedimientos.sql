/**********************
*Script de procedimientos
*Realizo: Luis Angel Mendoza
* Realizada: 27-02-2022
**********************************/
use ventaSoft;

/*****Alta de Producto***/
DELIMITER $$
create procedure newProd(
	in codeBars varchar(15),
    in nombre varchar(20),
    in unidad varchar(5),
    in precio decimal(7,2),
    in id_user int
    )
	begin
		insert into producto (codigo, nombre, unidad, precio) values (codeBars,nombre, unidad, precio);
        insert into bitacora(usuario, movimiento,coment) values (id_user,"ALTA DE PRODUCTO",codeBars);
    end
    $$
DELIMITER ;

/********Modificacion de Producto*****************************/
DELIMITER $$
create procedure updateProd(
	in codeBars varchar(15),
    in nombreU varchar(20),
    in unidadU varchar(5),
    in precioU decimal(7,2),
    in id_user int
    )
	begin
		update producto set nombre = nombreU, unidad = unidadU, precio = precioU where codigo = codeBars;
        insert into bitacora(usuario, movimiento,coment) values (id_user,"MOD. DE PRODUCTO",codeBars);
    end
    $$
DELIMITER ;


create view allProducts as
select * from producto order by nombre asc;

create view allProv as
select * from proveedores order by empresa asc;

/*select * from allProv;*/

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

/********Modificacion de Producto*****************************/
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