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
    <link rel="stylesheet" href="profile.css?v=1">
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
                            Store
                          </button>
                          <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Action two</a></li>
                            <li><a class="dropdown-item" href="#">Action three</a></li>
                          </ul>
                        </div>

                        <div class="dropdown-center">
                          <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Books
                          </button>
                          <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Action two</a></li>
                            <li><a class="dropdown-item" href="#">Action three</a></li>
                          </ul>
                        </div>
                    </div>
                    <!-- contents -->
                    <div class="container-fluid content">
                        <div class="container-fluid contcontent">


                        <!-- dito ang mga included -->

                            <?php 
                            include '../include/profileincluded.php/userspost.php';
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
                            <?php
                            //  include '../include/profileincluded.php/profilefollow.php';
                              ?>

                            <!-- own profile user -->
                            <div class="container-fluid features">
                    <div class="container-fluid contbuttons">
                      <div class="container-fluid buttonlinks">
                       <ul>
                        <li><a href=""><div class="container-fluid post">Create post</div></a></li>
                        <li><a href=""><div class="container-fluid notification">Notification</div></a></li>
                        <li><a href=""><div class="container-fluid collect">Collection</div></a></li>
                        <li><div class="container-fluid services" style="padding:0;">
                          <a class="nav-link dropdown-toggle" style="padding:none;" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false"><div class="container" style="padding:none;">Services<i class="fa-solid fa-angle-right" style="margin-left:5px;"></i></div></a>
                            <ul class="dropdown-menu">
                              <li><a class="dropdown-item" href="#"><div class="container">Store</div></a></li>
                              <li><a class="dropdown-item" href="#"><div class="container">Books</div></a></li>
                              <li><a class="dropdown-item" href="#"><div class="container">Student Dashboard</div></a></li>
                            </ul></div></li>
                        <li><a href=""><div class="container-fluid settings">Edit details</div></a></li>
                       </ul>
                      </div>
                    </div>
                </div>


                        </div>
                    </div>
                </div>
            </div>













            <div class="container-fluid grid4"></div>
        </div>
    </div>
    <script src="../functions/JsFunction.js"></script>
</body>
</html>