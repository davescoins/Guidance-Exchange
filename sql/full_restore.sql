CREATE TABLE Auth_t (
  UserID INT(9) NOT NULL Auto_Increment,
  username VARCHAR(100),
  password VARCHAR(100),
  email VARCHAR(255),
  phone_number VARCHAR(255),
  MentorStatus INT(1) NOT NULL DEFAULT 0,
  ModeratorStatus INT(1) NOT NULL DEFAULT 0,
  SystemAdministratorStatus INT(1) NOT NULL DEFAULT 0,
  CONSTRAINT Auth_t_PK PRIMARY KEY (UserID)
) Auto_Increment = 1;

CREATE TABLE UserData_t (
  UserID INT(9) NOT NULL,
  FirstName VARCHAR(255) NOT NULL,
  LastName VARCHAR(255) NOT NULL,
  ProfilePicture VARCHAR(255),
  ProfilePictureBorder VARCHAR(255),
  ProfilePictureBackground VARCHAR(255),
  Rating INT(1),
  LocationCity VARCHAR(255),
  LocationState VARCHAR(255),
  Facebook VARCHAR(255),
  Twitter VARCHAR(255),
  Instagram VARCHAR(255),
  LinkedIn VARCHAR(255),
  Mentoring LONGTEXT,
  AboutMe LONGTEXT,
  WorkTitle VARCHAR(255),
  WorkLocation VARCHAR(255),
  WorkStartDate DATE,
  WorkEndDate DATE,
  WorkDescription LONGTEXT,
  EducationDegree VARCHAR(255),
  EducationLocation VARCHAR(255),
  EducationStartDate DATE,
  EducationEndDate DATE,
  EducationDescription LONGTEXT,
  Associations VARCHAR(255),
  CONSTRAINT UserData_t_PK PRIMARY KEY (UserID),
  CONSTRAINT UserData_t_FK1 FOREIGN KEY (UserID) REFERENCES Auth_t(UserID)
);

ALTER TABLE
  UserData_t
ADD
  FullName VARCHAR(255) AS (CONCAT(FirstName, ' ', LastName)) STORED;

CREATE TABLE Appointments_t (
  AppointmentID INT(9) NOT NULL Auto_Increment,
  MentorID INT(9) NOT NULL,
  SchedulerID INT(9),
  AppointmentTime DATETIME,
  Missed INT(1) NOT NULL DEFAULT 0,
  Completed INT(1) NOT NULL DEFAULT 0,
  Canceled INT(1) NOT NULL DEFAULT 0,
  CONSTRAINT Appointments_t_PK PRIMARY KEY (AppointmentID),
  CONSTRAINT Appointments_t_FK1 FOREIGN KEY (MentorID) REFERENCES Auth_t(UserID),
  CONSTRAINT Appointments_t_FK2 FOREIGN KEY (SchedulerID) REFERENCES Auth_t(UserID)
) Auto_Increment = 1;

CREATE TABLE MentorRequests_t (
  MentorRequestID INT(9) NOT NULL Auto_Increment,
  UserID INT(9) NOT NULL,
  ResumeLocation VARCHAR(255),
  MentorStatement LONGTEXT,
  CONSTRAINT MentorRequests_t_PK PRIMARY KEY (MentorRequestID),
  CONSTRAINT MentorRequests_t_FK FOREIGN KEY (UserID) REFERENCES Auth_t(UserID)
) Auto_Increment = 1;

CREATE TABLE Messages_t (
  MessageID INT(9) NOT NULL Auto_Increment,
  SenderID INT(9) NOT NULL,
  MessageBody LONGTEXT NOT NULL,
  SendDate DATETIME NOT NULL,
  CONSTRAINT Messages_t_PK PRIMARY KEY (MessageID),
  CONSTRAINT Messages_t_FK1 FOREIGN KEY (SenderID) REFERENCES Auth_t(UserID)
) Auto_Increment = 1;

CREATE TABLE Message_Recipient_t (
  MessageRecipientID INT(9) NOT NULL Auto_Increment,
  MessageID INT(9) NOT NULL,
  RecipientID INT(9) NOT NULL,
  IsRead INT(1) NOT NULL,
  IsDeleted INT(1) NOT NULL DEFAULT 0,
  CONSTRAINT Message_Recipient_t_PK PRIMARY KEY (MessageRecipientID),
  CONSTRAINT Message_Recipient_t_FK1 FOREIGN KEY (MessageID) REFERENCES Messages_t(MessageID),
  CONSTRAINT Message_Recipient_t_FK2 FOREIGN KEY (RecipientID) REFERENCES Auth_t(UserID)
) Auto_Increment = 1;

CREATE TABLE Skills_t (
  SkillID INT(9) NOT NULL Auto_Increment,
  SkillName VARCHAR(255),
  SkillGroup VARCHAR(255),
  CONSTRAINT Skills_t_PK PRIMARY KEY (SkillID)
) Auto_Increment = 1;

