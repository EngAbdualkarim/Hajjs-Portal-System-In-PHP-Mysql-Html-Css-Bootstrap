<?php
include 'db.php';

if (isset($_POST['reject'])) {
    $applicationId = $_POST['application_id'];

    // Update the application status to rejected
    $sql = "UPDATE applications SET status='Rejected' WHERE id='$applicationId'";
    if ($conn->query($sql) === TRUE) {
        echo "Application rejected successfully.";
    } else {
        echo "Error: " . $sql . "<br>";
    }
}

header('Location: company.php');
?>