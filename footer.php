<!-- Script for Sticky Navigation -->
<script>
    $(document).ready(function() {
        var navOffset = $(".header-main").offset().top;
        $(window).scroll(function() {
            var scrollPos = $(window).scrollTop();
            if (scrollPos >= navOffset) {
                $(".header-main").addClass("fixed");
            } else {
                $(".header-main").removeClass("fixed");
            }
        });
    });
</script> 
<!-- End Script for Sticky Navigation -->

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Add Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>
        .sidebar-menu {
            background: linear-gradient(97deg, #ffffff, #6A5ACD);
            width: 250px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            
            transition: width 0.3s ease;
        }
        .sidebar-collapsed {
            width: 60px;
        }

        .sidebar-collapsed-back {
            width: 250px;
        }
        .logo1 {
            background-color: transparent;
            padding: 10px;
        }

        .logo1 img {
            display: block;
            margin: 0 auto;
            height: 160px;
            width: 200px;
        }
        .sidebar-icon {
            color: black;
            padding: 15px;
            cursor: pointer;
            font-size: 24px;
            transition: color 0.3s, transform 0.3s;
            margin-left: 187px;
        }
        .sidebar-collapsed .sidebar-icon {
            transform: rotate(180deg);
            margin-left: -4px;
        }
        .sidebar-icon:hover {
            color:#000;
        }
       .sidebar-collapsed .logo1 img {
            visibility: hidden;
        }
        .menu ul li a {
            color: white;
            display: block;
           
            text-decoration: none;
            font-size: 16px;
            background-color: #483D8B;
            padding: 12px;
            transition: background-color 0.3s ease;
        }

        .menu ul li a:hover {
            background-color: #6A5ACD;
            
        }


    </style>
</head>

<div class="sidebar-menu" >
    <header class="logo1">
      
 <a href="#">
            <img src="image/HR.png" alt="Logo"  style="height:150px; width:200px; margin-left:-25px; margin-bottom:-16px;">
        </a>       
        <a href="#" class="sidebar-icon" onclick="toggleIcon()" style="font-size: 24px; color: #000;">
    <span class="fa fa-arrow-right"></span>
</a>


    </header>
    <div class="menu">
        <ul id="menu" >
        <li>
                <a style="background-color:#6A5ACD; height:50px;  "   onmouseover="this.style.backgroundColor='#6A5ACD';" 
                onmouseout="this.style.backgroundColor='#483D8B';" href="home.php">
                    <i class="fa fa-home"></i>
                    <span class="menu-text">Dashboard</span> <!-- Text for Dashboard -->
                </a>
            </li>            <li>
                <a href="#" style="background-color:#483D8B;"   onmouseover="this.style.backgroundColor='#6A5ACD';" 
                onmouseout="this.style.backgroundColor='#483D8B';"><i class="fa fa-users" ></i><span>Employee</span><span class="fa fa-angle-right" style="float: right"></span><div class="clearfix"></div></a>
                <ul>
                    <li><a style=" background-color:#483D8B; color:white;"   onmouseover="this.style.backgroundColor='#6A5ACD';" 
                    onmouseout="this.style.backgroundColor='#483D8B';" href="employeeadd.php">Add Employee</a></li>
                    <li><a style=" background-color:#483D8B; color:white;"   onmouseover="this.style.backgroundColor='#6A5ACD';" 
                    onmouseout="this.style.backgroundColor='#483D8B';" href="employeeview.php">Employee View</a></li>
                    <li><a style=" background-color:#483D8B; color:white;"   onmouseover="this.style.backgroundColor='#6A5ACD';" 
                    onmouseout="this.style.backgroundColor='#483D8B';" href="atten.php">Attendance Details</a></li>
                    <li><a style=" background-color:#483D8B; color:white;"   onmouseover="this.style.backgroundColor='#6A5ACD';" 
                    onmouseout="this.style.backgroundColor='#483D8B';" href="modifiedlogout.php">Modified Logout Time</a></li>
                </ul>
            </li>
            <!-- <li>
                <a href="#" style="background-color:#483D8B;"   onmouseover="this.style.backgroundColor='#6A5ACD';" 
                onmouseout="this.style.backgroundColor='#483D8B';"><i class="fa fa-tag"></i><span>Designation</span><span class="fa fa-angle-right" style="float: right"></span><div class="clearfix"></div></a>
                <ul>
                    <li><a style=" background-color:#483D8B; color:white;"   onmouseover="this.style.backgroundColor='#6A5ACD';" 
                    onmouseout="this.style.backgroundColor='#483D8B';" href="Designation.php">Add Designation</a></li>
                </ul>
            </li> -->
            <li>
                <a href="#" style="background-color:#483D8B;"   onmouseover="this.style.backgroundColor='#6A5ACD';" 
                onmouseout="this.style.backgroundColor='#483D8B';"><i class="fa fa-project-diagram"></i><span>Project</span><span class="fa fa-angle-right" style="float: right"></span><div class="clearfix"></div></a>
                <ul>
                    <li><a style=" background-color:#483D8B; color:white;"   onmouseover="this.style.backgroundColor='#6A5ACD';" 
                    onmouseout="this.style.backgroundColor='#483D8B';" href="project.php">Add Project</a></li>
                    <li><a style=" background-color:#483D8B; color:white;"   onmouseover="this.style.backgroundColor='#6A5ACD';" 
                    onmouseout="this.style.backgroundColor='#483D8B';" href="viewproject.php">View Project</a></li>
                </ul>
            </li>
            <li>
                <a href="#" style="background-color:#483D8B;"   onmouseover="this.style.backgroundColor='#6A5ACD';" 
                onmouseout="this.style.backgroundColor='#483D8B';"><i class="fa fa-bell"></i><span>Vacancies</span><span class="fa fa-angle-right" style="float: right"></span><div class="clearfix"></div></a>
                <ul>
                    <li><a style=" background-color:#483D8B; color:white;"   onmouseover="this.style.backgroundColor='#6A5ACD';" 
                    onmouseout="this.style.backgroundColor='#483D8B';" href="vacancy.php">Add Vacancies</a></li>
                    <li><a style=" background-color:#483D8B; color:white;"   onmouseover="this.style.backgroundColor='#6A5ACD';" 
                    onmouseout="this.style.backgroundColor='#483D8B';" href="viewvacancy.php">View Vacancies</a></li>
                </ul>
            </li>
            <li>
                <a href="#" style="background-color:#483D8B;"   onmouseover="this.style.backgroundColor='#6A5ACD';" 
                onmouseout="this.style.backgroundColor='#483D8B';"><i class="fa fa-dollar-sign"></i><span>Salary</span><span class="fa fa-angle-right" style="float: right"></span><div class="clearfix"></div></a>
                <ul>
                    <li><a style=" background-color:#483D8B; color:white;" 
                    onmouseover="this.style.backgroundColor='#6A5ACD';" 
                    onmouseout="this.style.backgroundColor='#483D8B';"
                     href="salary.php">View Salary</a></li>
                </ul>
            </li>
            <li>
    <a href="#" style="background-color:#483D8B; color:white;"
       onmouseover="this.style.backgroundColor='#6A5ACD';" 
       onmouseout="this.style.backgroundColor='#483D8B';">
       <i class="fa fa-calendar-alt"></i>
       <span>Leave</span>
       <span class="fa fa-angle-right" style="float: right;"></span>
       <div class="clearfix"></div>
    </a>
    <ul>
        <li>
            <a href="leaverequest.php" style="background-color:#483D8B; color:white;"
               onmouseover="this.style.backgroundColor='#6A5ACD';" 
               onmouseout="this.style.backgroundColor='#483D8B';">
               Request Leave
            </a>
        </li>
        <li>
            <a href="addleave.php" style="background-color:#483D8B; color:white;"
               onmouseover="this.style.backgroundColor='#6A5ACD';" 
               onmouseout="this.style.backgroundColor='#483D8B';">
               Apply Leave
            </a>
        </li>
        <li>
            <a href="workingdayadd.php" style="background-color:#483D8B; color:white;"
               onmouseover="this.style.backgroundColor='#6A5ACD';" 
               onmouseout="this.style.backgroundColor='#483D8B';">
               Working Day
            </a>
        </li>
    </ul>
</li>
            
           
<li>
    <a href="#" style="background-color:#483D8B;" onmouseover="this.style.backgroundColor='#6A5ACD';" 
                onmouseout="this.style.backgroundColor='#483D8B';"><i class="fas fa-university"></i><span>Payment Details</span><span class="fa fa-angle-right" style="float: right"></span><div class="clearfix"></div></a>
                <ul>
                    <li><a style=" background-color:#483D8B; color:white;"   onmouseover="this.style.backgroundColor='#6A5ACD';" 
                    onmouseout="this.style.backgroundColor='#483D8B';" href="payment.php">Banking Management</a></li>

                    <li><a style=" background-color:#483D8B; color:white;"   onmouseover="this.style.backgroundColor='#6A5ACD';" 
                    onmouseout="this.style.backgroundColor='#483D8B';" href="paymentview.php">Banking Details Of Employee</a></li>
              
              
                </ul> 
               
</li>
          <li>
          <a href="#" style="background-color:#483D8B;"   onmouseover="this.style.backgroundColor='#6A5ACD';" 
          onmouseout="this.style.backgroundColor='#483D8B';"><i class="fas fa-file-invoice-dollar"></i><span>Payroll Info</span><span class="fa fa-angle-right" style="float: right"></span><div class="clearfix"></div></a>
                <ul>
                    <li><a style=" background-color:#483D8B; color:white;"   onmouseover="this.style.backgroundColor='#6A5ACD';" 
                    onmouseout="this.style.backgroundColor='#483D8B';" href="payroll.php">View Payroll Info</a></li>
                </ul>
            </li>   
           <li>
                <a href="#" style="background-color:#483D8B;"   onmouseover="this.style.backgroundColor='#6A5ACD';" 
                onmouseout="this.style.backgroundColor='#483D8B';"><i class="fab fa-whatsapp"></i><span>WhatsApp Web</span><span class="fa fa-angle-right" style="float: right"></span><div class="clearfix"></div></a>
                <ul>
                    <li><a style=" background-color:#483D8B; color:white;"   onmouseover="this.style.backgroundColor='#6A5ACD';" 
                    onmouseout="this.style.backgroundColor='#483D8B';" href="https://web.whatsapp.com/">WhatsApp Web</a></li>
                </ul>
            </li>


<!-- <li><a  href="changepassword.php"><i class="fa fa-key"></i><span>Change Password</span></a> </li> -->
        </ul>
    </div>
</div>
<div class="clearfix"></div>
<!-- Script for Sidebar Toggle -->
<script>
   var toggle = true;

$(".sidebar-icon").click(function() {
    if (toggle) {
        // Collapse the sidebar
        $(".sidebar-menu").addClass("sidebar-collapsed").removeClass("sidebar-collapsed-back");
        $(".sidebar-icon").css({"transform": "rotate(180deg)"});  // Rotate icon when sidebar is collapsed
        $("#menu span").css({"position": "absolute", "opacity": "0"});  // Hide text
    } else {
        // Expand the sidebar
        $(".sidebar-menu").removeClass("sidebar-collapsed").addClass("sidebar-collapsed-back");
        $(".sidebar-icon").css({"transform": "rotate(0deg)"});  // Reset icon rotation
        setTimeout(function() {
            $("#menu span").css({"position": "relative", "opacity": "1"});  // Show text
        }, 400);
    }
    toggle = !toggle;
});

// Handle submenu toggle on icon click
$(".menu ul li a").click(function(e) {
    var subMenu = $(this).next("ul");
    if (subMenu.length) {
        e.preventDefault();  // Prevent default action of anchor
        subMenu.slideToggle();  // Toggle the submenu
    }
});

// Handle submenu toggle when clicking on the angle icon
$(".fa-angle-right").click(function(e) {
    e.stopPropagation();  // Prevent the click from bubbling up
    $(this).closest("a").click();  // Trigger the click event on the parent link
});

</script>
<script>
function toggleIcon() {
    var icon = document.querySelector('.sidebar-icon .fa');
    var sidebar = document.querySelector('.sidebar-icon');
    
    if (icon.classList.contains('fa-arrow-right')) {
        icon.classList.remove('fa-arrow-right');
        icon.classList.add('fa-arrow-left');
        sidebar.style.color = '#FF6347'; // Change icon color
        sidebar.style.transform = 'rotate(180deg)'; // Optional rotation effect
    } else {
        icon.classList.remove('fa-arrow-left');
        icon.classList.add('fa-arrow-right');
        sidebar.style.color = '#483D8B'; // Revert icon color
        sidebar.style.transform = 'rotate(0deg)';
    }
}
</script>

<!-- JS Libraries -->
<script src="js/jquery.nicescroll.js"></script>
<script src="js/scripts.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>