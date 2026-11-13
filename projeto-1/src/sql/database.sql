create database cadastro;
use cadastro;

create table usuarios(
    id int(11) auto_increment primary key,
    nome varchar(30) not null,
    email varchar(30) not null,
    senha varchar(255) not null,
    telefone varchar(15) not null,
    data_nasc date not null,
    cidade varchar(20) not null,
    sexo enum('M', 'F') not null
);

CREATE USER 'tchali'@'localhost' IDENTIFIED BY '12345';
GRANT ALL PRIVILEGES ON cadastro.* TO 'tchali'@'localhost';
FLUSH PRIVILEGES;
SHOW GRANTS FOR 'tchali'@'localhost';
