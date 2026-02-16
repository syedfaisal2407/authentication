<?php
session_start();
require "db_connection.php";

// If already logged in, redirect
if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit();
}

function error_alert($message){
    echo "
    <script>
        alert('$message');
        window.location.href='registration.php';
    </script>";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // Check if email already exists
    $check_stmt = $con->prepare("SELECT id FROM users WHERE email = ?");
    $check_stmt->bind_param("s", $email);
    $check_stmt->execute();
    $check_stmt->store_result();

    if ($check_stmt->num_rows > 0) {
        $check_stmt->close();
        error_alert("Email already registered. Please use another email.");
        exit();
    }
    $check_stmt->close();

    // Hash password securely
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $con->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $hashed_password);

    if ($stmt->execute()) {
        echo "
        <script>
            alert('Registration successful! Please Log In');
            window.location.href='login.php';
        </script>";
    } else {
        // In case UNIQUE constraint triggers
        error_alert("Registration failed. Email may already exist.");
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>CSCI 4060</title>
  <link rel="stylesheet" href="custom_style.css">
</head>
<body>
  <div id="content_div">
    <h1>Insert New User</h1>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
      <input type="text" name="name" placeholder="Enter your name" required><br><br>
      <input type="email" name="email" placeholder="Enter your email" required><br><br>
      <input type="password" name="password" placeholder="Enter preferred password" required><br><br>
      <input type="submit" id="submit_btn" name="register_in_btn" value="Register">
    </form>
    <h3>Already a user? <a href='login.php'> Log In Here!</a></h3>
  </div>
</body>
</html>
