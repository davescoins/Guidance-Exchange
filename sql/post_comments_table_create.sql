CREATE TABLE post_comments (
  post_comment_id INT(9) NOT NULL Auto_Increment,
  comment_text LONGTEXT,
  post_id INT(9),
  UserID INT(9),
  CONSTRAINT post_comments_PK PRIMARY KEY (post_comment_id),
  CONSTRAINT post_comments_FK1 FOREIGN KEY (post_id) REFERENCES community_data_info(post_id),
  CONSTRAINT post_comments_FK2 FOREIGN KEY (UserID) REFERENCES Auth_t(UserID)
) Auto_Increment = 1;