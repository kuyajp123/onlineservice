<?php
session_start();
require_once 'include/bootsrap.php';
require_once 'functions/common_function.php';
require_once 'include/connect.php';

if(!isset($_SESSION['user_ID']) && (!isset($_SESSION['email'])) && (!isset($_SESSION['student_no']))){
      header('location: ./users/login.php');
      exit();
    }

    // Assume connection is already established

// $sql = "SELECT p.post_id, p.user_no, u.fname, u.lname, p.timestamp, p.postphoto, p.caption
// FROM posts p
// JOIN user_registration u ON p.user_no = u.user_no";

// $stmt = $con->prepare($sql);
// $stmt->execute();
// $result = $stmt->get_result();
// $row = $result->fetch_assoc();


// $current_user_no = $_SESSION['user_no'];
// $post_id = isset($_GET['post_id']) ? $_GET['post_id'] : '';

// // Fetch profile data from the database
// // Fetch post data from the database
// $query = "SELECT * FROM posts WHERE post_id = ?";
// $stmt = $con->prepare($query);
// $stmt->bind_param('i', $post_id);
// $stmt->execute();
// $result = $stmt->get_result();
// $post = $result->fetch_assoc();


$current_user_no = $_SESSION['user_no'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="index_style.css?v=3">
<link rel="stylesheet" href="users/profilemodal.css?v=3">
<link rel="stylesheet" href="./users/user_operation/createpost.css?v=3">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News feed</title>
</head>
<body>

<div class="container-fluid acon"> <!--------1st container--------->
    <!-- ----------------------------navbar-------------------------------------------- -->
    <div class="container-fluid sticky-top bcon"> <!--------2nd container nav--------->

<!--  for mobile -->
<div class="container-fluid navmobilecon">
<!-------------------------------------------- sidenav  mobile-------------------------------- -->
<?php include 'include/navbar/sidenav.php' ?>
<!---------------------------------- newfeed preferences mobile-------------------------------- -->
<?php include 'include/navbar/newsfeed.php' ?>
</div>


    <!-- navbar for desktop -->
        <div class="container-fluid navcon"> 
            <!-- NAV -->
            <ul class="nav nav-pills mb-0" id="pills-tab" role="tablist">
  <li class="nav-item" role="presentation">
    <button class="nav-link active text-light" id="pills-bothf-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true"><i class="fa-solid fa-eye-slash" style="color: #ffffff;"></i></button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link text-light" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Friends</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link text-light" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Following</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link text-light" id="pills-bothf-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">All</button>
  </li>
</ul>

<span><i class="fa-solid fa-circle fa-xs" style="color: #ffffff;font-size:5px; margin: 0 10px;"></i></span>

<ul class="nav nav-pills mb-0" id="pills-tab" role="tablist">
  
<li class="nav-item" role="presentation">
    <button class="nav-link text-light" id="pills-bothsb-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">All</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link active text-light" id="pills-store-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Store</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link text-light" id="pills-books-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Books</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link text-light" id="pills-bothf-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true"><i class="fa-solid fa-eye-slash" style="color: #ffffff;"></i></button>
  </li>
</ul>


        </div>

    </div><!--------bcon last div--------->
<!-- ------------------------------------------------------------------------ -->


        



    <!-- ------------------------------------------------------------------------ -->
    <div class="container-fluid ccon"> <!--------3rd container- content container-------->
        <div class="container-fluid sidenav">
            <div class="container-fluid sticky-top considenav">

          <!-- sidenav and modal for profile -->
            <?php
echo '<div class="container-fluid profile">';
echo '<a href="users/profile.php?user_no=' . urlencode($current_user_no) . '" style="color: black;" class="sidemodal" data-open-modal="profilemodal">';
echo '        <div class="container-fluid contprofname">';
echo '            <div class="container-fluid profilepicture">';
echo '                <!-- profile image in sidenav -->';
echo '                <img src="include/images/d6cdf2a5daaf96462127cc31fb621851.jpg" alt="">';
echo '            </div>';
echo '            <div class="container-fluid nameusername">';
echo '                <!-- profile name in side nav -->';
echo '                <div class="container-fluid nameko">';
echo '                    <span>';
echo '                    ';
if (isset($_SESSION['fname']) || isset($_SESSION['lname'])) {
    echo htmlspecialchars($_SESSION['fname']) . ' ' . htmlspecialchars($_SESSION['lname']);
}
echo '                    </span>';
echo '                </div>';
echo '                <!-- profile username in side nav -->';
echo '                <div class="container-fluid username">';
echo '                    <small><span style="font-size:13px;">';
echo '                    ';
if (isset($_SESSION['user_ID'])) {
    echo htmlspecialchars($_SESSION['user_ID']);
}
echo '                    </span></small>';
echo '                </div>';
echo '            </div>';
echo '        </div>';
echo '    </a>';
echo '</div>';
?>

            

                <div class="container-fluid linesidenav"></div>


                <div class="container-fluid features">
                    <div class="container-fluid contbuttons">
                      <div class="container-fluid buttonlinks">
                       <ul>
                                <!-- search bar -->
                        <div class="container-fluid searchbar">
                          <form class="d-flex" role="search">
                            <input class="form-control me-2" type="search" placeholder="@" aria-label="Search">
                            <button class="btn btn-outline-success" type="submit">Search</button>
                          </form>
                        </div>
                        <li><a href="#" data-open-modal="createpost"><div class="container-fluid post">Create post</div></a></li>
                        <li><a href=""><div class="container-fluid notification">Notification</div></a></li>
                        <li><a href=""><div class="container-fluid collect">Collection</div></a></li>
                        <li><div class="container-fluid services" style="padding:0;">
                          <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false"><div class="container" >Services<i class="fa-solid fa-angle-right" style="margin-left:5px;"></i></div></a>
                            <ul class="dropdown-menu">
                              <li><a class="dropdown-item" href="#"><div class="container">Store</div></a></li>
                              <li><a class="dropdown-item" href="#"><div class="container">Books</div></a></li>
                              <li><a class="dropdown-item" href="#"><div class="container">Student Dashboard</div></a></li>
                            </ul></div></li>
                        <li><a href=""><div class="container-fluid settings">Settings</div></a></li>
                       </ul>
                      </div>
                    </div>
                </div>


                <div class="container-fluid logout">
                  <div class="container-fluid logoutcont">
                      <div class="btn-group dropup dropdown-center">
                        <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                          <div class="container">more</div>
                        </button>
                        <ul class="dropdown-menu">
                          <li><a class="dropdown-item" href="#"><div class="container">Profile</div></a></li>
                          <button class="logoutbut"><div class="container">Logout</div></button>
                        </ul>
                      </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- contents second div -->
          <div class="seconddive"></div>
















            <!---eto ang simula ng ipapasok mo sa loob ng div sa may comment--------->
            <div class="container-fluid content">




      <?php

            // require 'include/posttemplate/post.php';
    
    
        // Post with text only
        // require 'include/posttemplate/textpost.php';

        // Post with image only
        // You can create a separate template for image-only posts if needed
        // require 'include/posttemplate/imagepost.php';
    
      ?>

      



</div>
               <!---------ilalagay mo dito sa loob nato ang bagong .container_post eto ang pinaka huling div-------------->



               <div class=" container-fluid invi"></div>
               

        <div class="container-fluid olservices">
            <div class="container-fluid sticky-top conolservice">
                <div class="container-fluid cvsustore">cvsustore</div>
                <div class="container-fluid books">books</div>
            </div>
        </div>
    </div>
    <!-- ------------------------------------------------------------------------ -->
</div>


















<!-- create post modal -->
 <?php include 'users/user_operation/createpostmodal.php'; ?>
 
<!-- modal profile -->
<script src="functions/JsFunction.js"></script>
<script>

</script>
</body>

</html>
<?php




// $sql = "select * from user_registration where user_no = ?";
// $stmt = $con->prepare($sql);
// $stmt->bind_param('i', $_SESSION['user_no']);
// $stmt->execute();
// $result = $stmt->get_result();
// $row = $result->fetch_assoc();



?>