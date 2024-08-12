<!-- own profile user -->
<?php



    $current_user_no = $_SESSION['user_no'];
    if ($current_user_no) {
        echo '<div class="container-fluid features">
        <div class="container-fluid contbuttons">
            <div class="container-fluid buttonlinks">
                <ul>
                    <li><a href="profile.php?sideprof" >
                        <div class="container-fluid post">Post</div>
                    </a></li>
                    <li><a href="#" data-open-modal="createpostprofile">
                        <div class="container-fluid post">Create post</div>
                    </a></li>
                    <li><a href="../additional/under_maitenance.php" >
                        <div class="container-fluid notification">Notification</div>
                    </a></li>
                    <li><a href="profile.php?schedule" >
                        <div class="container-fluid collect">Schedule</div>
                    </a></li>
                    <li>
                        <div class="container-fluid services" style="padding:0;">
                            <a class="nav-link dropdown-toggle" style="padding:none;" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">
                                <div class="container" style="padding:none;">
                                    Under construction
                                    <i class="fa-solid fa-angle-right" style="margin-left:5px;"></i>
                                </div>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#" >
                                    <div class="container">Store</div>
                                </a></li>
                                <li><a class="dropdown-item" href="#">
                                    <div class="container">Books</div>
                                </a></li>
                                <li><a class="dropdown-item" href="#">
                                    <div class="container">Student Dashboard</div>
                                </a></li>
                            </ul>
                        </div>
                    </li>
                    <li><a href="profile.php?editdetails" >
                        <div class="container-fluid settings">Personal Information</div>
                    </a></li>
                </ul>
            </div>
        </div>
    </div>';
    }
    

?>