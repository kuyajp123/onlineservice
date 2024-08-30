<?php
// Example variables
$loggedInUserNo = $_SESSION['user_no']; // Current logged-in user's number
$profilePic = getProfilePicture($user_no, $con);

$defaultProfilePic = 'profile.jpg';


?>

<!-- Start of the content to be inserted into the div for comments -->
<div class="container-fluid containertextpostpost" data-post-id="<?php echo htmlspecialchars($post_id); ?>">

    <!-- Name section -->
    <div class="container-fluid nametextpost">
        <div class="container-fluid lgyan">
            <div class="container-fluid prof_pic">
                <!-- Profile image in post -->
                <div>
                    <?php if ($user_no == $loggedInUserNo): ?>
                        <!-- Link to the current user's profile -->
                        <a href="users/profile.php?sideprof" style="font-size:1rem; text-decoration: none; color: black;">
                        <img src="users/images/profilepicture/<?php echo !empty($profilePic) ? $profilePic : $defaultProfilePic; ?>"
                        style="object-fit:contain; width: 40px; height: 40px; border-radius: 50%;" alt="">
                        </a>
                    <?php else: ?>
                        <!-- Link to the other user's profile -->
                        <a href="users/ban_other_profile.php?user_no=<?php echo htmlspecialchars($user_no); ?>" style="font-size:1rem; text-decoration: none; color: black;">
                        <img src="users/images/profilepicture/<?php echo !empty($profilePic) ? $profilePic : $defaultProfilePic; ?>" style="object-fit:contain; width: 40px; height: 40px; border-radius: 50%;" alt="">
                        </a>
                    <?php endif; ?>
                </div>
            </div>
            <div class="container-fluid pangalan">
                <!-- Profile name in post -->
                <div>
                    <?php if ($user_no == $loggedInUserNo): ?>
                        <!-- Display current user's name -->
                        <a href="users/profile.php?sideprof"><span class="pangalantextpost"><?php echo htmlspecialchars($fname . ' ' . $lname); ?></span></a>
                    <?php else: ?>
                        <!-- Link to other user's profile -->
                        <a href="users/ban_other_profile.php?user_no=<?php echo htmlspecialchars($user_no); ?>" style="font-size:1rem; text-decoration: none; color: black;">
                            <span class="pangalantextpost"><?php echo htmlspecialchars($fname . ' ' . $lname); ?></span>
                        </a>
                    <?php endif; ?>
                </div>
                <!-- Time in post -->
                <div>
                    <small style="font-size:13px;"><span class="timetextpost"><?php echo htmlspecialchars($formattedDate . ' at ' . $formattedTime); ?></span></small>
                </div>
            </div>
        </div>
        <!-- 3 dots section -->
        <div class="container-fluid dots">
        <div class="dropdown dot">

            </div>
        </div>
    </div>

    <!-- Caption -->
    <div class="container-fluid captiontextpost">
        <!-- Caption in post -->
        <div class="container-fluid bantextcontainerpost">
            <div class="container-fluid text-center banposttemplate">
                <h5><b>Post removed</b></h5>
            </div>
            <div class="container-fluid banpostmesstemplate">
                This post was termanated becuase it doesn't follow the <a href="users/t_c.php" target="_blank">Community standard</a>
            </div>
        </div>
    </div>

    <!-- Actions -->
    <div class="container-fluid heart">
        <div class="container-fluid thethree">
            <div class="container-fluid puso">
            </div>

            <div class="container-fluid comment">
                <!-- Buttons to open the modal -->
                
            </div>
            <div class="container-fluid share">
                <!-- <button><i class="fa-regular fa-share-from-square"></i></button> -->
            </div>
        </div>
        <!-- Collection -->
        <div class="container-fluid collection">
            <div class="container-fluid save">
                <div class="container-fluid bookmarkicon">
                    <!-- <button><i class="fa-regular fa-bookmark"></i></button> -->
                </div>
            </div>
        </div>
    </div>

    <!-- Line separator -->
    <div class="line"></div>

</div>