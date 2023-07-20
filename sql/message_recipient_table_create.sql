CREATE TABLE Message_Recipient_t (
  MessageRecipientID INT(9) NOT NULL Auto_Increment,
  MessageID INT(9) NOT NULL,
  RecipientID INT(9) NOT NULL,
  IsRead INT(1) NOT NULL DEFAULT 0,
  IsDeleted INT(1) NOT NULL DEFAULT 0,
  CONSTRAINT Message_Recipient_t_PK PRIMARY KEY (MessageRecipientID),
  CONSTRAINT Message_Recipient_t_FK1 FOREIGN KEY (MessageID) REFERENCES Messages_t(MessageID),
  CONSTRAINT Message_Recipient_t_FK2 FOREIGN KEY (RecipientID) REFERENCES Auth_t(UserID)
) Auto_Increment = 1;