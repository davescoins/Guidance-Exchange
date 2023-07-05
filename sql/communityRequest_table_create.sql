CREATE TABLE CommunityRequests_t (
  CommunityRequestID INT(9) NOT NULL Auto_Increment,
  UserID INT(9) NOT NULL,
  CommunityName VARCHAR(255),
  CommunityDescription LONGTEXT,
  CommunityPicture VARCHAR(255),
  CONSTRAINT CommunityRequests_t_PK PRIMARY KEY (CommunityRequestID),
  CONSTRAINT CommunityRequests_t_FK FOREIGN KEY (UserID) REFERENCES Auth_t(UserID)
) Auto_Increment = 1;