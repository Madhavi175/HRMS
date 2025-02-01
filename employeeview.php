<?php include('header.php'); ?>
<?php
    include_once('controller/connect.php');

    $dbs = new database();
    $db = $dbs->connection();

    $page = "";
    $RecordeLimit = 10;

    if (isset($_GET['search'])) {
        $SearchName = mysqli_real_escape_string($db, $_GET['search']);
        
        $search = mysqli_query($db, "
            SELECT COUNT(EmployeeId) AS total 
            FROM employees_data 
            WHERE RoleId != '1' 
              AND (FirstName LIKE '%$SearchName%' 
              OR MiddleName LIKE '%$SearchName%' 
              OR LastName LIKE '%$SearchName%' 
              OR EmployeeId LIKE '%$SearchName%')
        ");
        
        $SName = mysqli_fetch_array($search);
        $number_of_row = ceil($SName['total'] / $RecordeLimit);
        $current_page = isset($_GET['bn']) && intval($_GET['bn']) <= $number_of_row && intval($_GET['bn']) != 0 ? intval($_GET['bn']) : 1;
        $Skip = ($current_page * $RecordeLimit) - $RecordeLimit;
        
        $sql = mysqli_query($db, "
            SELECT * 
            FROM employees_data 
            WHERE RoleId != '1' 
              AND (FirstName LIKE '%$SearchName%' 
              OR MiddleName LIKE '%$SearchName%' 
              OR LastName LIKE '%$SearchName%' 
              OR EmployeeId LIKE '%$SearchName%') 
            LIMIT $Skip, $RecordeLimit
        ");
        
        for ($i = 0; $i < $number_of_row; $i++) {
            $d = $i + 1;
            $page .= "<a href='?search=$SearchName&bn=$d'>$d</a>&nbsp;&nbsp;&nbsp;";
        }
    } else if (isset($_GET['empid'])) {
        $empid = mysqli_real_escape_string($db, $_GET['empid']);
        mysqli_query($db, "DELETE FROM employees_data WHERE EmployeeId='$empid'");
        echo "<script>window.location='employeeview.php';</script>";
    } else {
        $search = mysqli_query($db, "SELECT COUNT(EmployeeId) AS total FROM employee");
        $SName = mysqli_fetch_array($search);
        $number_of_row = ceil($SName['total'] / $RecordeLimit);
        $current_page = isset($_GET['bn']) && intval($_GET['bn']) <= $number_of_row && intval($_GET['bn']) != 0 ? intval($_GET['bn']) : 1;
        $Skip = ($current_page * $RecordeLimit) - $RecordeLimit;
        
        $sql = mysqli_query($db, "SELECT * FROM employees_data WHERE RoleId != '1' LIMIT $Skip, $RecordeLimit");
        
        for ($i = 0; $i < $number_of_row; $i++) {
            $d = $i + 1;
            $page .= "<a href='?bn=$d'>$d</a>&nbsp;&nbsp;&nbsp;";
        }
    }
?>
<link rel="stylesheet" type="text/css" href="css/table-style.css" />
<script type="text/javascript" src="js/jquery.basictable.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
      $('#table').basictable();
    });
</script>
<style>
    .w3l-table-info h2{
        color: DodgerBlue;
        /* background-color: rgb(32, 178, 170); */
        text-align: center;
            font-weight: 500;
            margin-bottom: 10px;
            font-size: 27px;
            letter-spacing: 1px;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
            position: relative;
            padding-bottom: 10px;
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
<ol class="breadcrumb" style="margin: 10px 0px !important;">
    <li class="breadcrumb-item"><a href="Home.php">Home</a><i class="fa fa-angle-right"></i>Employee<i class="fa fa-angle-right"></i>Employee View</li>
</ol>
<div class="scrollable-container">
<div class="validation-system" style="margin-top: 0;">
    <div class="validation-form">
        <div class="w3l-table-info">
            <center>
                <h2><b>Employee View</b></h2>
                <center>
            <br>
            <form method="GET" action="#" class="form-inline" style="display: flex; justify-content: flex-end;">
                <input type="text" name="search" value="<?php echo(isset($SearchName))?$SearchName:''; ?>" placeholder="Search" class="form-control w-25 mr-2">
                <button type="submit" name="searchview" class="btn btn-primary">
                    <i class="fa fa-search"></i> Search
                </button>
            </form>
            <table id="table" class="table table-striped table-hover mt-4">
                <thead class="thead-dark" >
                    <tr>
                        <th style=" color:white; background-color:   #004085;">Profile Photo</th>
                        <th style=" color:white; background-color:   #004085;">Name</th>
                        <th class="text-center" style="  color:white; background-color:  #004085;">Employee Id</th>
                        <th class="text-center" style=" color:white;  background-color:   #004085;">Full Detail</th>
                    </tr>
                </thead>
                <tbody>
<?php while($row = mysqli_fetch_assoc($sql)) { ?>
    <tr>
        <td style="width: 140px;">
            <img 
                alt="<?php 
                    // Construct the full name for the alt attribute
                    $fname = isset($row['FirstName']) ? $row['FirstName'] : ''; 
                    $mname = isset($row['MiddleName']) ? $row['MiddleName'] : ''; 
                    $lname = isset($row['LastName']) ? $row['LastName'] : ''; 
                    echo ucfirst($fname) . " " . ucfirst($mname) . " " . ucfirst($lname); 
                ?>" 
                src="<?php 
                    // Check if the profile image exists in the database
                    if (!empty($row['ProfileImage']) && file_exists('uploads/' . $row['ProfileImage'])) {
                        echo 'uploads/' . $row['ProfileImage'];
                    } else {
                        // Use a default image if no profile image is available
                        echo 'image/default.png'; 
                    }
                ?>" 
                class="img-thumbnail profile-img" 
                style="width: 100px; height: 100px;"
            >
        </td>
        <td>
            <?php 
                // Display the full name
                echo ucfirst($fname) . " " . ucfirst($mname) . " " . ucfirst($lname); 
            ?>
        </td>
        <td class="text-center">
            <?php 
                // Display the Employee ID
                $emp = isset($row['EmployeeId']) ? $row['EmployeeId'] : '';  
                echo "<center>" . ucfirst($emp) . "</center>"; 
            ?>
        </td>
        <td class="text-center">
            <a href="detailview.php?EmployeeId=<?php echo $row['EmployeeId'];?>" class="btn btn-info btn-sm">View</a>
        </td>
    </tr>
<?php } ?>
</tbody>

            </table>
            <div class="pagination"><?php echo $page; ?></div>
        </div>
    </div>
</div>

<!-- Modal -->
<!-- Modal -->
<div id="myModal" class="modal">
    <span class="close">&times;</span>
    <img class="modal-content" id="img01">
    <div id="caption"></div>
</div>


<?php include('footer.php'); ?>

<script>
// Image Popup Script
var modal = document.getElementById('myModal');
var modalImg = document.getElementById("img01");
var captionText = document.getElementById("caption");

// Open modal when any profile image is clicked
document.querySelectorAll('.profile-img').forEach(function(img) {
    img.onclick = function() {
        modal.style.display = "block";
        modalImg.src = this.src;
        captionText.innerHTML = this.alt;
    }
});

var span = document.getElementsByClassName("close")[0];
span.onclick = function() { 
    modal.style.display = "none";
}

</script>
