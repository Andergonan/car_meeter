CREATE SCHEMA IF NOT EXISTS `car_meeter` DEFAULT CHARACTER SET utf8 COLLATE utf8_czech_ci;

USE `car_meeter`;

CREATE TABLE IF NOT EXISTS `car_meeter`.`users` (
	`id` INT NOT NULL AUTO_INCREMENT,
  `firstname` VARCHAR(50) NOT NULL,
  `lastname` VARCHAR(50) NOT NULL,
  `username` VARCHAR(50) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;

CREATE TRIGGER car_meeter.trg_format_names
BEFORE INSERT ON car_meeter.users
FOR EACH ROW
BEGIN 
  SET NEW.firstname = CONCAT(UCASE(LEFT(NEW.firstname, 1)), LCASE(SUBSTRING(NEW.firstname, 2)));
  SET NEW.lastname = CONCAT(UCASE(LEFT(NEW.lastname, 1)), LCASE(SUBSTRING(NEW.lastname, 2)));
END;


/*INSERT INTO `car_meeter`.`users` (`username`,  `email`, `password`) VALUES
('testuser', 'testuser@email.com', '$2y$10$qn9f7Q3oPTFMKHSIUUFyQeRHrp8U3o.EEbGooUyQIS/spYKoyF8O.');*/

/*CREATE TABLE IF NOT EXISTS `car_meeter`.`meets` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `title` varchar(20) NOT NULL,
    `description` varchar(1000) NOT NULL, 
    `date`
    `time`
    `place`
    `participants`
    `owner`
)*/