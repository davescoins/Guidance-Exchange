CREATE TABLE Appointments_t (
  AppointmentID INT(9) NOT NULL Auto_Increment,
  MentorID INT(9) NOT NULL,
  SchedulerID INT(9),
  AppointmentTime DATETIME,
  CONSTRAINT Appointments_t_PK PRIMARY KEY (AppointmentID),
  CONSTRAINT Appointments_t_FK1 FOREIGN KEY (MentorID) REFERENCES Auth_t(UserID),
  CONSTRAINT Appointments_t_FK2 FOREIGN KEY (SchedulerID) REFERENCES Auth_t(UserID)
) Auto_Increment = 1;