CREATE TABLE Qualifications_t (
  QualificationID INT(9) NOT NULL Auto_Increment,
  UserID INT(9) NOT NULL,
  SkillID INT(9) NOT NULL,
  CONSTRAINT Qualifications_t_PK PRIMARY KEY (QualificationID),
  CONSTRAINT Qualifications_t_FK1 FOREIGN KEY (UserID) REFERENCES Auth_t(UserID),
  CONSTRAINT Qualifications_t_FK2 FOREIGN KEY (SkillID) REFERENCES Skills_t(SkillID)
) Auto_Increment = 1;

CREATE TABLE community_data (
  community_id INT(11) NOT NULL Auto_Increment,
  community_name VARCHAR(255),
  community_desc LONGTEXT,
  active_flg tinyint(1),
  CONSTRAINT community_data_PK PRIMARY KEY (community_id)
) Auto_Increment = 1;

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

CREATE TABLE post_comments (
  post_comment_id INT(9) NOT NULL Auto_Increment,
  comment_text LONGTEXT,
  post_id INT(9),
  UserID INT(9),
  CONSTRAINT post_comments_PK PRIMARY KEY (post_comment_id),
  CONSTRAINT post_comments_FK1 FOREIGN KEY (post_id) REFERENCES community_data_info(post_id),
  CONSTRAINT post_comments_FK2 FOREIGN KEY (UserID) REFERENCES Auth_t(UserID)
) Auto_Increment = 1;

INSERT INTO
  Auth_t (
    `username`,
    `password`,
    `email`,
    `phone_number`,
    `MentorStatus`,
    `ModeratorStatus`,
    `SystemAdministratorStatus`
  )
VALUES
  (
    'david.anderson',
    '12345',
    'david.anderson@gmail.com',
    '(123) 456-7890',
    1,
    0,
    0
  ),
  (
    'benjamin.park',
    '12345',
    'benjamin.park@gmail.com',
    '(123) 456-7890',
    1,
    0,
    0
  ),
  (
    'harper.brown',
    '12345',
    'harper.brown@gmail.com',
    '(123) 456-7890',
    0,
    0,
    0
  ),
  (
    'lucas.khan',
    '12345',
    'lucas.khan@gmail.com',
    '(123) 456-7890',
    0,
    0,
    0
  ),
  (
    'mia.wilson',
    '12345',
    'mia.wilson@gmail.com',
    '(123) 456-7890',
    0,
    0,
    0
  ),
  (
    'sophia.lee',
    '12345',
    'sophia.lee@gmail.com',
    '(123) 456-7890',
    0,
    0,
    0
  ),
  (
    'isabella.martinez',
    '12345',
    'isabella.martinez@guidanceexchange.com',
    '(123) 456-7890',
    0,
    1,
    0
  ),
  (
    'andras.arato',
    '12345',
    'harold.pain@hide.com',
    '(123) 456-7890',
    0,
    0,
    1
  );

INSERT INTO
  UserData_t (
    `UserID`,
    `FirstName`,
    `LastName`,
    `ProfilePicture`,
    `ProfilePictureBorder`,
    `ProfilePictureBackground`,
    `Rating`,
    `LocationCity`,
    `LocationState`,
    `Facebook`,
    `Instagram`,
    `Twitter`,
    `LinkedIn`,
    `Mentoring`,
    `AboutMe`,
    `WorkTitle`,
    `WorkLocation`,
    `WorkStartDate`,
    `WorkEndDate`,
    `WorkDescription`,
    `EducationDegree`,
    `EducationLocation`,
    `EducationStartDate`,
    `EducationEndDate`,
    `EducationDescription`,
    `Associations`
  )
