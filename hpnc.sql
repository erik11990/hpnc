DROP TABLE IF EXISTS detalle_pedido_despacho,
pedido_despacho,
detalle_ingreso_bodega,
ingreso_bodega,
usuario,
colaborador,
paciente,
persona,
municipio,
departamento,
producto,
item,
categoria;

-- crud terminado
CREATE TABLE categoria (
    id_categoria int unsigned auto_increment primary key,
    descripcion varchar(50) not null
);

INSERT INTO categoria VALUES (null, 'Guatemala');
INSERT INTO categoria VALUES (null, 'Estado civil');
INSERT INTO categoria VALUES (null, 'Tipo de paciente');
INSERT INTO categoria VALUES (null, 'Tipo de colaborador');
INSERT INTO categoria VALUES (null, 'Forma');
INSERT INTO categoria VALUES (null, 'Serie');
INSERT INTO categoria VALUES (null, 'Proveedor');
INSERT INTO categoria VALUES (null, 'Codigo');
INSERT INTO categoria VALUES (null, 'Libro');
INSERT INTO categoria VALUES (null, 'Dependencia');
INSERT INTO categoria VALUES (null, 'Categoría del producto');
INSERT INTO categoria VALUES (null, 'Programa');
INSERT INTO categoria VALUES (null, 'Acción Farmacológica');
INSERT INTO categoria VALUES (null, 'Laboratorio');
INSERT INTO categoria VALUES (null, 'Presentación/Unidad de medida');
INSERT INTO categoria VALUES (null, 'Marca');
INSERT INTO categoria VALUES (null, 'Código/Gasto renglón');
INSERT INTO categoria VALUES (null, 'Clínicas');

-- crud terminado
CREATE TABLE item (
    id_item int unsigned auto_increment primary key,
    id_categoria int(4) unsigned not null,
    descripcion varchar(50) not null,
    constraint item_categoria_fk foreign key (id_categoria) references categoria (id_categoria)
);

INSERT INTO item VALUES (null, 2, 'Soltero (a)');
INSERT INTO item VALUES (null, 2, 'Casado (a)');
INSERT INTO item VALUES (null, 2, 'Viudo (a)');
INSERT INTO item VALUES (null, 2, 'Unión de hecho');

INSERT INTO item VALUES (null, 3, 'Titular');
INSERT INTO item VALUES (null, 3, 'Afiliado padre');
INSERT INTO item VALUES (null, 3, 'Afiliado madre');
INSERT INTO item VALUES (null, 3, 'Afiliado esposa');
INSERT INTO item VALUES (null, 3, 'Afiliado hij@');

INSERT INTO item VALUES (null, 4, 'Médico');
INSERT INTO item VALUES (null, 4, 'Enfermer@');

INSERT INTO item VALUES (null, 5, '1-H');

INSERT INTO item VALUES (null, 6, 'E');

INSERT INTO item VALUES (null, 7, 'DIMED');

INSERT INTO item VALUES (null, 8, 'AMP-01');
INSERT INTO item VALUES (null, 8, 'AMP-02');
INSERT INTO item VALUES (null, 8, 'PEN-01');
INSERT INTO item VALUES (null, 8, 'PEN-02');

INSERT INTO item VALUES (null, 9, 'L-01');
INSERT INTO item VALUES (null, 9, 'L-02');
INSERT INTO item VALUES (null, 9, 'M-01');
INSERT INTO item VALUES (null, 9, 'M-02');
INSERT INTO item VALUES (null, 9, 'M-02');

INSERT INTO item VALUES (null, 10, 'Subdirección General de Salud Policial');

INSERT INTO item VALUES (null, 11, 'Seleccione');
INSERT INTO item VALUES (null, 11, 'Medicamentos');
INSERT INTO item VALUES (null, 11, 'Reactivos de Laboratorio');
INSERT INTO item VALUES (null, 11, 'Material Dental');
INSERT INTO item VALUES (null, 11, 'Material Médico Quirúrgico');
INSERT INTO item VALUES (null, 11, 'Equipo Médico');
INSERT INTO item VALUES (null, 11, 'Rayos X');
INSERT INTO item VALUES (null, 11, 'Otros');

INSERT INTO item VALUES (null, 12, '11130005-206-11-04 SISTEMA DE SALUD POLICIAL -SISAP-');

