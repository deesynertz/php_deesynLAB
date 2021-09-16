/*CREATE DATABASE _database_name;*/

-- USE _database_name;

CREATE TABLE tblcontact (
  cont_ID int(255) NOT NULL AUTO_INCREMENT,
  name varchar(20) NOT NULL,
  email varchar(20) NOT NULL,
  subject varchar(20) NOT NULL,
  sms varchar(900) NOT NULL,
  sent_date timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  reply_date timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
	
	PRIMARY KEY (cont_ID)
);


CREATE TABLE `tblusertype` (
  `typeID` int(1) NOT NULL AUTO_INCREMENT,
  `typename` varchar(10) NOT NULL,
	
	PRIMARY KEY (typeID)
	
);


CREATE TABLE tblcourse (
  ID int(255) NOT NULL AUTO_INCREMENT,
  course_code varchar(20) NOT NULL,
  coursename varchar(255) NOT NULL,
	
	PRIMARY KEY (ID)
);

CREATE TABLE `tblskills` (
  `skill_ID` int(100) NOT NULL AUTO_INCREMENT,
  `skill_name` varchar(255) NOT NULL,
	
	PRIMARY KEY (skill_ID)
);

CREATE TABLE `tblprofesional` (
  `prof_ID` int(100) NOT NULL AUTO_INCREMENT,
  `prof_name` varchar(255) NOT NULL,
	
	PRIMARY KEY (prof_ID)
);