VALUES
  (
    1,
    'David',
    'Anderson',
    'david-anderson.png',
    '#008a0e',
    'biotech-pattern.png',
    4,
    'Boston',
    'Massachusetts',
    'david.anderson',
    'david.anderson',
    'david.anderson',
    'david.anderson',
    'David Anderson, an accomplished chemist with a passion for nurturing talent, is offering invaluable mentoring opportunities to aspiring chemists. Recognizing the importance of guidance and support in one\'s scientific journey, David is eager to share his knowledge and experiences with enthusiastic individuals looking to make their mark in the field. Through personalized mentoring sessions, he provides guidance on career paths, research methodologies, laboratory techniques, and scientific writing. David\'s patient and approachable nature fosters a supportive environment where mentees can gain practical insights, develop their skills, and embark on a successful career in chemistry with confidence.',
    'Introducing David, a talented and dedicated chemist with a profound passion for unraveling the mysteries of matter. With a strong educational background and years of hands-on experience in the field, he thrives in the laboratory, meticulously conducting experiments and analyzing chemical reactions. David\'s relentless pursuit of scientific discovery and his expertise in analytical techniques make him a valuable asset in advancing our understanding of the world at the molecular level.',
    'Research Chemist',
    'DEF Chemicals',
    '2018-03-23',
    null,
    'David actively contributes to the development of novel pharmaceutical compounds, conducting in-depth research, and performing experiments to assess their efficacy and safety. He collaborates with interdisciplinary teams to optimize formulations and improve manufacturing processes. David also plays a key role in analyzing data, preparing technical reports, and presenting findings to stakeholders.',
    'Ph.D. in Chemistry',
    'Massachussetts Institute of Technology',
    '2015-08-24',
    '2018-05-10',
    'David pursued his doctoral studies in Chemistry, specializing in a specific field such as organic chemistry, inorganic chemistry, or physical chemistry. He conducted in-depth research, published scientific papers, and presented his findings at conferences. His Ph.D. research focused on advancing knowledge in a specific area of chemistry, demonstrating his expertise and dedication to the field.',
    '2;3;4;5;6'
  ),
  (
    2,
    'Benjamin',
    'Park',
    'benjamin-park.png',
    '#800000',
    'biotech-pattern.png',
    5,
    'Los Angeles',
    'California',
    'benjamin.park',
    'benjamin.park',
    'benjamin.park',
    'benjamin.park',
    'Benjamin\'s passion for the legal profession extends beyond his practice as an attorney. He is also deeply committed to mentoring and sharing his expertise with aspiring lawyers and legal professionals. With his extensive experience in civil litigation, corporate law, and contract negotiations, Benjamin is well-equipped to offer guidance in these areas. His in-depth knowledge of legal research, negotiation strategies, and courtroom advocacy makes him a valuable resource for those seeking mentorship. Whether it\'s providing career advice, offering insights into legal practice, or assisting with specific legal challenges, Benjamin is always eager to lend a helping hand and inspire the next generation of legal minds.',
    'Meet Benjamin, a seasoned and knowledgeable lawyer with a passion for advocating justice and upholding the law. With sharp analytical skills and a persuasive demeanor, he excels in providing expert legal counsel and representation to clients. Benjamin\'s commitment to professionalism, integrity, and client-centered service has earned him a reputation for delivering successful outcomes and building strong relationships in the legal community.',
    'Attorney-at-Law',
    'Thompson & Mitchell Law Associates',
    '2010-09-01',
    null,
    'Benjamin has a proven track record of achieving favorable results for his clients in a wide range of legal matters. He conducts thorough research, prepares persuasive arguments, and navigates complex legal frameworks to build strong cases. Benjamin\'s expertise spans across civil litigation, corporate law, and contract negotiations. His strong negotiation skills and strategic approach contribute to successful settlements and favorable judgments on behalf of his clients.',
    'Juris Doctor (J.D.)',
    'Harvard Law School',
    '2007-08-30',
    '2010-05-27',
    'Benjamin earned his Juris Doctor degree from Harvard Law School, renowned for its rigorous legal education and distinguished faculty. He gained a solid foundation in legal theory, constitutional law, and legal research and writing. During his time at law school, Benjamin actively participated in moot court competitions and served on the editorial board of the law review, further honing his legal skills and cultivating a deep understanding of legal principles. His academic achievements and commitment to excellence laid the groundwork for a successful career in law.',
    '1;4;5;6'
  ),
  (
    3,
    'Harper',
    'Brown',
    'harper-brown.png',
    '#2565c7',
    'biotech-pattern.png',
    null,
    'Seattle',
    'Washington',
    'harper.brown',
    'harper.brown',
    'harper.brown',
    'harper.brown',
    null,
    'Meet Harper, a dedicated and innovative IT professional with a knack for problem-solving. With a deep passion for cutting-edge technologies and a keen eye for detail, she thrives in the dynamic world of IT. Her strong educational background in computer science, combined with her adaptability and creative thinking, enables her to develop impactful solutions that drive business growth.',
    'Data Scientist',
    'Data Analytics Corp.',
    '2019-03-15',
    null,
    'Harper excels in leveraging data to extract valuable insights and optimize business strategies. She collaborates with cross-functional teams to design and implement data-driven models, delivering accurate predictions and recommendations. Her expertise in programming languages such as R and Python allows her to build robust statistical models and conduct in-depth data analysis to drive informed decision-making.',
    'Master of Science in Data Science',
    'Stanford University',
    '2017-09-01',
    '2019-05-31',
    'Harper pursued her graduate studies in Data Science at Stanford University, where she honed her skills in advanced statistical analysis, machine learning, and data visualization. She actively participated in research projects and collaborated with industry partners to solve real-world data challenges. Her strong academic performance and dedication to continuous learning have equipped her with a solid foundation for applying cutting-edge techniques in data-driven decision-making.',
    '1;4;6'
  ),
  (
    4,
    'Lucas',
    'Khan',
    'lucas-khan.png',
    '#9900cc',
    'biotech-pattern.png',
    null,
    'Chicago',
    'Illinois',
    'lucas.khan',
    'lucas.khan',
    'lucas.khan',
    'lucas.khan',
    null,
    'Meet Lucas, a passionate and dedicated high school teacher committed to nurturing students\' intellectual growth and fostering a love for learning. With a warm and engaging teaching style, he creates a supportive classroom environment that encourages students to reach their full potential. Lucas\'s enthusiasm for his subject matter and her ability to connect with students make him an inspiring educator who is deeply invested in their academic and personal development.',
    'High English School Teacher',
    'Lincoln High School',
    '2012-08-20',
    null,
    'Lucas has made a significant impact on his students\' lives through his innovative teaching methods and personalized approach. He develops engaging lesson plans, incorporating multimedia resources and interactive activities to promote student engagement and understanding. Lucas also works closely with colleagues to collaborate on curriculum development and implement effective teaching strategies. His commitment to student success is evident in the improved academic performance and increased motivation of his students.',
    'Bachelor of Arts in English Education',
    'University of Illinois at Urbana-Champaign',
    '2008-08-25',
    '2012-05-12',
    'Lucas completed his undergraduate studies in English Education at the University of Illinois at Urbana-Champaign. He gained a comprehensive understanding of pedagogy, instructional strategies, and educational psychology. Through his coursework and field experiences, Lucas developed the necessary skills to create inclusive and student-centered learning environments. He actively participated in student teaching placements, working with diverse student populations and adapting his instruction to meet their individual needs. Lucas\'s dedication to his profession and his commitment to ongoing professional development contribute to his effectiveness as a high school English teacher.',
    '1;2;3;6'
  ),
  (
    5,
    'Mia',
    'Wilson',
    'mia-wilson.png',
    '#33cc33',
    'biotech-pattern.png',
    null,
    'New York City',
    'New York',
    'mia.wilson',
    'mia.wilson',
    'mia.wilson',
    'mia.wilson',
    null,
    'Meet Mia, a driven and results-oriented stock broker with a passion for financial markets and investment strategies. With a sharp analytical mind and a deep understanding of market trends, she excels in helping clients navigate the complexities of the stock market. Her exceptional communication skills and attention to detail enable her to provide personalized investment advice and deliver excellent service to her clients.',
    'Stock Broker',
    'Capital Investments LLC',
    '2015-06-10',
    null,
    'Mia has successfully guided numerous clients in making sound investment decisions to grow their portfolios. Shee conducts thorough research, analyzes market data, and identifies profitable investment opportunities. Her expertise in risk management and portfolio diversification has helped clients achieve their financial goals and build long-term wealth.',
    'Bachelor of Business Administration in Finance',
    'Wharton School of the University of Pennsylvania',
    '2011-09-05',
    '2015-05-17',
    'Mia completed her undergraduate studies in Finance at the prestigious Wharton School of the University of Pennsylvania. She gained a comprehensive understanding of financial markets, investment principles, and corporate finance. Through internships and extracurricular activities, she developed practical skills in analyzing financial statements, evaluating investment opportunities, and understanding market dynamics. Her academic excellence and involvement in finance-related clubs further enhanced her knowledge and passion for the field.',
    '1;2;6'
  ),
  (
    6,
    'Sophia',
    'Lee',
    'sophia-lee.png',
    '#fa7811',
    'circuits-pattern.png',
    null,
    'Washington',
    'District of Columbia',
    'sophia.lee',
    'sophia.lee',
    'sophia.lee',
    'sophia.lee',
    null,
    'Meet Sophia, a dynamic and talented IT professional with a passion for innovation and problem-solving. With a strong educational background in computer science and a natural curiosity for emerging technologies, she thrives in the fast-paced world of IT. Her dedication, adaptability, and keen eye for detail make her an invaluable asset in developing cutting-edge solutions that propel businesses forward.',
    'Software Engineeer',
    'Innovate Inc.',
    '2020-09-26',
    null,
    'Sophia plays a key role in developing and maintaining scalable software solutions for a diverse range of clients. She collaborates with cross-functional teams to design and implement efficient code, ensuring high-quality deliverables within strict deadlines. Her expertise in programming languages such as Java and Python helps to streamline processes and enhance system performance.',
    'Bachelor of Science in Computer Science',
    'The George Washington University',
    '2016-08-21',
    '2020-05-16',
    'Sophia pursued her undergraduate studies in Computer Science, gaining a solid foundation in programming, algorithms, data structures, and software development. She actively participated in various coding competitions, clubs, and workshops, further refining her technical skills and fostering a passion for innovation.',
    '1;2;3;4;5'
  ),
  (
    7,
    'Isabella',
    'Martinez',
    'isabella-martinez.png',
    '#ef5f9e',
    'abstract-lines-pattern_trans.png',
    null,
    null,
    null,
    null,
    null,
    null,
    null,
    null,
    null,
    null,
    null,
    null,
    null,
    null,
    null,
    null,
    null,
    null,
    null,
    null
  ),
  (
    8,
    'András',
    'Arató',
    'andras-arato.png',
    null,
    'abstract-lines-pattern_trans.png',
    null,
    null,
    null,
    null,
    null,
    null,
    null,
    null,
    null,
    null,
    null,
    null,
    null,
    null,
    null,
    null,
    null,
    null,
    null,
    null
  );