INSERT INTO item VALUES (null, 13, 'Fármacos de acción inespecífica');
INSERT INTO item VALUES (null, 13, 'Fármacos de acción específica');

INSERT INTO item VALUES (null, 14, 'ALFA FARMACEUTICA');
INSERT INTO item VALUES (null, 14, 'ALTIAN PHARMA');
INSERT INTO item VALUES (null, 14, 'AMERICAN VITALAB');

INSERT INTO item VALUES (null, 15, '1 gota');
INSERT INTO item VALUES (null, 15, '1 microgota');
INSERT INTO item VALUES (null, 15, '1 litro');
INSERT INTO item VALUES (null, 15, '1 mililitro');
INSERT INTO item VALUES (null, 15, '1 microlitro');
INSERT INTO item VALUES (null, 15, '1 centímetro cúbico');
INSERT INTO item VALUES (null, 15, '1 dracma líquida');
INSERT INTO item VALUES (null, 15, '1 onza líquida');
INSERT INTO item VALUES (null, 15, '1 cucharadita');
INSERT INTO item VALUES (null, 15, '1 cucharada');
INSERT INTO item VALUES (null, 15, '1 taza de té');
INSERT INTO item VALUES (null, 15, '1 vaso o taza');
INSERT INTO item VALUES (null, 15, '1 pinta');
INSERT INTO item VALUES (null, 15, '1 cuarto de galón');
INSERT INTO item VALUES (null, 15, '1 galón');

INSERT INTO item VALUES (null, 16, 'MERCK');
INSERT INTO item VALUES (null, 16, 'BAYER');

INSERT INTO item VALUES (null, 17, 'abc-2');
INSERT INTO item VALUES (null, 17, '154as');

INSERT INTO item VALUES (null, 18, 'Paciente');
INSERT INTO item VALUES (null, 18, 'Clinica San marcos');
INSERT INTO item VALUES (null, 18, 'Clinica Zona 6');
INSERT INTO item VALUES (null, 18, 'Clinica zona 7');
INSERT INTO item VALUES (null, 18, 'Clincia DG');
INSERT INTO item VALUES (null, 18, 'Clinica Escuintla');

-- crud terminado
CREATE TABLE producto (
    id_producto int unsigned auto_increment primary key,
    id_categoria int unsigned null,
    id_accion_farmacologica int unsigned,
    descripcion varchar(50) not null,
    stock int(25) null,
    constraint producto_categoria_fk foreign key (id_categoria) references item (id_item),
    constraint producto_accion_far_fk foreign key (id_accion_farmacologica) references item (id_item)
);

INSERT INTO producto VALUES (null, 26, 34,'Prednisona', 0);
INSERT INTO producto VALUES (null, 26, 35,'Penicillina', 0);
INSERT INTO producto VALUES (null, 28, 34,'Cepillos de diente', 0);


CREATE TABLE departamento (
    id_departamento int unsigned auto_increment primary key,
    id_categoria int unsigned not null,
    descripcion varchar(50) not null,
    constraint departamento_categoria foreign key (id_categoria) references categoria (id_categoria)
);

-- Departamentos
INSERT INTO departamento VALUES (null, 1, 'Alta Verapaz');
INSERT INTO departamento VALUES (null, 1, 'Baja Verapaz');
INSERT INTO departamento VALUES (null, 1, 'Chimaltenango');
INSERT INTO departamento VALUES (null, 1, 'Chiquimula');
INSERT INTO departamento VALUES (null, 1, 'El Progreso');
INSERT INTO departamento VALUES (null, 1, 'Escuintla');
INSERT INTO departamento VALUES (null, 1, 'Guatemala');
INSERT INTO departamento VALUES (null, 1, 'Huehuetenango');
INSERT INTO departamento VALUES (null, 1, 'Izabal');
INSERT INTO departamento VALUES (null, 1, 'Jalapa');
INSERT INTO departamento VALUES (null, 1, 'Jutiapa');
INSERT INTO departamento VALUES (null, 1, 'Petén');
INSERT INTO departamento VALUES (null, 1, 'Quetzaltenango');
INSERT INTO departamento VALUES (null, 1, 'Quiché');
INSERT INTO departamento VALUES (null, 1, 'Retalhuleu');
INSERT INTO departamento VALUES (null, 1, 'Sacatepéquez');
INSERT INTO departamento VALUES (null, 1, 'San Marcos');
INSERT INTO departamento VALUES (null, 1, 'Santa Rosa');
INSERT INTO departamento VALUES (null, 1, 'Solola');
INSERT INTO departamento VALUES (null, 1, 'Suchitepéquez');
INSERT INTO departamento VALUES (null, 1, 'Totonicapán');
INSERT INTO departamento VALUES (null, 1, 'Zacapa');


