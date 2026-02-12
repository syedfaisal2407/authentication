
<?php
  session_start();
  if (!isset($_SESSION['user_id']))
   {
    header("Location:Login.php");
    exit();
       }
  
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if($_POST['log_out_btn']){
      session_unset();
      session_destroy();
      
      
      header("Location: login.php");
      exit();
    }
  }
$name = $_SESSION['user_name'] ?? '';
$email = $_SESSION['user_email'] ?? '';
?>


<!DOCTYPE html>
<html>
<head>
  <title>CSCI 6040</title>
  <link rel="stylesheet" href="custom_style.css">
</head>
<body>
  <div id="content_div">
    <h1>Welcome to CSCI 6040</h1>
    <h2>Dashboard Under-contstruction</h2>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <p><b>User:</b> <?php echo htmlspecialchars($name); ?></p>
    <p><b>Email:</b> <?php echo htmlspecialchars($email); ?></p>

    <p>No content present yet!</p>
      <input type="submit" id="submit_btn" name="log_out_btn" value="Log Out">
    </form>
  </div>
</body>
</html>
