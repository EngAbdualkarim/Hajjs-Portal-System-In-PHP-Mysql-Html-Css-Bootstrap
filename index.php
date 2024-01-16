



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hajj Application Portal</title>
    <!-- Add Bootstrap CSS -->
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
    <h2>Pilgrim Sign Up</h2>
    <form action="index.php" method="post">
      <div class="form-group">
        <label for="username">Username:</label>
        <input type="text" class="form-control" name="username" id="username" required>
      </div>
      <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" class="form-control" name="password" id="password" required>
      </div>
      <input type="submit" class="btn btn-primary" value="Sign Up" name="submit">
      <a href="login.php">Log In</a>
    <a href="company.php">Company</a>
      <?php

include 'db.php';

if(isset($_POST['submit'])){
  // Get the input data
  $username = $_POST["username"];
  $password = $_POST["password"];

  // Data validation with regular expression
  $usernamePattern = '/^[a-zA-Z0-9_]{3,20}$/';
  if (!preg_match($usernamePattern, $username)) {
    echo '<div class="alert alert-danger">Invalid username format. It should contain 3-20 characters and only include letters, numbers, and underscores.</div>';
    exit;
  }

  if (empty($username) || empty($password)) {
    echo '<div class="alert alert-danger">Username and password are required.</div>';
    exit;
  }

  if (strlen($password) < 8) {
    echo '<div class="alert alert-danger">Invalid password length. It should be at least 8 characters.</div>';
    exit;
  }

  // Check if the Pilgrim already exists
  $checkStmt = $conn->prepare("SELECT * FROM pilgrims WHERE username = ?");
  $checkStmt->bind_param("s", $username);
  $checkStmt->execute();
  $result = $checkStmt->get_result();

  if ($result->num_rows > 0) {
    echo '<div class="alert alert-danger">Pilgrim already exists with the same username.</div>';
    exit;
  }

  // Insert the new user into the database using prepared statements
  $stmt = $conn->prepare("INSERT INTO pilgrims (username, password) VALUES (?, ?)");
  $stmt->bind_param("ss", $username, $password);

  if ($stmt->execute()) {
    echo '<div class="alert alert-success">User created successfully.</div>';
  } else {
    echo '<div class="alert alert-danger">Error: ' . $stmt->error . '</div>';
  }

  $stmt->close();
  $checkStmt->close();
  $conn->close();

  header('location:index.php');
}

?>


    </form>
    
  </div>



 
  <!-- Add Bootstrap JS (Optional) -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>