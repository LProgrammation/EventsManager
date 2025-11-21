-- phpMyAdmin SQL Dump
-- version 5.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE DATABASE IF NOT EXISTS events_manager;
USE events_manager;

CREATE TABLE evenements (
    id int(11) NOT NULL,
    name varchar(255) NOT NULL UNIQUE,
    creation_date date NOT NULL,
    start_date date NOT NULL,
    end_date date NOT NULL,
    max_attendees int(11) NOT NULL DEFAULT '10',
    attendees_count int(11) NOT NULL DEFAULT '0',
    location varchar(255) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

CREATE TABLE eventsAttendees (
    id int(11) NOT NULL,
    event_id int(11) NOT NULL,
    first_name varchar(100) NOT NULL,
    last_name varchar(100) NOT NULL,
    registration_date date
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

ALTER TABLE evenements ADD PRIMARY KEY (id);

ALTER TABLE eventsAttendees
ADD PRIMARY KEY (id),
ADD KEY event_id (event_id);

ALTER TABLE evenements
MODIFY id int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE eventsAttendees
MODIFY id int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE eventsAttendees
ADD CONSTRAINT eventsAttendees_ibfk_1 FOREIGN KEY (event_id) REFERENCES evenements (id) ON DELETE CASCADE;

COMMIT;

CREATE USER IF NOT EXISTS 'SGBDR' @'localhost' IDENTIFIED BY 'SGBDRPassword123!';

GRANT SELECT, EXECUTE ON events_manager.* TO 'SGBDR' @'localhost';

FLUSH PRIVILEGES;

DELIMITER // 
-- Functions
CREATE FUNCTION canRegister(p_event_id INT, p_first_name VARCHAR(100), p_last_name VARCHAR(100))
RETURNS BOOLEAN
DETERMINISTIC
BEGIN
    DECLARE max_attendeesnes INT;
    DECLARE current_attendees_count INT;
    DECLARE attendeeExistsInThisEvent INT;

    SELECT max_attendees, attendees_count INTO max_attendeesnes, current_attendees_count
    FROM evenements
    WHERE id = p_event_id;

    SELECT COUNT(*) INTO attendeeExistsInThisEvent
    FROM eventsAttendees
    WHERE event_id = p_event_id AND first_name = p_first_name AND last_name = p_last_name;
    IF attendeeExistsInThisEvent > 0 THEN
        RETURN FALSE;
    END IF;
    RETURN current_attendees_count < max_attendeesnes;
END //

CREATE FUNCTION canUnregister(p_event_id INT, p_first_name VARCHAR(100), p_last_name VARCHAR(100))
RETURNS BOOLEAN
DETERMINISTIC
BEGIN
    DECLARE attendee_count INT;

    SELECT COUNT(*) INTO attendee_count
    FROM eventsAttendees
    WHERE event_id = p_event_id AND first_name = p_first_name AND last_name = p_last_name;

    RETURN attendee_count > 0;
END //



-- Procedures
CREATE PROCEDURE getEvents()
BEGIN
   SELECT * FROM evenements;
END //

CREATE PROCEDURE getEventById(event_id INT)
BEGIN
   SELECT * FROM evenements WHERE id = event_id;
END //

CREATE PROCEDURE createEvent(
    IN event_name VARCHAR(255),
    IN event_location VARCHAR(255),
    IN start_date DATE,
    IN end_date DATE,
    IN max_attendees INT,
    OUT new_event_id INT
)
BEGIN
    INSERT INTO evenements (name, creation_date, start_date, end_date, max_attendees, attendees_count, location)
    VALUES (event_name, CURDATE(), start_date, end_date, max_attendees, 0, event_location);
    SET new_event_id = LAST_INSERT_ID();
END //



CREATE PROCEDURE incrementAttendeesCount(IN event_id INT)
BEGIN
    UPDATE evenements
    SET attendees_count = attendees_count + 1
    WHERE id = event_id;
END //

CREATE PROCEDURE decrementAttendeesCount(IN event_id INT)
BEGIN
    UPDATE evenements
    SET attendees_count = attendees_count - 1
    WHERE id = event_id;
END //

CREATE PROCEDURE registerAttendeeToEvent(IN event_id INT,IN first_name VARCHAR(100),IN last_name VARCHAR(100), IN registration_date DATE)
BEGIN
    IF NOT canRegister(event_id, first_name, last_name) THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Cannot register attendee: event is full OR user already registered';
    END IF;
    INSERT INTO eventsAttendees (event_id, first_name, last_name, registration_date)VALUES (event_id, first_name, last_name, registration_date);
END //

CREATE PROCEDURE unregisterAttendeeFromEvent(IN p_first_name VARCHAR(100), IN p_last_name VARCHAR(100), IN p_event_id INT)
BEGIN
    IF NOT canUnregister(p_event_id, p_first_name, p_last_name) THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Cannot unregister attendee: attendee not found for this event';
    END IF;
    DELETE FROM eventsAttendees WHERE first_name = p_first_name AND last_name = p_last_name AND event_id = p_event_id;
END //

CREATE PROCEDURE updateEventDates(IN event_id INT, IN new_start_date DATE, IN new_end_date DATE)
BEGIN
    UPDATE evenements
    SET start_date = new_start_date,
        end_date = new_end_date
    WHERE id = event_id;
END //

CREATE PROCEDURE deleteEvent(IN event_id INT)
BEGIN
    DELETE FROM evenements WHERE id = event_id;
END //

-- Triggers

CREATE TRIGGER after_registration_insert
AFTER INSERT ON eventsAttendees
FOR EACH ROW
BEGIN
  CALL incrementAttendeesCount(NEW.event_id);
END //

CREATE TRIGGER after_unregistration_delete
AFTER DELETE ON eventsAttendees
FOR EACH ROW
BEGIN
  CALL decrementAttendeesCount(OLD.event_id);
END //

DELIMITER ;