CREATE TABLE municipio (
    id_municipio int unsigned auto_increment primary key,
    descripcion varchar(50) not null,
    id_departamento int unsigned not null,
    constraint municipio_departamento foreign key (id_departamento) references departamento (id_departamento)
);

-- item (Municipios)
INSERT INTO municipio
    (id_municipio, descripcion, id_departamento)
    VALUES

      -- Alta Verapaz
    (null, 'Chahal', 1),
    (null, 'Chisec', 1),
    (null, 'Cobán', 1),
    (null, 'Fray Bartolomé de las Casas', 1),
    (null, 'La Tinta', 1),
    (null, 'Lanquín', 1),
    (null, 'Panzós', 1),
    (null, 'Raxruhá', 1),
    (null, 'San Cristóbal Verapaz', 1),
    (null, 'San Juan Chamelco', 1),
    (null, 'San Pedro Carchá', 1),
    (null, 'Santa Cruz Verapaz', 1),
    (null, 'Santa María Cahabón', 1),
    (null, 'Senahú', 1),
    (null, 'Tamahú', 1),
    (null, 'Tactic', 1),
    (null, 'Tucurú', 1),

      -- Baja Verapaz
    (null, 'Cubulco', 2),
    (null, 'Granados', 2),
    (null, 'Purulhá', 2),
    (null, 'Rabinal', 2),
    (null, 'Salamá', 2),
    (null, 'San Jerónimo', 2),
    (null, 'San Miguel Chicaj', 2),
    (null, 'Santa Cruz el Chol', 2),

      -- Chimaltenango
    (null, 'Acatenango', 3),
    (null, 'Chimaltenango', 3),
    (null, 'El Tejar', 3),
    (null, 'Parramos', 3),
    (null, 'Patzicía', 3),
    (null, 'Patzún', 3),
    (null, 'Pochuta', 3),
    (null, 'San Andrés Itzapa', 3),
    (null, 'San José Poaquíl', 3),
    (null, 'San Juan Comalapa', 3),
    (null, 'San Martín Jilotepeque', 3),
    (null, 'Santa Apolonia', 3),
    (null, 'Santa Cruz Balanyá', 3),
    (null, 'Tecpán', 3),
    (null, 'Yepocapa', 3),
    (null, 'Zaragoza', 3),

      -- Chiquimula
    (null, 'Camotán', 4),
    (null, 'Chiquimula', 4),
    (null, 'Concepción Las Minas', 4),
    (null, 'Esquipulas', 4),
    (null, 'Ipala', 4),
    (null, 'Jocotán', 4),
    (null, 'Olopa', 4),
    (null, 'Quezaltepeque', 4),
    (null, 'San Jacinto', 4),
    (null, 'San José la Arada', 4),
    (null, 'San Juan Ermita', 4),

      -- El Progreso
    (null, 'El Jícaro', 5),
    (null, 'Guastatoya', 5),
    (null, 'Morazán', 5),
    (null, 'San Agustín Acasaguastlán', 5),
    (null, 'San Antonio La Paz', 5),
    (null, 'San Cristóbal Acasaguastlán', 5),
    (null, 'Sanarate', 5),
    (null, 'Sansare', 5),

      -- Escuintla
    (null, 'Escuintla', 6),
    (null, 'Guanagazapa', 6),
    (null, 'Iztapa', 6),
    (null, 'La Democracia', 6),
    (null, 'La Gomera', 6),
    (null, 'Masagua', 6),
    (null, 'Nuesale_rent Concepción', 6),
    (null, 'Palín', 6),
    (null, 'San José', 6),
    (null, 'San Vicente Pacaya', 6),
    (null, 'Santa Lucía Cotzumalguapa', 6),
    (null, 'Siquinalá', 6),
    (null, 'Tiquisate', 6),

      -- Guatemala
    (null, 'Amatitlán', 7),
    (null, 'Chinautla', 7),
    (null, 'Chuarrancho', 7),
    (null, 'Guatemala', 7),
    (null, 'Fraijanes', 7),
    (null, 'Mixco', 7),
    (null, 'Palencia', 7),
    (null, 'San José del Golfo', 7),
    (null, 'San José Pinula', 7),
    (null, 'San Juan Sacatepéquez', 7),
    (null, 'San Miguel Petapa', 7),
    (null, 'San Pedro Ayampuc', 7),
    (null, 'San Pedro Sacatepéquez', 7),
    (null, 'San Raymundo', 7),
    (null, 'Santa Catarina Pinula', 7),
    (null, 'Villa Canales', 7),
    (null, 'Villa Nuesale_rent', 7),

      -- Huehuetenango
    (null, 'Aguacatán', 8),
    (null, 'Chiantla', 8),
    (null, 'Colotenango', 8),
    (null, 'Concepción Huista', 8),
    (null, 'Cuilco', 8),
    (null, 'Huehuetenango', 8),
    (null, 'Jacaltenango', 8),
    (null, 'La Democracia', 8),
    (null, 'La Libertad', 8),
    (null, 'Malacatancito', 8),
    (null, 'Nentón', 8),
    (null, 'San Antonio Huista', 8),
    (null, 'San Gaspar Ixchil', 8),
    (null, 'San Ildefonso Ixtahuacán', 8),
    (null, 'San Juan Atitán', 8),
    (null, 'San Juan Ixcoy', 8),
    (null, 'San Mateo Ixtatán', 8),
    (null, 'San Miguel Acatán', 8),
    (null, 'San Pedro Nécta', 8),
    (null, 'San Pedro Soloma', 8),
    (null, 'San Rafael La Independencia', 8),
    (null, 'San Rafael Pétzal', 8),
    (null, 'San Sebastián Coatán', 8),
    (null, 'San Sebastián Huehuetenango', 8),
    (null, 'Santa Ana Huista', 8),
    (null, 'Santa Bárbara', 8),
    (null, 'Santa Cruz Barillas', 8),
    (null, 'Santa Eulalia', 8),
    (null, 'Santiago Chimaltenango', 8),
    (null, 'Tectitán', 8),
    (null, 'Todos Santos Cuchumatán', 8),
    (null, 'Unión Cantinil', 8),

      -- Izabal
    (null, 'El Estor', 9),
    (null, 'Livingston', 9),
    (null, 'Los Amates', 9),
    (null, 'Morales', 9),
    (null, 'Puerto Barrios', 9),

      -- Jalapa
    (null, 'Jalapa', 10),
    (null, 'Mataquescuintla', 10),
    (null, 'Monjas', 10),
    (null, 'San Carlos Alzatate', 10),
    (null, 'San Luis Jilotepeque', 10),
    (null, 'San Manuel Chaparrón', 10),
    (null, 'San Pedro Pinula', 10),

      -- Jutiapa
    (null, 'Agua Blanca', 11),
    (null, 'Asunción Mita', 11),
    (null, 'Atescatempa', 11),
    (null, 'Comapa', 11),
    (null, 'Conguaco', 11),
    (null, 'El Adelanto', 11),
    (null, 'El Progreso', 11),
    (null, 'Jalpatagua', 11),
    (null, 'Jerez', 11),
    (null, 'Jutiapa', 11),
    (null, 'Moyuta', 11),
    (null, 'Pasaco', 11),
    (null, 'Quesada', 11),
    (null, 'San José Acatempa', 11),
    (null, 'Santa Catarina Mita', 11),
    (null, 'Yupiltepeque', 11),
    (null, 'Zapotitlán', 11),

      -- Petén
    (null, 'Dolores', 12),
    (null, 'El Chal', 12),
    (null, 'Ciudad Flores', 12),
    (null, 'La Libertad', 12),
    (null, 'Las Cruces', 12),
    (null, 'Melchor de Mencos', 12),
    (null, 'Poptún', 12),
    (null, 'San Andrés', 12),
    (null, 'San Benito', 12),
    (null, 'San Francisco', 12),
    (null, 'San José', 12),
    (null, 'San Luis', 12),
    (null, 'Santa Ana', 12),
    (null, 'Sayaxché', 12),

      -- Quetzaltenango
    (null, 'Almolonga', 13),
    (null, 'Cabricán', 13),
    (null, 'Cajolá', 13),
    (null, 'Cantel', 13),
    (null, 'Coatepeque', 13),
    (null, 'Colomba Costa Cuca', 13),
    (null, 'Concepción Chiquirichapa', 13),
    (null, 'El Palmar', 13),
    (null, 'Flores Costa Cuca', 13),
    (null, 'Génosale_rent', 13),
    (null, 'Huitán', 13),
    (null, 'La Esperanza', 13),
    (null, 'Olintepeque', 13),
    (null, 'Palestina de Los Altos', 13),
    (null, 'Quetzaltenango', 13),
    (null, 'Salcajá', 13),
    (null, 'San Carlos Sija', 13),
    (null, 'San Francisco La Unión', 13),
    (null, 'San Juan Ostuncalco', 13),
    (null, 'San Martín Sacatepéquez', 13),
    (null, 'San Mateo', 13),
    (null, 'San Miguel Sigüilá', 13),
    (null, 'Sibilia', 13),
    (null, 'Zunil', 13),

      -- Quiché
    (null, 'Canillá', 14),
    (null, 'Chajul', 14),
    (null, 'Chicamán', 14),
    (null, 'Chiché', 14),
    (null, 'Chichicastenango', 14),
    (null, 'Chinique', 14),
    (null, 'Cunén', 14),
    (null, 'Ixcán Playa Grande', 14),
    (null, 'Joyabaj', 14),
    (null, 'Nebaj', 14),
    (null, 'Pachalum', 14),
    (null, 'Patzité', 14),
    (null, 'Sacapulas', 14),
    (null, 'San Andrés Sajcabajá', 14),
    (null, 'San Antonio Ilotenango', 14),
    (null, 'San Bartolomé Jocotenango', 14),
    (null, 'San Juan Cotzal', 14),
    (null, 'San Pedro Jocopilas', 14),
    (null, 'Santa Cruz del Quiché', 14),
    (null, 'Uspantán', 14),
    (null, 'Zacualpa', 14),

      -- Retalhuleu
    (null, 'Champerico', 15),
    (null, 'El Asintal', 15),
    (null, 'Nuevo San Carlos', 15),
    (null, 'Retalhuleu', 15),
    (null, 'San Andrés Villa Seca', 15),
    (null, 'San Felipe Reu', 15),
    (null, 'San Martín Zapotitlán', 15),
    (null, 'San Sebastián', 15),
    (null, 'Santa Cruz Muluá', 15),

      -- Sacatepéquez
    (null, 'Alotenango', 16),
    (null, 'Ciudad Vieja', 16),
    (null, 'Jocotenango', 16),
    (null, 'Antigua Guatemala', 16),
    (null, 'Magdalena Milpas Altas', 16),
    (null, 'Pastores', 16),
    (null, 'San Antonio Aguas Calientes', 16),
    (null, 'San Bartolomé Milpas Altas', 16),
    (null, 'San Lucas Sacatepéquez', 16),
    (null, 'San Miguel Dueñas', 16),
    (null, 'Santa Catarina Barahona', 16),
    (null, 'Santa Lucía Milpas Altas', 16),
    (null, 'Santa María de Jesús', 16),
    (null, 'Santiago Sacatepéquez', 16),
    (null, 'Santo Domingo Xenacoj', 16),
    (null, 'Sumpango', 16),

      -- San Marcos
    (null, 'Ayutla', 17),
    (null, 'Catarina', 17),
    (null, 'Comitancillo', 17),
    (null, 'Concepción Tutuapa', 17),
    (null, 'El Quetzal', 17),
    (null, 'El Tumbador', 17),
    (null, 'Esquipulas Palo Gordo', 17),
    (null, 'Ixchiguán', 17),
    (null, 'La Blanca', 17),
    (null, 'La Reforma', 17),
    (null, 'Malacatán', 17),
    (null, 'Nuevo Progreso', 17),
    (null, 'Ocós', 17),
    (null, 'Pajapita', 17),
    (null, 'Río Blanco', 17),
    (null, 'San Antonio Sacatepéquez', 17),
    (null, 'San Cristóbal Cucho', 17),
    (null, 'San José El Rodeo', 17),
    (null, 'San José Ojetenam', 17),
    (null, 'San Lorenzo', 17),
    (null, 'San Marcos', 17),
    (null, 'San Miguel Ixtahuacán', 17),
    (null, 'San Pablo', 17),
    (null, 'San Pedro Sacatepéquez', 17),
    (null, 'San Rafael Pie de la Cuesta', 17),
    (null, 'Sibinal', 17),
    (null, 'Sipacapa', 17),
    (null, 'Tacaná', 17),
    (null, 'Tajumulco', 17),
    (null, 'Tejutla', 17),

    -- Santa Rosa
    (null, 'Barberena', 18),
    (null, 'Casillas', 18),
    (null, 'Chiquimulilla', 18),
    (null, 'Cuilapa', 18),
    (null, 'Guazacapán', 18),
    (null, 'Nuesale_rent Santa Rosa', 18),
    (null, 'Oratorio', 18),
    (null, 'Pueblo Nuevo Viñas', 18),
    (null, 'San Juan Tecuaco', 18),
    (null, 'San Rafael las Flores', 18),
    (null, 'Santa Cruz Naranjo', 18),
    (null, 'Santa María Ixhuatán', 18),
    (null, 'Santa Rosa de Lima', 18),
    (null, 'Taxisco', 18),

    -- Sololá
    (null, 'Concepción', 19),
    (null, 'Nahualá', 19),
    (null, 'Panajachel', 19),
    (null, 'San Andrés Semetabaj', 19),
    (null, 'San Antonio Palopó', 19),
    (null, 'San José Chacayá', 19),
    (null, 'San Juan La Laguna', 19),
    (null, 'San Lucas Tolimán', 19),
    (null, 'San Marcos La Laguna', 19),
    (null, 'San Pablo La Laguna', 19),
    (null, 'San Pedro La Laguna', 19),
    (null, 'Santa Catarina Ixtahuacán', 19),
    (null, 'Santa Catarina Palopó', 19),
    (null, 'Santa Clara La Laguna', 19),
    (null, 'Santa Cruz La Laguna', 19),
    (null, 'Santa Lucía Utatlán', 19),
    (null, 'Santa María Visitación', 19),
    (null, 'Santiago Atitlán', 19),
    (null, 'Sololá', 19),

    -- Suchitepéquez
    (null, 'Chicacao', 20),
    (null, 'Cuyotenango', 20),
    (null, 'Mazatenango', 20),
    (null, 'Patulul', 20),
    (null, 'Pueblo Nuevo', 20),
    (null, 'Río Bravo', 20),
    (null, 'Samayac', 20),
    (null, 'San Antonio Suchitepéquez', 20),
    (null, 'San Bernardino', 20),
    (null, 'San Francisco Zapotitlán', 20),
    (null, 'San Gabriel', 20),
    (null, 'San José El Idolo', 20),
    (null, 'San José La Maquina', 20),
    (null, 'San Juan Bautista', 20),
    (null, 'San Lorenzo', 20),
    (null, 'San Miguel Panán', 20),
    (null, 'San Pablo Jocopilas', 20),
    (null, 'Santa Bárbara', 20),
    (null, 'Santo Domingo Suchitepéquez', 20),
    (null, 'Santo Tomás La Unión', 20),
    (null, 'Zunilito', 20),

    -- Totonicapán
    (null, 'Momostenango', 21),
    (null, 'San Andrés Xecul', 21),
    (null, 'San Bartolo', 21),
    (null, 'San Cristóbal Totonicapán', 21),
    (null, 'San Francisco El Alto', 21),
    (null, 'Santa Lucía La Reforma', 21),
    (null, 'Santa María Chiquimula', 21),
    (null, 'Totonicapán', 21),

    -- Zacapa
    (null, 'Cabañas', 22),
    (null, 'Estanzuela', 22),
    (null, 'Gualán', 22),
    (null, 'Huité', 22),
    (null, 'La Unión', 22),
    (null, 'Río Hondo', 22),
    (null, 'San Diego', 22),
    (null, 'San Jorge', 22),
    (null, 'Teculután', 22),
    (null, 'Usumatlán', 22),
    (null, 'Zacapa', 22);

