CREATE DATABASE rajyp;

USE rajyp;

CREATE TABLE Usuario(
	email VARCHAR(50) NOT NULL,
	foto VARCHAR(200),
	primeiroNome VARCHAR(50) NOT NULL,
	sobrenome VARCHAR(200) NOT NULL,
	senha VARCHAR(200) NOT NULL,
	dataDeNascimento DATE NOT NULL,
	estado CHAR(2) NOT NULL,
	cidade VARCHAR(200) NOT NULL,
	sexo VARCHAR(10) NOT NULL,
	primary key(email)
);

CREATE TABLE Projeto(
	id INT NOT NULL AUTO_INCREMENT,
	titulo VARCHAR(200) NOT NULL,
	descricao VARCHAR(400) NOT NULL,
	orientador VARCHAR(200),
	participantes VARCHAR(400) NOT NULL,
	usuario_email VARCHAR(50) NOT NULL,
	primary key(id),
	foreign key (usuario_email) references Usuario(email)
);

