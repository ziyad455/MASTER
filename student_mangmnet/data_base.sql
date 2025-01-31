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

CREATE TABLE student_subject (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_id INT,
    subject_id INT UNIQUE,
    FOREIGN KEY (student_id) REFERENCES students(id) ON DELETE CASCADE,
    FOREIGN KEY (subject_id) REFERENCES subject(id) ON DELETE CASCADE
);

INSERT INTO subject(id, subject_name)
    VALUES (1, 'algorithm'), (2, 'python'), (3, 'English'), (4, 'base de donne'), (5, 'soft skiles');