-- crud terminado
CREATE TABLE persona (
    id_persona int unsigned auto_increment primary key,
    nombres varchar(50) not null,
    apellidos varchar(50) not null,
    fecha_nacimiento date not null,
    dpi varchar(13) not null,
    telefono varchar(8) not null,
    id_departamento_residencia int(4) unsigned not null,
    id_municipio_residencia int(4) unsigned not null,
    direccion_residencia varchar(100) not null,
    nombre_padre varchar(50) not null,
    nombre_madre varchar(50) not null,
    id_estado_civil int(4) unsigned not null,
    constraint persona_departamento foreign key (id_departamento_residencia) references departamento (id_departamento),
    constraint persona_municipio foreign key (id_municipio_residencia) references municipio (id_municipio),
    constraint persona_item foreign key (id_estado_civil) references item (id_item)
);

-- crud terminado
CREATE TABLE paciente (
    id_paciente int unsigned auto_increment primary key,
    id_tipo_paciente int unsigned not null,
    id_persona int unsigned not null,
    bandera int(2) unsigned null,
    constraint paciente_item foreign key (id_tipo_paciente) references item (id_item),
    constraint paciente_departamento foreign key (id_persona) references persona (id_persona)
);

-- crud terminado
CREATE TABLE colaborador (
    id_colaborador int unsigned auto_increment primary key,
    id_persona int unsigned not null,
    id_tipo_colabordor int unsigned not null,
    bandera int(2) unsigned null,
    constraint colaborador_persona foreign key (id_persona) references persona (id_persona),
    constraint colaborador_item foreign key (id_tipo_colabordor) references item (id_item)
);

