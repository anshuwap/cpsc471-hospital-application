/** DROP OLD TABLE **/
DROP TABLE STAY;
DROP TABLE RENT;
DROP TABLE DVD;
DROP TABLE BOOK;
DROP TABLE RENTAL;
DROP TABLE SCHEDULE;
DROP TABLE BEDROOM;
DROP TABLE ROOM;
DROP TABLE LONGTERMPATIENT;
DROP TABLE MEALPLAN;
DROP TABLE PATIENTFILE;
DROP TABLE PATIENT;
DROP TABLE ALERTS;
DROP TABLE SPECIALITY;
DROP TABLE DOCTOR;
DROP TABLE SECRETARY;
DROP TABLE USER;



/** CREATE TABLE **/

CREATE TABLE USER (
    UserId INT PRIMARY KEY, 
    FName VARCHAR(30), 
    LName VARCHAR(30), 
    Pwd VARCHAR(10), 
    Adress VARCHAR(90), 
    PhoneNumber VARCHAR(10), 
    UserType VARCHAR(10)  
)ENGINE=InnoDb;


CREATE TABLE SECRETARY (
    SecretaryId INT PRIMARY KEY,
    Section VARCHAR(20),
    JobTitle VARCHAR(20),
    FOREIGN KEY (SecretaryId) REFERENCES USER(UserId)
)ENGINE=InnoDb;
    

CREATE TABLE DOCTOR (
    DoctorId INT PRIMARY KEY,
    Section VARCHAR(20),
    FOREIGN KEY (DoctorId) REFERENCES USER(UserId)
)ENGINE=InnoDb;


CREATE TABLE SPECIALITY (
    DoctorId INT PRIMARY KEY,
    Speciality VARCHAR(20)
)ENGINE=InnoDb;


CREATE TABLE ALERTS (
    SenderId INT,
    ReceiverId INT,
    DateA Date,
    TimeA Time,
    Description VARCHAR(60),
    PRIMARY KEY (SenderId, ReceiverId, DateA, TimeA),
    FOREIGN KEY (SenderId) REFERENCES USER(UserId),
    FOREIGN KEY (SenderId) REFERENCES USER(UserId)
)ENGINE=InnoDb;
    

CREATE TABLE PATIENT (
    PatientId INT PRIMARY KEY, 
    FName VARCHAR(30), 
    LName VARCHAR(30),  
    Adress VARCHAR(90), 
    PhoneNumber VARCHAR(10), 
    PreferedDoctor INT, 
    PatientType VARCHAR(10),
    FOREIGN KEY (PreferedDoctor) REFERENCES DOCTOR(DoctorId)
)ENGINE=InnoDb;


CREATE TABLE PATIENTFILE (
    PatientId INT,
    DoctorId INT, 
    DateOfVisit Date,
    LenghtOfVisit INT,
    TypeOfVisit VARCHAR(20),
    Description VARCHAR(60),
    DoctorNotes VARCHAR(60),
    PRIMARY KEY (PatientId, DoctorId, DateOfVisit),
    FOREIGN KEY (PatientId) REFERENCES PATIENT(PatientId),
    FOREIGN KEY (DoctorId) REFERENCES DOCTOR(DoctorId)
)ENGINE=InnoDb;
    

CREATE TABLE MEALPLAN (
    MealId INT PRIMARY KEY,
    Type VARCHAR(20),
    Sunday VARCHAR(20),
    Monday VARCHAR(20),
    Tuesday VARCHAR(20),
    Wednesday VARCHAR(20),
    Thursday VARCHAR(20),
    Friday VARCHAR(20),
    Saturday VARCHAR(20)
)ENGINE=InnoDb;


CREATE TABLE LONGTERMPATIENT (
    PatientId INT PRIMARY KEY,
    MealId INT,
    FOREIGN KEY (PatientId) REFERENCES PATIENT(PatientId),
    FOREIGN KEY (MealId) REFERENCES MEALPLAN(MealId)
)ENGINE=InnoDb;
    

CREATE TABLE ROOM (
    RoomId INT PRIMARY KEY,
    NumberR INT, 
    Floor INT,
    Section VARCHAR(20),
    RoomType VARCHAR(30)
)ENGINE=InnoDb;


CREATE TABLE BEDROOM (
    RoomId INT PRIMARY KEY,
    NumberOfBed INT,
    FOREIGN KEY (RoomId) REFERENCES ROOM(RoomId)
)ENGINE=InnoDb;


CREATE TABLE SCHEDULE (
    Sid INT PRIMARY KEY,
    RoomId INT,
    PatientId INT,
    DoctorId INT,
    DateS Date,
    BeginTime Time,
    EndTime Time,
    FOREIGN KEY (RoomId) REFERENCES ROOM(RoomId),
    FOREIGN KEY (PatientId) REFERENCES PATIENT(PatientId),
    FOREIGN KEY (DoctorId) REFERENCES DOCTOR(DoctorId)
)ENGINE=InnoDb;


