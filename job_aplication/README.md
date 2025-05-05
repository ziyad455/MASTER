# Job Application Management System (PHP)

This is a simple backend project built with PHP that simulates a job application system. It allows users to apply for a job and wait for admin approval. Once accepted, users become employees and the admin can assign tasks to them.

## Features

- User registration for job application
- Admin dashboard to approve/reject applicants
- Role change after acceptance (Applicant → Employee)
- Task assignment system for employees
- Basic PHP and MySQL-based backend system

## Technologies Used

- PHP (Core)
- MySQL (Database)
- HTML/CSS (Frontend structure)

## Setup Instructions

1. **Clone the repository**  
   ```bash
   git clone https://github.com/ziyad455/MASTER/tree/main/job_aplication
   cd job-application


2. Create the database

Import the database.sql file (if available) into your MySQL server.

Configure the database connection

3. Open connectdb.php.

Replace the placeholder credentials with your own:
$db = new Database($config['DB'], 'root', 'your password');

4. Run the project
Place the project folder in your local server directory (e.g., htdocs for XAMPP).
Start Apache and MySQL from your local server software.
Open the project in your browser (e.g., http://localhost/job-application-system/).