CREATE TABLE usuario (
    id_usuario int unsigned auto_increment primary key,
    id_persona int unsigned not null,
    id_rol int unsigned not null,
    constraint usuario_persona foreign key (id_persona) references persona (id_persona),
    constraint usuario_item foreign key (id_rol) references item (id_item)
);

CREATE TABLE ingreso_bodega (
    id_ingreso_bodega int unsigned auto_increment primary key,
    id_forma int unsigned not null,
    id_serie int unsigned not null,
    numero varchar(50) not null,
    factura_serie varchar(50) not null,
    numero_dte varchar(50) not null,
    fecha datetime not null,
    id_proveedor int unsigned not null,
    id_codigo int unsigned not null,
    id_libro int unsigned not null,
    numero_libro varchar(50) not null,
    id_categoria_producto int unsigned not null,
    id_dependencia int unsigned not null,
    id_programa int unsigned not null,
    observaciones varchar(250),
    costo double not null,
    constraint ingreso_bodega_id_forma foreign key (id_forma) references item (id_item),
    constraint ingreso_bodega_id_serie foreign key (id_serie) references item (id_item),
    constraint ingreso_bodega_id_proveedor foreign key (id_proveedor) references item (id_item),
    constraint ingreso_bodega_id_codigo foreign key (id_codigo) references item (id_item),
    constraint ingreso_bodega_id_libro foreign key (id_libro) references item (id_item),
    constraint ingreso_bodega_id_categoria_producto foreign key (id_categoria_producto) references item (id_item),
    constraint ingreso_bodega_id_dependencia foreign key (id_dependencia) references item (id_item),
    constraint ingreso_bodega_id_programa foreign key (id_programa) references item (id_item)
);

