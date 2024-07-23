<?php
require_once '../include/connect.php';
require_once '../functions/common_function.php';
require_once '../include/bootsrap.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="profile.css?v=2">
</head>
<body>
    <div class="container-fluid body">
        <div class="container-fluid bodyprof">
            <div class="container-fluid grid1"></div>










            <div class="container-fluid grid2">
                <div class="container-fluid gri1cont">
                    <div class="container-fluid header">
                        <!-- background photo here -->
                        <div class="container-fluid imgcontainer"><img src="../include/images/0wzknw7460n31.jpg" alt=""></div>
                        <!-- profile photo here -->
                        <div class="container-fluid profilecontainer"><img src="../include/images/433610472_1427797164763718_6516813264608892964_n.jpg" alt=""></div>
                        <div class="container-fluid backbutton"><button type="button" class="btn btn-primary">Back</button>
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

                            <?php 
                            // include '../include/profileincluded/userspost.php';
                             ?>
                            
                            
                            <!-- edit details -->
                             <!-- for own profile -->
                            <?php 
                            // include '../include/profileincluded/editdetails.php'; 
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

                            <div class="container-fluid identity">
                                <!-- image to be upload profile here -->
                                <div class="container-fluid profilepic"></div>
                                <!-- name to be upload here -->
                                <div class="container-fluid name">John Paul Naag</div>
                                <div class="container-fluid username">@johnpaul12</div>
                                <div class="container-fluid bio">Hello world!</div>
                            </div>


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

                            <!-- other profile user -->
                             <!-- follow button -->
                            <?php
                            //  include '../include/profileincluded/profilefollow.php';
                              ?>
                            
                            
                            <!-- users own features button -->
                            <?php
                            //  include '../include/profileincluded/featuresprofile.php'; 
                            ?>
                            


                        </div>
                    </div>
                </div>
            </div>













            <div class="container-fluid grid4"></div>
        </div>
    </div>
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




    <script src="../functions/JsFunction.js"></script>
    <script src="../include/modal.js"></script>
</body>
</html>