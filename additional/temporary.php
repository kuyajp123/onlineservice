<!---eto ang simula ng ipapasok mo sa loob ng div sa may comment--------->
<div class='container-fluid container_post' data-post-id='<?php echo htmlspecialchars($post_id); ?>'>

<!-- lagayan ng pangalan 1st div -->
<div class='container-fluid name'>
    
    <div class='container-fluid lgyan'>
      
      <div class='container-fluid prof_pic'>
        <!-- profile image inpost -->
          <div>
            <?php if ($user_no == $loggedInUserNo): ?>
                        <!-- Link to the current user's profile -->
                        <a href='users/profile.php?sideprof' style='font-size:1rem; text-decoration: none; color: black;'>
                            <img src='users/images/profilepicture/<?php echo htmlspecialchars($profilePic); ?>' style='object-fit:contain; width: 40px; height: 40px; border-radius: 50%;' alt=''>
                        </a>
                    <?php else: ?>
                        <!-- Link to the other user's profile -->
                        <a href='users/other_profile.php?user_no=<?php echo htmlspecialchars($user_no); ?>' style='font-size:1rem; text-decoration: none; color: black;'>
                            <img src='users/images/profilepicture/<?php echo htmlspecialchars($profilePic); ?>' style='object-fit:contain; width: 40px; height: 40px; border-radius: 50%;' alt=''>
                        </a>
                    <?php endif; ?></div></a>
      </div>
      <div class='container-fluid pangalan'>
        <!-- profile name in post -->
        <div>
            <?php if ($user_no == $loggedInUserNo): ?>
                        <!-- Display current user's name -->
                        <a href='users/profile.php?sideprof'><span class='pangalantextpost'><?php echo htmlspecialchars($fname . ' ' . $lname); ?></span></a>
                    <?php else: ?>
                        <!-- Display other user's name -->
                        <a href='users/other_profile.php?user_no=<?php echo htmlspecialchars($user_no); ?>' style='font-size:1rem; text-decoration: none; color: black;'>
                            <span class='pangalantextpost'><?php echo htmlspecialchars($fname . ' ' . $lname); ?></span>
                        </a>
                    <?php endif; ?>
                </div>
                <div>
                    <small style='font-size:13px;'><span class='ipadname2'><?php echo htmlspecialchars($formattedDate . ' at ' . $formattedTime); ?></span></small>
                </div>
            </div>
      </div>
      

    <!-- 3dots 1st div -->
    <div class='container-fluid dots'>
      <button><div class='container-fluid dot'><i class='fa-solid fa-ellipsis fa-xl' style='color: #575b60; font-size:20px;'></i></div></button>
    </div>
</div>

<!-- image 1st div -->
<div class='container-fluid image'>
<!-- image in post -->
<div class='container-fluid image_container'><img src='include/posts_images/<?php echo htmlspecialchars($postphoto); ?>' alt=''></div>
    
</div>


<!-- heart,comment,share, 1st div -->
<div class='container-fluid heart'>
   
    <div class='container-fluid thethree'>
      <div class='container-fluid puso'><button><i class='fa-regular fa-heart'></i></button></div>

      <div class='container-fluid comment'>
  <button data-post-id='<?php echo $post_id; ?>' data-user-no='<?php echo $loggedInUserNo; ?>'>
    <i class='fa-regular fa-comment-dots fa-flip-horizontal'></i>
  </button>
</div>

      <div class='container-fluid share'><button><i class='fa-regular fa-paper-plane'></i></button></div>
    </div>

    <!-- collection 1st div -->
    <div class='container-fluid collection'>
      <div class='container-fluid save'>
        <div class='container-fluid bookmarkicon'>
          <button><i class='fa-regular fa-bookmark'></i></button>
        </div>
      </div>
    </div>
</div>

      <!-- line -->
      <div class='line'></div>

<!-- caption 1st div -->
<div class='container-fluid container_cap'>
    <div class='container-fluid caption'><?php echo htmlspecialchars($caption) ?></div>
</div>

</div>