CREATE TABLE detalle_ingreso_bodega (
    id_detalle_ingreso_bodega int unsigned auto_increment primary key,
    id_ingreso_bodega int unsigned not null,
    id_nombre_producto int unsigned not null,
    id_accion_farmacologica int unsigned,
    id_laboratorio int unsigned not null,
    concentracion varchar(50) not null,
    id_presentacion_unidad_de_medida int unsigned not null,
    id_marca int unsigned not null,
    lote varchar(50) not null,
    fecha_vencimiento date not null,
    cantidad double not null,
    precio_unidad double not null,
    id_codigo_gasto_renglon int unsigned not null,
    orden_cp_y_p_numero varchar(50) not null,
    folio_libro_inventario varchar(50) not null,
    nomenclatura_de_cuentas varchar(50) not null,
    folio_almacen varchar(50) not null,
    constraint detalle_ingreso_bodega_id_ingreso_bodega foreign key (id_ingreso_bodega) references ingreso_bodega (id_ingreso_bodega),
    constraint detalle_ingreso_bodega_id_nombre_producto foreign key (id_nombre_producto) references producto (id_producto),
    constraint detalle_ingreso_bodega_id_accion_farmacologica foreign key (id_accion_farmacologica) references item (id_item),
    constraint detalle_ingreso_bodega_id_laboratorio foreign key (id_laboratorio) references item (id_item),
    constraint detalle_ingreso_bodega_id_presentacion_unidad_de_medida foreign key (id_presentacion_unidad_de_medida) references item (id_item),
    constraint detalle_ingreso_bodega_id_marca foreign key (id_marca) references item (id_item),
    constraint detalle_ingreso_bodega_id_codigo_gasto_renglon foreign key (id_codigo_gasto_renglon) references item (id_item)
);