INSERT INTO
  Appointments_t (`MentorID`, `SchedulerID`, `AppointmentTime`)
VALUES
  (1, null, "2023-07-01 09:00"),
  (1, 2, "2023-07-01 13:30"),
  (1, 4, "2023-07-02 09:00"),
  (1, null, "2023-07-03 09:30"),
  (1, 2, "2023-07-04 10:30"),
  (1, null, "2023-07-05 10:00"),
  (1, 5, "2023-07-06 10:30"),
  (1, null, "2023-07-06 11:00"),
  (1, 5, "2023-07-07 13:30"),
  (1, 2, "2023-07-08 11:00"),
  (1, null, "2023-07-09 11:30"),
  (1, 3, "2023-07-10 15:00"),
  (1, 4, "2023-07-11 12:00"),
  (1, null, "2023-07-11 16:30"),
  (1, null, "2023-07-13 12:30"),
  (1, 2, "2023-07-13 18:00"),
  (1, null, "2023-07-14 13:00"),
  (1, 5, "2023-07-15 19:30"),
  (1, 3, "2023-07-16 13:30"),
  (1, 4, "2023-07-18 09:00"),
  (1, 5, "2023-07-18 14:00"),
  (1, null, "2023-07-19 14:30"),
  (1, null, "2023-07-20 10:30"),
  (1, 3, "2023-07-21 12:00"),
  (1, null, "2023-07-21 15:00"),
  (1, 5, "2023-07-23 13:30"),
  (1, null, "2023-07-23 15:30"),
  (1, 2, "2023-07-24 15:00"),
  (1, 4, "2023-07-24 16:00"),
  (1, 4, "2023-07-26 15:30"),
  (1, null, "2023-07-26 16:30"),
  (1, null, "2023-07-28 17:00"),
  (1, 3, "2023-07-28 18:00"),
  (1, null, "2023-07-29 19:30"),
  (1, null, "2023-07-29 17:30"),
  (1, 2, "2023-07-30 09:00"),
  (1, null, "2023-07-30 10:30"),
  (1, 5, "2023-07-30 12:00"),
  (1, 3, "2023-07-30 13:30"),
  (1, 3, "2023-07-30 18:00"),
  (1, null, "2023-07-30 18:30");

