<?php
session_start();
require_once '../../include/connect.php'; // Go up two directories from fetch_textpost to reach include
require_once '../../functions/common_function.php'; // Go up two directories from

if (isset($_POST['post_id'])) {
    $post_id = $_POST['post_id'];
    $loggedInUserNo = $_SESSION['user_no'];

    // Fetch post details with user information
    $query = "SELECT p.post_id, p.user_no, u.fname, u.lname, p.timestamp, p.postphoto, p.caption
        FROM posts p
        JOIN user_registration u ON p.user_no = u.user_no
        WHERE p.post_id = ?";
    
    $stmt = $con->prepare($query);
    $stmt->bind_param("i", $post_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $post = $result->fetch_assoc();
        $user_no = $post['user_no'];
        $fname = $post['fname'];
        $lname = $post['lname'];
        $caption = $post['caption'];
        $postphoto = $post['postphoto'];
        $timestamp = $post['timestamp']; // Adjust as needed for date/time formatting

        // Fetch profile picture
        $profilePic = getProfilePicture($user_no, $con);
        // Create DateTime object
        $dateTime = new DateTime($timestamp);

        // Format date and time
        $formattedDate = $dateTime->format('F j, Y'); // e.g., July 24, 2023
        $formattedTime = $dateTime->format('g:i a'); // e.g., 6:27 pm

        // Prepare dynamic content
        echo "
    <div class='container-fluid containertextpostpost' data-post-id='" . htmlspecialchars($post_id) . "'>
        <div class='container-fluid nametextpost'>
            <div class='container-fluid lgyan'>
                <div class='container-fluid prof_pic'>
                    <div>
                        <a href='" . ($user_no == $loggedInUserNo ? "users/profile.php?sideprof" : "users/other_profile.php?user_no=" . htmlspecialchars($user_no)) . "' style='font-size:1rem; text-decoration: none; color: black;'>
                            <img src='users/images/profilepicture/" . htmlspecialchars($profilePic) . "' style='object-fit:contain; width: 40px; height: 40px; border-radius: 50%;' alt=''>
                        </a>
                    </div>
                </div>
                <div class='container-fluid pangalan'>
                    <div>
                        <a href='" . ($user_no == $loggedInUserNo ? "users/profile.php?sideprof" : "users/other_profile.php?user_no=" . htmlspecialchars($user_no)) . "' style='font-size:1rem; text-decoration: none; color: black;'>
                            <span class='pangalantextpost'>" . htmlspecialchars($fname . ' ' . $lname) . "</span>
                        </a>
                    </div>
                    <div>
                        <small style='font-size:13px;'><span class='timetextpost'>" . htmlspecialchars($formattedDate . ' at ' . $formattedTime) . "</span></small>
                    </div>
                </div>
            </div>
            <div class='container-fluid dots'>
                <button class='btn btn-secondary dropdown-toggle bg-white' style='border:none;' type='button' data-bs-toggle='dropdown' aria-expanded='false'>
                    <i class='fa-solid fa-ellipsis fa-xl' style='color: #575b60; font-size:20px;'></i>
                </button>
                <ul class='dropdown-menu'>";
                    if ($user_no == $loggedInUserNo) {
                        echo "
                        <li><a class='dropdown-item' href='#'>Copy post</a></li>
                        <li><a class='dropdown-item' href='#'>Delete post</a></li>";
                    } else {
                        echo "
                        <li><a class='dropdown-item' href='#' 
                            data-bs-toggle='modal' 
                            data-bs-target='#reportmodal2'
                            data-post-id='" . htmlspecialchars($post_id) . "' 
                            data-user-no='" . htmlspecialchars($user_no) . "'>Report</a></li>
                        <li><a class='dropdown-item' href='#'>Copy post</a></li>";
                    }
                echo "
                </ul>
            </div>
        </div>
        <div class='container-fluid captiontextpost'>
            <div class='container-fluid textcontainerpost'>
                <figure>
                    <figcaption>" . htmlspecialchars($caption) . "</figcaption>
                </figure>
            </div>
        </div>
        ";

    } else {
        echo "Invalid request.";
    }
} else {
    echo "Invalid request.";
}
?>
<!-- this will be add on the last div -->
 
<!-- <div class='container-fluid heart'>
                <div class='container-fluid thethree'>
                    <div class='container-fluid puso'>
                        <button type='button'><i class='fa-regular fa-heart'></i></button>
                    </div>
                    <div class='container-fluid comment'>
                        <button type='button' data-bs-toggle='modal' data-bs-target='#btn-comments'>
                            <i class='fa-regular fa-comment-dots fa-flip-horizontal'></i>
                        </button>
                    </div>
                    <div class='container-fluid share'><button><i class='fa-regular fa-share-from-square'></i></button></div>
                </div>
                <div class='container-fluid collection'>
                    <div class='container-fluid save'>
                        <div class='container-fluid bookmarkicon'>
                            <button><i class='fa-regular fa-bookmark'></i></button>
                        </div>
                    </div>
                </div>
            </div> -->