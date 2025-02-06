CREATE DATABASE students_management;
USE students_management;
DROP DATABASE students_management;


CREATE TABLE students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(100),
    last_name VARCHAR(100),
    age INT CHECK(age > 18 and age <= 30),
    group_name VARCHAR(50)
);

CREATE TABLE subject (
    id INT AUTO_INCREMENT PRIMARY KEY,
    subject_name VARCHAR(100) UNIQUE
);

CREATE TABLE exams (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_id INT,
    subject_id INT,
    exam_date DATE,
    score FLOAT check(score>=0 and score<=20),
    FOREIGN KEY (student_id) REFERENCES students(id) ON DELETE CASCADE,
    FOREIGN KEY (subject_id) REFERENCES subject(id) ON DELETE CASCADE 
);



CREATE TABLE group_subject (
    id INT AUTO_INCREMENT PRIMARY KEY,
    group_name VARCHAR(50),
    subject_id INT,
    FOREIGN KEY (subject_id) REFERENCES subject(id) ON DELETE CASCADE,
    UNIQUE (group_name, subject_id)
);

INSERT INTO subject(id, subject_name)
VALUES 
(1, 'algorithm'),
(2, 'python'),
(3, 'English'),
(4, 'base de donne'),
(5, 'soft skills'),
(6, 'Data Structures'),
(7, 'Web Development'),
(8, 'Operating Systems'),
(9, 'Mathematics'),
(10, 'Networking'),
(11, 'Machine Learning'),
(12, 'Artificial Intelligence'),
(13, 'Database Management'),
(14, 'Cybersecurity'),
(15, 'Software Engineering');

INSERT INTO students(first_name, last_name, age, group_name)
VALUES
("Ziyad", "Tber", 20, 'DEV108'),
("Ahmed", "Al-Farsi", 21, 'DEV107'),
("Sara", "Khaled", 19, 'DEV109'),
("Lina", "Hassan", 22, 'DEV106'),
("Omar", "Ali", 23, 'DEV105'),
("Mona", "Fayed", 20, 'DEV104'),
("Rami", "Zaid", 21, 'DEV103'),
("Yara", "Mustafa", 19, 'DEV102'),
("Khaled", "Abdallah", 22, 'DEV101'),
("Layla", "Mohamed", 20, 'DEV108'),
("Tariq", "El-Amin", 24, 'DEV107'),
("Nadia", "Sayed", 21, 'DEV106'),
("Samir", "Hussein", 22, 'DEV105'),
("Dina", "Gamal", 19, 'DEV104'),
("Karim", "Youssef", 23, 'DEV103'),
("Fatima", "Hassan", 20, 'DEV102'),
("Mohamed", "Shams", 21, 'DEV101'),
("Zahra", "Nasser", 23, 'DEV108'),
("Khaled", "Rashid", 22, 'DEV107'),
("Huda", "Khalil", 24, 'DEV106'),
("Ali", "Mohammed", 23, 'DEV105'),
("Laila", "Jaber", 20, 'DEV104'),
("Walid", "Omar", 21, 'DEV103'),
("Mariam", "Mansour", 19, 'DEV102'),
("Yusuf", "Saad", 22, 'DEV101'),
("Maha", "Omar", 20, 'DEV108'),
("Iman", "Sami", 21, 'DEV107'),
("Rasha", "Saad", 23, 'DEV106'),
("Nour", "Salem", 24, 'DEV105'),
("Fayez", "Shaker", 19, 'DEV104'),
("Hassan", "Adel", 20, 'DEV103'),
("Mohammed", "El-Sayed", 22, 'DEV102'),
("Samar", "Ali", 23, 'DEV101'),
("Amira", "Ragab", 21, 'DEV108'),
("Mahmoud", "Fayez", 22, 'DEV107'),
("Kassem", "Nabil", 24, 'DEV106'),
("Noha", "Saad", 23, 'DEV105'),
("Rania", "Zaki", 19, 'DEV104'),
("Yasmine", "Abdullah", 21, 'DEV103'),
("Zeinab", "Hassan", 22, 'DEV102'),
("Samah", "Ali", 20, 'DEV101');
