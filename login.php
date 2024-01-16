




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Add custom styles here */
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 50px;
            width: 400px;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            margin-bottom: 30px;
        }
        form {
            margin-bottom: 20px;
        }
        label {
            font-weight: bold;
        }
        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ced4da;
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            border: none;
            color: #fff;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #0069d9;
        }
        a {
            display: block;
            text-align: center;
        }
    </style>

 
</head>
<body>
<div class="container">
<h2>Pilgrim Sign In</h2>
  <form action="login.php" method="post">
    
    <label for="username">Username:</label>
    <input type="text" name="username" id="username" required><br><br>

    <label for="password">Password:</label>
    <input type="password" name="password" id="password" required><br><br>
    <input type="submit" value="Sign In" name="submit">
    
    <?php

include 'db.php';

if(isset($_POST['submit'])){
  // Get the input data
  $username = $_POST["username"];
  $password = $_POST["password"];

  // Prepare the SQL statement using a prepared statement
  $stmt = $conn->prepare("SELECT * FROM pilgrims WHERE username=? AND password=?");
  $stmt->bind_param("ss", $username, $password);
  $stmt->execute();

  // Get the result
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $id = $row['id'];
    // User exists, redirect to the application page
    header("Location: application.php?id=$id");
    exit;
  } else {
    echo '<div class="alert alert-danger">Invalid username or password.</div>';
    header('location:login.php');
    exit;
  }
  
  $stmt->close();
  $conn->close();
}
?>
  <a href="index.php">Sign Up</a>
    <a href="company.php">Company</a> 
  </form> 
 
</div>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>