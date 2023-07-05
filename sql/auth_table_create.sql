CREATE TABLE Auth_t (
  UserID INT(9) NOT NULL Auto_Increment,
  username VARCHAR(100),
  password VARCHAR(100),
  email VARCHAR(255),
  phone_number VARCHAR(255),
  MentorStatus BOOL NOT NULL,
  ModeratorStatus BOOL NOT NULL,
  SystemAdministratorStatus BOOL NOT NULL,
  CONSTRAINT Auth_t_PK PRIMARY KEY (UserID)
) Auto_Increment = 1;