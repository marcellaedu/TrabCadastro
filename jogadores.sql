CREATE TABLE jogadores (
id INTEGER NOT NULL AUTO_INCREMENT,
nome VARCHAR(100) NOT NULL,
nickname varchar(100) NOT NULL,
data_nascimento date,
email varchar(100) NOT NULL,
telefone varchar(15),
/* A=Ação, Av=Aventura, R=RPG, S= Simulação, E=Esportes, Es=Estratégias, O=Outros */
classficacao VARCHAR(2) NOT NULL,
CONSTRAINT pk_jogadores PRIMARY KEY (id)
);
