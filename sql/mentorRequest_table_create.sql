CREATE TABLE MentorRequests_t (
  MentorRequestID INT(9) NOT NULL Auto_Increment,
  UserID INT(9) NOT NULL,
  ResumeLocation VARCHAR(255),
  MentorStatement LONGTEXT,
  CONSTRAINT MentorRequests_t_PK PRIMARY KEY (MentorRequestID),
  CONSTRAINT MentorRequests_t_FK FOREIGN KEY (UserID) REFERENCES Auth_t(UserID)
) Auto_Increment = 1;