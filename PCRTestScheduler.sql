CREATE DATABASE IF NOT EXISTS PCRTestScheduler;

USE PCRTestScheduler;

CREATE TABLE IF NOT EXISTS `TestSlot` (
  `testSlotID` INT NOT NULL AUTO_INCREMENT,
  `Date` DATE NOT NULL UNIQUE,
  `Time` INT NOT NULL,
  PRIMARY KEY (`testSlotID`)
);

CREATE TABLE IF NOT EXISTS `PastTestResults` (
  `testSlotID` INT NOT NULL,
  `patientID` INT NOT NULL,
  `result` BOOLEAN,
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
  `540` BOOLEAN,
  `555` BOOLEAN,
  `570` BOOLEAN,
  `585` BOOLEAN,
  `600` BOOLEAN,
  `615` BOOLEAN,
  `630` BOOLEAN,
  `645` BOOLEAN,
  `660` BOOLEAN,
  `675` BOOLEAN,
  `690` BOOLEAN,
  `705` BOOLEAN,
  `720` BOOLEAN,
  `735` BOOLEAN,
  `750` BOOLEAN,
  `765` BOOLEAN,
  `780` BOOLEAN,
  `795` BOOLEAN,
  `810` BOOLEAN,
  `825` BOOLEAN,
  `840` BOOLEAN,
  `855` BOOLEAN,
  `870` BOOLEAN,
  `885` BOOLEAN,
  `900` BOOLEAN,
  `915` BOOLEAN,
  `930` BOOLEAN,
  `945` BOOLEAN,
  `960` BOOLEAN,
  `975` BOOLEAN,
  `990` BOOLEAN,
  `1005` BOOLEAN,
  PRIMARY KEY (`Date`)
);