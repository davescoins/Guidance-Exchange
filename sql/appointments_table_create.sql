CREATE TABLE Appointments_t (
  AppointmentID INT(9) NOT NULL Auto_Increment,
  MentorID INT(9) NOT NULL,
  SchedulerID INT(9),
  AppointmentTime DATETIME,
  CONSTRAINT Appointments_PK PRIMARY KEY (AppointmentID),
  CONSTRAINT Appointments_FK1 FOREIGN KEY (MentorID) REFERENCES UserData_t(UserID),
  CONSTRAINT Appointments_FK2 FOREIGN KEY (SchedulerID) REFERENCES UserData_t(UserID)
) Auto_Increment = 1;