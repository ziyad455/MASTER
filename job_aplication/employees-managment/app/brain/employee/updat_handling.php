<?php
session_start();
require (str_replace('\\', '/', 'C:\xampp\htdocs\my-web\employees-managment\app\database\conectdb.php')); 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $taskId = $_POST['task_id'];
    $status = $_POST['status'];
    $description = $db->selectOne('SELECT title FROM tasks WHERE id = ?', [$taskId])['title'];
    

    $query = "UPDATE tasks SET status = ? WHERE id = ? AND assigned_to = ?";
    $result = $db->update($query, [$status, $taskId, $_SESSION['employee']['user_id']]);
    $name = $db->selectOne('SELECT name FROM users WHERE id = ?',[$_SESSION['employee']['user_id']])['name'];
    
    if ($result) {
        $_SESSION['message'] = 'Task status updated successfully';

        $fullDescription = "Task ," . htmlspecialchars($description, ENT_QUOTES, 'UTF-8') . "," . $status . "ed by ," . $name;
        $db->insert('INSERT INTO activity (description, category) VALUES (?, ?)', [$fullDescription, 'update']);
        if($status == 'completed'){
            $db->insert('INSERT INTO notify (user_id, descrotption, category) VALUES (?, ?, ?)', [$_SESSION['employee']['user_id'], 'Your task has been Aproved,' . htmlspecialchars($description, ENT_QUOTES, 'UTF-8') , 'completed', 'completed']);
        } 
        
    } else {
        $_SESSION['error'] = 'Failed to update task status';
    }
    
    header('Location: http://localhost/my-web/employees-managment/public/views/employee/Tasks.php');
    exit();
}