DELIMITER //

CREATE FUNCTION ocupacion_actual_est_mas_uno(clave INT) RETURNS INT
BEGIN
    DECLARE resul INT;
    SET resul = (SELECT ocupacion_actual_est FROM estacionamiento WHERE codigo_est = clave) + 1;
    RETURN resul;
END

CREATE FUNCTION ocupacion_actual_est_menos_uno(clave INT) RETURNS INT
BEGIN
    DECLARE resul INT;
    SET resul = (SELECT ocupacion_actual_est FROM estacionamiento WHERE codigo_est = clave) - 1;
    RETURN resul;
END

DELIMITER ;




DELIMITER //
CREATE TRIGGER actualizacion_est AFTER INSERT ON movimientos FOR EACH ROW BEGIN

    IF NEW.accion_mov = 'i' THEN BEGIN
    UPDATE estacionamiento SET ocupacion_actual_est = ocupacion_actual_est_mas_uno(NEW.codigo_est)  WHERE estacionamiento.codigo_est = NEW.codigo_est;
    END;
    
    ELSEIF NEW.accion_mov = 'o' THEN BEGIN
    UPDATE estacionamiento SET ocupacion_actual_est = ocupacion_actual_est_menos_uno(NEW.codigo_est)  WHERE estacionamiento.codigo_est = NEW.codigo_est;
    END;
    
END IF;

END //

DELIMITER ;






/* 2do trigger  */

DELIMITER //

CREATE FUNCTION actual_esp_mas_uno(clave INT) RETURNS INT
BEGIN
    DECLARE resul INT;
    SET resul = (SELECT ocupacion_actual_esp FROM espacio_esp WHERE codigo_esp = clave) + 1;
    RETURN resul;
END 

CREATE FUNCTION actual_esp_menos_uno(clave INT) RETURNS INT
BEGIN
    DECLARE resul INT;
    SET resul = (SELECT ocupacion_actual_esp FROM espacio_esp WHERE codigo_esp = clave) - 1;
    RETURN resul;
END //

DELIMITER ;




DELIMITER //
CREATE TRIGGER actualizacion_esp AFTER INSERT ON movimientos_esp FOR EACH ROW BEGIN

    IF NEW.accion_esp = 'i' THEN BEGIN
    UPDATE espacio_esp SET ocupacion_actual_esp = actual_esp_mas_uno(NEW.codigo_esp)  WHERE espacio_esp.codigo_esp  = NEW.codigo_esp;
    END;
    
    ELSEIF NEW.accion_esp = 'o' THEN BEGIN
    UPDATE espacio_esp SET ocupacion_actual_esp = actual_esp_menos_uno(NEW.codigo_esp)  WHERE espacio_esp.codigo_esp = NEW.codigo_esp;
    END;
    
END IF;

END //

DELIMITER ;










