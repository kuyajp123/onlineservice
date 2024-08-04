<?php
session_start();
require_once '../include/connect.php'; // Adjust path as needed
require_once '../functions/common_function.php';

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
                    <button>
                        <div class='container-fluid dot'>
                            <i class='fa-solid fa-ellipsis fa-xl' style='color: #575b60; font-size:20px;'></i>
                        </div>
                    </button>
                </div>
            </div>

            <div class='container-fluid captiontextpost'>
                <div class='container-fluid textcontainerpost'>
                    <figure>
                        <figcaption>" . htmlspecialchars($caption) . "</figcaption>
                    </figure>
                </div>
            </div>

            <div class='container-fluid heart'>
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
            </div>

            <div class='line'></div>

            <div class='container contcomments'>
                    <form action='' method='post'>
                        <input type='hidden' name='post_id' value='" . htmlspecialchars($post_id) . "'>
                        <div class='container-fluid writecomments'>
                            <input class='form-control inputcomments' name='send_comment' placeholder='Write a comment...'>
                            <button type='submit' name='submit_comment' class='btn btn-outline-primary' id='sendbtncomments'><i class='fa-solid fa-paper-plane'></i></button>
                        </div>
                    </form>

                <div class='line'></div>

                <!-----display comments------>

                <div class='container-fluid comments'>
                    <div class='container-fluid usercomments'>
                        <div class='container-fluid lgyan'>
                            <div class='container-fluid prof_pic' style='display: flex; align-items: center; justify-content: flex-start; width:auto;'>
                                <div>
                                    <a href='" . ($user_no == $loggedInUserNo ? "users/profile.php?sideprof" : "users/other_profile.php?user_no=" . htmlspecialchars($user_no)) . "' style='font-size:1rem; text-decoration: none; color: black;'>
                                        <img src='users/images/profilepicture/" . htmlspecialchars($profilePic) . "' style='object-fit:contain; width: 40px; height: 40px; border-radius: 50%;' alt=''>
                                    </a>
                                </div>
                            </div>
                            <div class='container-fluid pangalan' style='justify-content:flex-start; padding:0;'>
                                <div style='margin-left:5px'>
                                    <a href='" . ($user_no == $loggedInUserNo ? "users/profile.php?sideprof" : "users/other_profile.php?user_no=" . htmlspecialchars($user_no)) . "' style='font-size:1rem; text-decoration: none; color: black;'>
                                        <span class='pangalantextpost'>" . htmlspecialchars($fname . ' ' . $lname) . "</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class='container-fluid commenttext'>
                            <figure>
                                <figcaption>" . //htmlspecialchars($comments) . 
                                "</figcaption>
                            </figure>
                        </div>
                    </div>
                </div>
            </div>
        </div>";
    } else {
        echo "Invalid request.";
    }
}elseif (isset($_POST["submit_comment"])) {
    $comment = $_POST["send_comment"];
    $post_id = $_POST['post_id'];

    if (!empty($comment)) {
        // Use the correct table name within the schema
        $sql = "INSERT INTO posts_management.comments (post_id, user_no, comment_text) VALUES (?, ?, ?)";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("iis", $post_id, $loggedInUserNo, $comment);
        
        if ($stmt->execute()) {
            echo "success";
        } else {
            $error = "error";
            echo "$error";
        }
    }else{
        $error = "comment cannot be empty";
            echo "$error";
    }
} else {
    echo "Invalid request.";
}
?>
