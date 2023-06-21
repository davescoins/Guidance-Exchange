CREATE TABLE Auth_t (
  UserID INT(9) NOT NULL Auto_Increment,
  username VARCHAR(100),
  password VARCHAR(100),
  email VARCHAR(255),
  phone_number VARCHAR(255),
  CONSTRAINT Auth_t_PK PRIMARY KEY (UserID)
) Auto_Increment = 1;

CREATE TABLE UserData_t (
  UserID INT(9) NOT NULL,
  FirstName VARCHAR(255) NOT NULL,
  LastName VARCHAR(255) NOT NULL,
  ProfilePicture VARCHAR(255),
  ProfilePictureBorder VARCHAR(255),
  ProfilePictureBackground VARCHAR(255),
  MentorStatus BOOL NOT NULL,
  Rating INT(1),
  LocationCity VARCHAR(255),
  LocationState VARCHAR(255),
  Facebook VARCHAR(255),
  Twitter VARCHAR(255),
  Instagram VARCHAR(255),
  LinkedIn VARCHAR(255),
  Mentoring LONGTEXT,
  AboutMe LONGTEXT,
  WorkTitle VARCHAR(255),
  WorkLocation VARCHAR(255),
  WorkStartDate DATE,
  WorkEndDate DATE,
  WorkDescription LONGTEXT,
  EducationDegree VARCHAR(255),
  EducationLocation VARCHAR(255),
  EducationStartDate DATE,
  EducationEndDate DATE,
  EducationDescription LONGTEXT,
  Associations VARCHAR(255),
  CONSTRAINT UserData_t_PK PRIMARY KEY (UserID),
  CONSTRAINT UserData_t_FK1 FOREIGN KEY (UserID) REFERENCES Auth_t(UserID)
) Auto_Increment = 1;

CREATE TABLE Appointments_t (
  AppointmentID INT(9) NOT NULL Auto_Increment,
  MentorID INT(9) NOT NULL,
  SchedulerID INT(9),
  AppointmentTime DATETIME,
  CONSTRAINT Appointments_t_PK PRIMARY KEY (AppointmentID),
  CONSTRAINT Appointments_t_FK1 FOREIGN KEY (MentorID) REFERENCES Auth_t(UserID),
  CONSTRAINT Appointments_t_FK2 FOREIGN KEY (SchedulerID) REFERENCES Auth_t(UserID)
) Auto_Increment = 1;

CREATE TABLE Skills_t (
  SkillID INT(9) NOT NULL Auto_Increment,
  SkillName VARCHAR(255),
  SkillGroup VARCHAR(255),
  CONSTRAINT Skills_t_PK PRIMARY KEY (SkillID)
) Auto_Increment = 1;

CREATE TABLE Qualifications_t (
  UserID INT(9) NOT NULL,
  SkillID INT(9) NOT NULL,
  CONSTRAINT Qualifications_t_FK1 FOREIGN KEY (UserID) REFERENCES Auth_t(UserID),
  CONSTRAINT Qualifications_t_FK2 FOREIGN KEY (SkillID) REFERENCES Skills_t(SkillID)
);

INSERT INTO
  Auth_t (
    `username`,
    `password`,
    `email`,
    `phone_number`
  )
VALUES
  (
    'david.anderson',
    '12345',
    'david.anderson@gmail.com',
    '(123) 456-7890'
  ),
  (
    'benjamin.park',
    '12345',
    'benjamin.park@gmail.com',
    '(123) 456-7890'
  ),
  (
    'harper.brown',
    '12345',
    'harper.brown@gmail.com',
    '(123) 456-7890'
  ),
  (
    'lucas.khan',
    '12345',
    'lucas.khan@gmail.com',
    '(123) 456-7890'
  ),
  (
    'mia.wilson',
    '12345',
    'mia.wilson@gmail.com',
    '(123) 456-7890'
  );

INSERT INTO
  UserData_t (
    `UserID`,
    `FirstName`,
    `LastName`,
    `ProfilePicture`,
    `ProfilePictureBorder`,
    `ProfilePictureBackground`,
    `MentorStatus`,
    `Rating`,
    `LocationCity`,
    `LocationState`,
    `Facebook`,
    `Instagram`,
    `Twitter`,
    `LinkedIn`,
    `Mentoring`,
    `AboutMe`,
    `WorkTitle`,
    `WorkLocation`,
    `WorkStartDate`,
    `WorkEndDate`,
    `WorkDescription`,
    `EducationDegree`,
    `EducationLocation`,
    `EducationStartDate`,
    `EducationEndDate`,
    `EducationDescription`,
    `Associations`
  )
