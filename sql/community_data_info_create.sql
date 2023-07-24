CREATE TABLE community_data_info (
  post_id INT(9) NOT NULL Auto_Increment,
  title VARCHAR(255) NOT NULL,
  content TEXT NOT NULL,
  active_flg TINYINT(1),
  user_id INT(9),
  community_id INT(11) NOT NULL,
  CONSTRAINT community_data_info_PK PRIMARY KEY (post_id),
  CONSTRAINT community_data_info_FK FOREIGN KEY (community_id) REFERENCES community_data(community_id)
) Auto_Increment = 1;