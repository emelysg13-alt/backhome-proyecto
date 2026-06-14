
create DATABASE p_backhome;
USE p_backhome;


CREATE TABLE tipo_documento (
    id_t_doc VARCHAR(3) PRIMARY KEY,
    n_doc VARCHAR(25) NOT NULL
);

CREATE TABLE localidades (
    id_localidad TINYINT UNSIGNED PRIMARY KEY,
    n_localidad VARCHAR(100) NOT NULL
);


CREATE TABLE lugares (
    id_lugar INT PRIMARY KEY AUTO_INCREMENT,
    direccion VARCHAR(255) not null,
  localidad_id TINYINT UNSIGNED NOT NULL,
  constraint fk_l_localidad foreign key (localidad_id) references localidades (id_localidad) on update cascade
);

CREATE TABLE personas (
id_persona INT AUTO_INCREMENT primary key,
    t_documento_id VARCHAR(3) NOT NULL,
    n_documento VARCHAR(20) NOT NULL unique,

primer_nombre VARCHAR(100) NOT NULL,
    segundo_nombre VARCHAR(100),

    primer_apellido VARCHAR(100) NOT NULL,
    segundo_apellido VARCHAR(100),

    email VARCHAR(150) UNIQUE NOT NULL,
email_verified_at TIMESTAMP NULL,
    numero_tel VARCHAR(20) NOT NULL,

    password VARCHAR(255) NOT NULL,

    estado ENUM(
        'activo',
        'bloqueado',
        'suspendido'
    ) DEFAULT 'activo',
    
    remember_token VARCHAR(100) NULL,
    
  created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
foto_perfil varchar(255), 

 FOREIGN KEY (t_documento_id)
  REFERENCES tipo_documento (id_t_doc)
 on update cascade
);


CREATE TABLE administrador (
id_admin INT AUTO_INCREMENT PRIMARY KEY,
persona_id INT NOT NULL UNIQUE,
  FOREIGN KEY (persona_id)
   REFERENCES personas (id_persona) 
   on delete cascade on update cascade);

CREATE TABLE cliente (
   id_cliente INT AUTO_INCREMENT PRIMARY KEY,
   persona_id INT NOT NULL UNIQUE,
  FOREIGN KEY (persona_id)
   REFERENCES personas (id_persona) 
   on delete cascade on update cascade
);

CREATE TABLE animal (
    id_animal INT PRIMARY KEY AUTO_INCREMENT,
     sexo ENUM('macho','hembra','desconocido') NOT NULL,
    color VARCHAR(50) not null,
    descripcion TEXT not null
);


CREATE TABLE animal_exotico (
    id_animal_e INT AUTO_INCREMENT PRIMARY KEY,
    animal_id INT NOT NULL UNIQUE,
    especie VARCHAR(100) NOT NULL,
    FOREIGN KEY (animal_id) REFERENCES animal(id_animal)
    on delete cascade on update cascade
);

CREATE TABLE animal_domestico (
    id_animal_d INT AUTO_INCREMENT PRIMARY KEY,
    animal_id INT NOT NULL UNIQUE,
    especie VARCHAR(100) NOT NULL,
    raza VARCHAR(100) NOT NULL,
    FOREIGN KEY (animal_id) REFERENCES animal(id_animal)
    on delete cascade on update cascade
);


CREATE TABLE seguimiento (
    id_seguimiento INT PRIMARY KEY AUTO_INCREMENT,
        titulo VARCHAR(150) NOT NULL,
    descripcion TEXT not null,
    fecha_publicacion DATETIME 
    DEFAULT CURRENT_TIMESTAMP not null ,
    estado_reporte ENUM(
        'perdido',
        'encontrado',
        'reunido',
        'cerrado'
    ) NOT NULL,
    estado_moderacion ENUM('pendiente', 'aprobado', 'rechazado') DEFAULT 'pendiente' NOT NULL,
  animal_id INT NOT NULL,
    lugar_id INT NOT NULL,
    cliente_id INT NOT NULL,
    CONSTRAINT fk_seguimiento_animal FOREIGN KEY (animal_id) REFERENCES animal (id_animal) on delete cascade on update cascade,
    constraint fk_s_lugar foreign key (lugar_id) references lugares (id_lugar) on update cascade,
    constraint fk_s_cliente foreign key (cliente_id) references cliente (id_cliente) on delete cascade on update cascade
    
  );


