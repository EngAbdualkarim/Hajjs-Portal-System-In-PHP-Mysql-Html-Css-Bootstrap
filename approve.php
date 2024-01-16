
<?php
include 'db.php';

if (isset($_POST['approve'])) {
    $applicationId = $_POST['application_id'];

    // Update the application status to approved
    $sql = "UPDATE applications SET status='Approved' WHERE id='$applicationId'";
    if ($conn->query($sql) === TRUE) {
        echo "Application approved successfully.";
    } else {
        echo "Error: " . $sql . "<br>";
    }
}

header('Location: company.php');
?>