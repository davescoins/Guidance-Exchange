CREATE TABLE post_comments (
  post_comment_id INT(9) NOT NULL Auto_Increment,
  comment_text LONGTEXT,
  post_id INT(9),
  CONSTRAINT post_comments_PK PRIMARY KEY (post_comment_id)
) Auto_Increment = 1;