
<?php
include 'db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hajj Application</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

  <style>
  
  .navbar {
   background-color: #333; 
   overflow: hidden; 
   display: flex; 
   justify-content: center; 
  }
  .navbar a {
   color: white; 
   text-align: center; 
   padding: 14px 16px;
   text-decoration: none; 
   font-size: 20px; 
  }
  .active {
   background-color: #4CAF50;
  }

        /* Add custom styles here */
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 50px;
            width: 50%;
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
            margin-bottom: 15px;
        }
        label {
          padding-left: 5px;
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
<div class="navbar">
  <a href="updateform_application.php" class="active">Update Info</a>
  <a href="index.php">LogOut</a>
 </div>
<center>
<div class="container">
  <h2>Hajj Application</h2>
  <form action="updateform_application.php" method="post">
  <div class="form-group">
    <label for="pilgrim_id">Iqama Number:</label>
    <input type="text" name="pilgrim_id" id="pilgrim_id" required><br><br>
    <label for="first_name">First Name(s) and Surname:</label>
    <input type="text" name="first_name" id="first_name" required><br><br>
    <label for="dob">Date of Birth:</label>
    <input type="date" name="dob" id="dob" required><br><br>
    <label for="contact_number">Contact Number:</label>
    <input type="text" name="contact_number" id="contact_number" required><br><br>
    <label for="companions">Companions:</label>
    <input type="text" name="companions" id="companions" required><br><br>
    <label for="package_company">Package Company:</label>
    <select name="package_company" id="package_company">
    <option value="Hijj">Hijj</option>
      <option value="Omra">Omra</option>
      <option value="Hijj2">Hijj2</option>
    </select><br><br>
    <input type="submit" value="Update Application" name="submit">
  </div>
  <?php
if(isset($_POST['submit'])){
    include 'db.php';
  
    $pilgrim_id = $_POST["pilgrim_id"];
    $first_name = $_POST["first_name"];
    $dob = $_POST["dob"];
    $contact_number = $_POST["contact_number"];
    $companions = $_POST["companions"];
    $package_company = $_POST["package_company"];
  
    // Data validation
    if (strlen($contact_number) !== 14 || strpos($contact_number, "00966") !== 0) {
      echo '<div class="alert alert-danger">Invalid contact number. It should start with "00966" and be 14 characters long.</div>';
      exit;
    }
  
    // Update the application in the database using prepared statements
    $stmt = $conn->prepare("UPDATE applications SET first_name=?, dob=?, contact_number=?, companions=?, package_company=? WHERE pilgrim_id=?");
    $stmt->bind_param("ssssss", $first_name, $dob, $contact_number, $companions, $package_company, $pilgrim_id);
  
    if ($stmt->execute()) {
      echo '<div class="alert alert-success">Application updated successfully.</div>';
    } else {
      echo '<div class="alert alert-danger">Error: ' . $stmt->error . '</div>';
    }
  
    $stmt->close();
    $conn->close();
}
?>
  </form>
</div>
  </center>


<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
 
</body>
</html>