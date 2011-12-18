-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 18, 2011 at 07:36 PM
-- Server version: 5.5.8
-- PHP Version: 5.3.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: 'cpscdb_hospital'
--

-- --------------------------------------------------------

--
-- Table structure for table 'alerts'
--

CREATE TABLE IF NOT EXISTS alerts (
  SenderId int(11) NOT NULL DEFAULT '0',
  ReceiverId int(11) NOT NULL DEFAULT '0',
  DateA date NOT NULL DEFAULT '0000-00-00',
  TimeA time NOT NULL DEFAULT '00:00:00',
  Description varchar(60) DEFAULT NULL,
  PRIMARY KEY (SenderId,ReceiverId,DateA,TimeA)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table 'alerts'
--

INSERT INTO alerts (SenderId, ReceiverId, DateA, TimeA, Description) VALUES
(1, 2, '2011-12-06', '00:54:59', 'Are you free tomorrow at 6pm ?');

-- --------------------------------------------------------

--
-- Table structure for table 'bedroom1'
--

CREATE TABLE IF NOT EXISTS bedroom1 (
  RoomId int(11) NOT NULL,
  NumberOfBed int(11) DEFAULT NULL,
  PRIMARY KEY (RoomId)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table 'bedroom1'
--

INSERT INTO bedroom1 (RoomId, NumberOfBed) VALUES
(1, 4);

-- --------------------------------------------------------

--
-- Table structure for table 'book'
--

CREATE TABLE IF NOT EXISTS book (
  RentalId int(11) NOT NULL,
  Author varchar(20) DEFAULT NULL,
  PRIMARY KEY (RentalId)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table 'book'
--

INSERT INTO book (RentalId, Author) VALUES
(1, 'Patrick Dewitt'),
(2, 'Haruki Murakami'),
(3, 'Chad Harbach');

-- --------------------------------------------------------

--
-- Table structure for table 'doctor'
--

CREATE TABLE IF NOT EXISTS doctor (
  DoctorId int(11) NOT NULL,
  Section varchar(20) DEFAULT NULL,
  PRIMARY KEY (DoctorId)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table 'doctor'
--

INSERT INTO doctor (DoctorId, Section) VALUES
(2, 'Block'),
(4, 'Surgeon'),
(5, 'Anesthesiologist'),
(27, 'Emergency');

-- --------------------------------------------------------

--
-- Table structure for table 'dvd'
--

CREATE TABLE IF NOT EXISTS dvd (
  RentalId int(11) NOT NULL,
  Director varchar(20) DEFAULT NULL,
  Duration int(11) DEFAULT NULL,
  PRIMARY KEY (RentalId)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table 'dvd'
--

INSERT INTO dvd (RentalId, Director, Duration) VALUES
(4, 'Jessica Chastain', 137),
(5, 'Tom Hooper', 119);

-- --------------------------------------------------------

--
-- Table structure for table 'longtermpatient'
--

CREATE TABLE IF NOT EXISTS longtermpatient (
  PatientId int(11) NOT NULL,
  MealId int(11) DEFAULT NULL,
  PRIMARY KEY (PatientId),
  KEY MealId (MealId)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table 'longtermpatient'
--

INSERT INTO longtermpatient (PatientId, MealId) VALUES
(3, 1);

-- --------------------------------------------------------

--
-- Table structure for table 'mealplan'
--

CREATE TABLE IF NOT EXISTS mealplan (
  MealId int(11) NOT NULL,
  `Type` varchar(20) DEFAULT NULL,
  Sunday varchar(20) DEFAULT NULL,
  Monday varchar(20) DEFAULT NULL,
  Tuesday varchar(20) DEFAULT NULL,
  Wednesday varchar(20) DEFAULT NULL,
  Thursday varchar(20) DEFAULT NULL,
  Friday varchar(20) DEFAULT NULL,
  Saturday varchar(20) DEFAULT NULL,
  PRIMARY KEY (MealId)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table 'mealplan'
--

INSERT INTO mealplan (MealId, Type, Sunday, Monday, Tuesday, Wednesday, Thursday, Friday, Saturday) VALUES
(1, 'salt free', 'Chicken', 'Beef', 'Beef', 'Beef', 'Chicken', 'Beef', 'CHicken'),
(2, 'sugar', 'Beef', 'Beef', 'Beef', 'Beef', 'Beef', 'Beef', 'Beef'),
(3, 'salt and sugar free', 'Chicken', 'chicken', 'chicken', 'chicken', 'Chicken', 'chicken', 'CHicken');

-- --------------------------------------------------------

--
-- Table structure for table 'patient'
--

CREATE TABLE IF NOT EXISTS patient (
  PatientId int(11) NOT NULL AUTO_INCREMENT,
  FName varchar(30) DEFAULT NULL,
  LName varchar(30) DEFAULT NULL,
  Adress varchar(90) DEFAULT NULL,
  PhoneNumber varchar(10) DEFAULT NULL,
  PreferedDoctor int(11) DEFAULT NULL,
  PatientType varchar(10) DEFAULT NULL,
  PRIMARY KEY (PatientId),
  KEY PreferedDoctor (PreferedDoctor)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Dumping data for table 'patient'
--

INSERT INTO patient (PatientId, FName, LName, Adress, PhoneNumber, PreferedDoctor, PatientType) VALUES
(3, 'Pierre', 'Vaidie', 'Cacscade Hall', '5037078788', 2, 'LONGTERM'),
(4, 'Curtis', 'Korchynski', '2432 Red Road', '2345963', 2, 'SHORTTERM'),
(12, 'George', 'Mcfly', '1222 sadf adsf', '1234244', NULL, 'SHORTTERM'),
(17, 'jack', 'jackyy', '234666', '34', NULL, 'SHORTTERM'),
(28, 'Joe', 'Sakic', '2934 Hockey Way', '23444', NULL, 'LONGTERM');

-- --------------------------------------------------------

--
-- Table structure for table 'patientfile'
--

CREATE TABLE IF NOT EXISTS patientfile (
  PatientId int(11) NOT NULL DEFAULT '0',
  DoctorId int(11) NOT NULL DEFAULT '0',
  DateOfVisit date NOT NULL DEFAULT '0000-00-00',
  LenghtOfVisit int(11) DEFAULT NULL,
  TypeOfVisit varchar(20) DEFAULT NULL,
  Description varchar(60) DEFAULT NULL,
  DoctorNotes varchar(60) DEFAULT NULL,
  PRIMARY KEY (PatientId,DoctorId,DateOfVisit),
  KEY DoctorId (DoctorId)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table 'patientfile'
--

INSERT INTO patientfile (PatientId, DoctorId, DateOfVisit, LenghtOfVisit, TypeOfVisit, Description, DoctorNotes) VALUES
(3, 4, '2011-12-06', 60, 'Operation', 'Operation of the heart', 'All is good');

-- --------------------------------------------------------

--
-- Table structure for table 'rent'
--

CREATE TABLE IF NOT EXISTS rent (
  RentalId int(11) NOT NULL DEFAULT '0',
  LongTermID int(11) NOT NULL DEFAULT '0',
  BeginDate date NOT NULL DEFAULT '0000-00-00',
  EndDate date DEFAULT NULL,
  PRIMARY KEY (RentalId,LongTermID,BeginDate),
  KEY LongTermID (LongTermID)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table 'rent'
--

INSERT INTO rent (RentalId, LongTermID, BeginDate, EndDate) VALUES
(5, 3, '2011-12-01', '2011-12-23');

-- --------------------------------------------------------

--
-- Table structure for table 'rental'
--

CREATE TABLE IF NOT EXISTS rental (
  RentalId int(11) NOT NULL,
  `Name` varchar(30) DEFAULT NULL,
  PRIMARY KEY (RentalId)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table 'rental'
--

INSERT INTO rental (RentalId, Name) VALUES
(1, 'The Sisters Brothers'),
(2, '1Q84 '),
(3, 'The Art of Fielding: A Novel'),
(4, 'The Help'),
(5, 'The Kings Speech');

-- --------------------------------------------------------

--
-- Table structure for table 'room'
--

CREATE TABLE IF NOT EXISTS room (
  RoomId int(11) NOT NULL,
  Number int(11) DEFAULT NULL,
  Floor int(11) DEFAULT NULL,
  Section varchar(20) DEFAULT NULL,
  RoomType varchar(30) DEFAULT NULL,
  PRIMARY KEY (RoomId)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table 'room'
--

INSERT INTO room (RoomId, Number, Floor, Section, RoomType) VALUES
(1, 234, 2, 'Left', 'Long Term'),
(2, 121, 1, 'Left', 'Emergency');

-- --------------------------------------------------------

--
-- Table structure for table 'schedule'
--

CREATE TABLE IF NOT EXISTS `schedule` (
  Sid int(11) NOT NULL,
  RoomId int(11) DEFAULT NULL,
  PatientId int(11) DEFAULT NULL,
  DoctorId int(11) DEFAULT NULL,
  DateS date DEFAULT NULL,
  BeginTime time DEFAULT NULL,
  EndTime time DEFAULT NULL,
  PRIMARY KEY (Sid),
  KEY RoomId (RoomId),
  KEY PatientId (PatientId),
  KEY DoctorId (DoctorId)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table 'schedule'
--


-- --------------------------------------------------------

--
-- Table structure for table 'secretary'
--

CREATE TABLE IF NOT EXISTS secretary (
  SecretaryId int(11) NOT NULL,
  Section varchar(20) DEFAULT NULL,
  JobTitle varchar(20) DEFAULT NULL,
  PRIMARY KEY (SecretaryId)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table 'secretary'
--

INSERT INTO secretary (SecretaryId, Section, JobTitle) VALUES
(1, 'Nursery', 'chief'),
(20, 'Front Desk', 'Receptionist');

-- --------------------------------------------------------

--
-- Table structure for table 'speciality'
--

CREATE TABLE IF NOT EXISTS speciality (
  DoctorId int(11) NOT NULL,
  Speciality varchar(20) NOT NULL DEFAULT '',
  KEY DoctorId (DoctorId)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table 'speciality'
--

INSERT INTO speciality (DoctorId, Speciality) VALUES
(2, 'Head'),
(2, 'Eye'),
(4, 'Cardio Vascular'),
(5, 'Ear'),
(27, 'Special');

-- --------------------------------------------------------

--
-- Table structure for table 'stay'
--

CREATE TABLE IF NOT EXISTS stay (
  PatientId int(11) NOT NULL DEFAULT '0',
  BedRoomId int(11) NOT NULL DEFAULT '0',
  BeginDate date NOT NULL DEFAULT '0000-00-00',
  EndDate date DEFAULT NULL,
  PRIMARY KEY (PatientId,BedRoomId,BeginDate),
  KEY BedRoomId (BedRoomId)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table 'stay'
--


-- --------------------------------------------------------

--
-- Table structure for table 'user'
--

CREATE TABLE IF NOT EXISTS `user` (
  UserId int(11) NOT NULL AUTO_INCREMENT,
  FName varchar(30) DEFAULT NULL,
  LName varchar(30) DEFAULT NULL,
  Pwd varchar(10) DEFAULT NULL,
  Adress varchar(90) DEFAULT NULL,
  PhoneNumber varchar(10) DEFAULT NULL,
  UserType varchar(10) DEFAULT NULL,
  PRIMARY KEY (UserId)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Dumping data for table 'user'
--

INSERT INTO user (UserId, FName, LName, Pwd, Adress, PhoneNumber, UserType) VALUES
(1, 'Audrey', 'Dupont', 'pass', '4th AVE NE', '5037078788', 'SECRETARY'),
(2, 'Mike', 'Kim', 'pass', '7878 98th AVE NE', '5037078788', 'DOCTOR'),
(3, 'Pierre', 'Vaidie', 'pass', 'Cacscade Hall', '5037078788', 'PATIENT'),
(4, 'Diane', 'Depardon', 'pass', '7878 98th AVE NE', '5037078788', 'DOCTOR'),
(5, 'Hannah', 'Creeper', 'pass', '7878 98th AVE NE', '5037078788', 'DOCTOR'),
(18, 'jack', 'jackyy', 'pass', '234666', '34', 'PATIENT'),
(20, 'Ronald', 'McDonald', 'pass', '2999 Big Mac Dr', '2333333', 'SECRETARY'),
(27, 'Doc', 'Brown4', 'pass', '1.21 Gigawatt Way', '121121121', 'DOCTOR'),
(28, 'Joe', 'Sakic', 'pass', '2934 Hockey Way', '23444', 'PATIENT');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `alerts`
--
ALTER TABLE `alerts`
  ADD CONSTRAINT ALERTS_ibfk_1 FOREIGN KEY (SenderId) REFERENCES `user` (UserId),
  ADD CONSTRAINT ALERTS_ibfk_2 FOREIGN KEY (SenderId) REFERENCES `user` (UserId);

--
-- Constraints for table `bedroom1`
--
ALTER TABLE `bedroom1`
  ADD CONSTRAINT BEDROOM_ibfk_1 FOREIGN KEY (RoomId) REFERENCES room (RoomId);

--
-- Constraints for table `book`
--
ALTER TABLE `book`
  ADD CONSTRAINT BOOK_ibfk_1 FOREIGN KEY (RentalId) REFERENCES rental (RentalId);

--
-- Constraints for table `doctor`
--
ALTER TABLE `doctor`
  ADD CONSTRAINT DOCTOR_ibfk_1 FOREIGN KEY (DoctorId) REFERENCES `user` (UserId);

--
-- Constraints for table `dvd`
--
ALTER TABLE `dvd`
  ADD CONSTRAINT DVD_ibfk_1 FOREIGN KEY (RentalId) REFERENCES rental (RentalId);

--
-- Constraints for table `longtermpatient`
--
ALTER TABLE `longtermpatient`
  ADD CONSTRAINT longtermpatient_ibfk_1 FOREIGN KEY (PatientId) REFERENCES `user` (UserId),
  ADD CONSTRAINT LONGTERMPATIENT_ibfk_2 FOREIGN KEY (MealId) REFERENCES mealplan (MealId);

--
-- Constraints for table `patient`
--
ALTER TABLE `patient`
  ADD CONSTRAINT PATIENT_ibfk_1 FOREIGN KEY (PreferedDoctor) REFERENCES doctor (DoctorId);

--
-- Constraints for table `patientfile`
--
ALTER TABLE `patientfile`
  ADD CONSTRAINT PATIENTFILE_ibfk_1 FOREIGN KEY (PatientId) REFERENCES patient (PatientId),
  ADD CONSTRAINT PATIENTFILE_ibfk_2 FOREIGN KEY (DoctorId) REFERENCES doctor (DoctorId);

--
-- Constraints for table `rent`
--
ALTER TABLE `rent`
  ADD CONSTRAINT RENT_ibfk_1 FOREIGN KEY (RentalId) REFERENCES rental (RentalId),
  ADD CONSTRAINT RENT_ibfk_2 FOREIGN KEY (LongTermID) REFERENCES longtermpatient (PatientId);

--
-- Constraints for table `schedule`
--
ALTER TABLE `schedule`
  ADD CONSTRAINT SCHEDULE_ibfk_1 FOREIGN KEY (RoomId) REFERENCES room (RoomId),
  ADD CONSTRAINT SCHEDULE_ibfk_2 FOREIGN KEY (PatientId) REFERENCES patient (PatientId),
  ADD CONSTRAINT SCHEDULE_ibfk_3 FOREIGN KEY (DoctorId) REFERENCES doctor (DoctorId);

--
-- Constraints for table `secretary`
--
ALTER TABLE `secretary`
  ADD CONSTRAINT SECRETARY_ibfk_1 FOREIGN KEY (SecretaryId) REFERENCES `user` (UserId);

--
-- Constraints for table `speciality`
--
ALTER TABLE `speciality`
  ADD CONSTRAINT speciality_ibfk_1 FOREIGN KEY (DoctorId) REFERENCES doctor (DoctorId);

--
-- Constraints for table `stay`
--
ALTER TABLE `stay`
  ADD CONSTRAINT STAY_ibfk_1 FOREIGN KEY (PatientId) REFERENCES longtermpatient (PatientId),
  ADD CONSTRAINT STAY_ibfk_2 FOREIGN KEY (BedRoomId) REFERENCES bedroom1 (RoomId);
