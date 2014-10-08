drop table if exists usuario;
create table if not exists usuario (
    usuario_rut varchar(10) not null,
    nombre varchar(50) not null,
    password varchar(32) not null,
    email varchar(50) not null,
    isadmin boolean not null default 0,
    readonly boolean not null default 0,
    primary key(usuario_rut)
);

drop table if exists mensaje;
create table if not exists mensaje(
    mensaje_id int unsigned not null auto_increment,
    titulo varchar(50) not null,
    cuerpo text(2000) not null,
    autor varchar(50) not null,
    fecha timestamp  null,
    primary key(mensaje_id)
);
    
alter table mensaje
add constraint  mensaje_autor
foreign key(autor)
references usuario(usuario_rut);

drop table if exists participante ;
create table if not exists participante (
    participante_rut char(10) not null,
    nombre varchar (25) not null,
    apellido_paterno varchar(25) not null,
    apellido_materno varchar(25) not null,
    fono varchar(20) not null,
    email varchar(50) not null,
    nickname varchar(25) null,
    clan varchar(100) null,
    equipo varchar(10) not null,
    preinscrito boolean not null default 0,
    ingreso boolean not null default 0,
    primary key(participante_rut)
);
