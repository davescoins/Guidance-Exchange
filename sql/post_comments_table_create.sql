CREATE TABLE post_comments (
  post_comment_id INT(9) NOT NULL Auto_Increment,
  comment_text LONGTEXT,
  post_id INT(9),
  CONSTRAINT post_comments_PK PRIMARY KEY (post_comment_id),
  CONSTRAINT community_data_info_t_FK FOREIGN KEY (post_id) REFERENCES community_data_info(post_id)
) Auto_Increment = 1;