INSERT INTO
  MentorRequests_t (
    `UserID`,
    `ResumeLocation`,
    `MentorStatement`
  )
VALUES
  (
    5,
    'mia-wilson-resume.pdf',
    'I am a seasoned stock broker with a wealth of experience in managing stock portfolios, and am dedicated to helping aspiring stock traders navigate the dynamic world of investments. With my deep understanding of market trends, risk management strategies, and financial analysis, I aim to offer invaluable mentoring and advice to those looking to enter the exciting realm of stock trading. Drawing from my years of experience in executing trades, analyzing market data, and building successful portfolios, I can provide personalized guidance tailored to individual goals and risk tolerance. My passion for empowering others, coupled with my extensive expertise, makes me an ideal mentor for aspiring stock traders seeking to achieve financial success in the stock market.'
  ),
  (6, null, 'This is a test.');

INSERT INTO
  Messages_t (
    `SenderID`,
    `MessageBody`,
    `SendDate`
  )
VALUES
  (
    1,
    'I have been working in the software industry for a few years now, and I\'m at a point where I want to take my career to the next level. I would greatly appreciate any advice or insights you can provide regarding career growth, skill development, and potential opportunities.',
    '2023-06-03 06:10:00'
  ),
  (
    3,
    'I have been following your successful career journey and I\'m impressed by your achievements. I believe that having you as a mentor would greatly benefit my professional growth. I am eager to learn from your experiences, receive guidance on navigating challenges, and gain insights into the industry trends.',
    '2023-06-10 12:45:00'
  ),
  (
    4,
    'I am currently at a crossroads in my career, and I\'m seeking advice from experienced professionals like yourself. I would like to discuss my long-term goals, potential career paths, and strategies for advancing in my field. Your guidance and wisdom would be invaluable to me.',
    '2023-06-12 05:40:00'
  ),
  (
    2,
    'I have been following your career trajectory with great interest, and I am inspired by your achievements. I would like to request your mentorship and guidance as I navigate my own professional journey. Your insights, feedback, and support would be immensely valuable in helping me achieve my career goals.',
    '2023-06-17 00:40:00'
  ),
  (
    5,
    'I am considering transitioning into a new career field and I\'m looking for advice on how to successfully make the switch. I would appreciate any insights you can share regarding the skills I should acquire, the challenges I may face, and the best strategies to make a smooth transition.',
    '2023-06-20 15:30:00'
  ),
  (
    6,
    'I have recognized the importance of mentorship in career development, and I am actively seeking a mentor to guide me. I believe that your expertise and experience align perfectly with my aspirations. I would be grateful for the opportunity to learn from you and receive guidance on my professional journey.',
    '2023-06-25 16:50:00'
  ),
  (
    1,
    'I have been contemplating a career change for some time now, but I\'m unsure about the best approach. I would greatly appreciate your advice on how to successfully navigate this transition. I would like to discuss the steps I should take, the potential challenges I may encounter, and any opportunities you may be aware of.',
    '2023-07-02 00:35:00'
  ),
  (
    2,
    'I\'m highly interested in exploring mentoring opportunities with professionals like yourself. I am eager to gain insights into your journey, learn from your experiences, and receive guidance on how to overcome obstacles and achieve my career objectives. I would be grateful for the chance to discuss further and explore the potential of a mentor-mentee relationship.',
    '2023-07-05 03:45:00'
  ),
  (
    3,
    'I have reached a point in my career where I feel stuck and uncertain about the next steps. I would greatly appreciate your suggestions and guidance on how to progress and overcome this hurdle. Your expertise and perspectives would be invaluable in helping me regain direction and momentum.',
    '2023-07-10 14:35:00'
  ),
  (
    4,
    'I have been facing several challenges in my professional life, and I believe that having a mentor would provide valuable support. I am seeking a mentor who can guide me through these challenges, help me develop essential skills, and offer advice on how to navigate the complexities of the industry. Your mentorship would be immensely beneficial to me.',
    '2023-07-13 02:25:00'
  ),
  (
    5,
    'I have been working in my current field for several years, but I feel like it\'s time for a change. I\'m interested in exploring new career opportunities and would appreciate your advice on how to successfully transition into a different industry. I\'m particularly curious about the skills and qualifications I should focus on acquiring.',
    '2023-06-01 11:55:00'
  ),
  (
    3,
    'Your accomplishments and expertise in the industry have inspired me, and I believe that having you as a mentor would greatly benefit my professional growth. I would love to learn from your experiences, seek guidance on building a successful career, and discuss strategies for overcoming challenges. Your mentorship would mean a lot to me.',
    '2023-06-05 15:25:00'
  ),
  (
    1,
    'As a recent graduate, I\'m excited to embark on my professional journey, but I\'m also feeling a bit lost.I would appreciate any career guidance or advice you can offer.I\'m curious to learn about the career paths you took, the challenges you faced, and any lessons you can share to help me kickstart my own career on the right foot.',
    '2023-06-09 01:45:00'
  ),
  (
    2,
    'I have been following your impressive career trajectory and have always admired your achievements. I\'m seeking a mentor who can provide guidance, support, and insights to help me grow professionally. Your expertise and industry knowledge would be invaluable in helping me navigate the challenges and make informed career decisions.',
    '2023-06-14 09:40:00'
  ),
  (
    6,
    'I\'m at a crossroads in my career and could use some advice. I\'m torn between pursuing higher education or gaining more work experience. I would appreciate your perspective on the pros and cons of each path and any recommendations you may have based on your own experiences. Your guidance would help me make an informed decision.',
    '2023-06-18 03:10:00'
  ),
  (
    4,
    'I have been following your contributions in the industry and have been inspired by your achievements. I would like to request your mentorship to help me develop the necessary skills, overcome challenges, and advance in my career. Your guidance and mentorship would be invaluable as I work towards my professional goals.',
    '2023-06-23 14:00:00'
  ),
  (
    5,
    'I have recently decided to change my career path, and I\'m in the process of exploring different options. I would appreciate any advice or insights you can provide on successfully transitioning into a new field. I\'m particularly interested in understanding how to leverage my existing skills and experiences in this transition.',
    '2023-06-28 16:35:00'
  ),
  (
    1,
    'I\'m interested in finding a mentor who can help me grow as a professional. Your extensive experience and expertise align perfectly with my aspirations. I would be honored to receive guidance from you on topics such as career development, networking, and personal growth. I\'m eager to explore the potential of a mentor-mentee relationship.',
    '2023-07-01 08:20:00'
  ),
  (
    3,
    'I\'m in a phase of my career where I\'m looking to take on more challenging roles and advance in my field. I would greatly appreciate your advice on how to effectively position myself for growth opportunities, expand my professional network, and develop the skills necessary to excel in higher-level roles. Your insights would be invaluable to me.',
    '2023-07-06 09:50:00'
  ),
  (
    2,
    'I\'m facing some career-related obstacles and would greatly benefit from having a mentor to guide me. I\'m seeking someone who can provide advice, offer a fresh perspective on my challenges, and help me overcome obstacles. Your mentorship would be highly valued as I work towards achieving my career aspirations.',
    '2023-07-10 14:20:00'
  ),
  (
    2,
    'I appreciate your eagerness to take your career to the next level. One piece of advice I can offer is to focus on continuous learning and skill development. Stay updated with the latest industry trends and technologies to remain competitive.',
    '2023-06-04 08:45:00'
  ),
  (
    5,
    'Thank you for reaching out and expressing your interest in having me as your mentor. I\'m honored by your request. I believe mentorship can play a crucial role in one\'s career growth, and I\'m excited to embark on this mentoring journey with you.',
    '2023-06-11 11:55:00'
  ),
  (
    1,
    'I\'m glad you reached out for career advice. Exploring different paths and seeking guidance is a wise move. Let\'s schedule a conversation where we can discuss your long - term goals, assess your skills, and explore potential career opportunities together.',
    ' 2023-06-15 13:20:00'
  ),
  (
    6,
    'I appreciate your interest in my mentorship. It\'s always rewarding to help aspiring professionals like yourself. I would be happy to guide you on your professional journey. Let\'s set up a time to discuss your goals and create a plan to achieve them.',
    '2023-06-20 15:50:00'
  ),
  (
    3,
    'Transitioning into a new career field can be challenging, but with the right strategies, it\'s definitely achievable. I suggest conducting thorough research, networking with professionals in your desired field, and considering relevant certifications or training programs to enhance your skills.',
    '2023-06-23 09:30:00'
  ),
  (
    4,
    'Mentorship is a valuable resource, and I\'m glad you recognize its importance.I would be honored to be your mentor.Let\'s connect and discuss your specific needs, goals, and how we can make the most of this mentor-mentee relationship.',
    '2023-06-28 20:10:00'
  ),
  (
    3,
    'Transitioning into a new career path can be both exciting and challenging. I recommend conducting informational interviews with professionals in your desired field, attending industry events, and considering internships or part-time positions to gain hands-on experience and make a smooth transition.',
    '2023-07-03 07:50:00'
  ),
  (
    4,
    'I appreciate your interest in mentoring. I believe mentorship can provide valuable guidance and support. Let\'s schedule a meeting to discuss your career goals,
    expectations, and how we can establish an effective mentorship dynamic.',
    ' 2023-07-06 06:35:00'
  ),
  (
    6,
    'Feeling stuck in your career is a common experience. To regain direction and momentum, I suggest taking a step back to evaluate your goals and values.We can explore various strategies, such as identifying transferable skills, pursuing additional training, or seeking new challenges within your current role.',
    '2023-07-12 18:15:00'
  ),
  (
    5,
    'Overcoming professional challenges often requires guidance and support. I\'m glad you\'re seeking a mentor. Let\'s discuss your specific challenges and create an action plan to address them. Together, we can work towards your professional success.',
    '2023-07-12 17:45:00'
  );

