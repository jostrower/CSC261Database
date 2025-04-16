-- reset.sql

-- Delete everything from the Student table
DELETE FROM TeamMember;
DELETE FROM Enrollment;
DELETE FROM Team;
DELETE FROM Course;
DELETE FROM Professor;
DELETE FROM Student;

-- Reload original data
SOURCE load.sql;
