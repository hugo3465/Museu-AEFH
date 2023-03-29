DROP DATABASE IF EXISTS museu;

CREATE DATABASE museu;
USE museu;

/*
    Base de dados Principal - Objetos, Categorias, Colecoes e notícias
*/

CREATE TABLE Colecoes
(
    Id_Colecao      int AUTO_INCREMENT,
    Nome_Colecao    varchar(255) not null,
    Fotografia      varchar(255),

    PRIMARY KEY (Id_Colecao)
);

INSERT INTO Colecoes
VALUES
    (0, 'Sem Coleção', null);

CREATE TABLE Categorias
(
    Id_Categoria    int AUTO_INCREMENT,
    Categoria       varchar(100) not null,

    PRIMARY KEY (Id_Categoria)
);

CREATE TABLE Categorias_Estado
(
    Id_Estado   int(1) not null,
    Estado      varchar(30) not null,

    PRIMARY KEY (Id_Estado)
);

CREATE TABLE Objetos
(
    Id_Objeto       int AUTO_INCREMENT,
    Nome_Objeto     varchar(155) not null,
    Descricao       longtext,
    Criador         varchar(155),
    Ano_Origem      varchar(20),
    Pais            varchar(100),
    Id_Categoria    int not null,
    Id_Colecao      int not null,
    Fotografia      varchar(155) not null,
    Id_Estado       int(1) not null,            /*Se está público no site ou não*/
    Data            datetime not null,    

    PRIMARY KEY (Id_Objeto)
);

ALTER TABLE Objetos
    ADD CONSTRAINT Id_Categorias_Estado_fk FOREIGN KEY (Id_Estado) REFERENCES Categorias_Estado (Id_Estado),
    ADD CONSTRAINT Id_Categoria_fk FOREIGN KEY (Id_Categoria) REFERENCES Categorias (Id_Categoria),
    ADD CONSTRAINT Id_Colecao_fk FOREIGN KEY (Id_Colecao) REFERENCES Colecoes (Id_Colecao);

INSERT INTO Categorias_Estado
VALUES
    (1, 'Público'),
    (2, 'Privado');

CREATE TABLE Noticias
(
    Id_Email    int AUTO_INCREMENT,
    Email       varchar(255) not null unique,

    PRIMARY KEY (Id_Email)
);

/*
    Utilizadores
*/

CREATE TABLE Niveis
(
    Id_Nivel    int(1),
    Nome        varchar(50),

    PRIMARY KEY (Id_Nivel)
);

CREATE TABLE Utilizadores
(
    Id_Utilizador       int AUTO_INCREMENT,
    Nome_Utilizador     varchar(155) not null,
    Email               varchar(255) not null,
    Senha               varchar(90) not null,
    Id_Nivel            int(1) not null,
    recuperar_senha     varchar(300) DEFAULT NULL,

    PRIMARY KEY (Id_Utilizador)
);

INSERT INTO Niveis
VALUES
    (1, 'Administrador'),
    (2, 'Padrão');

INSERT INTO Utilizadores (Nome_Utilizador, Email, Senha, Id_Nivel)
VALUES
    ('admin', 'a4092@aefh.pt', SHA1('123456789'), 2);

ALTER TABLE Utilizadores
    ADD CONSTRAINT Id_Nivel_fk FOREIGN KEY (Id_Nivel) REFERENCES Niveis (Id_Nivel);

/*
    Visitas
*/

CREATE TABLE Instituicao
(
    Id_Instituicao int(1) not null,
    Instituicao varchar(20) not null,

    PRIMARY KEY (Id_Instituicao)
);

CREATE TABLE Ciclo
(
    Id_Ciclo    int(1) not null,
    Ciclo       varchar(100) not null,

    PRIMARY KEY (Id_Ciclo)
);

CREATE TABLE Hora
(
    Id_Hora     int(1) not null,
    Hora        varchar(55) not null,

    PRIMARY KEY (Id_Hora)
);

CREATE TABLE Visitas_Estado
(
    Id_Estado   int(1) not null,
    Estado      varchar(50) not null,

    PRIMARY KEY (Id_Estado)
);

CREATE TABLE Visitas
(
    Id_Visita               int AUTO_INCREMENT,
    Nome_Instituicao        varchar(255),
    Nome_Orientador         varchar(155) not null,
    Localidade              varchar(155) not null,
    Email                   varchar(155) not null,
    Telefone                int(10) not null,
    Tipo                    int(1) not null,
    NAlunos                 int,
    Id_Ciclo                int,
    Dia                     date not null,
    Id_Hora                 int(1) not null,
    Motivo                  longtext not null,
    Id_Estado               int(1) not null,
    Motivo_Rejeicao         longtext,

    PRIMARY KEY (Id_Visita)
);

INSERT INTO Instituicao
VALUES
    (1, 'Sim'),
    (2, 'Não');

INSERT INTO Ciclo
VALUES
    (1, '1º Ciclo'),
    (2, '2º Ciclo'),
    (3, '3º Ciclo'),
    (4, 'Secundário');

INSERT INTO Hora
VALUES
    (1, 'Manhã'),
    (2, 'Tarde');

INSERT INTO Visitas_Estado
VALUES
    (1, 'Aceite'),
    (2, 'Em Espera'),
    (3, 'Rejeitado');

ALTER TABLE Visitas
    ADD CONSTRAINT Id_Instituicao_fk FOREIGN KEY (Tipo) REFERENCES Instituicao (Id_Instituicao),
    ADD CONSTRAINT Id_Ciclo_fk FOREIGN KEY (Id_Ciclo) REFERENCES Ciclo (Id_Ciclo),
    ADD CONSTRAINT Id_Hora_fk FOREIGN KEY (Id_Hora) REFERENCES Hora (Id_Hora),
    ADD CONSTRAINT Id_Visitas_Estado_fk FOREIGN KEY (Id_Estado) REFERENCES Visitas_Estado (Id_Estado);