CREATE TABLE pedido_despacho (
    id_pedido_despacho int unsigned auto_increment primary key,
    pedido varchar(50) not null,
    id_lugar int unsigned not null,
    fecha_pedido datetime not null,
    fecha_ingreso datetime not null,
    fecha_entrega datetime not null,
    id_entrega int unsigned not null,
    id_autoriza int unsigned not null,
    id_solicitante_paciente int unsigned null,
    id_solicitante_colaborador int unsigned null,
    id_categoria_producto int unsigned not null,
    total double not null,
    constraint pedido_despacho_id_lugar foreign key (id_lugar) references item (id_item),
    constraint pedido_despacho_id_entrega foreign key (id_entrega) references colaborador (id_colaborador),
    constraint pedido_despacho_id_autoriza foreign key (id_autoriza) references colaborador (id_colaborador),
    constraint pedido_despacho_id_solicitante_paciente foreign key (id_solicitante_paciente) references paciente (id_paciente),
    constraint pedido_despacho_id_solicitante_colaborador foreign key (id_solicitante_colaborador) references colaborador (id_colaborador),
    constraint pedido_despacho_id_categoria_producto foreign key (id_categoria_producto) references item (id_item)
);

CREATE TABLE detalle_pedido_despacho (
    id_detalle_pedido_despacho int unsigned auto_increment primary key,
    id_pedido_despacho int unsigned not null,
    id_nombre_medicamento int unsigned not null,
    cantidad_solicitada int not null,
    cantidad_despachada int not null,
    precio float(10,2) not null,
    constraint pedido_despacho_id_pedido_despacho foreign key (id_pedido_despacho) references pedido_despacho (id_pedido_despacho),
    constraint pedido_despacho_id_nombre_medicamento foreign key (id_nombre_medicamento) references producto (id_producto)
);

