CREATE TABLE Auth_t (
  UserID INT(9) NOT NULL Auto_Increment,
  username VARCHAR(100),
  password VARCHAR(100),
  email VARCHAR(255),
  phone_number VARCHAR(255),
  MentorStatus BOOL NOT NULL,
  ModeratorStatus BOOL NOT NULL,
  SystemAdministratorStatus BOOL NOT NULL,
  CONSTRAINT Auth_t_PK PRIMARY KEY (UserID)
) Auto_Increment = 1;

CREATE TABLE UserData_t (
  UserID INT(9) NOT NULL,
  FirstName VARCHAR(255) NOT NULL,
  LastName VARCHAR(255) NOT NULL,
  FullName VARCHAR(255) NOT NULL,
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

CREATE TABLE Appointments_t (
  AppointmentID INT(9) NOT NULL Auto_Increment,
  MentorID INT(9) NOT NULL,
  SchedulerID INT(9),
  AppointmentTime DATETIME,
  CONSTRAINT Appointments_t_PK PRIMARY KEY (AppointmentID),
  CONSTRAINT Appointments_t_FK1 FOREIGN KEY (MentorID) REFERENCES Auth_t(UserID),
  CONSTRAINT Appointments_t_FK2 FOREIGN KEY (SchedulerID) REFERENCES Auth_t(UserID)
) Auto_Increment = 1;

CREATE TABLE Skills_t (
  SkillID INT(9) NOT NULL Auto_Increment,
  SkillName VARCHAR(255),
  SkillGroup VARCHAR(255),
  CONSTRAINT Skills_t_PK PRIMARY KEY (SkillID)
) Auto_Increment = 1;

CREATE TABLE Qualifications_t (
  UserID INT(9) NOT NULL,
  SkillID INT(9) NOT NULL,
  CONSTRAINT Qualifications_t_FK1 FOREIGN KEY (UserID) REFERENCES Auth_t(UserID),
  CONSTRAINT Qualifications_t_FK2 FOREIGN KEY (SkillID) REFERENCES Skills_t(SkillID)
);

CREATE TABLE MentorRequests_t (
  MentorRequestID INT(9) NOT NULL Auto_Increment,
  UserID INT(9) NOT NULL,
  ResumeLocation VARCHAR(255),
  MentorStatement LONGTEXT,
  CONSTRAINT MentorRequests_t_PK PRIMARY KEY (MentorRequestID),
  CONSTRAINT MentorRequests_t_FK FOREIGN KEY (UserID) REFERENCES Auth_t(UserID)
) Auto_Increment = 1;

CREATE TABLE CommunityRequests_t (
  CommunityRequestID INT(9) NOT NULL Auto_Increment,
  UserID INT(9) NOT NULL,
  CommunityName VARCHAR(255),
  CommunityDescription LONGTEXT,
  CommunityPicture VARCHAR(255),
  CONSTRAINT CommunityRequests_t_PK PRIMARY KEY (CommunityRequestID),
  CONSTRAINT CommunityRequests_t_FK FOREIGN KEY (UserID) REFERENCES Auth_t(UserID)
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
    'system.admin',
    '12345',
    'system.admin@guidanceexchange.com',
    '(123) 456-7890',
    0,
    1,
    0
  );

INSERT INTO
  UserData_t (
    `UserID`,
    `FirstName`,
    `LastName`,
    `FullName`,
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
    'David Anderson',
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
    'Benjamin Park',
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
    '1;2;5'
  ),
  (
    3,
    'Harper',
    'Brown',
    'Harper Brown',
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
    'Lucas Khan',
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
    '1;2;5'
  ),
  (
    5,
    'Mia',
    'Wilson',
    'Mia Wilson',
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
    '2;4;5'
  ),
  (
    6,
    'Sophia',
    'Lee',
    'Sophia Lee',
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
    '2;4;5'
  ),
  (
    7,
    'Isabella',
    'Martinez',
    'Isabella Martinez',
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
    'System',
    'Administrator',
    'System Administrator',
    null,
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
  (1, 22),
  (1, 23),
  (1, 24),
  (1, 25),
  (1, 26),
  (1, 27);

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
  CommunityRequests_t (
    `UserID`,
    `CommunityName`,
    `CommunityDescription`,
    `CommunityPicture`
  )
VALUES
  (
    6,
    'Java Programming',
    'I\'m thrilled to propose the creation of a fantastic forum community for Java programming enthusiasts. I\'m looking for a place where passionate programmers can come together to discuss, learn, and share knowledge about Java. Imagine a space brimming with like-minded individuals who are just as eager as you are to delve into the intricacies of Java programming. I want a Java community where you can initiate and participate in stimulating conversations, exchange valuable code snippets, seek advice on troubleshooting, and connect with seasoned professionals ready to mentor. Whether you\'re a beginner seeking guidance or a seasoned expert eager to contribute, the Java community would be a supportive environment where growth and collaboration thrive. Thank you for considering creating this exciting space for Java enthusiasts, and let\'s unlock endless possibilities for learning and networking within the Java community.',
    'java_icon.png'
  ),
  (
    5,
    'Stock Trading',
    'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Excepturi omnis, quod odio praesentium rem cupiditate soluta laborum aspernatur, explicabo temporibus veritatis a cumque quas dolor libero corrupti vero dolorum consequatur! Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestiae voluptatem ipsam libero iure fugit facere omnis, consequuntur dolor? In aperiam pariatur ex aut vel vitae reprehenderit sunt vero modi deleniti. ',
    'stocks_circle.png'
  ),
  (
    4,
    'Coin Collecting',
    'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Excepturi omnis, quod odio praesentium rem cupiditate soluta laborum aspernatur, explicabo temporibus veritatis a cumque quas dolor libero corrupti vero dolorum consequatur! Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestiae voluptatem ipsam libero iure fugit facere omnis, consequuntur dolor? In aperiam pariatur ex aut vel vitae reprehenderit sunt vero modi deleniti. ',
    'coins_circle.png'
  );