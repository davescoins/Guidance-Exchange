CREATE TABLE Qualifications_t (
  QualificationID INT(9) NOT NULL Auto_Increment,
  UserID INT(9) NOT NULL,
  SkillID INT(9) NOT NULL,
  CONSTRAINT Qualifications_t_PK PRIMARY KEY (QualificationID),
  CONSTRAINT Qualifications_t_FK1 FOREIGN KEY (UserID) REFERENCES Auth_t(UserID),
  CONSTRAINT Qualifications_t_FK2 FOREIGN KEY (SkillID) REFERENCES Skills_t(SkillID)
) Auto_Increment = 1;