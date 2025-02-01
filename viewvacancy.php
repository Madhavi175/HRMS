<?php include('header.php'); 
// Database connection using mysqli
$mysqli = new mysqli("localhost", "root", "", "hr");

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Query to fetch data
$query = "SELECT * FROM `vacancy`";
$result = $mysqli->query($query);

if ($result->num_rows > 0) {
    echo "<center><h1>HRMS VACANCY DETAILS</h1></center>";

    echo "<table>";
    echo "<tr>";
    echo "<th>Vacancy Id</th>";
    echo "<th>Vacancy Name</th>";
    echo "<th>Issue Date</th>";
    echo "<th>Expiry Date</th>";
    echo "<th>For Post</th>";
    echo "<th>Degree Required</th>";
    echo "<th>Action</th>"; // Changed the column header to "Action"
    echo "</tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>{$row['vid']}</td>";
        echo "<td>{$row['vname']}</td>";
        echo "<td>{$row['vidate']}</td>";
        echo "<td>{$row['vedate']}</td>";
        echo "<td>{$row['vpreq']}</td>";
        echo "<td>{$row['vdreq']}</td>";

        // Combined Edit and Delete buttons in one column with button style
        echo "<td>
                <a href='vedit.php?id={$row['vid']}' class='btn btn-edit'>Edit</a>
                <a href='vdelete.php?id={$row['vid']}' class='btn btn-delete' onclick='return confirm(\"Are you sure you want to delete this vacancy?\");'>Delete</a>
              </td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "<p>No vacancies found.</p>";
}

// Close connection
$mysqli->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Vacancy Info</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 10pt;
            background-image: url('HR/image/img.jpg');
            background-size: cover;
            background-attachment: fixed;
            background-color: white;
        }
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
            opacity: 0.95;
        }
        th, td {
            padding: 10px;
            text-align: center;
        }
        th {
            background-color:  #004085;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #e8e8e8;
        }
        tr:nth-child(odd) {
            background-color: #B0C4DE;
        }
        /* Button Styling */
        .btn {
            padding: 8px 12px;
            border: none;
            color: white;
            text-decoration: none;
            font-size: 12px;
            border-radius: 4px;
            margin: 0 5px;
            transition: background-color 0.3s ease;
        }
        .btn-edit {
            background-color: #4CAF50; /* Green */
        }
        .btn-delete {
            background-color: #f44336; /* Red */
        }
        /* Hover Effects */
        .btn-edit:hover {
            background-color: #45a049;
        }
        .btn-delete:hover {
            background-color: #e60000;
        }
    </style>
</head>
<body>

<?php include('footer.php'); ?>

</body>
</html>
