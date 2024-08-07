<?php
session_start();
require_once '../../include/connect.php';
require_once '../../functions/common_function.php';

// Fetch post ID from request
$post_id = isset($_POST['post_id']) ? $_POST['post_id'] : null;
if (!$post_id) {
    echo "No post ID provided.";
    exit;
}

// Fetch post details from database
$sql = "SELECT p.post_id, p.user_no, p.caption, p.postphoto, u.fname, u.lname, u.profilepicture, 
        DATE_FORMAT(p.timestamp, '%b %d, %Y') as formattedDate,
        DATE_FORMAT(p.timestamp, '%I:%i %p') as formattedTime
        FROM posts p
        JOIN user_registration u ON p.user_no = u.user_no
        WHERE p.post_id = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("i", $post_id);
$stmt->execute();
$result = $stmt->get_result();
$post = $result->fetch_assoc();

if ($post) {
    $user_no = $post['user_no'];
    $fname = htmlspecialchars($post['fname']);
    $lname = htmlspecialchars($post['lname']);
    $profilePic = htmlspecialchars($post['profilepicture']);
    $caption = htmlspecialchars($post['caption']);
    $postphoto = htmlspecialchars($post['postphoto']);
    $formattedDate = htmlspecialchars($post['formattedDate']);
    $formattedTime = htmlspecialchars($post['formattedTime']);
    $loggedInUserNo = isset($_SESSION['user_no']) ? $_SESSION['user_no'] : null;
?>

<div class='container-fluid container_post' data-post-id='<?php echo htmlspecialchars($post_id); ?>'>

    <!-- Name and profile picture -->
    <div class='container-fluid name'>
        <div class='container-fluid lgyan'>
            <div class='container-fluid prof_pic'>
                <div>
                    <?php if ($user_no == $loggedInUserNo): ?>
                        <a href='users/profile.php?sideprof' style='font-size:1rem; text-decoration: none; color: black;'>
                            <img src='users/images/profilepicture/<?php echo $profilePic; ?>' style='object-fit:contain; width: 40px; height: 40px; border-radius: 50%;' alt=''>
                        </a>
                    <?php else: ?>
                        <a href='users/other_profile.php?user_no=<?php echo $user_no; ?>' style='font-size:1rem; text-decoration: none; color: black;'>
                            <img src='users/images/profilepicture/<?php echo $profilePic; ?>' style='object-fit:contain; width: 40px; height: 40px; border-radius: 50%;' alt=''>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
            <div class='container-fluid pangalan'>
                <div>
                    <?php if ($user_no == $loggedInUserNo): ?>
                        <a href='users/profile.php?sideprof'><span class='pangalantextpost'><?php echo $fname . ' ' . $lname; ?></span></a>
                    <?php else: ?>
                        <a href='users/other_profile.php?user_no=<?php echo $user_no; ?>' style='font-size:1rem; text-decoration: none; color: black;'>
                            <span class='pangalantextpost'><?php echo $fname . ' ' . $lname; ?></span>
                        </a>
                    <?php endif; ?>
                </div>
                <div>
                    <small style='font-size:13px;'><span class='ipadname2'><?php echo $formattedDate . ' at ' . $formattedTime; ?></span></small>
                </div>
            </div>
        </div>

        <!-- 3 dots menu -->
        <div class='container-fluid dots'>
            <button>
                <div class='container-fluid dot'>
                    <i class='fa-solid fa-ellipsis fa-xl' style='color: #575b60; font-size:20px;'></i>
                </div>
            </button>
        </div>
    </div>

    <!-- Post image -->
    <div class='container-fluid image'>
        <div class='container-fluid image_container'>
            <img src='include/posts_images/<?php echo $postphoto; ?>' alt=''>
        </div>
    </div>

    <!-- Heart, comment, share buttons -->
    <div class='container-fluid heart'>
        <div class='container-fluid thethree'>
            <div class='container-fluid puso'>
                <button><i class='fa-regular fa-heart'></i></button>
            </div>
            <div class='container-fluid comment'>
                <button type='button' data-bs-toggle='modal' data-bs-target='#btn-comments' data-post-id='<?php echo $post_id; ?>' data-user-no='<?php echo $loggedInUserNo; ?>'>
                    <i class='fa-regular fa-comment-dots fa-flip-horizontal'></i>
                </button>
            </div>
            <div class='container-fluid share'>
                <button><i class='fa-regular fa-paper-plane'></i></button>
            </div>
        </div>

        <!-- Collection (Save) -->
        <div class='container-fluid collection'>
            <div class='container-fluid save'>
                <div class='container-fluid bookmarkicon'>
                    <button><i class='fa-regular fa-bookmark'></i></button>
                </div>
            </div>
        </div>
    </div>

    <div class='line'></div>

    <!-- Caption -->
    <div class='container-fluid container_cap'>
        <div class='container-fluid caption'><?php echo $caption; ?></div>
    </div>

</div>

<?php
} else {
    echo "Post not found.";
}
?>