VALUES
  (
    1,
    'David',
    'Anderson',
    'david-anderson.png',
    '#008a0e',
    'biotech-pattern.png',
    1,
    4,
    'Boston',
    'Massachusetts',
    'david.anderson',
    'david.anderson',
    'david.anderson',
    'david.anderson',
    'David Anderson, an accomplished chemist with a passion for nurturing talent, is offering invaluable mentoring opportunities to aspiring chemists. Recognizing the importance of guidance and support in one\'s scientific journey, David is eager to share his knowledge and experiences with enthusiastic individuals looking to make their mark in the field. Through personalized mentoring sessions, he provides guidance on career paths, research methodologies, laboratory techniques, and scientific writing. David\'s patient and approachable nature fosters a supportive environment where mentees can gain practical insights, develop their skills, and embark on a successful career in chemistry with confidence.',
    'Introducing David, a talented and dedicated chemist with a profound passion for unraveling the mysteries of matter. With a strong educational background and years of hands-on experience in the field, he thrives in the laboratory, meticulously conducting experiments and analyzing chemical reactions. David\'s relentless pursuit of scientific discovery and his expertise in analytical techniques make him a valuable asset in advancing our understanding of the world at the molecular level.',
    'Research Chemist',
    'DEF Chemicals',
    '2018-03-23',
    null,
    'David actively contributes to the development of novel pharmaceutical compounds, conducting in-depth research, and performing experiments to assess their efficacy and safety. He collaborates with interdisciplinary teams to optimize formulations and improve manufacturing processes. David also plays a key role in analyzing data, preparing technical reports, and presenting findings to stakeholders.',
    'Ph.D. in Chemistry',
    'Massachussetts Institute of Technology',
    '2015-08-24',
    '2018-05-10',
    'David pursued his doctoral studies in Chemistry, specializing in a specific field such as organic chemistry, inorganic chemistry, or physical chemistry. He conducted in-depth research, published scientific papers, and presented his findings at conferences. His Ph.D. research focused on advancing knowledge in a specific area of chemistry, demonstrating his expertise and dedication to the field.',
    '2;3;4;5'
  ),
  (
    2,
    'Benjamin',
    'Park',
    'benjamin-park.png',
    '#008a0e',
    'biotech-pattern.png',
    0,
    null,
    null,
    null,
    null,
    null,
    null,
    null,
    null,
    null,
    null,
    null,
    null,
    null,
    null,
    null,
    null,
    null,
    null,
    null,
    null
  ),
  (
    3,
    'Harper',
    'Brown',
    'harper-brown.png',
    '#008a0e',
    'biotech-pattern.png',
    0,
    null,
    null,
    null,
    null,
    null,
    null,
    null,
    null,
    null,
    null,
    null,
    null,
    null,
    null,
    null,
    null,
    null,
    null,
    null,
    null
  ),
  (
    4,
    'Lucas',
    'Khan',
    'lucas-khan.png',
    '#008a0e',
    'biotech-pattern.png',
    0,
    null,
    null,
    null,
    null,
    null,
    null,
    null,
    null,
    null,
    null,
    null,
    null,
    null,
    null,
    null,
    null,
    null,
    null,
    null,
    null
  ),
  (
    5,
    'Mia',
    'Wilson',
    'mia-wilson.png',
    '#008a0e',
    'biotech-pattern.png',
    0,
    null,
    null,
    null,
    null,
    null,
    null,
    null,
    null,
    null,
    null,
    null,
    null,
    null,
    null,
    null,
    null,
    null,
    null,
    null,
    null
  );

INSERT INTO
  Appointments_t (`MentorID`, `SchedulerID`, `AppointmentTime`)
VALUES
  (1, null, "2023-07-01 09:00"),
  (1, 2, "2023-07-01 13:30"),
  (1, 4, "2023-07-02 09:00"),
  (1, null, "2023-07-03 09:30"),
  (1, 2, "2023-07-04 10:30"),
  (1, null, "2023-07-05 10:00"),
  (1, 5, "2023-07-06 10:30"),
  (1, null, "2023-07-06 11:00"),
  (1, 5, "2023-07-07 13:30"),
  (1, 2, "2023-07-08 11:00"),
  (1, null, "2023-07-09 11:30"),
  (1, 3, "2023-07-10 15:00"),
  (1, 4, "2023-07-11 12:00"),
  (1, null, "2023-07-11 16:30"),
  (1, null, "2023-07-13 12:30"),
  (1, 2, "2023-07-13 18:00"),
  (1, null, "2023-07-14 13:00"),
  (1, 5, "2023-07-15 19:30"),
  (1, 3, "2023-07-16 13:30"),
  (1, 4, "2023-07-18 09:00"),
  (1, 5, "2023-07-18 14:00"),
  (1, null, "2023-07-19 14:30"),
  (1, null, "2023-07-20 10:30"),
  (1, 3, "2023-07-21 12:00"),
  (1, null, "2023-07-21 15:00"),
  (1, 5, "2023-07-23 13:30"),
  (1, null, "2023-07-23 15:30"),
  (1, 2, "2023-07-24 15:00"),
  (1, 4, "2023-07-24 16:00"),
  (1, 4, "2023-07-26 15:30"),
  (1, null, "2023-07-26 16:30"),
  (1, null, "2023-07-28 17:00"),
  (1, 3, "2023-07-28 18:00"),
  (1, null, "2023-07-29 19:30"),
  (1, null, "2023-07-29 17:30"),
  (1, 2, "2023-07-30 09:00"),
  (1, null, "2023-07-30 10:30"),
  (1, 5, "2023-07-30 12:00"),
  (1, 3, "2023-07-30 13:30"),
  (1, 3, "2023-07-30 18:00"),
  (1, null, "2023-07-30 18:30");

INSERT INTO
  Skills_t (`SkillName`, `SkillGroup`)
VALUES
  ('HTML', 'Web Development'),
  ('CSS', 'Web Development'),
  ('JavaScript', 'Web Development'),
  (
    'Leadership',
    'Entrepreneurial Skills'
  ),
  (
    'Decision-Making',
    'Entrepreneurial Skills'
  ),
  ('Finance', 'Entrepreneurial Skills'),
  (
    'Chemical Analysis',
    'Laboratory Science'
  ),
  (
    'Organic Synthesis',
    'Laboratory Science'
  ),
  ('Spectroscopy', 'Laboratory Science'),
  (
    'Chromatography',
    'Laboratory Science'
  ),
  (
    'Lab Techniques',
    'Laboratory Science'
  ),
  ('Data Analysis', 'Laboratory Science');

INSERT INTO
  Qualifications_t (`UserID`, `SkillID`)
VALUES
  (1, 7),
  (1, 8),
  (1, 9),
  (1, 10),
  (1, 11),
  (1, 12);