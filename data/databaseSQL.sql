-- phpMyAdmin SQL Dump
-- version 5.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE DATABASE IF NOT EXISTS events_manager;
USE events_manager;

CREATE TABLE evenements (
    id int(11) NOT NULL,
    name varchar(255) NOT NULL,
    creation_date date NOT NULL,
    start_date date NOT NULL,
    end_date date NOT NULL,
    max_person int(11) NOT NULL,
    registration_number int(11) NOT NULL DEFAULT '0',
    location varchar(255) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

CREATE TABLE eventsRegister (
    id int(11) NOT NULL,
    event_id int(11) NOT NULL,
    first_name varchar(100) NOT NULL,
    last_name varchar(100) NOT NULL,
    registration_date date NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

ALTER TABLE evenements ADD PRIMARY KEY (id);

ALTER TABLE eventsRegister
ADD PRIMARY KEY (id),
ADD KEY event_id (event_id);

ALTER TABLE evenements
MODIFY id int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE eventsRegister
MODIFY id int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE eventsRegister
ADD CONSTRAINT eventsRegister_ibfk_1 FOREIGN KEY (event_id) REFERENCES evenements (id);

COMMIT;

CREATE USER IF NOT EXISTS 'SGBDR' @'localhost' IDENTIFIED BY 'SGBDRPassword123!';

GRANT SELECT, EXECUTE ON events_manager.* TO 'SGBDR' @'localhost';

FLUSH PRIVILEGES;

DELIMITER // 

CREATE FUNCTION canRegister(event_id INT) 
RETURNS BOOLEAN
DETERMINISTIC
BEGIN
    DECLARE max_personnes INT;
    DECLARE current_eventsRegister INT;

    SELECT max_person, registration_number INTO max_personnes, current_eventsRegister
    FROM evenements
    WHERE id = event_id;

    RETURN current_eventsRegister < max_personnes;
END //

CREATE PROCEDURE getEvents()
BEGIN
   SELECT * FROM evenements;
END //

CREATE PROCEDURE getEventById(event_id INT)
BEGIN
   SELECT * FROM evenements WHERE id = event_id;
END //



CREATE PROCEDURE incrementRegistrationCount(IN event_id INT)
BEGIN
    UPDATE evenements
    SET registration_number = registration_number + 1
    WHERE id = event_id;
END //

CREATE PROCEDURE registerPersonToEvent(IN event_id INT,IN first_name VARCHAR(100),IN last_name VARCHAR(100))
BEGIN
    INSERT INTO eventsRegister (event_id, first_name, last_name, registration_date)VALUES (event_id, first_name, last_name, CURDATE());
END //


-- Triggers

CREATE TRIGGER after_registration_insert
AFTER INSERT ON eventsRegister
FOR EACH ROW
BEGIN
  CALL incrementRegistrationCount(NEW.event_id);
END //

CREATE TRIGGER after_delete_events  
AFTER DELETE ON evenements
FOR EACH ROW
BEGIN
  DELETE FROM eventsRegister WHERE event_id = OLD.id;
END //
DELIMITER ;