<?php
// Example variables
$loggedInUserNo = $_SESSION['user_no']; // Current logged-in user's number
$profilePic = getProfilePicture($user_no, $con);
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
                            <img src="users/images/profilepicture/<?php echo htmlspecialchars($profilePic); ?>" style="object-fit:contain; width: 40px; height: 40px; border-radius: 50%;" alt="">
                        </a>
                    <?php else: ?>
                        <!-- Link to the other user's profile -->
                        <a href="users/other_profile.php?user_no=<?php echo htmlspecialchars($user_no); ?>" style="font-size:1rem; text-decoration: none; color: black;">
                            <img src="users/images/profilepicture/<?php echo htmlspecialchars($profilePic); ?>" style="object-fit:contain; width: 40px; height: 40px; border-radius: 50%;" alt="">
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
                        <a href="users/other_profile.php?user_no=<?php echo htmlspecialchars($user_no); ?>" style="font-size:1rem; text-decoration: none; color: black;">
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
            <button>
                <div class="container-fluid dot">
                    <i class="fa-solid fa-ellipsis fa-xl" style="color: #575b60; font-size:20px;"></i>
                </div>
            </button>
        </div>
    </div>

    <!-- Caption -->
    <div class="container-fluid captiontextpost">
        <!-- Caption in post -->
        <div class="container-fluid textcontainerpost">
            <figure>
                <figcaption><?php echo htmlspecialchars($caption); ?></figcaption>
            </figure>
        </div>
    </div>

    <!-- Actions -->
    <div class="container-fluid heart">
        <div class="container-fluid thethree">
            <div class="container-fluid puso"><button><i class="fa-regular fa-heart"></i></button></div>
            <div class="container-fluid comment"><button><i class="fa-regular fa-comment-dots fa-flip-horizontal"></i></button></div>
            <div class="container-fluid share"><button><i class="fa-regular fa-paper-plane"></i></button></div>
        </div>
        <!-- Collection -->
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
