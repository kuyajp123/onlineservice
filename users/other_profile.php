<?php
session_start();
require_once '../include/connect.php';
require_once '../functions/common_function.php';
require_once '../include/bootsrap.php';

if (!isset($_SESSION['user_ID']) && !isset($_SESSION['email']) && !isset($_SESSION['student_no'])) {
    header('location: login.php');
    exit();
}

$other_user_no = isset($_GET['user_no']) ? $_GET['user_no'] : null;

// Fetch posts if 'user_no' is set
$posts = [];
if ($other_user_no) {
    $query = "SELECT * FROM posts WHERE user_no = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param('i', $other_user_no);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($post = $result->fetch_assoc()) {
        $posts[] = $post;
    }
}

// Determine what to show based on query parameters
$showEditDetails = isset($_GET['othereditdetails']) && $_GET['othereditdetails'] === 'true';
$showPosts = !isset($_GET['othereditdetails']);

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
    <div class="container-fluid body" id="body">
        <div class="container-fluid bodyprof">
            <div class="container-fluid grid1"></div>

            <div class="container-fluid grid2">
                <div class="container-fluid gri1cont">
                    <div class="container-fluid header">
                        <!-- background photo here -->
                        <div class="container-fluid imgcontainer"><img src="../users/images/coverphoto/<?php echo htmlspecialchars($coverphoto, ENT_QUOTES, 'UTF-8'); ?>" style="position:absolute;"></div>
                        <!-- profile photo here -->
                        <div class="container-fluid profilecontainer"><img src="../users/images/profilepicture/<?php echo htmlspecialchars($profilepicture, ENT_QUOTES, 'UTF-8'); ?>"></div>
                        <div class="container-fluid backbutton"><a href="../index.php?newsfeed=<?php echo urlencode($other_user_no) ?>"><button type="button" class="btn btn-primary">Back</button></a></div>
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
                            <?php
                            if ($showPosts) {
                                if (count($posts) > 0) {
                                    include '../include/profileincluded/otherusers/otherposts.php';
                                } else {
                                    echo "<div class='container-fluid nopostavailable'><p>No posts available</p></div>";
                                }
                            }

                            if ($showEditDetails) {
                                include '../include/profileincluded/otherusers/othereditdetails.php';
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
                                        <li><a class="dropdown-item" href="#">Action</a></li>
                                        <li><a class="dropdown-item" href="#">Another action</a></li>
                                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                                    </ul>
                                </div>
                            </div>
                            <?php getName($other_user_no); // Fetches and displays the profile for the other user ?>
                            <div class="container-fluid ff">
                                <div class="container-fluid following">
                                    <div class="container-fluid numbers"><div style="display: flex; align-items: center; justify-content: center;">1k</div></div>
                                    <div class="container-fluid words"><div style="display: flex; align-items: center; justify-content: center;">Following</div></div>
                                </div>
                                <div class="container-fluid followers">
                                    <div class="container-fluid numbers" style="display: flex; align-items: center; justify-content: center;">262k</div>
                                    <div class="container-fluid words" style="display: flex; align-items: center; justify-content: center;">Followers</div>
                                </div>
                            </div>
                            <div class="container-fluid line"></div>
                            <?php
                            if ($other_user_no) {
                                include '../include/profileincluded/otherusers/profilefollow.php'; 
                                include '../include/profileincluded/otherusers/otherfeauture.php'; 
                            } else {
                                echo "error";
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid grid4"></div>
        </div>
    </div>

    <script>
    $(document).ready(function() {
        $('.ajax-link').on('click', function(event) {
            event.preventDefault();
            var url = $(this).attr('href');
            $.ajax({
                url: url,
                method: 'GET',
                success: function(response) {
                    $('#body').html(response);
                },
                error: function(xhr, status, error) {
                    console.error('AJAX request failed:', status, error);
                }
            });
        });
        $(document).on('click', '[data-open-modal]', function(event) {
            event.preventDefault();
            var modalId = $(this).attr('data-open-modal');
            $('#' + modalId).modal('show');
        });
    });
    </script>
</body>
</html>
