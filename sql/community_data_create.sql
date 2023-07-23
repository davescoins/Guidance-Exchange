CREATE TABLE community_data (
  community_id INT(11) NOT NULL Auto_Increment,
  community_name VARCHAR(255),
  community_desc VARCHAR(255),
  active_flg tinyint(1),
  CONSTRAINT community_data_PK PRIMARY KEY (community_id)
) Auto_Increment = 1;