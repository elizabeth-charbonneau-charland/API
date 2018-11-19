CREATE DATABASE eccbank;
USE eccbank;

CREATE TABLE `User` (
  `ID` Integer AUTO_INCREMENT,
   `first_name` Varchar(100),
   `last_name` Varchar(100),
  `email` Varchar(100),
  `password` Char(60),
  PRIMARY KEY (`ID`)
);

CREATE TABLE `Account_Type` (
  `ID`  INTEGER AUTO_INCREMENT,
  `type` VARCHAR (10),
  PRIMARY KEY (`ID`)
);

CREATE TABLE `Account` (
  `ID`  INTEGER AUTO_INCREMENT,
  `owner` INTEGER ,
   `name` VARCHAR (100),
   `account_type` INTEGER,
  `amount` Varchar(50),
  PRIMARY KEY (`ID`),
  FOREIGN KEY (owner) REFERENCES User(ID),
   FOREIGN KEY (account_type) REFERENCES Account_Type(ID)
);

CREATE TABLE `Providers` (
  `ID`  INTEGER AUTO_INCREMENT,
  `name` VARCHAR (100),
  PRIMARY KEY (`ID`)
);

CREATE TABLE `Transfer` (
  `ID`  VARCHAR(50) ,
  `amount` VARCHAR (100),
  `account` INTEGER,
  PRIMARY KEY (`ID`),
  FOREIGN KEY (account) REFERENCES Account(ID)
);

INSERT INTO `Account_Type` (type)
VALUES ('checking'),('savings')


INSERT INTO `Providers` (name)
VALUES ('Videotron S.E.N.C.'),('Bell Canada Inc.'),('Visa Scotia'),('Visa Desjardins'),('Mastercard BMO')


