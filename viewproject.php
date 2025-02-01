<?php include('header.php'); ?>

<?php
// Establish database connection
$con = new mysqli("localhost", "root", "", "hr");

// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// Fetch project data
$s = "SELECT * FROM `project`";
$resource = $con->query($s);

if ($resource->num_rows > 0) {
    echo "<center><h1>HRMS PROJECT DETAILS</h1></center>";
    echo "<table border=1>";
    echo "<tr>";
    echo "<th>Project Id</th>";
    echo "<th>Project Name</th>";
    echo "<th>Project Manager</th>";
    echo "<th>Project Location</th>";
    echo "<th>Action</th>"; // Combine both buttons under one Action column
    echo "</tr>";

    // Loop through and display each project
    while ($row = $resource->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['pid']) . "</td>";
        echo "<td>" . htmlspecialchars($row['pname']) . "</td>";
        echo "<td>" . htmlspecialchars($row['pmgr']) . "</td>";
        echo "<td>" . htmlspecialchars($row['plocation']) . "</td>";
        
        // Combined Action column for both Edit and Delete buttons
        echo "<td>
            <a href='editproject.php?id=" . urlencode($row['pid']) . "' class='btn btn-edit'>Edit</a>
            <a href='pdelete.php?id=" . urlencode($row['pid']) . "' class='btn btn-delete' onclick='return confirmDelete();'>Delete</a>
        </td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "<center><h2>No projects found</h2></center>";
}

$con->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Info</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 10pt;
            background-image: url('HR/image/img.jpg');
            background-size: cover;
            background-attachment: fixed;
            margin: 0;
            padding: 0;
            background-color: white;
        }
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            opacity: 0.95;
        }
        table, th, td {
            border: 1px solid black;
            text-align: center;
        }
        th {
            background-color:  #004085;
            color: white;
            padding: 10px;
        }
        td {
            padding: 10px;
        }
        tr:nth-child(even) {
            background-color: #e8e8e8;
        }
        tr:nth-child(odd) {
            background-color: #B0C4DE;
        }
        /* Button Styling */
        a.btn {
            padding: 8px 12px;
            border-radius: 4px;
            text-decoration: none;
            color: white;
            transition: background-color 0.3s ease;
        }
        /* Specific button colors */
        a.btn-edit {
            background-color: #4CAF50; /* Green */
        }
        a.btn-delete {
            background-color: #f44336; /* Red */
        }
        /* Hover effects */
        a.btn-edit:hover {
            background-color: #45a049;
        }
        a.btn-delete:hover {
            background-color: #e60000;
        }
    </style>
    <script>
        function confirmDelete() {
            return confirm("Are you sure you want to delete this project?");
        }
    </script>
</head>
<body>
    <?php include('footer.php'); ?>
</body>
</html>
