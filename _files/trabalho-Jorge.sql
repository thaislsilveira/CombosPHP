CREATE TABLE combos.bebida(
	idBebida SERIAL NOT NULL,
	descricaoBebida VARCHAR(100),
	tipoBebida VARCHAR(20),
	recipiente VARCHAR(30),
	CONSTRAINT Pk_bebida PRIMARY KEY (idBebida)
	
);

CREATE TABLE combos.comidaSalgada(
	idComidaSalgada SERIAL NOT NULL,
	descricaoComida VARCHAR(200),
	tipoComida VARCHAR(20),
	CONSTRAINT Pk_comidaSalgada PRIMARY KEY (idComidaSalgada)
	
);

CREATE TABLE combos.doce(
	idDoce SERIAL NOT NULL,
	descricaoDoce VARCHAR(200),
	tipoDoce VARCHAR(20),
	CONSTRAINT Pk_doce PRIMARY KEY (idDoce)

);

CREATE TABLE combos.usuario(
	idUsuario SERIAL NOT NULL,
	nomeUsuario VARCHAR(100),
	cpfUsuario VARCHAR (30),
	emailUsuario VARCHAR(30),
	telefoneUsuario VARCHAR(20),
	senhaUsuario VARCHAR (25),	
	CONSTRAINT Pk_usuario PRIMARY KEY(idUsuario)	
);

CREATE TABLE combos.combo(
	idCombo SERIAL NOT NULL,
	precoTotal FLOAT NOT NULL,
	idBebida INTEGER,
	idComidaSalgada INTEGER,
	idDoce INTEGER,
	idUsuario INTEGER,
	CONSTRAINT Pk_combo PRIMARY KEY(idCombo),
	CONSTRAINT Fk_combo_bebida FOREIGN KEY (idBebida) REFERENCES combos.bebida(idBebida),
	CONSTRAINT Fk_combo_comidaSalgada FOREIGN KEY (idComidaSalgada) REFERENCES combos.comidaSalgada(idComidaSalgada),
	CONSTRAINT Fk_combo_doce FOREIGN KEY (idDoce) REFERENCES combos.doce(idDoce),
	CONSTRAINT Fk_combo_usuario FOREIGN KEY (idUsuario) REFERENCES combos.usuario(idUsuario)	

);