CREATE TABLE community_data_info (
  post_id INT(9) NOT NULL Auto_Increment,
  title VARCHAR(255) NOT NULL,
  content TEXT() NOT NULL,
  active_flg TINYINT(1),
  user_id INT(9),
  community_id INT(11) NOT NULL
) Auto_Increment = 1;