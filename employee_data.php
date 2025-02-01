<?php
// Create a database connection
$con = mysqli_connect("localhost", "root", "", "hr");

// Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['submit'])) {
    // Retrieve and sanitize form data
    $empid = mysqli_real_escape_string($con, $_POST['empid']); 
    $gender = mysqli_real_escape_string($con, $_POST['gender']); 
    $fname = mysqli_real_escape_string($con, $_POST['fname']); 
    $mname = mysqli_real_escape_string($con, $_POST['mname']); 
    $lname = mysqli_real_escape_string($con, $_POST['lname']); 
    $bdate = mysqli_real_escape_string($con, $_POST['bdate']); 
    $marital = mysqli_real_escape_string($con, $_POST['marital']); 
    $mnumber = mysqli_real_escape_string($con, $_POST['mnumber']); 
    $address1 = mysqli_real_escape_string($con, $_POST['address1']); 
    $address2 = mysqli_real_escape_string($con, $_POST['address2']); 
    $address3 = mysqli_real_escape_string($con, $_POST['address3']); 
    $state = mysqli_real_escape_string($con, $_POST['state']); 
    $city = mysqli_real_escape_string($con, $_POST['city']); 
    $aadharcard = mysqli_real_escape_string($con, $_POST['aadharcard']); 
    $joindate = mysqli_real_escape_string($con, $_POST['joindate']); 
    $leavedate = mysqli_real_escape_string($con, $_POST['leavedate']); 
    $status = mysqli_real_escape_string($con, $_POST['status']); 
    $role = mysqli_real_escape_string($con, $_POST['role']); 
    $position = mysqli_real_escape_string($con, $_POST['position']); 
    $email = mysqli_real_escape_string($con, $_POST['email']); 
    $password = mysqli_real_escape_string($con, $_POST['password']); 
    $Salary = mysqli_real_escape_string($con, $_POST['Salary']); 

    // Handle file upload
    $pfimg = '';
    if (isset($_FILES['pfimg']) && $_FILES['pfimg']['error'] == 0) {
        $upload_dir = 'uploads/';
        $pfimg = uniqid() . '-' . basename($_FILES['pfimg']['name']); // Unique file name
        $target_file = $upload_dir . $pfimg;

        // Check if the file is an image
        $check = getimagesize($_FILES['pfimg']['tmp_name']);
        if ($check !== false) {
            if (move_uploaded_file($_FILES['pfimg']['tmp_name'], $target_file)) {
                // File is uploaded successfully
            } else {
                die("Sorry, there was an error uploading your file.");
            }
        } else {
            die("File is not an image.");
        }
    }

    // Hash the password
   // $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // Prepare an SQL statement
    $sql = "INSERT INTO `employees_data` (`EmployeeId`, `ProfileImage`, `FirstName`, `MiddleName`, `LastName`, `Birthdate`, `Gender`, `Address1`, `Address2`, `Address3`, `State`,`City`, `Mobile`, `Email`, `Password`, `AadharNumber`, `MaritalStatus`, `PositionId`, `JoinDate`, `LeaveDate`, `StatusId`, `RoleId`, `Salary`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?,?,?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($con, $sql);

    // Bind parameters
    mysqli_stmt_bind_param($stmt, 'sssssssssssssssssssssss', $empid, $pfimg, $fname, $mname, $lname, $bdate, $gender, $address1, $address2, $address3,$state, $city, $mnumber, $email, $password, $aadharcard, $marital, $position, $joindate, $leavedate, $status, $role, $Salary);

    // Execute the statement
    if (mysqli_stmt_execute($stmt)) {
        echo "New employee added successfully";
        header("Location: employeeadd.php");
        exit();
    } else {
        echo "Error: " . mysqli_stmt_error($stmt);
    }

    // Close the statement and connection
    mysqli_stmt_close($stmt);
    mysqli_close($con);
}
?>
