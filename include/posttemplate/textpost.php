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
            <div class="container-fluid puso"><button type="button" data-bs-toggle="modal" data-bs-target="#btn-comments"><i class="fa-regular fa-heart"></i></button></div>
            <div class="container-fluid comment">
                <button type="button" data-bs-toggle="modal" data-bs-target="#btn-comments">
                    <i class="fa-regular fa-comment-dots fa-flip-horizontal"></i>
                </button>
            </div>
            <div class="container-fluid share"><button><i class="fa-regular fa-share-from-square"></i></button></div>
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






<!-- Modal -->
<div class="modal fade" id="btn-comments" tabindex="-1" aria-labelledby="btn-commentsLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="btn-commentsLabel">

        <div>
                    <?php if ($user_no == $loggedInUserNo): ?>
                        <!-- Display current user's name -->
                       <span class="pangalantextpost"><?php echo htmlspecialchars($fname); ?>'s Post</span>
                    <?php else: ?>
                            <span class="pangalantextpost"><?php echo htmlspecialchars($fname); ?>'s Post</span>
                    <?php endif; ?>
                </div>

        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Modal body content here -->




<!-- post template -->

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
            <div class="container-fluid puso">
                <button type="button"><i class="fa-regular fa-heart"></i></button>
            </div>
            <div class="container-fluid comment">
                <button type="button" data-bs-toggle="modal" data-bs-target="#btn-comments">
                    <i class="fa-regular fa-comment-dots fa-flip-horizontal"></i>
                </button>
            </div>
            <div class="container-fluid share"><button><i class="fa-regular fa-share-from-square"></i></i></button></div>
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


<!-- comments -->

<div class="container contcomments">

    <form action="" method="post">
        <div class="container-fluid writecomments">
            <input class="form-control inputcomments" name="send_comment" placeholder="Write a comment...">
            <button type="submit_comment" class="btn btn-outline-primary" id="sendbtncomments"><i class="fa-solid fa-paper-plane"></i></button>
        </div>
    </form>

    <!-- Line separator -->
    <div class="line"></div>

    <div class="container-fluid comments">













    

        <!-- this will be included if theres a comment in post -->
        <div class="container-fluid usercomments">

        <div class="container-fluid lgyan" style="border:px solid red;">
            <div class="container-fluid prof_pic" style="display: flex; align-items: center; justify-content: flex-start; width:auto;">
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
            <div class="container-fluid pangalan" style="justify-content:flex-start; padding:0;">
                <!-- Profile name in post -->
                <div style="margin-left:5px">
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
            </div>
        </div>

        <div class="container-fluid commenttext">
            <?php if ($user_no == $loggedInUserNo): ?>
            <figure>
                <figcaption><?php echo htmlspecialchars($comments); ?></figcaption>
            </figure>
            <?php else: ?>
            <figure>
                <figcaption><?php echo htmlspecialchars($comments); ?></figcaption>
            </figure>
            <?php endif; ?>
        </div>

        </div>














        

    </div>

</div>








</div>
<!-- end post template-->














        
      </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div> -->
    </div>
  </div>
</div>

<?php
$comment = "";
$error = "";

// Check if the form is submitted
if(isset($_POST['submit_comment'])){
    $comments = trim($_POST['send_comment']);

    if (!empty($comments)) {
        // Prepare the SQL query to insert the comment
        $query = "INSERT INTO posts (post_id, user_no, comments) VALUES (?, ?, ?)";
        $stmt = $con->prepare($query);
        $stmt->bind_param("iis", $post_id, $loggedInUserNo, $comments); // Adjust parameters based on your table structure

        if ($stmt->execute()) {
            // Successfully inserted
            echo "Comment posted successfully.";
        } else {
            $error = "Failed to post comment.";
        }
    } else {
        $error = "Comment cannot be empty.";
    }
}
?>
