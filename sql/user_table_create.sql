CREATE TABLE UserData_t (
  UserID INT(9) NOT NULL,
  FirstName VARCHAR(255) NOT NULL,
  LastName VARCHAR(255) NOT NULL,
  ProfilePicture VARCHAR(255),
  ProfilePictureBorder VARCHAR(255),
  ProfilePictureBackground VARCHAR(255),
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
);

ALTER TABLE
  UserData_t
ADD
  FullName VARCHAR(255) AS (CONCAT(FirstName, ' ', LastName)) STORED;