CREATE TABLE RENTAL (
    RentalId INT PRIMARY KEY,
    Name VARCHAR(30)
)ENGINE=InnoDb;


CREATE TABLE BOOK (
    RentalId INT PRIMARY KEY,
    Author VARCHAR(20),
    FOREIGN KEY (RentalId) REFERENCES RENTAL(RentalId)
)ENGINE=InnoDb;

CREATE TABLE DVD (
    RentalId INT PRIMARY KEY,
    Director VARCHAR(20),
    Duration INT,
    FOREIGN KEY (RentalId) REFERENCES RENTAL(RentalId)
)ENGINE=InnoDb;


CREATE TABLE RENT (
    RentalId INT,
    LongTermID INT,
    BeginDate Date,
    EndDate Date,
    PRIMARY KEY (RentalId, LongTermId, BeginDate),
    FOREIGN KEY (RentalId) REFERENCES RENTAL(RentalId),
    FOREIGN KEY (LongTermId) REFERENCES LONGTERMPATIENT(PatientId)
)ENGINE=InnoDb;


CREATE TABLE STAY (
    PatientId INT,
    BedRoomId INT,
    BeginDate Date,
    EndDate Date,
    PRIMARY KEY (PatientId, BedRoomId, BeginDate),
    FOREIGN KEY (PatientId) REFERENCES LONGTERMPATIENT(PatientId),
    FOREIGN KEY (BedRoomId) REFERENCES BEDROOM(RoomId)
)ENGINE=InnoDb;


/** INSERT VALUE **/

/*MEAL PLAN*/
INSERT INTO MEALPLAN
    VALUES (1, 'salt free', 'Chicken', 'Beef', 'Beef', 'Beef', 'Chicken', 'Beef', 'CHicken');
INSERT INTO MEALPLAN
    VALUES (2, 'sugar', 'Beef', 'Beef', 'Beef', 'Beef', 'Beef', 'Beef', 'Beef');
INSERT INTO MEALPLAN
    VALUES (3, 'salt and sugar free', 'Chicken', 'chicken', 'chicken', 'chicken', 'Chicken', 'chicken', 'CHicken');

/*SECRETARY*/
INSERT INTO USER 
    VALUES (1,'Audrey','Dupont','pass','4th AVE NE','5037078788','SECRETARY');
INSERT INTO SECRETARY
    VALUES (1,'Nursery', 'chief');

/*DOCTOR*/
INSERT INTO USER 
    VALUES (2,'Mike','Kim','pass','7878 98th AVE NE','5037078788','DOCTOR');
INSERT INTO DOCTOR
    VALUES (2,'Block');

INSERT INTO USER 
    VALUES (4,'Diane','Depardon','pass','7878 98th AVE NE','5037078788','DOCTOR');
INSERT INTO DOCTOR
    VALUES (4,'Surgeon');

INSERT INTO USER 
    VALUES (5,'Hannah','Creeper','pass','7878 98th AVE NE','5037078788','DOCTOR');
INSERT INTO DOCTOR
    VALUES (5,'Anesthesiologist');

/*PATIENT*/
INSERT INTO USER 
    VALUES (3,'Pierre','Vaidie','pass','Cacscade Hall','5037078788','PATIENT');
INSERT INTO PATIENT
    VALUES (3,'Pierre','Vaidie','Cacscade Hall','5037078788', 2,'LONGTERM');
INSERT INTO LONGTERMPATIENT
    VALUES (3, 1);

/*RENTAL*/
INSERT INTO RENTAL
    VALUES (1,'The Sisters Brothers');
INSERT INTO RENTAL
    VALUES (2,'1Q84 ');
INSERT INTO RENTAL
    VALUES (3,'The Art of Fielding: A Novel');
INSERT INTO RENTAL
    VALUES (4,'The Help');
INSERT INTO RENTAL
    VALUES (5,'The Kings Speech');

/*BOOK*/
INSERT INTO BOOK
    VALUES (1,'Patrick Dewitt');
INSERT INTO BOOK
    VALUES (2,'Haruki Murakami');
INSERT INTO BOOK
    VALUES (3,'Chad Harbach');

/*DVD*/
INSERT INTO DVD
    VALUES (4,'Jessica Chastain', 137);
INSERT INTO DVD
    VALUES (5,'Tom Hooper', 119);


/*RENT*/
INSERT INTO RENT
    VALUES (5,3,'2011-12-01','2011-12-23');

/*ALERT*/
INSERT INTO ALERTS
    VALUES (1,2,CURDATE(),CURTIME(),'Are you free tomorrow at 6pm ?');

/*PATIENTFILE*/
INSERT INTO PATIENTFILE
    VALUES (3,4,CURDATE(),60,'Operation', 'Operation of the heart','All is good');