DELIMITER //

CREATE TRIGGER update_stock_quantity
AFTER INSERT ON detalle_ingreso_bodega
FOR EACH ROW
BEGIN
  UPDATE producto
  SET stock = stock + NEW.cantidad
  WHERE producto.id_producto = NEW.id_nombre_producto;
END//

DELIMITER ;


/* CREATE TABLE rol (
  rol_id int unsigned auto_increment primary key,
  rol_nombre varchar(30) DEFAULT NULL,
  rol_fregistro date DEFAULT NULL,
  rol_estatus enum('ACTIVO','INACTIVO') DEFAULT NULL
);

INSERT INTO rol (rol_id, rol_nombre, rol_fregistro, rol_estatus) VALUES
(null, 'Administrador', '2021-06-16', 'ACTIVO');

CREATE TABLE usuario (
  usu_id int unsigned auto_increment primary key,
  usu_nombre varchar(20) DEFAULT NULL,
  usu_contrasena varchar(255) DEFAULT NULL,
  rol_id int unsigned DEFAULT NULL,
  usu_status enum('ACTIVO','INACTIVO') DEFAULT NULL,
  usu_email varchar(255) DEFAULT NULL,
  usu_foto varchar(255) DEFAULT NULL,
  constraint u_r foreign key(rol_id) references rol (rol_id)
);

INSERT INTO usuario (usu_id, usu_nombre, usu_contrasena, rol_id, usu_status, usu_email, usu_foto) VALUES
(null, 'Admin', '$2y$10$SXMtMX83rAnvwLOrUjNP8OPzH2Hb5ha3bspiWez3xWvUXqDkHzQoi', 1, 'ACTIVO', 'admin@gmail.com', 'storage/avatars/default_user.png'),
(null, 'demo', '$2y$10$SXMtMX83rAnvwLOrUjNP8OPzH2Hb5ha3bspiWez3xWvUXqDkHzQoi', 1, 'ACTIVO', 'dem@gmail.com', '/storage/avatars/BloX6WAmKj9CfKxM3Ttg2GiYMhb3Zuym6BSWsefG.svg'); */


INSERT INTO persona(
id_persona, 
nombres, 
apellidos, 
fecha_nacimiento, 
dpi, 
telefono, 
id_departamento_residencia, 
id_municipio_residencia, 
direccion_residencia, 
nombre_padre, 
nombre_madre, 
id_estado_civil) 
VALUES (null, 
'', 
'', 
'', 
'', 
'', 
'', 
'', 
'', 
'', 
'', 
'')