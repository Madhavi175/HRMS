<?php include('header.php'); ?>
<?php
  include_once('controller/connect.php');
  
  $dbs = new database();
  $db = $dbs->connection();
  $TotalEmp = mysqli_query($db, "select count(EmployeeId) as emp from employee where Role !='1' ");
  $TotalEmploId = mysqli_fetch_assoc($TotalEmp);
  $pandingleave = mysqli_query($db, "select count(LeaveStatus) as pleave from leavedetails where LeaveStatus='Pending'");
  $tpandingleave = mysqli_fetch_assoc($pandingleave);
  $result = mysqli_query($db, "SELECT * FROM project");
  $num_rows = mysqli_num_rows($result);
  $vacancy = mysqli_query($db, "SELECT * FROM vacancy");
  $res = mysqli_num_rows($vacancy);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    <style>
/* General Body Styling */
body {
    background-color: white;
    color: black;
    font-family: 'Arial', sans-serif;
    margin: 0;
    padding: 0;
}

/* Navbar Styles */
.navbar {
    background-color: #6A5ACD;
    border-radius: 8px;
    padding: 10px;
    margin-bottom: 20px;
    justify-content: center;
    width: 1250%;
    margin-left: -18%;
    box-sizing: border-box;
}

.navbar a {
    color: white;
    text-decoration: none;
    font-size: 16px;
    font-weight: bold;
    margin-left: 370px;
}

.navbar a:hover {
    color: darkturquoise;
}

/* Container Styles */
.container {
    margin: 20px auto;
    width: 95%;
    max-width: 1200px;
}

/* Card Styling */
.card {
    background-color: white;
    color: black;
    border-radius: 12px;
    margin-bottom: 20px;
    border: 1px solid #ddd;
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s, box-shadow 0.3s;
    position: relative;
    overflow: hidden;
}

.card:hover {
    transform: translateY(-10px);
    box-shadow: 0 12px 24px rgba(0, 0, 0, 0.2);
}

/* Icon Styling */
.icon {
    font-size: 50px;
    color: gray;
    margin-bottom: 15px;
    transition: color 0.3s;
}

.icon:hover {
    color: darkturquoise;
}

/* Card Text Styling */
h3 {
    font-size: 18px;
    font-weight: bold;
    margin-bottom: 10px;
    color: #333;
}

h4 {
    font-size: 26px;
    color: #6A5ACD;
    font-weight: bold;
}

/* Shapes Styling */
.card::before, .card::after {
    content: '';
    position: absolute;
    width: 150px;
    height: 150px;
    border-radius: 50%;
    background-color: rgba(106, 90, 205, 0.15);
    opacity: 0;
    transition: opacity 0.5s, transform 0.5s;
}

.card::before {
    bottom: -40px;
    right: -40px;
    transition: transform 0.5s ease-in-out, opacity 0.5s;
}

.card::after {
    top: -40px;
    left: -40px;
    background-color: rgba(0, 206, 209, 0.15); /* Light turquoise */
}

.card:hover::before, .card:hover::after {
    opacity: 1;
    transform: scale(1.2);
}

/* Adding Additional Shapes */
.card .shape-square {
    position: absolute;
    top: 10px;
    right: 10px;
    width: 50px;
    height: 50px;
    background-color: rgba(255, 69, 0, 0.2); /* Orange square */
    transform: rotate(45deg); /* Diagonal square */
    z-index: 0;
    opacity: 0;
    transition: opacity 0.5s, transform 0.5s ease-in-out;
}

.card .shape-triangle {
    position: absolute;
    bottom: 20px;
    left: 20px;
    width: 0;
    height: 0;
    border-left: 30px solid transparent;
    border-right: 30px solid transparent;
    border-bottom: 50px solid rgba(0, 255, 127, 0.2); /* Light green triangle */
    z-index: 0;
    opacity: 0;
    transition: opacity 0.5s, transform 0.5s ease-in-out;
}

/* Show the shapes on hover */
.card:hover .shape-square, .card:hover .shape-triangle {
    opacity: 1;
    transform: scale(1.2);
}

/* Card Body */
.card-body {
    padding: 2rem;
    text-align: center;
    position: relative;
    z-index: 1; /* Ensure content is above the shapes */
}

/* Responsive Design */
@media (max-width: 768px) {
    .col-md-3 {
        flex: 0 0 100%;
        max-width: 100%;
    }
}

/* Horizontal Line Styling */
.line {
    border: 0;
    border-top: 5px solid #6A5ACD;
    margin: 29px 0;
    margin-right: -20px;
    color: #6A5ACD;
}

/* Button Styling */
.btn-todo {
    display: block;
    width: 200px;
    margin: 20px auto;
    padding: 10px 20px;
    text-align: center;
    background-color: #6A5ACD;
    color: white;
    border: none;
    margin-left: 4px;
    border-radius: 5px;
    font-size: 16px;
    font-weight: bold;
    cursor: pointer;
    text-decoration: none;
}

.btn-todo:hover {
    background-color: darkturquoise;
}



    </style>
</head>
<body>
    <!-- Sidebar (if any) -->

    <!-- Navigation Bar -->
    <nav class="navbar">
      <a href="employeeview.php" class="nav-link">EMPLOYEE</a>
        <a href="viewproject.php" class="nav-link">PROJECT</a>
        <a href="" class="nav-link">COMPLIANCE</a>
        <!-- Add more links as needed -->
      
    </nav>

    <!-- Dashboard Cards -->
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <a href="employeeview.php">
                    <div class="card">
                        <div class="card-body">
                            <div class="icon">
                                <i class="fa fa-users" aria-hidden="true"></i>
                            </div>
                            <h3>Employee</h3>
                            <h4><?php echo isset($TotalEmploId['emp']) ? $TotalEmploId['emp'] : ""; ?></h4>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3">
                <a href="leaverequest.php">
                    <div class="card">
                        <div class="card-body">
                            <div class="icon">
                                <i class="fa fa-calendar-alt" aria-hidden="true"></i>
                            </div>
                            <h3>Leave Request</h3>
                            <h4><?php echo isset($tpandingleave['pleave']) ? $tpandingleave['pleave'] : ""; ?></h4>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3">
                <a href="viewproject.php">
                    <div class="card">
                        <div class="card-body">
                            <div class="icon">
                                <i class="fa fa-tasks" aria-hidden="true"></i>
                            </div>
                            <h3>Projects</h3>
                            <h4><?php echo $num_rows; ?></h4>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3">
                <a href="viewvacancy.php">
                    <div class="card">
                        <div class="card-body">
                            <div class="icon">
                                <i class="fa fa-briefcase" aria-hidden="true"></i>
                            </div>
                            <h3>Vacancies</h3>
                            <h4><?php echo $res; ?></h4>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <!-- Horizontal Line -->
        <hr class="line">

        <!-- Calendar Button -->
        <a href="todo.php" class="btn-todo">Open TO DO LIST</a>
    </div>

    <hr>

    <?php include('footer.php'); ?>

    <script src="js/jquery-2.1.4.min.js"></script>
    <!-- Popper.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    <script>
        // Function to close sidebar if it exists
        function closeSidebar() {
            // Add your logic to close the sidebar
        }

        // Attach click event to navbar links to close the sidebar
        document.querySelectorAll('.navbar a').forEach(link => {
            link.addEventListener('click', closeSidebar);
        });
    </script>
    
</body>
</html>
