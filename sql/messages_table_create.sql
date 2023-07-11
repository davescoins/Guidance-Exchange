CREATE TABLE Messages_t (
  MessageID INT(9) NOT NULL Auto_Increment,
  SenderID INT(9) NOT NULL,
  RecipientID INT(9) NOT NULL,
  MessageSubject VARCHAR(255),
  MessageBody LONGTEXT,
  SendDate DATETIME,
  CONSTRAINT Messages_t_PK PRIMARY KEY (MessageID),
  CONSTRAINT Messages_t_FK FOREIGN KEY (SenderID) REFERENCES Auth_t(UserID),
  CONSTRAINT Messages_t_FK FOREIGN KEY (RecipientID) REFERENCES Auth_t(UserID)
) Auto_Increment = 1;