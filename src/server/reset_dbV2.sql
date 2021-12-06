DROP TABLE IF EXISTS WebsiteUsers;
DROP TABLE IF EXISTS Threads;
DROP TABLE IF EXISTS ThreadComments;
DROP TABLE IF EXISTS UserImages;

CREATE TABLE WebsiteUsers(
    username VARCHAR(30),
    email    VARCHAR(100),
    password VARCHAR(50),
    admin BOOLEAN,
    allowedToPost BOOLEAN,
    PRIMARY KEY (username)
);

CREATE TABLE UserImages(
    username VARCHAR(30),
    imageContentType VARCHAR(255),
    userImage BLOB,
    PRIMARY KEY (username)
);

CREATE TABLE Threads(
    id INT AUTO_INCREMENT,
    creatorUserName VARCHAR(30),
    date DATE,
    threadTitle VARCHAR(100),
    threadQuestion  VARCHAR(500),
    threadTopic VARCHAR(50),
    numberOfViews INTEGER,
    threadViewStatus BOOLEAN,
    PRIMARY KEY (id)
);

CREATE TABLE ThreadComments(
    id INT AUTO_INCREMENT,
    threadId INT,
    creatorUserName VARCHAR(30),
    date DATE,
    content VARCHAR(500),
    commentViewStatus BOOLEAN,
    PRIMARY KEY (id)
);

-- password admin1
INSERT INTO WebsiteUsers Values ("admin1", "admin1@gmail.com", "e00cf25ad42683b3df678c61f42c6bda", TRUE, TRUE);
-- password admin2
INSERT INTO WebsiteUsers Values ("admin2", "admin2@outlook.com", "c84258e9c39059a89ab77d846ddab909", TRUE, TRUE);

-- password 123
INSERT INTO WebsiteUsers Values ("Firestone", "bmorrow@msn.com", "202cb962ac59075b964b07152d234b70", FALSE, TRUE);
-- password 234
INSERT INTO WebsiteUsers Values ("Beneful1", "suresh@yahoo.com", "289dff07669d7a23de0ef88d2f7129e7", FALSE, TRUE);
-- password 345
INSERT INTO WebsiteUsers Values ("spokale", "JaneSmithChicago@ESP.com", "d81f9c1be2e08964bf9f24b15f0e4900", FALSE, TRUE);

INSERT INTO WebsiteUsers Values ("CaffeinatedGuy", "saritaagarwalgoyal@gmail.com", "d81f9c1be2e08964bf9f24b15f0e4900", FALSE, TRUE);

INSERT INTO WebsiteUsers Values ("ColdDesert77", "onezo@telus.ca", "d81f9c1be2e08964bf9f24b15f0e4900", FALSE, TRUE);



INSERT INTO Threads Values (1, "Firestone", "2018-01-28", "Your opinion on robot vacuums?", "What do you think of robot vacuums? Are they worth it? Or just a novelty type of electronic with marginal improvements to quality of life...", "RVC", 0, TRUE);
INSERT INTO Threads Values (2, "Beneful1", "2019-10-17", "Why Aren't CPU Clock Speeds All That Important?", "Could someone could explain what the clock rate of a cpu is? Thanks", "Computers", 0, TRUE);
INSERT INTO Threads Values (3, "spokale", "2019-10-17", "Newton's Second law?", "I don't quite understand it. I have a paper to do and I'm not entirely sure on how it works. F = ma? Is it possible for someone to simplify the definition here?", "Physics", 0, TRUE);
INSERT INTO Threads Values (4, "Beneful1", "2019-10-17", "Handshaking theorem", "Although I can intuitively see why it is true (each edge connects 2 vertices, and the degree of a vertex is is the number of edges incidents with it, so summing up deg(v) of all vertices in a graph will yield twice the number of edges), I don't understand the analogy presented in my slides.", "Math", 0, TRUE);
INSERT INTO Threads Values (5, "Beneful1", "2019-10-17", "Any 2016 SE users still out there?", "am i the only one with the original SE? still running smooth. waiting to see what the iPhone SE 3 looks like then i might upgrade.", "Mobile Phones", 0, TRUE);
INSERT INTO Threads Values (6, "Firestone", "2019-10-17", "What's the best Internet service provider in Canada?", "Because I’m sick of bell the internet just stops every 10 minutes it feels like. They put a pause on my account for no reason so my internet speed drops drastically.", "Internet", 0, TRUE);
INSERT INTO Threads Values (7, "Beneful1", "2019-10-17", "What is considered the best vpn in 2021?", " I want a VPN recommendation that’s good for keeping things anonymous and also one that can bypass geo blocking and that sort of thing.", "Internet", 0, TRUE);
INSERT INTO Threads Values (8, "spokale", "2019-10-17", "Discrete and Continouos mathematics", "What are discrete and continuous mathematics?", "Math", 0, TRUE);
INSERT INTO Threads Values (9, "Beneful1", "2019-10-17", "What programming language to use for robotics", "Could someone could explain what programming language works well with robotics?", "Robotics", 0, TRUE);
INSERT INTO Threads Values (10, "Firestone", "2019-10-17", "Do you know how I can change this user password in phpmyadmin?", "I was given a script and loaded the database and uploaded the files but can not log in as admin because I do not know the password. Thanks", "Computers", 0, TRUE);
INSERT INTO Threads Values (11, "ColdDesert77", "2019-10-17", "What are the main components of a computer?", "What are the main components of a computer?", "Computers", 0, TRUE);
INSERT INTO Threads Values (12, "1stGenOutdoorsman", "2019-10-17", "What is an operating system?", "What is an operating system? How does software run directly on the hardware?", "Computers", 0, TRUE);







