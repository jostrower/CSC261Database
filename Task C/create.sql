CREATE TABLE Student (
    ID INT PRIMARY KEY,
    Name VARCHAR(100) NOT NULL,
    Major VARCHAR(100),
    Year INT,
    Email VARCHAR(255) UNIQUE
);

CREATE TABLE Professor (
    ID INT PRIMARY KEY,
    Name VARCHAR(100) NOT NULL,
    DepartmentID VARCHAR(100),
    Email VARCHAR(255) UNIQUE
);

CREATE TABLE Course (
    ID VARCHAR(100) PRIMARY KEY,
    Name VARCHAR(100) NOT NULL,
    Semester VARCHAR(100) NOT NULL,
    Year INT NOT NULL,
    ProfessorID INT REFERENCES Professor(ID)
);

CREATE TABLE Team (
    ID INT PRIMARY KEY,
    Name VARCHAR(100) NOT NULL,
    CourseID VARCHAR(100) NOT NULL REFERENCES Course(ID)
);

CREATE TABLE Enrollment (
    StudentID INT NOT NULL REFERENCES Student(ID),
    CourseID VARCHAR(100) NOT NULL REFERENCES Course(ID),
    PRIMARY KEY (StudentID, CourseID)
);

CREATE TABLE TeamMember(
    StudentID INT NOT NULL REFERENCES Student(ID),
    TeamID INT NOT NULL REFERENCES Team(ID),
    PRIMARY KEY (StudentID, TeamID)
);