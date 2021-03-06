/*****
* Base de Datos Venta Soft
* Realizo: Mendoza Garcia Luis Angel
* Fecha de Realización: 15-03-2022
**********/

drop database ventasoft;

create database ventasoft;

use ventasoft;

CREATE TABLE sucursal(
	id_suc int auto_increment not null,
    nombre_suc varchar(60) not null,
    telefono varchar(10) not null,
    rfc varchar(15) default null,
    logo varchar(15),
    primary key(id_suc)
);

CREATE TABLE tipo_us(
	id_tipo int auto_increment not null,
    tipo varchar(20) not null,
    primary key(id_tipo)
);

CREATE TABLE persona(
	id_p int auto_increment not null,
    nombre varchar(20) not null,
    app varchar(25) not null,
    apm varchar(25) not null,
    sexo char(1) not null,
    telefono varchar(10) not null,
    primary key(id_p)
);

CREATE TABLE proveedores(
	id_prov int auto_increment not null,
    nombre_prov varchar(60) not null,
    empresa varchar(50) not null,
    numero varchar(10) not null,
    estatus int(1) not null default 1,
    primary key(id_prov)
);

CREATE TABLE producto(
	codigo varchar(15) not null,
    nombre varchar(30) not null,
    unidad varchar(5) not null,
    precio decimal(7,2) not null,
    cantidad decimal(7,2) not null,
    primary key(codigo)
);

CREATE TABLE prod_may(
    folio int auto_increment not null,
	codigo varchar(15) not null,
    precioMay decimal(7,2) not null,
    cantMay decimal(7,2) not null,
    primary key(folio),
    foreign key(codigo) references producto(codigo)
);

/*****************DIRECCIONES*****************/
CREATE TABLE direccion_s(
	id_dirS int not null,
    calle varchar(30) not null,
    cp varchar(7) not null,
    alcaldia varchar(30) not null,
    colonia varchar(30) not null,
    primary key(id_dirS),
    foreign key(id_dirS) references sucursal(id_suc)
);

CREATE TABLE direccion_p(
	id_dirP int not null,
    calle varchar(60) not null,
    cp varchar(7) not null,
    alcaldia varchar(30) not null,
    colonia varchar(30) not null,
    primary key(id_dirP),
    foreign key(id_dirP) references persona(id_p)
);

/******************TABLAS FUNCIONALES******************/
CREATE TABLE usuarios(
	id_us int auto_increment not null,
    tipo int not null,
    persona int not null,
    usuario varchar(15) not null,
    contra varchar(15) not null,
    primary key(id_us),
    foreign key(tipo) references tipo_us(id_tipo),
    foreign key(persona) references persona(id_p)
);

CREATE TABLE notas(
	id_nota int auto_increment not null,
    usuario int not null,
    n_nota varchar(20) not null,
    prov int not null,
    fecha datetime default now(),
    primary key(id_nota),
    foreign key(usuario) references usuarios(id_us),
    foreign key(prov) references proveedores(id_prov)
);

CREATE TABLE prod_nota(
	folio int auto_increment not null,
    nota int not null,
    producto varchar(15) not null,
    costo decimal(7,2) not null,
    cantidad decimal(7,2) not null,
    primary key(folio),
    foreign key(nota) references notas(id_nota),
    foreign key(producto) references producto(codigo)
);

/*********************VENTAS*******************/

CREATE TABLE ventas(
	folio_v int auto_increment not null,
    usuario int not null,
    fecha_v datetime default now(),
    total decimal(7,2),
    primary key(folio_v),
    foreign key (usuario) references usuarios(id_us)
);

CREATE TABLE venta_prod(
	n_registro int auto_increment not null,
    ticket int not null,
    producto varchar(15) not null,
    precio_v decimal(7,2) not null,
    cantidad_v decimal(7,2) not null,
    primary key(n_registro),
    foreign key (ticket) references ventas(folio_v),
    foreign key (producto) references producto(codigo)
);

CREATE TABLE bitacora(
	folio int auto_increment not null,
    fecha_mov datetime default now(),
    usuario int not null,
    movimiento varchar(25) not null,
    coment varchar(20) not null,
    primary key(folio),
    foreign key(usuario) references usuarios(id_us)
);