INSERT INTO
  Message_Recipient_t (
    `MessageID`,
    `RecipientID`,
    `IsRead`,
    `IsDeleted`
  )
VALUES
  (1, 2, 0, 0),
  (2, 5, 0, 0),
  (3, 1, 0, 0),
  (4, 6, 0, 0),
  (5, 3, 0, 0),
  (6, 4, 0, 0),
  (7, 3, 0, 0),
  (8, 4, 0, 0),
  (9, 6, 0, 0),
  (10, 5, 0, 0),
  (11, 4, 0, 0),
  (12, 2, 0, 0),
  (13, 6, 0, 0),
  (14, 5, 0, 0),
  (15, 1, 0, 0),
  (16, 3, 0, 0),
  (17, 2, 0, 0),
  (18, 4, 0, 0),
  (19, 6, 0, 0),
  (20, 1, 0, 0),
  (21, 1, 0, 0),
  (22, 3, 0, 0),
  (23, 4, 0, 0),
  (24, 2, 0, 0),
  (25, 5, 0, 0),
  (26, 6, 0, 0),
  (27, 1, 0, 0),
  (28, 4, 0, 0),
  (29, 3, 0, 0),
  (30, 4, 0, 0);

INSERT INTO
  Skills_t (`SkillName`, `SkillGroup`)
