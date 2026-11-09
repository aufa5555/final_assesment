<?php
session_start();
 
// Already logged in -> go to records page
if (isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] === true) {
    header("Location: index.php");
    exit();
}
 
// IMPORTANT: include db.php FIRST, because db.php also uses a variable called
// $password (for the database password). If it were included after reading the
// form, it would overwrite the password typed by the user with "".
include 'db.php';
 
$error = "";
 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
 
    $id         = trim($_POST['id']);
    $name       = trim($_POST['name']);
    $email      = trim($_POST['email']);
    $input_pass = $_POST['password'];
 
    $sql  = "SELECT * FROM users WHERE id = ? AND name = ? AND email = ? AND password = ?";
    $stmt = $conn->prepare($sql);
 
    if ($stmt) {
        $stmt->bind_param("isss", $id, $name, $email, $input_pass);
        $stmt->execute();
        $result = $stmt->get_result();
 
        if ($result && $result->num_rows > 0) {
            session_regenerate_id(true);
            $_SESSION['user_logged_in'] = true;
            $_SESSION['user_id']        = $id;
            $_SESSION['user_name']      = $name;
            $_SESSION['user_email']     = $email;
 
            header("Location: index.php");
            exit();
        } else {
            $error = "Invalid ID, Name, Email or Password!";
        }
        $stmt->close();
    } else {
        $error = "Database query failed: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Student Grading System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f2f2f2;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }
        .login-box {
            background: white;
            padding: 35px;
            width: 350px;
            border-radius: 12px;
            box-shadow: 0 0 12px #ccc;
        }
        h2 { text-align: center; color: #333; }
        p  { text-align: center; color: #555; }
        input {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        button {
            width: 100%;
            padding: 12px;
            background: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
        }
        button:hover { background: #0056b3; }
        .error { color: red; text-align: center; }
    </style>
</head>
<body>
 
<div class="login-box">
    <h2>Student Grading System</h2>
    <p>Please enter your details</p>
 
    <?php if ($error != ""): ?>
        <p class="error"><?php echo htmlspecialchars($error); ?></p>
    <?php endif; ?>
 
    <form method="POST" action="login.php">
        <input type="number" name="id" placeholder="Enter ID" required>
        <input type="text" name="name" placeholder="Enter Name" required>
        <input type="email" name="email" placeholder="Enter Email" required>
        <input type="password" name="password" placeholder="Enter Password" required>
        <button type="submit">Login</button>
    </form>
</div>
 
</body>
</html>