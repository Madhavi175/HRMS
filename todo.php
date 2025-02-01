<?php
ob_start(); // Start output buffering

include('header.php');
include_once('controller/connect.php');

$dbs = new database();
$db = $dbs->connection();

// Handle adding a new to-do item
if (isset($_POST['add_todo'])) {
    $task = mysqli_real_escape_string($db, $_POST['task']);
    $date = mysqli_real_escape_string($db, $_POST['date']);
    $time = mysqli_real_escape_string($db, $_POST['time']);
    
    if ($task && $date && $time) {
        $datetime = $date . ' ' . $time;
        $query = "INSERT INTO todo_list (task, datetime, status) VALUES ('$task', '$datetime', 'Pending')";
        mysqli_query($db, $query);
        echo "<script>alert('To-Do item added successfully!');</script>";
    } else {
        echo "<script>alert('Please fill all fields.');</script>";
    }
}

// Handle deleting a to-do item
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $query = "DELETE FROM todo_list WHERE id = $id";
    mysqli_query($db, $query);
    echo "<script>alert('To-Do item deleted successfully!');</script>";
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

// Handle marking a to-do item as done or pending
if (isset($_GET['mark_done'])) {
    $id = (int)$_GET['mark_done'];
    $query = "UPDATE todo_list SET status = 'Done' WHERE id = $id";
    mysqli_query($db, $query);
    echo "<script>alert('To-Do item marked as Done!');</script>";
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

if (isset($_GET['mark_pending'])) {
    $id = (int)$_GET['mark_pending'];
    $query = "UPDATE todo_list SET status = 'Pending' WHERE id = $id";
    mysqli_query($db, $query);
    echo "<script>alert('To-Do item marked as Pending!');</script>";
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

// Fetch to-do list items
$result = mysqli_query($db, "SELECT * FROM todo_list ORDER BY datetime DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To Do List</title>
    <style>
        body {
            background-color: #f4f4f4;
            color: black;
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            margin: 20px auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
        }

        .form-group input, .form-group textarea, .form-group select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .btn-primary {
            background-color: #6A5ACD;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
        }

        .btn-primary:hover {
            background-color: darkturquoise;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #6A5ACD;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .btn-status {
            margin-right: 10px;
            text-decoration: none;
        }

        .btn-status img {
            vertical-align: middle;
        }

        .btn-delete {
            color: red;
            text-decoration: none;
        }

        .btn-delete img {
            vertical-align: middle;
        }

        .btn-delete:hover {
            text-decoration: underline;
        }

        .scrollable-container {
            max-height: 500px;
            overflow-y: auto;
            padding: 10px;
            background: #fff;
            border-radius: 4px;
            border: 1px solid #ddd;
            margin-top: 10px;
        }
    </style>
</head>
<body>
<div class="scrollable-container">
    <div class="container">
        <h2>Add New To-Do Item</h2>
        <form method="POST">
            <div class="form-group">
                <label for="task">Task</label>
                <input type="text" name="task" id="task" required>
            </div>
            <div class="form-group">
                <label for="date">Date</label>
                <input type="date" name="date" id="date" required>
            </div>
            <div class="form-group">
                <label for="time">Time</label>
                <input type="time" name="time" id="time" required>
            </div>
            <button type="submit" name="add_todo" class="btn-primary">Add Task</button>
        </form>

        <h2>To-Do List</h2>
        <table>
            <thead>
                <tr>
                    <th>Task</th>
                    <th>Date & Time</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?php echo htmlspecialchars($row['task']); ?></td>
            <td><?php echo htmlspecialchars($row['datetime']); ?></td>
            <td>
                <?php
                if ($row['status'] == 'Done') {
                    echo '<img src="https://img.icons8.com/material-rounded/24/4CAF50/thumb-up.png" alt="Done">';
                } elseif ($row['status'] == 'Pending') {
                    echo '<img src="https://img.icons8.com/material-rounded/24/F44336/thumb-down.png" alt="Pending">';
                }
                ?>
            </td>
            <td>
                <?php if ($row['status'] == 'Pending') { ?>
                    <a href="?mark_done=<?php echo $row['id']; ?>" class="btn-status" title="Mark as Done">
                        <img src="https://img.icons8.com/ios-filled/20/4CAF50/thumbs-up.png" alt="Done">
                    </a>
                <?php } else { ?>
                    <a href="?mark_pending=<?php echo $row['id']; ?>" class="btn-status" title="Mark as Pending">
                        <img src="https://img.icons8.com/ios-filled/20/F44336/thumbs-down.png" alt="Pending">
                    </a>
                <?php } ?>
                <a href="?delete=<?php echo $row['id']; ?>" class="btn-delete" title="Delete">
                    <img src="https://img.icons8.com/ios-filled/20/F44336/delete.png" alt="Delete">
                </a>
            </td>
        </tr>
    <?php } ?>
</tbody>

        </table>
    </div>

    <?php include('footer.php'); ?>
</div>

<?php
ob_end_flush(); // End output buffering and flush output
?>
</body>
</html>