VALUES
  ('HTML', 'Web Development'),
  ('CSS', 'Web Development'),
  ('JavaScript', 'Web Development'),
  ('Java', 'Programming'),
  ('Python', 'Programming'),
  ('R', 'Programming'),
  ('SQL', 'Programming'),
  ('Database Management', 'Information Systems'),
  ('Data Analysis', 'Information Systems'),
  ('Statistical Modeling', 'Information Systems'),
  ('UX Design', 'Application Design'),
  (
    'Leadership',
    'Entrepreneurial Skills'
  ),
  (
    'Creativity',
    'Entrepreneurial Skills'
  ),
  ('Teamwork', 'Entrepreneurial Skills'),
  (
    'Problem Solving',
    'Entrepreneurial Skills'
  ),
  (
    'Decision-Making',
    'Entrepreneurial Skills'
  ),
  (
    'Critical Thinking',
    'Entrepreneurial Skills'
  ),
  (
    'Communication',
    'Entrepreneurial Skills'
  ),
  (
    'Mediation',
    'Entrepreneurial Skills'
  ),
  (
    'Negotiation',
    'Entrepreneurial Skills'
  ),
  (
    'Attention to Detail',
    'Entrepreneurial Skills'
  ),
  (
    'Chemical Analysis',
    'Laboratory Science'
  ),
  (
    'Organic Synthesis',
    'Laboratory Science'
  ),
  ('Spectroscopy', 'Laboratory Science'),
  (
    'Chromatography',
    'Laboratory Science'
  ),
  (
    'Lab Techniques',
    'Laboratory Science'
  ),
  (
    'Data Analysis',
    'Laboratory Science'
  ),
  ('Financial Analysis', 'Finance'),
  ('Investment Strategies', 'Finance'),
  ('Portfolio Management', 'Finance'),
  ('Risk Assessment', 'Finance'),
  ('Market Research', 'Finance'),
  ('Curriculum Design', 'Education'),
  ('Classroom Management', 'Education'),
  ('Student Assessment', 'Education'),
  ('Differentiated Instruction', 'Education'),
  ('Lesson Planning', 'Education'),
  ('Classroom Technology Integration', 'Education'),
  ('Legal Research', 'Law'),
  ('Litigation', 'Law'),
  ('Contract Law', 'Law'),
  ('Client Counseling', 'Law'),
  ('Legal Writing', 'Law'),
  ('Courtroom Advocacy', 'Law');

