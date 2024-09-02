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

<?php
// Example variables
$loggedInUserNo = $_SESSION['user_no']; // Current logged-in user's number
$profilePic = getProfilePicture($user_no, $con);

$defaultProfilePic = 'profile.jpg';
?>

<!---eto ang simula ng ipapasok mo sa loob ng div sa may comment--------->
<div class="container-fluid container_post" data-post-id="<?php echo htmlspecialchars($post_id); ?>">

<!-- lagayan ng pangalan 1st div -->
<div class="container-fluid name">
    
    <div class="container-fluid lgyan">
      
      <div class="container-fluid prof_pic">
        <!-- profile image inpost -->
          <div>
            <?php if ($user_no == $loggedInUserNo): ?>
                        <!-- Link to the current user's profile -->
                        <a href="users/profile.php?sideprof" style="font-size:1rem; text-decoration: none; color: black;">
                        <img src="users/images/profilepicture/<?php echo !empty($profilePic) ? $profilePic : $defaultProfilePic; ?>" style="object-fit:contain; width: 40px; height: 40px; border-radius: 50%;" alt="">
                        </a>
                    <?php else: ?>
                        <!-- Link to the other user's profile -->
                        <a href="users/other_profile.php?user_no=<?php echo htmlspecialchars($user_no); ?>" style="font-size:1rem; text-decoration: none; color: black;">
                        <img src="users/images/profilepicture/<?php echo !empty($profilePic) ? $profilePic : $defaultProfilePic; ?>" style="object-fit:contain; width: 40px; height: 40px; border-radius: 50%;" alt="">
                        </a>
                    <?php endif; ?></div></a>
      </div>
      <div class="container-fluid pangalan">
        <!-- profile name in post -->
        <div>
            <?php if ($user_no == $loggedInUserNo): ?>
                        <!-- Display current user's name -->
                        <a href="users/profile.php?sideprof"><span class="pangalantextpost"><?php echo htmlspecialchars($fname . ' ' . $lname); ?></span></a>
                    <?php else: ?>
                        <!-- Display other user's name -->
                        <a href="users/other_profile.php?user_no=<?php echo htmlspecialchars($user_no); ?>" style="font-size:1rem; text-decoration: none; color: black;">
                            <span class="pangalantextpost"><?php echo htmlspecialchars($fname . ' ' . $lname); ?></span>
                        </a>
                    <?php endif; ?>
                </div>
                <div>
                    <small style="font-size:13px;"><span class="ipadname2"><?php echo htmlspecialchars($formattedDate . ' at ' . $formattedTime); ?></span></small>
                </div>
            </div>
      </div>
      

    <!-- 3dots 1st div -->
    <div class="container-fluid dots">
            <div class="dropdown dot">
                <button class="btn dropdown-toggle mgatuldok" style="border:none;" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa-solid fa-ellipsis fa-xl" style="color: #575b60; font-size:20px;"></i>
                        <ul class="dropdown-menu">
                        <?php if($user_no == $loggedInUserNo): ?>
                            <li><a class="dropdown-item" href="#">Copy post</a></li>
                            <li><a class="dropdown-item" href="#">Delete post</a></li>
                        <?php else: ?>
                            <!-- Pass the post_id and user_no as data attributes for the report option -->
                            <li><a class="dropdown-item" href="#" 
                                data-bs-toggle="modal" 
                                data-bs-target="#reportmodal2"
                                data-post-id="<?php echo htmlspecialchars($post_id); ?>" 
                                data-user-no="<?php echo htmlspecialchars($user_no); ?>">Report</a></li>
                            <li><a class="dropdown-item" href="#">Copy post</a></li>
                        <?php endif; ?>
                        </ul>
                </button>
            </div>
    </div>
</div>

<!-- image 1st div -->
<div class="container-fluid image">
<!-- image in post -->
<div class="container-fluid image_container"><img src="include/posts_images/<?php echo htmlspecialchars($postphoto); ?>" alt=""></div>
    
</div>


<!-- heart,comment,share, 1st div -->
<div class="container-fluid heart">


</div>

      <!-- line -->
      <div class="line"></div>

<!-- caption 1st div -->
<div class="container-fluid container_cap">
    <div class="container-fluid caption"><?php echo htmlspecialchars($caption) ?></div>
</div>

</div>
<?php include 'report_post_incomment.php'; ?>

<?php
} else {
    echo "Post not found.";
}
?>
