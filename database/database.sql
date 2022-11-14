CREATE TABLE usuarios(
    id              int auto_increment not null,
    nombre          varchar(100) not null,
    apellidos       varchar(255) not null,
    email           varchar(255) not null,
    password        varchar(255) not null,
    rol             varchar(20)  not null,
    CONSTRAINT pk_usuarios PRIMARY KEY (id),
    CONSTRAINT uq_email UNIQUE(email)
)ENGINE = InnoDb;

CREATE TABLE categorias(
    id              int auto_increment not null,
    nombre          varchar(100) not null,
    imagen          varchar(255) not null,
    CONSTRAINT pk_categorias PRIMARY KEY (id),
    CONSTRAINT uq_nombre UNIQUE(nombre)
)ENGINE = InnoDb;

CREATE TABLE productos(
    id              int auto_increment not null,
    categoria_id    int not null,
    nombre          varchar(100) not null,
    descripcion     text not null,
    precio          int not null,
    imagen          varchar(255),
    iva             varchar(10) not null,
    stock           varchar(5) not null,
    CONSTRAINT pk_productos PRIMARY KEY (id),
    CONSTRAINT fk_producto_categoria FOREIGN KEY (categoria_id)
    REFERENCES categorias(id)
)ENGINE = InnoDb;

CREATE TABLE recuperar(
    email varchar(200) not null,
    clave_nueva int not null,
    token int not null,
    fecha_alta date,
    CONSTRAINT pk_recuperar PRIMARY KEY (email)
)ENGINE = InnoDb;






