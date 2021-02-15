CREATE DATABASE IF NOT EXISTS PCRTestScheduler;

USE PCRTestScheduler;

CREATE TABLE IF NOT EXISTS `TestSlot` (
  `testSlotID` INT NOT NULL UNIQUE,
  `Date` DATE NOT NULL,
  `Time` INT NOT NULL
);

CREATE TABLE IF NOT EXISTS `PastTestResults` (
  `testSlotID` INT NOT NULL,
  `patientID` INT NOT NULL,
  `result` VARCHAR(1),
  `adminID` INT,
  `iv` VARCHAR(32),
  PRIMARY KEY (`patientID`, `testSlotID`)
);

CREATE TABLE IF NOT EXISTS `Patients` (
  `patientID` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(128) NOT NULL,
  `email` VARCHAR(320) NOT NULL UNIQUE,
  `phoneNumber` VARCHAR(128) NOT NULL UNIQUE,
  `password` VARCHAR(120) NOT NULL,
  `testSlotID` INT,
  `iv` VARCHAR(32),
  PRIMARY KEY (`patientID`)
);

CREATE TABLE IF NOT EXISTS `Administrators` (
  `adminID` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(120) NOT NULL,
  `email` VARCHAR(320) NOT NULL UNIQUE,
  `password` VARCHAR(120) NOT NULL,
  `iv` VARCHAR(32),
  PRIMARY KEY (`adminID`)
);

CREATE TABLE IF NOT EXISTS `TestReservations` (
  `Date` DATE,
  `slotsRemaining` BOOLEAN,
  `nextSlot` INT(5)
);

INSERT INTO `TestReservations` VALUES ("2021-02-14", 1, 540);
INSERT INTO `TestReservations` VALUES ("2021-02-15", 1, 540);
INSERT INTO `TestReservations` VALUES ("2021-02-16", 1, 540);
INSERT INTO `TestReservations` VALUES ("2021-02-17", 1, 540);
INSERT INTO `TestReservations` VALUES ("2021-02-18", 1, 540);
INSERT INTO `TestReservations` VALUES ("2021-02-19", 1, 540);
INSERT INTO `TestReservations` VALUES ("2021-02-20", 1, 540);
INSERT INTO `TestReservations` VALUES ("2021-02-21", 1, 540);
INSERT INTO `TestReservations` VALUES ("2021-02-22", 1, 540);
INSERT INTO `TestReservations` VALUES ("2021-02-23", 1, 540);
INSERT INTO `TestReservations` VALUES ("2021-02-24", 1, 540);
INSERT INTO `TestReservations` VALUES ("2021-02-25", 1, 540);
INSERT INTO `TestReservations` VALUES ("2021-02-26", 1, 540);
INSERT INTO `TestReservations` VALUES ("2021-02-27", 1, 540);
INSERT INTO `TestReservations` VALUES ("2021-02-28", 1, 540);
INSERT INTO `TestReservations` VALUES ("2021-03-01", 1, 540);
INSERT INTO `TestReservations` VALUES ("2021-03-02", 1, 540);
INSERT INTO `TestReservations` VALUES ("2021-03-03", 1, 540);
INSERT INTO `TestReservations` VALUES ("2021-03-04", 1, 540);
INSERT INTO `TestReservations` VALUES ("2021-03-05", 1, 540);
INSERT INTO `TestReservations` VALUES ("2021-03-06", 1, 540);
INSERT INTO `TestReservations` VALUES ("2021-03-07", 1, 540);
INSERT INTO `TestReservations` VALUES ("2021-03-08", 1, 540);
INSERT INTO `TestReservations` VALUES ("2021-03-09", 1, 540);
INSERT INTO `TestReservations` VALUES ("2021-03-10", 1, 540);
INSERT INTO `TestReservations` VALUES ("2021-03-11", 1, 540);
INSERT INTO `TestReservations` VALUES ("2021-03-12", 1, 540);
INSERT INTO `TestReservations` VALUES ("2021-03-13", 1, 540);
INSERT INTO `TestReservations` VALUES ("2021-03-14", 1, 540);
INSERT INTO `TestReservations` VALUES ("2021-03-15", 1, 540);
INSERT INTO `TestReservations` VALUES ("2021-03-16", 1, 540);
INSERT INTO `TestReservations` VALUES ("2021-03-17", 1, 540);
INSERT INTO `TestReservations` VALUES ("2021-03-18", 1, 540);
INSERT INTO `TestReservations` VALUES ("2021-03-19", 1, 540);
INSERT INTO `TestReservations` VALUES ("2021-03-20", 1, 540);
INSERT INTO `TestReservations` VALUES ("2021-03-21", 1, 540);
INSERT INTO `TestReservations` VALUES ("2021-03-22", 1, 540);
INSERT INTO `TestReservations` VALUES ("2021-03-23", 1, 540);
INSERT INTO `TestReservations` VALUES ("2021-03-24", 1, 540);
INSERT INTO `TestReservations` VALUES ("2021-03-25", 1, 540);
INSERT INTO `TestReservations` VALUES ("2021-03-26", 1, 540);
INSERT INTO `TestReservations` VALUES ("2021-03-27", 1, 540);
INSERT INTO `TestReservations` VALUES ("2021-03-28", 1, 540);
INSERT INTO `TestReservations` VALUES ("2021-03-29", 1, 540);
INSERT INTO `TestReservations` VALUES ("2021-03-30", 1, 540);
INSERT INTO `TestReservations` VALUES ("2021-03-31", 1, 540);