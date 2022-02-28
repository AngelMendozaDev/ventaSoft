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

select * from allProducts;