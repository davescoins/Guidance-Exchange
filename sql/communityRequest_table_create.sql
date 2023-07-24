CREATE TABLE CommunityRequests_t (
  CommunityRequestID INT(9) NOT NULL Auto_Increment,
  CommunityID INT(11) NOT NULL,
  UserID INT(9) NOT NULL,
  CommunityName VARCHAR(255),
  CommunityDescription LONGTEXT,
  CommunityPicture VARCHAR(255),
  CONSTRAINT CommunityRequests_t_PK PRIMARY KEY (CommunityRequestID),
  CONSTRAINT CommunityRequests_t_FK1 FOREIGN KEY (UserID) REFERENCES Auth_t(UserID),
  CONSTRAINT CommunityRequests_t_FK2 FOREIGN KEY (CommunityID) REFERENCES community_data(community_id)
) Auto_Increment = 1;