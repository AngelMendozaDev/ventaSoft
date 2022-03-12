/**********************
*Script de procedimientos
*Realizo: Luis Angel Mendoza
* Realizada: 27-02-2022
**********************************/
use ventaSoft;

/*****Alta de Producto***/
DELIMITER $$
create procedure newProd(
	in codeBars varchar(20),
    in nombre varchar(20),
    in unidad varchar(5),
    in precio decimal(7,2),
    in id_user int
    )
	begin
		insert into producto (codigo, nombre, unidad, precio) values (codeBars,nombre, unidad, precio);
        insert into almacen (producto, stock) values(codeBars,'0');
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
    in phone varchar(10),
    in id_user int
    )
	begin
		delete from proveedores where id_prov  = id_provD;
        insert into bitacora(usuario, movimiento,coment) values (id_user,"ELIMINO PROVEDOR",phone);
    end
    $$
DELIMITER ;


/***************************
* Notas
***************************************************/

use ventaSoft;

create view getAllNotes
as 
select * from notas;

create view getAllNameProv
as 
select empresa from proveedores group by empresa;

/*****Alta de Nota***/
DELIMITER $$
create procedure newNote(
    in id_user int,
    in nota varchar(20),
    in proveedor varchar(50)
    )
	begin
		insert into notas(usuario, n_nota,prov) values(id_user, nota, proveedor);
        insert into bitacora(usuario, movimiento,coment) values (id_user,"ALTA DE NOTA",nota);
    end
    $$
DELIMITER ;

/********Modificacion de Provedor*****************************/
DELIMITER $$
create procedure deleteNote(
    in id_user int,
    in nota varchar(20),
    in idnota int
    )
	begin
		delete from notas where id_nota = idnota; 
        insert into bitacora(usuario, movimiento,coment) values (id_user,"DELETE NOTE",nota);
    end
    $$
DELIMITER ;

/*****Alta de PROD-NOTA***/
DELIMITER $$
create procedure newNoteProd(
    in n_nota int,
    in prod varchar(15),
    in cant decimal(7,2),
    in id_user int
    )
	begin
		declare act decimal (7,2) default 0;
        declare listo decimal(7,2) default 0;
		insert into prod_nota(nota, producto, cantidad) values(n_nota, prod, cant);
        set act = (select stock from almacen where producto = prod);
        set listo = act + cant;
        update almacen set stock = listo where producto = prod; 
        insert into bitacora(usuario, movimiento,coment) values (id_user,n_nota,prod);
        
    end
    $$
DELIMITER ;

create view lastNote as select max(id_nota) from notas;

create view getAlmacen as SELECT p.codigo, p.nombre, a.stock, p.unidad, p.precio FROM almacen AS a INNER JOIN producto AS p ON p.codigo = a.producto;

create view getFaltantes as SELECT p.codigo, p.nombre, a.stock, p.unidad, p.precio FROM almacen AS a INNER JOIN producto AS p ON p.codigo = a.producto WHERE  a.stock <= 4;

create view getAllUsers as select u.id_us, p.nombre, p.app, p.apm from persona as p inner join usuarios as u on u.id_us = p.id_p;