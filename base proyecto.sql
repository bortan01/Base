create table equipos(
nombre varchar2(25) primary key
);
create table personas(
dui  varchar2(9) primary key,
nombre varchar2(25),
apellido varchar2(25),
telefono varchar2(8),
deporte varchar2(25),
edad varchar2(3),
equipo varchar2(25),
direccion varchar2(520),
CONSTRAINT fk_equipos FOREIGN KEY (equipo) REFERENCES equipos (nombre)
);


