<?php
    session_start();
     
    if(!isset($_SESSION['User']))
    {
        header('location:index.php');exit();
    }
?>
<!-- <script>$(document).ready(function(){
    // Open dropdown on click
    $('#navbarDropdown').on('click', function(event) {
        event.stopPropagation();
        $(this).parent().toggleClass('open');
    });

    // Close dropdown when clicking outside
    $(document).on('click', function(e) {
        if (!$('.profile_details_drop').is(e.target) && $('.profile_details_drop').has(e.target).length === 0) {
            $('.profile_details_drop').removeClass('open');
        }
    });

    // Prevent dropdown from closing when clicking inside it
    $('.dropdown-menu').on('click', function(e) {
        e.stopPropagation();
    });
}); -->
</script> 
<!DOCTYPE HTML>
<html>
<head>
<title>HRMS </title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content=" Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- Bootstrap Core CSS -->
<link href="css/bootstrap.min.css" rel='stylesheet' type='text/css' />
<!-- Custom CSS -->
<link href="css/style.css" rel='stylesheet' type='text/css' />
<link rel="stylesheet" href="css/morris.css" type="text/css"/>
<!-- Graph CSS -->
<link href="css/font-awesome.css" rel="stylesheet"> 
<!-- jQuery -->
<!-- <script src="js/jquery-2.1.4.min.js"></script> -->
<!-- //jQuery -->
<link href='//fonts.googleapis.com/css?family=Roboto:700,500,300,100italic,100,400' rel='stylesheet' type='text/css'/>
<link href='//fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
<!-- lined-icons -->
<link rel="stylesheet" href="css/icon-font.min.css" type='text/css' />
<!-- //lined-icons -->

<!-- datepicker-->
<link rel="stylesheet" type="text/css" href="dp/jquery.datetimepicker.css"/>
<script src="dp/jquery.datetimepicker.full.js"></script>
<?php date_default_timezone_set("Asia/Kolkata"); ?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<!--Image Popup-->
<style>


@-webkit-keyframes zoom {
    from {-webkit-transform:scale(0)} 
    to {-webkit-transform:scale(1)}
}

@keyframes zoom {
    from {transform:scale(0)} 
    to {transform:scale(1)}
}

@media only screen and (max-width: 700px){
    .modal-content {
        width: 100%;
    }
}

/* .dropdown-toggle{
    color: #2a9df4; 
    text-decoration: none; 
    font-weight: bold; 
    margin-top: 50px;
}   */
/* .logo-w3-agile {
    position: relative;
    width: 100%; 
    height: 180px;
}  */

 .logo-w3-agile img {
    position: absolute;
    top: 0;
    margin-left: -320px;
     width: 150px;
    height: 170px; 
    margin-bottom: 10px;
    object-fit: cover; 
    z-index: 1;
    margin-top: 0px;
} 


 .logo-w3-agile h1 {
font-size: 35px;
margin-bottom: 10px;
font-weight: bold; 
margin-right: 10px;
font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
margin-top: 50px;
}



</style>
<!-- End image popup -->

</head> 
<body>
   <div class="page-container">
   <!--/content-inner-->
<div class="left-content">
	   <div class="mother-grid-inner">
               <!--header start here-->
				<div class="hea+der-main">
                         <div style="padding: 0em; margin-right:0%; margin-left:-18%;  height:180px; width:70%;   background:linear-gradient(-90deg, #6A5ACD, black); "
                          class="logo-w3-agile">
                               <!-- <img src="image/Poppies Art Print Purple Flower Wall Decor Floral Watercolor Painting - Etsy Canada.jpg" style="background-color: whitesmoke;" alt="Company Logo">  -->
                             <h1>
                     <a class="header-title" style="color: white">
                       <marquee><b>Welcome to HRMS</b></marquee></a></h1>
                        
                            
                        </div>
                        <div class="profile_details w3l" style=" margin-right:-10%; display: flex; justify-content:flex-end; align-items: center; width:55%; height: 180px; background: linear-gradient(90deg, #6A5ACD, black);">
    <ul class="nav">
        <li class="nav-item dropdown profile_details_drop">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
                <div class="profile_img" style="display: flex; align-items: center;">
                    <div class="user-name" style="color: #fff; margin-right: 55px;">
                        <p style="margin: 0; font-size: 16px; font-weight: bold;">
                            <?php echo isset($_SESSION['User']['Email']) ? $_SESSION['User']['Email'] : ''; ?>
                        </p>
                        <span style="font-size: 14px;">
                            <?php echo isset($_SESSION['role']['Name']) ? $_SESSION['role']['Name'] : ''; ?>
                        </span>
                    </div>
                    <div class="custom-arrow" style="width: 0; height: 0; border-left: 5px solid transparent; border-right: 10px solid transparent; border-top: 15px solid #fff;  margin-right:70px;"></div>
                </div>
            </a>
            <ul class="dropdown-menu drp-mnu" aria-labelledby="navbarDropdown" style="background: slateblue; border-radius: 8px; padding: 10px;">
                <?php if (isset($_SESSION['User'])): ?>
                    <li>
                        <a class="dropdown-item" href="profile.php" style="color: #663399; font-weight: bold; font-size: 16px; padding: 10px; border-radius: 4px;">
                            <i class="fa fa-user" style="margin-right: 8px; font-size: 16px; color: #663399;"></i>
                            View Profile
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="changepassword.php" style="color: #663399; font-weight: bold; font-size: 16px; padding: 5px; border-radius: 4px;">
                            <i class="fa fa-key" style="margin-right: -8px; font-size: 16px; color: #663399;"></i>
                            Change Password
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="controller/logout.php" style="color: #663399; font-weight: bold; font-size: 16px; padding: 10px; border-radius: 4px;">
                            <i class="fa fa-sign-out" style="margin-right: 8px; font-size: 16px; color: #663399;"></i>
                            Logout
                        </a>
                    </li>
                <?php else: ?>
                    <li>
                        <a class="dropdown-item" href="controller/login.php" style="color: #663399; font-weight: bold; font-size: 16px; padding: 10px; border-radius: 4px;">
                            <i class="fa fa-sign-in" style="margin-right: 8px; font-size: 16px; color: #663399;"></i>
                            Login
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </li>
    </ul>
</div>

				</div>
                <div class="clearfix"> </div>	


                <script src="js/jquery-2.1.4.min.js"></script>
    <!-- Popper.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>
<script>
$(document).ready(function(){
    $('#navbarDropdown').on('click', function(event) {
        event.stopPropagation();
        $(this).parent().toggleClass('open');
    });

    $('body').on('click', function(e) {
        if (!$('.profile_details_drop').is(e.target) && $('.profile_details_drop').has(e.target).length === 0) {
            $('.profile_details_drop').removeClass('open');
        }
    });
});
</script>
       