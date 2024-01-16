<?php
include 'db.php';

// Retrieve the list of company names from the database
$sql = "SELECT DISTINCT package_company FROM applications";
$result = $conn->query($sql);
$companies = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $companies[] = $row['package_company'];
    }
}

// Handle form submission
if (isset($_POST['submit'])) {
    $selectedCompany = $_POST['company'];

    // Retrieve the applications for the selected company
    $sql = "SELECT * FROM applications WHERE package_company = '$selectedCompany'";
    $result = $conn->query($sql);

    // Display the records in a table
    if ($result->num_rows > 0) {
        echo '<table class="table">';
        echo '<thead><tr><th>ID</th><th>Pilgrim ID</th><th>First Name</th><th>Date of Birth</th><th>Contact Number</th><th>Companions</th><th>Package Company</th><th>Actions</th></tr></thead>';
        echo '<tbody>';
        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . $row['id'] . '</td>';
            echo '<td>' . $row['pilgrim_id'] . '</td>';
            echo '<td>' . $row['first_name'] . '</td>';
            echo '<td>' . $row['dob'] . '</td>';
            echo '<td>' . $row['contact_number'] . '</td>';
            echo '<td>' . $row['companions'] . '</td>';
            echo '<td>' . $row['package_company'] . '</td>';
            echo '<td>
                      <form action="approve.php" method="post" class="d-inline">
                          <input type="hidden" name="application_id" value="' . $row['id'] . '">
                          <button type="submit" class="btn btn-success" name="approve">Approve</button>
                      </form>
                      <form action="reject.php" method="post" class="d-inline">
                          <input type="hidden" name="application_id" value="' . $row['id'] . '">
                          <button type="submit" class="btn btn-danger" name="reject">Reject</button>
                      </form>
                  </td>';
            echo '</tr>';
        }
        echo '</tbody></table>';
    } else {
        echo '<p class="mt-4">No records found for the selected company.</p>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Company Applications</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2 class="mt-4">Select a Company</h2>
        <form action="company.php" method="post" class="mt-4">
            <div class="mb-3">
                <label for="company" class="form-label">Company:</label>
                <select name="company" id="company" class="form-select">
                    <?php
                    foreach ($companies as $company) {
                        echo '<option value="' . $company . '">' . $company . '</option>';
                    }
                    ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Show Applications</button>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>