CREATE TABLE tbluser(
  regnumber varchar(13) NOT NULL,
  fname varchar(20) NOT NULL,
  email varchar(255) NOT NULL,
  username varchar(255) NOT NULL,
  password varchar(255) NOT NULL,
  image varchar(255) DEFAULT NULL,
  `typeID` int(1) NOT NULL,
  parmision_status int(1) NOT NULL DEFAULT '0',
  location varchar(100) NOT NULL,
  regdate date NOT NULL,
	
  PRIMARY KEY (regnumber),
  CONSTRAINT tbl_user_typeid_id FOREIGN KEY(typeID) REFERENCES tblusertype(typeID)ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE `tbllogin_detail` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `user_ID` varchar(13) NOT NULL,
  `last_activity` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `is_type` enum('no','yes') NOT NULL,
	
	PRIMARY KEY (ID),
	CONSTRAINT tbl_user_login_detail_regno FOREIGN KEY (user_ID) REFERENCES tbluser(regnumber) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE `tbleducation` (
  `ed_ID` int(255) NOT NULL AUTO_INCREMENT,
  `regnumber` varchar(13) NOT NULL,
  `ed_description` varchar(100) NOT NULL,
	
	PRIMARY KEY(ed_ID,regnumber,ed_description),
	
	CONSTRAINT tbl_user_education_regno FOREIGN KEY (regnumber) REFERENCES tbluser(regnumber)ON DELETE CASCADE ON UPDATE CASCADE
);


CREATE TABLE tblchat_message(
  chat_ID int(255) NOT NULL AUTO_INCREMENT,
  to_user_ID varchar(13)  NOT NULL,
  from_user_ID varchar(13)  NOT NULL,
  chat_sms varchar(900) NOT NULL,
  status int(11) NOT NULL,
  last_time timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	
	PRIMARY KEY (chat_ID),
	CONSTRAINT tbl_user_message_to FOREIGN KEY (to_user_ID) REFERENCES tbluser(regnumber)ON DELETE CASCADE ON UPDATE CASCADE,
	CONSTRAINT tbl_user_message_from FOREIGN KEY (from_user_ID) REFERENCES tbluser(regnumber) ON DELETE CASCADE ON UPDATE CASCADE
);




CREATE TABLE `tblfile` (
  `fileID` int(20) NOT NULL AUTO_INCREMENT,
  `filename` varchar(20) NOT NULL,
  `dateUp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `regnumber` varchar(13) NOT NULL,
  `ID` int(255) NOT NULL,
  `read_in` int(1) NOT NULL DEFAULT '1',
	
	PRIMARY KEY (fileID),
	CONSTRAINT tbl_course_user_regno FOREIGN KEY (regnumber) REFERENCES tbluser(regnumber) ON DELETE CASCADE ON UPDATE CASCADE,
	CONSTRAINT tbl_course_file_id FOREIGN KEY (ID) REFERENCES tblcourse(ID) ON DELETE CASCADE ON UPDATE CASCADE
);



CREATE TABLE `tblskills_user` (
   ID int(100) NOT NULL AUTO_INCREMENT,
  `skill_ID` int(100) NOT NULL,
  `regnumber` varchar(13) NOT NULL,
	
	PRIMARY KEY (ID,skill_ID,regnumber),
	CONSTRAINT tbl_user_skills_skill_ID FOREIGN KEY (skill_ID) REFERENCES tblskills(skill_ID) ON DELETE CASCADE ON UPDATE CASCADE,
	CONSTRAINT tbl_user_skills_user_regno FOREIGN KEY (regnumber) REFERENCES tbluser(regnumber) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE `tblpro_user` (
   ID int(100) NOT NULL AUTO_INCREMENT,
  `prof_ID` int(100) NOT NULL,
  `regnumber` varchar(13) NOT NULL,
	
	PRIMARY KEY (ID,prof_ID,regnumber),
	CONSTRAINT tbl_profesional_pro_user_ID FOREIGN KEY (prof_ID) REFERENCES tblprofesional(prof_ID) ON DELETE CASCADE ON UPDATE CASCADE,
	CONSTRAINT tbl_user_pro_user_regno FOREIGN KEY (regnumber) REFERENCES tbluser(regnumber) ON DELETE CASCADE ON UPDATE CASCADE	
);


CREATE TABLE tblcustomer(
    cust_ID int NOT NULL AUTO_INCREMENT,
    cust_fname varchar(40) NOT NULL,
    address varchar(40) NOT NULL,
    comp_name varchar(40),
    
     PRIMARY KEY(cust_ID)
);


CREATE TABLE tbladvatsment(
    adv_ID int NOT NULL AUTO_INCREMENT,
    cust_ID int NOT NULL,
    big_img varchar(40) NOT NULL,
    small_img varchar(40) NOT NULL,
    pammison int NOT NULL DEFAULT '0',
    p_date timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    admin_id varchar(13) NOT NULL,
                          
    PRIMARY KEY(adv_ID,cust_ID),
    CONSTRAINT tblcustomer_advatsment_cust_ID FOREIGN KEY(cust_ID) REFERENCES tblcustomer(cust_ID) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT tbluser_advatsment_admin_id FOREIGN KEY(admin_id) REFERENCES tbluser(regnumber) ON DELETE CASCADE ON UPDATE CASCADE
);


CREATE TABLE tblfollow(
    follow_ID int NOT NULL AUTO_INCREMENT,
    sender_id varchar(13) NOT NULL,
    receiver_id varchar(13) NOT NULL,
                          
    PRIMARY KEY(follow_ID),
    CONSTRAINT tbluser_follow_sender_id FOREIGN KEY(sender_id) REFERENCES tbluser(regnumber) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT tbluser_follow_receiver_id FOREIGN KEY(receiver_id) REFERENCES tbluser(regnumber) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE tbluser_file(
    userfile_ID int NOT NULL AUTO_INCREMENT,
    fileID int(255) NOT NULL,
    regnumber varchar(13) NOT NULL,
    read_in int(1) NOT NULL,
                          
    PRIMARY KEY(userfile_ID,fileID,regnumber),
    CONSTRAINT tbluser_user_file_fileID FOREIGN KEY(fileID) REFERENCES tblfile(fileID) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT tbluser_user_file_regnumber FOREIGN KEY(regnumber) REFERENCES tbluser(regnumber) ON DELETE CASCADE ON UPDATE CASCADE
);



INSERT INTO `tblusertype` (`typeID`, `typename`) VALUES
(1, 'admin'),
(2, 'user');



INSERT INTO `tblprofesional` (`prof_ID`, `prof_name`) VALUES
(1, 'Founder & C.E.O'),
(2, 'Chief Manager'),
(3, 'Human Resource(HR)'),
(4, 'Marketing Officer');


INSERT INTO `tblskills` (`skill_ID`, `skill_name`) VALUES
(1, 'UI Designer'),
(2, 'DB Designer'),
(3, 'Graphics  Designer'),
(4, 'Security Designer'),
(5, 'Network Designer'),
(6, 'Programing(coding)');



INSERT INTO `tbluser` (`regnumber`, `fname`, `email`, `username`, `password`, `image`, `typeID`, `parmision_status`, `location`, `regdate`) VALUES
('12301267/T.18', 'Alison Deogratias', 'alison@gmail.com', 'alison', '123456', 'default.jpg', 1, 0, '', '0000-00-00'),
('13201589/T.18', 'Kelvin Harrison', 'deogbar@gmail.com', 'kelvin', '12345', 'default.jpg', 1, 0, '', '0000-00-00'),
('13301179/T.18', 'Joshua E Thabiti', 'josh@gmail.com', 'josh', 'josh4', 'default.jpg', 1, 1, '', '0000-00-00'),
('13301228/T.18', 'Faith J kiluwi', 'faith@gmail.com', 'faye', '12345', '12345', 1, 0, '', '0000-00-00'),
('13301250/T.18', 'Annah A Kweka', 'annah@gmail.com', 'annah', '12345', 'default.jpg', 1, 0, '', '0000-00-00'),
('13301284/T.18', 'Deogratias Alison', 'deesynertz@gmail.com', 'Admin', '12345', 'deo.jpg', 0, 1, 'P.o.Box 01, Mzumbe,Morogoro, Tanzania', '2019-02-28');


INSERT INTO `tblcourse` (`ID`, `course_code`, `coursename`) VALUES
(1, 'CSS 111', 'INTRODUCTION TO COMPUTER STYSTEM'),
(2, 'CSS 114', 'DATABASE MANAGEMENT '),
(3, 'ICT 112', 'HIGH LEVEL PROGRAMMING C#'),
(4, 'CSS 119', 'ELEMENTARY STATISTIC'),
(5, 'COM 101', 'COMMUNICATION SKILLS'),
(6, 'DST 100', 'DEVELOPMENT STUDIES');


INSERT INTO `tbleducation` (`ed_ID`, `regnumber`, `ed_description`) VALUES
(1, '13301284/T.18', 'Diploma in Information and Technology'),
(2, '13301284/T.18', 'BSc. in Information Technology and System');


