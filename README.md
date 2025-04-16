# Task A:
## Relations after decomposition:
- Relation 1: Student(ID, Name, Major, Year, Email)
- Relation 2: Professor(ID, Name, Email, DeptID)
- Relation 3: Class(ID, Name, Semester, Year, ProfessorID)
- Relation 4: Group(ID, Name, ClassID)
- Relation 5: Enrollment(StudentID, ClassID)
- Relation 6: TeamMember(StudentID, GroupID)

# Task B:
## Conceptual design:
There will be a login page where students are asked for their student ID. If this student ID is not already in the database, they will be redirected to a registration page where they input their information. If they are already registered they are taken to a dashboard page with their classes and groups listed. For each registration (class or group), they can edit the registration, remove it, or add new ones. Each will take the user to a new page and on completion they will be directed back to the dashboard. The dashboard will also have a search tab and a create group button. The search tab allows the user to search the database for other groups by class and other factors. Any group that pops up can be joined by the user. The create group button will allow the user to create a group for any class they are part of and add other members to that group as well.

# Task C/D:
## How to access the files:
I hosted the files on my betaweb account: **jostrowe@betaweb.csug.rochester.edu:~/public_html/**.
The password for both the betaweb account and the MariaDB sql database on there is **DAh8jEgS**.
The sql files are not in the public_html folder, they are just in **jostrowe@betaweb.csug.rochester.edu:~/**.
To view the project go to **https://betaweb.csug.rochester.edu/~jostrowe/login.html**.
To reset the database, run **mysql -u jostrowe -p jostrowe_1 < reset.sql** in the betaweb server.
