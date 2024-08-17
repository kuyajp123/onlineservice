<?php
session_start();
require_once '../include/connect.php';
require_once '../functions/common_function.php';
require_once '../include/bootsrap.php';

if(!isset($_SESSION['user_ID']) && (!isset($_SESSION['email'])) && (!isset($_SESSION['student_no']))){
    header('location: login.php');
    exit();
  }
  $_SESSION['ip'] = getIPAddress();
  $_SESSION['user_no'];
  $_SESSION['user_ID'];
  $_SESSION['email'];
  $_SESSION['student_no'];
  $_SESSION['fname'];
  $_SESSION['lname'];
  $_SESSION['bday'];
  $_SESSION['gender'];
  $_SESSION['user_password'];
  $_SESSION['coverphoto'];
  $coverphoto = $_SESSION['coverphoto'];
  $profilepicture = $_SESSION['profilepicture'];
  $current_user_no = $_SESSION['user_no'];
    
  if(CheckBanStatus($current_user_no)){
    session_unset();
    session_destroy();
    header("Location: logout.php");
    exit();
  }

  $query = "SELECT * FROM posts WHERE user_no = ? ORDER BY timestamp DESC";
  $stmt = $con->prepare($query);
  $stmt->bind_param('i', $current_user_no);
  $stmt->execute();
  $result = $stmt->get_result();
 

  $posts = [];
  while ($post = $result->fetch_assoc()) {
      $posts[] = $post;
  }


?>






<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo "".$_SESSION['fname']."" ?>'s Profile</title>
    <link rel="stylesheet" href="profile.css?v=<?php echo time(); ?>">
</head>
<body>
    <div class="container-fluid body" id="body">
        <div class="container-fluid bodyprof">
            <div class="container-fluid grid1"></div>





            <div class="container-fluid grid2">
                <div class="container-fluid gri1cont">
                    <div class="container-fluid sticky-top sidenavprofile">
                    <div class="container-fluid backbutton2"><a href="../index.php?newsfeed=<?php echo urlencode($current_user_no) ?>"><button style="height:5vh;background-color: #4BCBCB;border:none;" type="button" class="btn btn-primary">Back</button></a>
                    </div>
                    <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight" style="height:5vh;background-color: #4BCBCB;border:none;"><i class="fa-solid fa-bars"></i></button>
                    </div>
                    <div class="container-fluid header">
                        <!-- background photo here -->
                        <div class="container-fluid imgcontainer"><img src="../users/images/coverphoto/<?php echo htmlspecialchars($coverphoto, ENT_QUOTES, 'UTF-8'); ?>" style="position:absolute;"><a href="#" class="editcoverphotolink" data-open-modal="editcoverphoto"><i class="fa-solid fa-pen-to-square" style="position:absolute;"></i></a></div>
                        <!-- profile photo here -->
                        <div class="container-fluid profilecontainer"><img src="../users/images/profilepicture/<?php echo htmlspecialchars($profilepicture, ENT_QUOTES, 'UTF-8'); ?>"><a href="#" class="editprofilephotolink" data-open-modal="editprofile"><i class="fa-solid fa-pen-to-square" style="position:absolute; left:0;"></i></a></div>
                        <div class="container-fluid backbutton"><a href="../index.php?newsfeed=<?php echo urlencode($current_user_no) ?>"><button type="button" class="btn btn-primary"  style="background-color: #4BCBCB;border:none;">Back</button></a>
                        </div>
                    </div>
                    <!-- navbar -->
                    <div class="container-fluid sticky-top navbar">
                        <!-- <div class="dropdown-center">
                          <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Connection
                          </button>
                          <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">All</a></li>
                            <li><a class="dropdown-item" href="#">Friends</a></li>
                            <li><a class="dropdown-item" href="#">Following</a></li>
                          </ul>
                        </div>

                        <div class="dropdown-center">
                          <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Services
                          </button>
                          <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">All</a></li>
                            <li><a class="dropdown-item" href="#">Store</a></li>
                            <li><a class="dropdown-item" href="#">Books</a></li>
                          </ul>
                        </div> -->
                    </div>
                    <!-- contents -->
                    <div class="container-fluid content">
                        <div class="container-fluid contcontent">

                        <!-- dito ang mga included -->

                            <!-- user posts -->
                            <?php                                
                            if (isset($current_user_no)) {
                                if (isset($_GET['sideprof'])) {
                                    if (count($posts) > 0) {
                                        include '../include/profileincluded/userspost.php';
                                    } else {
                                        echo "
                                            <div class='container-fluid nopostavailable'>
                                            <p>No posts available</p>
                                            </div>
                                            ";
                                    }
                                }
                                // Edit details section
                                if (isset($_GET['editdetails'])) {
                                    // own edit details
                                    include '../include/profileincluded/editdetails.php';                           
                                }
                                // schedule
                                if (isset($_GET['schedule'])) {
                                    // shecdule
                                    include '../include/profileincluded/set_schedule.php';                           
                                }
                                // add schedule
                                if (isset($_GET['add_schedule'])) {
                                    // shecdule
                                    include '../include/profileincluded/add_schedule.php';                           
                                }
                            }
                            ?>

                        </div>
                    </div>
                </div>
            </div>

            <div class="container-fluid grid3">
                <div class="container-fluid rightnav">
                    <div class="container-fluid rightnavcont"><!-- mobile device -->
                        <div class="container-fluid displayprof">

                            <div class="container-fluid settingsicon">
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdownsettings" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa-solid fa-ellipsis-vertical"></i>
                                </button>
                                <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#" data-open-modal="editprofile">Edit Profile Picture</a></li>
                                <li><a class="dropdown-item" href="#" data-open-modal="editcoverphoto">Edit Cover Photo</a></li>
                                    <!-- <li><a class="dropdown-item" href="#">Something else here</a></li> -->
                                </ul>
                                </div>
                            </div>

                            <?php
                            // get name function
                            getName();
                            ?>


                            <div class="container-fluid ff">

                                <!-- <div class="container-fluid following">
                                    <div class="container-fluid numbers"><div style="display: flex;
                                        align-items: center;
                                        justify-content: center;">1k</div></div>
                                    <div class="container-fluid words"><div style="display: flex;
                                    align-items: center;
                                    justify-content: center;">Following</div></div>
                                </div>
                                <div class="container-fluid followers">
                                    <div class="container-fluid numbers" style="display: flex;
                                        align-items: center;
                                        justify-content: center;">262k</div>
                                    <div class="container-fluid words" style="display: flex;
                                        align-items: center;
                                        justify-content: center;">Followers</div>
                                </div> -->

                            </div>


                            <div class="container-fluid line"></div>
                   
                            <?php
                                // <!-- users features button -->
                                    
                                        if ($current_user_no) {
                                            include '../include/profileincluded/featuresprofile.php'; 
                                        }else{
                                            echo "error";
                                        }                                        
                                            // include '../include/profileincluded/profilefollow.php'; 
                                            // include '../include/profileincluded/otherfeauture.php'; 
 
                            ?>
                        
                        </div>
                    </div>
                </div>
            </div>




            <div class="container-fluid grid4"></div>
        </div>
    </div>
    <!-- create post modal -->
    <?php include '../users/user_operation/createpostprofile.php'; ?>
