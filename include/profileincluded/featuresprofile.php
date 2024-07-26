<!-- own profile user -->
<?php

$current_user_no = $_SESSION['user_no'];
$profile_user_no = isset($_GET['user_no']) ? $_GET['user_no'] : '';

$query = "SELECT * FROM user_registration WHERE user_no = ?";
$stmt = $con->prepare($query);
$stmt->bind_param('i', $profile_user_no);
$stmt->execute();
$result = $stmt->get_result();
$profile = $result->fetch_assoc();

$user_no = $profile['user_no'];

if ($profile) {
    $current_user_no = $_SESSION['user_no'];
    if ($profile_user_no == $current_user_no) {
        echo '<div class="container-fluid features">
        <div class="container-fluid contbuttons">
            <div class="container-fluid buttonlinks">
                <ul>
                    <li><a href="profile.php?post=' . urlencode($user_no) . '" class="ajax-link">
                        <div class="container-fluid post">Post</div>
                    </a></li>
                    <li><a href="">
                        <div class="container-fluid post">Create post</div>
                    </a></li>
                    <li><a href="">
                        <div class="container-fluid notification">Notification</div>
                    </a></li>
                    <li><a href="">
                        <div class="container-fluid collect">Collection</div>
                    </a></li>
                    <li>
                        <div class="container-fluid services" style="padding:0;">
                            <a class="nav-link dropdown-toggle" style="padding:none;" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">
                                <div class="container" style="padding:none;">
                                    Services<i class="fa-solid fa-angle-right" style="margin-left:5px;"></i>
                                </div>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">
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
                    <li><a href="profile.php?editdetails=' . urlencode($current_user_no) . '">
                        <div class="container-fluid settings">Edit details</div>
                    </a></li>
                </ul>
            </div>
        </div>
    </div>';
    }
}
    

?>