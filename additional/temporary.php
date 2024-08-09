<?php
// Example variables
$loggedInUserNo = $_SESSION['user_no']; // Current logged-in user's number
$profilePic = getProfilePicture($user_no, $con);

// Fetch the initial reaction state for the user
$stmt = $con->prepare("SELECT COUNT(*) AS reacted FROM heart_reactions WHERE post_id = ? AND user_no = ?");
$stmt->bind_param("ii", $postId, $userNo);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$reacted = $row['reacted'] > 0 ? 'true' : 'false';

// Fetch the heart count for the post
$stmt = $con->prepare("SELECT COUNT(*) AS heart_count FROM heart_reactions WHERE post_id = ?");
$stmt->bind_param("i", $postId);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$heartCount = $row['heart_count']; // Ensure this line is reached and $heartCount is defined

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
            <div class="dropdown dot">
                <button class="btn btn-secondary dropdown-toggle bg-white" style="border:none;" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa-solid fa-ellipsis fa-xl" style="color: #575b60; font-size:20px;"></i>
                    <ul class="dropdown-menu">
                        <?php if($user_no == $loggedInUserNo){
                            echo '
                            <li><a class="dropdown-item" href="#">Copy post</a></li>
                            <li><a class="dropdown-item" href="#">Delete post</a></li>
                            ';
                        } else {
                            echo '
                            <li>
                            <a class="dropdown-item" href="#" data-bs-whatever="'.htmlspecialchars($post_id).'" data-bs-toggle="modal" data-bs-target="#reportmodal2">Report</a>
                            </li>
                            <li><a class="dropdown-item" href="#">Copy post</a></li>
                            ';
                        } 
                        ?>
                    </ul>
                </button>
            </div>
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
            <div class="container-fluid puso">
                <button class="heart-btn" data-post-id="<?php echo $postId; ?>" data-user-no="<?php echo $userNo; ?>" data-reacted="<?php  echo $reacted; ?>">
                    <i class="fa-heart <?php echo $reacted === 'true' ? 'fa-solid' : 'fa-regular'; ?>"></i>
                    <span class="heart-count"><?php echo $heartCount; ?></span>
                </button>
            </div>

            <div class="container-fluid comment">
                <!-- Buttons to open the modal -->
                <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="<?php echo htmlspecialchars($post_id); ?>">
                    <i class="fa-regular fa-comment-dots fa-flip-horizontal"></i>
                </button>
            </div>
            <div class="container-fluid share">
                <button><i class="fa-regular fa-share-from-square"></i></button>
            </div>
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
<?php include 'include/posttemplate/report_modal/report_textpost_modal.php'; ?>
