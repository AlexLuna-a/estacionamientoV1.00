CREATE DATABASE IF NOT EXISTS estacionamiento;
USE estacionamiento;



/* ----- TABLAS ---------  */
/* ----- TABLAS ---------  */
/* ----- TABLAS ---------  */

CREATE TABLE IF NOT EXISTS tipo_usuario(
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre_tipo VARCHAR(40) NOT NULL UNIQUE,
    descripcion_tipo TEXT NOT NULL,
    nivel_tipo int NOT NULL DEFAULT 1,
    created_at DATE NOT NULL,
    updated_at DATE
);

CREATE TABLE IF NOT EXISTS usuario(
    id CHAR(10) PRIMARY KEY,
    password_user VARCHAR(255) NOT NULL,
    apellido_p_user VARCHAR(30) NOT NULL,
    apellido_m_user VARCHAR(30) NOT NULL,
    nombre_user VARCHAR(50) NOT NULL,
    fecha_ingreso_user DATE NOT NULL,
    vigencia_user DATE NOT NULL,
    clave_tipo INT NOT NULL,
    created_at DATE NOT NULL,
    updated_at DATE,
    
    
    FOREIGN KEY (clave_tipo) REFERENCES tipo_usuario (clave_tipo)
);

CREATE TABLE IF NOT EXISTS estacionamiento(
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre_est VARCHAR(70) NOT NULL UNIQUE,
    ubicacion_est VARCHAR(100) NOT NULL UNIQUE,
    capacidad_max_est INT NOT NULL,
    ocupacion_actual_est INT NOT NULL DEFAULT 0,
    nivel_est INT NOT NULL DEFAULT 3,
    created_at DATE NOT NULL,
    updated_at DATE,
    
    FOREIGN KEY (nivel_est) REFERENCES tipos_usuarios (nivel_tipo) 
);

CREATE TABLE IF NOT EXISTS movimientos(
    codigo_user CHAR(10) NOT NULL,
    codigo_est INT NOT NULL,
    fecha_mov TIMESTAMP NOT NULL,
    accion_mov CHAR NOT NULL DEFAULT 'i',
    created_at DATE NOT NULL,
    updated_at DATE,
    
    FOREIGN KEY (codigo_user) REFERENCES usuario(codigo_user),
    FOREIGN KEY (codigo_est) REFERENCES estacionamiento(codigo_est)
);

CREATE TABLE IF NOT EXISTS vehiculo (
    id INT AUTO_INCREMENT PRIMARY KEY,
    placa_veh  CHAR(8),
    tipo_veh VARCHAR(12) NOT NULL,
    color_veh VARCHAR(25) NOT NULL,
    codigo_user CHAR(10) NOT NULL,
    created_at DATE NOT NULL,
    updated_at DATE,
    
    FOREIGN KEY (codigo_user) REFERENCES usuario (codigo_user)
);

CREATE TABLE IF NOT EXISTS espacio_esp (
    id INT AUTO_INCREMENT PRIMARY KEY,
    descripcion VARCHAR(255) NOT NULL,
    capacidad_max_esp INT NOT NULL,
    ocupacion_actual_esp INT NOT NULL DEFAULT 0,
    codigo_est INT NOT NULL,
    nivel_tipo INT NOT NULL,
    FOREIGN KEY (codigo_est) REFERENCES estacionamiento (codigo_est),
    FOREIGN KEY (nivel_tipo) REFERENCES tipos_usuarios(nivel_tipo)
);

CREATE TABLE IF NOT EXISTS movimientos_esp (
    codigo_user CHAR(10) NOT NULL,
    placa_veh CHAR(8) NOT NULL,
    codigo_esp INT NOT NULL,
    fecha_esp TIMESTAMP NOT NULL,
    accion_esp CHAR DEFAULT 'i',
    razon_esp VARCHAR(255) NOT NULL,
    
    FOREIGN KEY (codigo_user) REFERENCES usuario(codigo_user),
    FOREIGN KEY (placa_veh) REFERENCES vehiculo(placa_veh),
    FOREIGN KEY (codigo_esp) REFERENCES espacio_esp(codigo_esp)
);


/* ----- INSERT ---------  */
/* ----- INSERT ---------  */
/* ----- INSERT ---------  */
INSERT INTO `tipo_usuario` (`id`, `nombre_tipo`, `descripcion_tipo`, `nivel_tipo`) VALUES 
(NULL, 'Administrador', 'Acceso a los diferentes registros de la base de datos, y manipulación de la información ', '10'), 
(NULL, 'Supervisor', 'Control de acceso a los estacionamientos, registro de entradas y salidas', '9'), 
(NULL, 'Visitante', 'Puede acceder a espacios delimitados\r\nno requiere identificarse al sistema', '1'), 
(NULL, 'Provedor', 'Solo tiene acceso a espacios especiales', '2'), 
(NULL, 'Alumno ', 'Tiene acceso a los diferentes estacionamientos destinados para el alumnado', '3'), 
(NULL, 'Maestro/Administrativo', 'Tiene acceso a estacionamientos exclusivos para personal', '4'), 
(NULL, 'Maestro/Administrativo Reserv', 'tienen acceso a espacios especiales, reservados solo para algunos', '5');



INSERT INTO `usuario` (`id`, `password_user`, `apellido_p_user`, `apellido_m_user`, `nombre_user`, `fecha_ingreso_user`, `vigencia_user`, `clave_tipo`) VALUES 
('1111111111', '123456', 'ADMIN APP', 'ADMIN APM', 'ADMIN NAME', '2020-05-01', '2020-05-31', '1'),
('1111111112', '123456', 'SUPER APP', 'SUPER APM', 'SUPER NAME', '2020-05-01', '2020-05-31', '2'),
('1111111113', '123456', 'VISIT APP', 'VISIT APM', 'VISIT NAME', '2020-05-01', '2020-05-31', '3'),
('1111111114', '123456', 'PROV APP', 'PROV APM', 'PROV NAME', '2020-05-01', '2020-05-31', '4'),
('1111111115', '123456', 'ALUMN APP', 'ALUMN APM', 'ALUMN NAME', '2020-05-01', '2020-05-31', '5'),
('1111111116', '123456', 'PERSONAL APP', 'PERSONAL APM', 'PERSONAL NAME', '2020-05-01', '2020-05-31', '6'),
('1111111117', '123456', 'RESERV APP', 'RESERV APM', 'RESERV NAME', '2020-05-01', '2020-05-31', '7');



INSERT INTO `estacionamiento` (`id`, `nombre_est`, `ubicacion_est`, `capacidad_max_est`, `ocupacion_actual_est`, `nivel_est`) VALUES 
(NULL, 'BOULEVARD 1', 'BOULEVARD 1', '200', '0', '4'), 
(NULL, 'OLIMPICA 1', 'OLIMPICA 1', '200', '0', '3'), 
(NULL, 'RECTORIA', 'RECTORIA 1', '20', '0', '5');

INSERT INTO `espacio_esp` (`id`, `descripcion`, `capacidad_max_esp`, `ocupacion_actual_esp`, `codigo_est`, `nivel_tipo`) VALUES 
(NULL, 'BAHIA PASAJE BOULEBVARD 1', '3', '0', '1', '1'), 
(NULL, 'PROVEDORES BOULEVARD 1', '5', '0', '1', '2');
