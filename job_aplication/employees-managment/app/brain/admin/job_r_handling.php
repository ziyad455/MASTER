<?php
require str_replace('\\', '/', 'C:/xampp/htdocs/my-web/employees-managment/app/database/conectdb.php'); 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['accept'])) {
        try {
            $q = "INSERT INTO employees (user_id, salary, hire_date) VALUES (?, ?, ?)";
            $db->insert($q, [$_POST['user_id'], '1000', date('Y-m-d')]);
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    } elseif (isset($_POST['reject'])) {
        try {
            $q = "DELETE FROM users WHERE id = ?";
            $db->delete($q, [$_POST['user_id']]);
        } catch (PDOException $e) {
            die("Error deleting user: " . $e->getMessage());
        }
    }

    header('Location: http://localhost/my-web/employees-managment/public/views/admin/job_r.php');
    exit();
}
