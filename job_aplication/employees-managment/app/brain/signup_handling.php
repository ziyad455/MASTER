<?php 
session_start();
ob_start();
require (str_replace('\\', '/', 'C:\xampp\htdocs\my-web\employees-managment\app\database\conectdb.php')); 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  $errors = [];
  

  $old = $_POST;
  
  // Validate form data
  $name = trim($_POST['name'] ?? '');
  $email = trim($_POST['email'] ?? '');
  $password = trim($_POST['password'] ?? '');
  $c_password = trim($_POST['confirm_password'] ?? '');
  $country = $_POST['country'] ?? '';
  

  if (empty($name)) {
    $errors['name'] = "Name is required.";
  } elseif (strlen($name) < 5 || !preg_match('/^[a-zA-Z]{2,}\s[a-zA-Z]{2,}$/', $name)) {
    $errors['name'] = "Name must contain only letters with a single space in between, at least 2 letters each.";
  }
  

  if (empty($email)) {
    $errors['email'] = "Email is required.";
  } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors['email'] = "Please enter a valid email address.";
  } else {

    $existingUser = $db->selectOne("SELECT id FROM users WHERE email = ?", [$email]);
    if ($existingUser) {
      $errors['email'] = "This email is already registered.";
    }
  }
  

  if (empty($password)) {
    $errors['password'] = "Password is required.";
  } elseif (strlen($password) < 8 || !preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/', $password)) {
    $errors['password'] = "Password must be at least 8 characters long and contain at least one uppercase letter, one lowercase letter, and one number.";
  }
  

  if (empty($c_password)) {
    $errors['confirm_password'] = "Confirm Password is required.";
  } elseif ($c_password !== $password) {
    $errors['confirm_password'] = "Passwords do not match.";
  }
  

  if (empty($country)) {
    $errors['country'] = "Please select a country.";
  }
  

  if (!isset($_FILES['cv']) || $_FILES['cv']['error'] === UPLOAD_ERR_NO_FILE) {
    $errors['cv'] = "CV file is required.";
  } elseif ($_FILES['cv']['error'] !== UPLOAD_ERR_OK) {
    switch ($_FILES['cv']['error']) {
      case UPLOAD_ERR_INI_SIZE:
      case UPLOAD_ERR_FORM_SIZE:
        $errors['cv'] = "File is too large. Maximum size is " . ini_get('upload_max_filesize');
        break;
      case UPLOAD_ERR_PARTIAL:
        $errors['cv'] = "The file was only partially uploaded.";
        break;
      default:
        $errors['cv'] = "Error uploading file. Please try again.";
    }
  } else {
    $cv = $_FILES['cv'];
    $allowedTypes = ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
    
    if (!in_array($cv['type'], $allowedTypes)) {
      $errors['cv'] = "Invalid file type. Please upload a PDF or Word document.";
    }
    
    if ($cv['size'] > 5000000) { 
      $errors['cv'] = "File is too large. Maximum size is 5MB.";
    }
  }
  

  if (empty($errors)) {
    try {

      $db->conection->beginTransaction();
      

      $query1 = "INSERT INTO users (name, email, password, country) VALUES (?, ?, ?, ?)";
      $db->insert($query1, [$name, $email, password_hash($password, PASSWORD_DEFAULT), $country]);
      
      $userId = $db->conection->lastInsertId();
      

      $uploadDir = 'C:/xampp/htdocs/my-web/employees-managment/public/assist/cvs';
      
   
      if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
      }
      

      $fileExt = pathinfo($cv['name'], PATHINFO_EXTENSION);
      $safeFilename = $userId . '_' . preg_replace('/[^a-zA-Z0-9_-]/', '', str_replace(' ', '_', $name));
      $filename = $safeFilename . '.' . $fileExt;
      $fullFilePath = $uploadDir . '/' . $filename;
      
      $relativePath = 'http://localhost/my-web/employees-managment/public/assist/cvs/' . $filename;
      
      if (move_uploaded_file($cv['tmp_name'], $fullFilePath)) {
        $query2 = "INSERT INTO cvs (user_id, file_path, file_type) VALUES (?, ?, ?)";
        $db->insert($query2, [$userId, $relativePath, $cv['type']]);
      } else {
        throw new Exception("Failed to upload file.");
      }
      

      $description = "New job request from ," . $name;
      $db->insert('INSERT INTO activity (description, category) VALUES (?, ?)', [$description, 'job_request']);
      

      $db->conection->commit();
      

      $user = $db->selectOne('SELECT id, name, email, country FROM users WHERE id = ?', [$userId]);
      $_SESSION['user'] = $user;
      

      $subject = "Thanks for your job request";
      $message = "Dear $name,\n\nWe hope to see you working with our service!\n\nBest regards,\nThe Team\n\n";
      $headers = "From: tberziad016@gmail.com\r\n";
      $headers .= "Reply-To: tberziad016@gmail.com\r\n";
      $headers .= "X-Mailer: PHP/" . phpversion();
      
      mail($email, $subject, $message, $headers);
      

      header("Location: http://localhost/my-web/employees-managment/public/views/employee/waiting_room.php");
      exit();
      
    } catch (PDOException $e) {

      $db->conection->rollBack();
      

      error_log('Database error: ' . $e->getMessage());
      

      $errorCode = $e->getCode();
      
      switch ($errorCode) {
        case '23000':
          $errors['email'] = "This email is already registered.";
          break;
        default:
          $errors['general'] = "A database error occurred. Please try again later.";
      }
      
    } catch (Exception $e) {

      if ($db->conection->inTransaction()) {
        $db->conection->rollBack();
      }
      

      error_log('Error: ' . $e->getMessage());
      
      $errors['general'] = $e->getMessage();
    }
  }
  

  if (!empty($errors)) {

    unset($old['password']);
    unset($old['confirm_password']);
    

    $_SESSION['errors'] = $errors;
    $_SESSION['old'] = $old;
    
    // Redirect back to form
    header("Location: http://localhost/my-web/employees-managment/public/views/signup.php");
    exit();
  }
}
?>