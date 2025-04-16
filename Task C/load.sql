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
(101, 'FMS161'), (101, 'FMS238'), (101, 'CSC261'), (101, 'CSC211'),
(102, 'FMS161'), (102, 'PSY110'), (102, 'PSY205'), (102, 'CSC261'),
(103, 'FMS238'), (103, 'PSY110'), (103, 'PSY205'), (103, 'CSC211'),
(104, 'FMS161'), (104, 'FMS238'), (104, 'CSC261'), (104, 'CSC211'),
(105, 'PSY110'), (105, 'PSY205'), (105, 'CSC261'), (105, 'CSC211'),
(106, 'FMS161'), (106, 'FMS238'), (106, 'PSY110'), (106, 'PSY205'),
(107, 'FMS238'), (107, 'PSY110'), (107, 'CSC261'), (107, 'CSC211'),
(108, 'FMS161'), (108, 'PSY205'), (108, 'CSC261'), (108, 'CSC211'),
(109, 'FMS161'), (109, 'FMS238'), (109, 'CSC261'), (109, 'PSY205');

-- Team Members
-- Grace Kelly (101)
INSERT INTO TeamMember (StudentID, TeamID) VALUES
(101, 401), (101, 403), (101, 409), (101, 411);

-- Jimmy Stewart (102)
INSERT INTO TeamMember (StudentID, TeamID) VALUES
(102, 402), (102, 405), (102, 407), (102, 409);

-- Cary Grant (103)
INSERT INTO TeamMember (StudentID, TeamID) VALUES
(103, 404), (103, 405), (103, 408), (103, 412);

-- Alfred Hitchcock (104)
INSERT INTO TeamMember (StudentID, TeamID) VALUES
(104, 401), (104, 403), (104, 410), (104, 411);

-- Leo G. Carroll (105)
INSERT INTO TeamMember (StudentID, TeamID) VALUES
(105, 406), (105, 407), (105, 409), (105, 411);

-- Joan Fontaine (106)
INSERT INTO TeamMember (StudentID, TeamID) VALUES
(106, 402), (106, 404), (106, 406), (106, 408);

-- Ingrid Bergman (107)
INSERT INTO TeamMember (StudentID, TeamID) VALUES
(107, 403), (107, 406), (107, 410), (107, 411);

-- Tippi Hedren (108)
INSERT INTO TeamMember (StudentID, TeamID) VALUES
(108, 401), (108, 408), (108, 409), (108, 412);

-- Kim Novak (109)
INSERT INTO TeamMember (StudentID, TeamID) VALUES
(109, 402), (109, 404), (109, 410), (109, 407);