CREATE TABLE historial_estado_seguimiento (
    id_historial INT PRIMARY KEY AUTO_INCREMENT,
    
    seguimiento_id INT NOT NULL,
    
    estado_anterior VARCHAR(50),
    
    estado_nuevo VARCHAR(50),
    
    fecha_cambio DATETIME DEFAULT CURRENT_TIMESTAMP,
    
    FOREIGN KEY (seguimiento_id)
    REFERENCES seguimiento(id_seguimiento)
    ON DELETE CASCADE
ON UPDATE CASCADE
);

CREATE TABLE actualizaciones_seguimiento (
    id_actualizacion INT PRIMARY KEY AUTO_INCREMENT,

    seguimiento_id INT NOT NULL,

    mensaje TEXT NOT NULL,

    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP
ON UPDATE CURRENT_TIMESTAMP,

    FOREIGN KEY (seguimiento_id)
    REFERENCES seguimiento(id_seguimiento)
    ON DELETE CASCADE ON UPDATE CASCADE
);

 
 
 CREATE TABLE imagenes_seguimiento (
    id_imagen INT PRIMARY KEY AUTO_INCREMENT,
    
    seguimiento_id INT NOT NULL,
    
    ruta_imagen VARCHAR(255) NOT NULL,
    imagen_principal BOOLEAN DEFAULT FALSE,
    
    
    FOREIGN KEY (seguimiento_id)
    REFERENCES seguimiento(id_seguimiento)
    ON DELETE CASCADE ON UPDATE CASCADE
);


CREATE TABLE gestion_seguimiento (
    id_gestion INT PRIMARY KEY AUTO_INCREMENT,
    seguimiento_id INT not null,
    fecha_seguimiento DATEtime not null,
    accion VARCHAR(50) not null,
    observacion TEXT,
   administrador_id int not null,

CONSTRAINT fk_gestiones_seguimiento FOREIGN KEY (seguimiento_id) REFERENCES seguimiento (id_seguimiento) ON UPDATE CASCADE,
    CONSTRAINT fk_gestiones_administrador FOREIGN KEY (administrador_id) REFERENCES administrador (id_admin) ON UPDATE CASCADE
    
);




CREATE TABLE mensajes_de_soporte (
    id_mensaje INT PRIMARY KEY AUTO_INCREMENT,
    cliente_id int not null,
    mensaje_cliente TEXT NOT NULL,
   fecha_mensaje DATETIME DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_soporte_cliente FOREIGN KEY (cliente_id) REFERENCES cliente (id_cliente) ON DELETE CASCADE ON UPDATE CASCADE
);



DELIMITER //

CREATE TRIGGER tr_historial_estado
AFTER UPDATE ON seguimiento
FOR EACH ROW
BEGIN

    IF OLD.estado_reporte <> NEW.estado_reporte THEN

        INSERT INTO historial_estado_seguimiento(
            seguimiento_id,
            estado_anterior,
            estado_nuevo,
            fecha_cambio
        )

        VALUES(
            NEW.id_seguimiento,
            OLD.estado_reporte,
            NEW.estado_reporte,
            CURRENT_TIMESTAMP
        );

    END IF;

END //

DELIMITER ;

CREATE TABLE control_acciones (
    id_control INT AUTO_INCREMENT PRIMARY KEY,

    descripcion TEXT NOT NULL,

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

DELIMITER //

CREATE TRIGGER tr_seguimiento_eliminado
BEFORE DELETE ON seguimiento
FOR EACH ROW
BEGIN

    INSERT INTO control_acciones(descripcion)

    VALUES(
        CONCAT(
            'Se eliminó el seguimiento ID: ',
            OLD.id_seguimiento,
            ' - Titulo: ',
            OLD.titulo
        )
    );

END //

DELIMITER ;

DELIMITER //

CREATE PROCEDURE agregar_actualizacion(

    IN p_seguimiento_id INT,
    IN p_mensaje TEXT
)

BEGIN

    DECLARE v_existe INT;

    SELECT COUNT(*)
    INTO v_existe
    FROM seguimiento
    WHERE id_seguimiento = p_seguimiento_id;

    IF v_existe = 0 THEN

        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Seguimiento no encontrado';

    END IF;

    INSERT INTO actualizaciones_seguimiento(
        seguimiento_id,
        mensaje,
        created_at,
        updated_at
    )

    VALUES(
        p_seguimiento_id,
        p_mensaje,
        CURRENT_TIMESTAMP,
        CURRENT_TIMESTAMP
    );

END //

DELIMITER ;