INSERT INTO
  Qualifications_t (`UserID`, `SkillID`)
VALUES
  (1, 23),
  (1, 24),
  (1, 25),
  (1, 26),
  (1, 27),
  (1, 15),
  (2, 39),
  (2, 40),
  (2, 41),
  (2, 42),
  (2, 43),
  (2, 44),
  (3, 9),
  (3, 10),
  (3, 5),
  (3, 6),
  (3, 7),
  (3, 15),
  (3, 17),
  (4, 33),
  (4, 34),
  (4, 35),
  (4, 18),
  (4, 36),
  (4, 37),
  (4, 38),
  (5, 28),
  (5, 29),
  (5, 30),
  (5, 31),
  (5, 32),
  (5, 18),
  (5, 21),
  (6, 4),
  (6, 5),
  (6, 11),
  (6, 8),
  (6, 14),
  (6, 13);

INSERT INTO
  community_data (
    `community_name`,
    `community_desc`,
    `active_flg`
  )
VALUES
  (
    'Java Programming',
    'Welcome to the ultimate online community forum for Java Programming enthusiasts! Join a vibrant community of developers and learners from all levels, where you can share your knowledge, ask questions, and engage in discussions about Java-related topics. Whether you\'re a seasoned programmer or just starting your coding journey, Guidance Exchange is the perfect place to connect, collaborate, and grow together in the world of Java Programming.',
    0
  ),
  (
    'Stock Trading',
    'Step into the world of stock trading with the premier online community forum for traders and investors! Discover a dynamic platform where traders of all backgrounds come together to exchange ideas, strategies, and market insights. Whether you\'re a seasoned Wall Street pro or a novice exploring the markets, Guidance Exchange offers a supportive space to discuss stocks, analyze trends, and stay informed on the latest financial developments.',
    0
  ),
  (
    'Coin Collecting',
    'Welcome to the ultimate online community forum for passionate numismatists! Immerse yourself in the fascinating world of coin collecting, where enthusiasts gather to share their expertise, showcase rare finds, and discuss the rich history behind these treasured pieces. Whether you\'re a seasoned collector or a newcomer with a growing interest, Guidance Exchange provides a welcoming environment to connect with like-minded individuals, expand your knowledge, and embark on a captivating journey through the realm of coins.',
    0
  );

INSERT INTO
  CommunityRequests_t (
    `CommunityID`,
    `UserID`,
    `CommunityName`,
    `CommunityDescription`,
    `CommunityPicture`
  )
VALUES
  (
    1,
    6,
    'Java Programming',
    'Welcome to the ultimate online community forum for Java Programming enthusiasts! Join a vibrant community of developers and learners from all levels, where you can share your knowledge, ask questions, and engage in discussions about Java-related topics. Whether you\'re a seasoned programmer or just starting your coding journey, Guidance Exchange is the perfect place to connect, collaborate, and grow together in the world of Java Programming.',
    'java_icon.png'
  ),
  (
    2,
    5,
    'Stock Trading',
    'Welcome to the ultimate online community forum for Java Programming enthusiasts! Join a vibrant community of developers and learners from all levels, where you can share your knowledge, ask questions, and engage in discussions about Java-related topics. Whether you\'re a seasoned programmer or just starting your coding journey, Guidance Exchange is the perfect place to connect, collaborate, and grow together in the world of Java Programming.',
    'stocks_circle.png'
  ),
  (
    3,
    4,
    'Coin Collecting',
    'Welcome to the ultimate online community forum for passionate numismatists! Immerse yourself in the fascinating world of coin collecting, where enthusiasts gather to share their expertise, showcase rare finds, and discuss the rich history behind these treasured pieces. Whether you\'re a seasoned collector or a newcomer with a growing interest, Guidance Exchange provides a welcoming environment to connect with like-minded individuals, expand your knowledge, and embark on a captivating journey through the realm of coins.',
    'coins_circle.png'
  );