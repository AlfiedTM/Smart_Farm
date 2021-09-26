DROP TABLE admin;

CREATE TABLE `admin` (
  `ID` smallint(255) unsigned NOT NULL,
  `Admin_name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Admin_username` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Admin_email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Phone_number` varchar(14) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Registration_date` datetime NOT NULL,
  PRIMARY KEY (`Admin_email`,`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO admin VALUES("1","Alfred T Matakala","admin","alfredtwaambo@gmail.com","+260975770988","e6e061838856bf47e1de730719fb2609","2021-04-27 09:11:09");
INSERT INTO admin VALUES("3","Mashapi E Matimba","Mashapi E Matimba","mashapimatimba@gmail.com","+260979516292","5a1604e8dac1e9e6031c93028e018112","2021-07-09 17:07:32");



DROP TABLE current_irrigation;

CREATE TABLE `current_irrigation` (
  `ID` smallint(255) unsigned NOT NULL,
  `Plant_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`ID`,`Plant_name`),
  CONSTRAINT `current_irrigation_ibfk_1` FOREIGN KEY (`ID`, `Plant_name`) REFERENCES `plant_records` (`ID`, `Plant_name`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO current_irrigation VALUES("4","Chibwabwa");



DROP TABLE description;

CREATE TABLE `description` (
  `ID` int(11) NOT NULL,
  `Description` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  UNIQUE KEY `ID` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO description VALUES("1","Ph");
INSERT INTO description VALUES("2","Temperature");
INSERT INTO description VALUES("3","Moisture");
INSERT INTO description VALUES("4","Nitrogen");
INSERT INTO description VALUES("5","Phosphorus");
INSERT INTO description VALUES("6","Potassium");
INSERT INTO description VALUES("7","Date");
INSERT INTO description VALUES("8","Time");



DROP TABLE farm_data;

CREATE TABLE `farm_data` (
  `ID` int(11) NOT NULL,
  `Ph` int(10) unsigned NOT NULL,
  `Temperature` int(11) NOT NULL,
  `Moisture` int(10) unsigned NOT NULL,
  `Nitrogen` tinyint(3) unsigned NOT NULL,
  `Phosphorus` tinyint(3) unsigned NOT NULL,
  `Potassium` tinyint(3) unsigned NOT NULL,
  `Date` date NOT NULL,
  `Time` time NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO farm_data VALUES("1","7","45","550","5","4","7","2021-07-05","09:11:09");
INSERT INTO farm_data VALUES("2","5","35","460","5","6","7","2021-07-07","19:37:47");



DROP TABLE manager;

CREATE TABLE `manager` (
  `ID` smallint(255) unsigned NOT NULL,
  `Admin_name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Admin_username` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Admin_email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Phone_number` varchar(14) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Registration_date` datetime NOT NULL,
  PRIMARY KEY (`Admin_email`,`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO manager VALUES("1","Alfred T Matakala","admin","alfredtwaambo@gmail.com","+260975770988","e6e061838856bf47e1de730719fb2609","2021-04-27 09:11:09");
INSERT INTO manager VALUES("3","Mashapi E Matimba","Mashapi E Matimba","mashapimatimba@gmail.com","+260979516292","5a1604e8dac1e9e6031c93028e018112","2021-07-09 17:07:32");



DROP TABLE plant_records;

CREATE TABLE `plant_records` (
  `ID` smallint(255) unsigned NOT NULL,
  `Plant_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `Ph_low` tinyint(3) unsigned NOT NULL,
  `Ph_high` tinyint(3) unsigned NOT NULL,
  `Temp_high` tinyint(4) NOT NULL,
  `Temp_low` tinyint(4) NOT NULL,
  `Moisture_high` smallint(5) unsigned NOT NULL,
  `Moisture_low` smallint(5) unsigned NOT NULL,
  `Nitrogen` tinyint(3) unsigned NOT NULL,
  `Phosphorus` tinyint(3) unsigned NOT NULL,
  `Potassium` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`ID`,`Plant_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO plant_records VALUES("1","Maize","2","5","20","35","550","450","9","5","4");
INSERT INTO plant_records VALUES("2","Rape","4","8","34","20","759","540","7","4","6");
INSERT INTO plant_records VALUES("3","Mpiru","6","9","30","34","780","670","7","9","2");
INSERT INTO plant_records VALUES("4","Chibwabwa","9","5","30","34","780","670","7","9","2");



