<?php
// Example variables
$loggedInUserNo = $_SESSION['user_no']; // Current logged-in user's number
?>

<div class="container-fluid container_post" data-post-id="<?php echo htmlspecialchars($post_id); ?>">
    <!-- Name section -->
    <div class="container-fluid name">
        <div class="container-fluid lgyan">
            <div class="container-fluid prof_pic">
                <!-- Profile image in post -->
                <div>
                    <?php if ($user_no == $loggedInUserNo): ?>
                        <!-- Link to the current user's profile -->
                        <a href="users/profile.php?sideprof" style="font-size:1rem; text-decoration: none; color: black;">
                            <img src="include/images/profile.jpg" style="object-fit:contain; width: 40px; height: 40px; border-radius: 50%;" alt="">
                        </a>
                    <?php else: ?>
                        <!-- Link to the other user's profile -->
                        <a href="users/other_profile.php?user_no=<?php echo htmlspecialchars($user_no); ?>" style="font-size:1rem; text-decoration: none; color: black;">
                            <img src="include/images/profile.jpg" style="object-fit:contain; width: 40px; height: 40px; border-radius: 50%;" alt="">
                        </a>
                    <?php endif; ?>
                </div>
            </div>
            <div class="container-fluid pangalan">
                <!-- Profile name in post -->
                <div>
                    <?php if ($user_no == $loggedInUserNo): ?>
                        <!-- Display current user's name -->
                        <span class="ipadname1"><?php echo htmlspecialchars($fname . ' ' . $lname); ?></span>
                    <?php else: ?>
                        <!-- Display other user's name -->
                        <a href="profile.php?user_no=<?php echo htmlspecialchars($user_no); ?>" style="font-size:1rem; text-decoration: none; color: black;">
                            <span class="ipadname1"><?php echo htmlspecialchars($fname . ' ' . $lname); ?></span>
                        </a>
                    <?php endif; ?>
                </div>
                <!-- Time in post -->
                <div>
                    <small style="font-size:13px;"><span class="ipadname2"><?php echo htmlspecialchars($formattedDate . ' at ' . $formattedTime); ?></span></small>
                </div>
            </div>
        </div>
        <!-- 3 dots section -->
        <div class="container-fluid dots">
            <button><div class="container-fluid dot"><i class="fa-solid fa-ellipsis fa-xl" style="color: #575b60; font-size:20px;"></i></div></button>
        </div>
    </div>
    <!-- Image section -->
    <div class="container-fluid image">
        <!-- Image in post -->
        <div class="container-fluid image_container">
            <img src="include/posts_images/<?php echo htmlspecialchars($postphoto); ?>" alt="">
        </div>
    </div>
    <!-- Actions section -->
    <div class="container-fluid heart">
        <div class="container-fluid thethree">
            <div class="container-fluid puso"><button><i class="fa-regular fa-heart"></i></button></div>
            <div class="container-fluid comment"><button><i class="fa-regular fa-comment-dots fa-flip-horizontal"></i></button></div>
            <div class="container-fluid share"><button><i class="fa-regular fa-paper-plane"></i></button></div>
        </div>
        <!-- Collection section -->
        <div class="container-fluid collection">
            <div class="container-fluid save">
                <div class="container-fluid bookmarkicon">
                    <button><i class="fa-regular fa-bookmark"></i></button>
                </div>
            </div>
        </div>
    </div>
    <!-- Line separator -->
    <div class="line"></div>
</div>