INSERT INTO ThreadComments Values (1, 1, "spokale", "2018-02-1", "Great for me because I have a dog and he sheds everyday. With the Dyson handheld it takes up to 15 minutes out of my day and I would prefer to do it twice a day.", TRUE);
INSERT INTO ThreadComments Values (2, 1, "CaffeinatedGuy", "2018-02-1", "I got a cheapie one from Amazon on Prime days and I like it a lot. The only real issue is it depends on how tidy of a person you are and if it'll go under your chairs.", TRUE);
INSERT INTO ThreadComments Values (3, 1, "ColdDesert77", "2018-02-1", "Robot vacuums have been around for almost 10 years now and getting better with each passing year. If I was buying one now i would buy the Roomba with Automatic dirt disposal.", TRUE);
INSERT INTO ThreadComments Values (4, 2, "Firestone", "2018-02-1", "Clock speed doesn't capture efficiency. If a 2.7GHz processor wastes half of it's cycles on bad branch prediction or math, and a 2.1GHz processor only wastes 25% of it's cycles, the 2.1GHz processor will complete any given task faster.", TRUE);
INSERT INTO ThreadComments Values (5, 2, "ColdDesert77", "2018-02-1", "Let's say you're walking with a small child. You're taking 3 steps per second. They, with much smaller legs, are also taking 3 steps per second and get left way behind you.", TRUE);
INSERT INTO ThreadComments Values (6, 3, "Beneful1", "2018-02-1", "Newton's first law tells us that anything with a constant velocity (including a stationary object) will continue doing what it is doing unless a force acts upon it.", TRUE);
INSERT INTO ThreadComments Values (7, 3, "CaffeinatedGuy", "2018-02-1", "Newton's Second Law is that Force is equal to the rate of change of momentum, usually expressed as F=ma, where F is force, m is mass and a is acceleration (and occasionally F=dp/dt where p is momentum, ie mass x velocity).", TRUE);
INSERT INTO ThreadComments Values (8, 4, "spokale", "2018-02-1", " That's why it's called the \"handshake theorem\": to count handshakes, ask everyone how many hands they shook, add those up, then divide by 2 since you've now counted both sides of every handshake.", TRUE);
INSERT INTO ThreadComments Values (9, 5, "1stGenOutdoorsman", "2018-02-1", "I want 13 pro for the camera anyway. So I don’t need to replace it.", TRUE);
INSERT INTO ThreadComments Values (10, 5, "CaffeinatedGuy", "2018-02-1", "I use it as my backup/spare phone (currently using a 13 Mini). But I could go back to daily driving it no problem if I had to, still a very capable little phone", TRUE);
INSERT INTO ThreadComments Values (11, 6, "spokale", "2018-02-1", "Start.ca, Teksavvy.", TRUE);
INSERT INTO ThreadComments Values (12, 6, "1stGenOutdoorsman", "2018-02-1", "Buy a dog and take it for walks.", TRUE);
INSERT INTO ThreadComments Values (13, 7, "spokale", "2018-02-1", "cyberghost for privacy and torrenting since it has no logs. I've never had my IP leaked when using them. ", TRUE);
INSERT INTO ThreadComments Values (14, 7, "Firestone", "2018-02-1", "I'm pretty new to this whole VPN game, but I've been using Nord for last couple of weeks mainly for playing WoW and watching netflix and I'm really happy for what I'm paying (really not all that much)", TRUE);
INSERT INTO ThreadComments Values (15, 8, "1stGenOutdoorsman", "2018-02-1", "Continuous maths is concerned with functions which are defined 'continuously' i.e. functions which can be evaluated at any accuracy.", TRUE);
INSERT INTO ThreadComments Values (16, 8, "ColdDesert77", "2018-02-1", "A discrete function/set just means that the difference between one value and another is countable, so a set like {0,2,5,5.1,9} is discrete and finite, whereas the set [0,2] is continuous because you have 0.000000001, 00000000100001, etc., ", TRUE);
INSERT INTO ThreadComments Values (17, 9, "spokale", "2018-02-1", "There isn't really a right answer here, it all depends on what you want to do. Any text-based language provides a great start - the key is to focus on good coding practices.", TRUE);
INSERT INTO ThreadComments Values (18, 9, "Firestone", "2018-02-1", "If you’re doing it for school, learn the language that is going to be used in class. If it is for work learn that language your company is using.", TRUE);
INSERT INTO ThreadComments Values (19, 10, "Beneful1", "2018-02-1", "UPDATE mysql.user SET password = PASSWORD(‘new password here’) WHERE user = ‘username here’ AND host = ‘host here’;", TRUE);
INSERT INTO ThreadComments Values (20, 10, "CaffeinatedGuy", "2018-02-1", "You need a FLUSH PRIVILEGES or a server restart after that.", TRUE);
INSERT INTO ThreadComments Values (21, 11, "Firestone", "2018-02-1", "Case (holds everything). Motherboard (the brains, all the other components connect to this). CPU (processor). Hard drive. RAM (memory, get at least 2G, but memory is relatively cheap so go with 4-8G if you want). Power supply. Video card", TRUE);
INSERT INTO ThreadComments Values (22, 12, "CaffeinatedGuy", "2018-02-1", "An OS is a program. The BIOS or UEFI on the motherboard knows enough to execute one program", TRUE);
INSERT INTO ThreadComments Values (23, 12, "Beneful1", "2018-02-1", " OS is short for Operating System, so Windows is an OS, Linux is an OS, and Mac OS X is an OS.", TRUE);


