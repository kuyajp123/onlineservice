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
  $current_user_no = $_SESSION['user_no'];
  $_SESSION['profile_user_no'] = isset($_GET['sideprof']) ? $_GET['sideprof'] : '';
    
  
//   $query = "SELECT * FROM user_registration WHERE user_no = ?";
//   $stmt = $con->prepare($query);
//   $stmt->bind_param('i', $_SESSION['profile_user_no']);
//   $stmt->execute();
//   $result = $stmt->get_result();
//   $profile = $result->fetch_assoc();


?>






<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="profile.css?v=1">
</head>
<body>
    <div class="container-fluid body" id="body">
        <div class="container-fluid bodyprof">
            <div class="container-fluid grid1"></div>










            <div class="container-fluid grid2">
                <div class="container-fluid gri1cont">
                    <div class="container-fluid header">
                        <!-- background photo here -->
                        <div class="container-fluid imgcontainer"><img src=""></div>
                        <!-- profile photo here -->
                        <div class="container-fluid profilecontainer"><img src=""></div>
                        <div class="container-fluid backbutton"><a href="../index.php"><button type="button" class="btn btn-primary">Back</button></a>
                        </div>
                    </div>
                    <!-- navbar -->
                    <div class="container-fluid sticky-top navbar">
                        <div class="dropdown-center">
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
                        </div>
                    </div>
                    <!-- contents -->
                    <div class="container-fluid content">
                        <div class="container-fluid contcontent">



                        <!-- dito ang mga included -->

                            <!-- user posts -->
                            <?php

                            if(isset($current_user_no)){
                                if(isset($_GET['sideprof'])){
                                    include '../include/profileincluded/userspost.php';
                                }
                            
                        
                        
                                if(isset($_GET['editdetails'])){
                                    include '../include/profileincluded/editdetails.php';         
                                }
                            }


                            
  








                            





                            // include '../include/profileincluded/userspost.php';
                           
                            //     <!-- edit details -->
                            //  <!-- for own profile -->
                                // include '../include/profileincluded/editdetails.php'; 

                                // other user details
                                // include '../include/profileincluded/othereditdetails.php';


                       
                            
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
                                    <li><a class="dropdown-item" href="#">Action</a></li>
                                    <li><a class="dropdown-item" href="#">Another action</a></li>
                                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                                </ul>
                                </div>
                            </div>


                            <?php
                            getName();
                            ?>


                            <div class="container-fluid ff">

                                <div class="container-fluid following">
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
                                </div>

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
    <?php include '../users/user_operation/createpostmodal.php'; ?>
<!-- edit section -->
 <?php
  include '../users/user_operation/editdetails/editname.php'; 
  include '../users/user_operation/editdetails/editusername.php'; 
  include '../users/user_operation/editdetails/editbirthdate.php'; 
  include '../users/user_operation/editdetails/editgender.php'; 
  include '../users/user_operation/editdetails/editpassword.php'; 
  include '../users/user_operation/editdetails/editstdnum.php'; 
  include '../users/user_operation/editdetails/editemail.php'; 
  ?>




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
</body>
</html>