-- Students
INSERT INTO Student (ID, Name, Major, Year, Email) VALUES
(101, 'Grace Kelly', 'Film Studies', 2, 'gkelly1@u.rochester.edu'),
(102, 'Jimmy Stewart', 'Digital Media Studies', 3, 'jstewart2@u.rochester.edu'),
(103, 'Cary Grant', 'Theatre', 4, 'cgrant3@u.rochester.edu'),
(104, 'Alfred Hitchcock', 'Computer Science', 4, 'ahitchcock4@u.rochester.edu'),
(105, 'Leo G. Carroll', 'Psychology', 3, 'lcarroll5@u.rochester.edu'),
(106, 'Joan Fontaine', 'Political Philosophy', 2, 'jfontaine6@u.rochester.edu'),
(107, 'Ingrid Bergman', 'Film Studies', 3, 'ibergman7@u.rochester.edu'),
(108, 'Tippi Hedren', 'Digital Media Studies', 2, 'thedren8@u.rochester.edu'),
(109, 'Kim Novak', 'Psychology', 1, 'knovak9@u.rochester.edu');

-- Professors
INSERT INTO Professor (ID, Name, DepartmentID, Email) VALUES
(201, 'Dr. L. B. Jefferies', 'FMS', 'ljefferies1@u.rochester.edu'),
(202, 'Dr. Norman Bates', 'PSY', 'nbates2@u.rochester.edu'),
(203, 'Dr. Roger Thornhill', 'CSC', 'rthornhill3@u.rochester.edu');

-- Courses
INSERT INTO Course (ID, Name, Semester, Year, ProfessorID) VALUES
('FMS161', 'Intro to the Art of Film', 'Spring', 2025, 201),
('FMS238', 'Making Your First Short Film', 'Spring', 2025, 201),
('PSY110', 'Foundations of Psychology', 'Spring', 2025, 202),
('PSY205', 'Psychopathology in Pop Culture', 'Spring', 2025, 202),
('CSC261', 'Database Systems', 'Spring', 2025, 203),
('CSC211', 'Introduction to HCI', 'Spring', 2025, 203);

-- Teams
INSERT INTO Team (ID, Name, CourseID) VALUES
-- FMS161
(401, 'Cinephiles!', 'FMS161'),
(402, '12 Angry Students', 'FMS161'),
-- FMS238
(403, 'Kubrickians', 'FMS238'),
(404, 'Men with Movie Cameras', 'FMS238'),
-- PSY110
(405, 'Mind Squad', 'PSY110'),
(406, 'Psychos!', 'PSY110'),
-- PSY205
(407, 'The Freudian Slips', 'PSY205'),
(408, 'Cognitive Collective', 'PSY205'),
-- CSC261
(409, 'Null Terminators', 'CSC261'),
(410, 'Stack Overflow', 'CSC261'),
-- CSC211
(411, 'Byte Me!', 'CSC211'),
(412, 'Runtime Terrors', 'CSC211');

-- Enrollments
INSERT INTO Enrollment (StudentID, CourseID) VALUES
(10, 'FMS161'), (10, 'FMS238'), (10, 'CSC261'), (10, 'CSC211'),
(11, 'FMS161'), (11, 'PSY110'), (11, 'PSY205'), (11, 'CSC261'),
(12, 'FMS238'), (12, 'PSY110'), (12, 'PSY205'), (12, 'CSC211'),
(13, 'FMS161'), (13, 'FMS238'), (13, 'CSC261'), (13, 'CSC211'),
(14, 'PSY110'), (14, 'PSY205'), (14, 'CSC261'), (14, 'CSC211'),
(15, 'FMS161'), (15, 'FMS238'), (15, 'PSY110'), (15, 'PSY205'),
(16, 'FMS238'), (16, 'PSY110'), (16, 'CSC261'), (16, 'CSC211'),
(17, 'FMS161'), (17, 'PSY205'), (17, 'CSC261'), (17, 'CSC211'),
(18, 'FMS161'), (18, 'FMS238'), (18, 'CSC261'), (18, 'PSY205');

-- Team Members
-- Grace Kelly (10)
INSERT INTO TeamMember (StudentID, TeamID) VALUES
(10, 401), (10, 403), (10, 409), (10, 411);

-- Jimmy Stewart (11)
INSERT INTO TeamMember (StudentID, TeamID) VALUES
(11, 402), (11, 405), (11, 407), (11, 409);

-- Cary Grant (12)
INSERT INTO TeamMember (StudentID, TeamID) VALUES
(12, 404), (12, 405), (12, 408), (12, 412);

-- Alfred Hitchcock (13)
INSERT INTO TeamMember (StudentID, TeamID) VALUES
(13, 401), (13, 403), (13, 410), (13, 411);

-- Leo G. Carroll (14)
INSERT INTO TeamMember (StudentID, TeamID) VALUES
(14, 406), (14, 407), (14, 409), (14, 411);

-- Joan Fontaine (15)
INSERT INTO TeamMember (StudentID, TeamID) VALUES
(15, 402), (15, 404), (15, 406), (15, 408);

-- Ingrid Bergman (16)
INSERT INTO TeamMember (StudentID, TeamID) VALUES
(16, 403), (16, 406), (16, 410), (16, 411);

-- Tippi Hedren (17)
INSERT INTO TeamMember (StudentID, TeamID) VALUES
(17, 401), (17, 408), (17, 409), (17, 412);

-- Kim Novak (18)
INSERT INTO TeamMember (StudentID, TeamID) VALUES
(18, 402), (18, 404), (18, 410), (18, 407);