<!-- edit section -->
 <?php
  include '../users/user_operation/editdetails/editname.php'; 
  include '../users/user_operation/editdetails/editusername.php'; 
  include '../users/user_operation/editdetails/editbirthdate.php'; 
  include '../users/user_operation/editdetails/editgender.php'; 
  include '../users/user_operation/editdetails/editpassword.php'; 
  include '../users/user_operation/editdetails/editstdnum.php'; 
  include '../users/user_operation/editdetails/editemail.php'; 
  include '../users/user_operation/editdetails/editcoverphoto.php'; 
  include '../users/user_operation/editdetails/editprofile.php'; 
  ?>


<!-- mobile sidenav -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="offcanvasRightLabel">Offcanvas right</h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
    <div class="offcanvas-body">


    <div class="container-fluid rightnavcont2"><!-- mobile device -->
                        <div class="container-fluid displayprof">

                            <div class="container-fluid settingsicon">
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdownsettings" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa-solid fa-ellipsis-vertical"></i>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#" data-open-modal="editprofile">Edit Profile Picture</a></li>
                                    <li><a class="dropdown-item" href="#" data-open-modal="editcoverphoto">Edit Cover Photo</a></li>
                                    <!-- <li><a class="dropdown-item" href="#">Something else here</a></li> -->
                                </ul>
                                </div>
                            </div>

                            <?php
                            // get name function
                            getName();
                            ?>


                            <div class="container-fluid ff">

                                <!-- <div class="container-fluid following">
                                    <div class="container-fluid numbers"><div style="display: flex;
                                        align-items: center;
                                        justify-content: center;">1k</div></div>
                                    <div class="container-fluid words"><div style="display: flex;
                                    align-items: center;
                                    justify-content: center;">Following</div></div>
                                </div>
                                <div class="container-fluid followers">
                                    <div class="container-fluid numbers" style="display: flex;
                                        align-items: center;
                                        justify-content: center;">262k</div>
                                    <div class="container-fluid words" style="display: flex;
                                        align-items: center;
                                        justify-content: center;">Followers</div>
                                </div> -->

                            </div>


                            <div class="container-fluid line"></div>
                   
                            <?php
                                // <!-- users features button -->
                                    
                                        if ($current_user_no) {
                                            include '../include/profileincluded/featuresprofile.php'; 
                                        }else{
                                            echo "error";
                                        }                                        
                                            // include '../include/profileincluded/profilefollow.php'; 
                                            // include '../include/profileincluded/otherfeauture.php'; 
 
                            ?>
                        
                        </div>
                    </div>


    </div>
</div>
</body>
</html>
<script>
$(document).ready(function() {
    // Intercept click event on elements with class 'ajax-link'
    $('.ajax-link').on('click', function(event) {
        event.preventDefault(); // Prevent the default link behavior

        var url = $(this).attr('href'); // Get the URL from the href attribute

        // Perform the AJAX request
        $.ajax({
            url: url,
            method: 'GET', // Or 'POST' depending on your requirement
            success: function(response) {
                // Update the content container with the response
                $('#body').html(response);
            },
            error: function(xhr, status, error) {
                // Handle errors here
                console.error('AJAX request failed:', status, error);
            }
        });
    });
});
$(document).on('click', '[data-open-modal]', function(event) {
    event.preventDefault();
    var modalId = $(this).attr('data-open-modal');
    $('#' + modalId).modal('show');
});
    </script>