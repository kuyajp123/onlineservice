<?php
// Example variables
$loggedInUserNo = $_SESSION['user_no']; // Current logged-in user's number
$profilePic = getProfilePicture($user_no, $con);
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
                            <img src="users/images/profilepicture/<?php echo htmlspecialchars($profilePic); ?>" style="object-fit:contain; width: 40px; height: 40px; border-radius: 50%;" alt="">
                        </a>
                    <?php else: ?>
                        <!-- Link to the other user's profile -->
                        <a href="users/other_profile.php?user_no=<?php echo htmlspecialchars($user_no); ?>" style="font-size:1rem; text-decoration: none; color: black;">
                            <img src="users/images/profilepicture/<?php echo htmlspecialchars($profilePic); ?>" style="object-fit:contain; width: 40px; height: 40px; border-radius: 50%;" alt="">
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
      <button><div class="container-fluid dot"><i class="fa-solid fa-ellipsis fa-xl" style="color: #575b60; font-size:20px;"></i></div></button>
    </div>
</div>

<!-- image 1st div -->
<div class="container-fluid image">
<!-- image in post -->
<div class="container-fluid image_container"><img src="include/posts_images/<?php echo htmlspecialchars($postphoto); ?>" alt=""></div>
    
</div>


<!-- heart,comment,share, 1st div -->
<div class="container-fluid heart">
   
    <div class="container-fluid thethree">
      <div class="container-fluid puso"><button><i class="fa-regular fa-heart"></i></button></div>

        <div class="container-fluid postcomment">
            <button data-post-id="<?php echo $post_id; ?>" data-user-no="<?php echo $loggedInUserNo; ?>">
            <i class="fa-regular fa-comment-dots fa-flip-horizontal"></i>
            </button>
        </div>

      <div class="container-fluid share"><button><i class="fa-regular fa-paper-plane"></i></button></div>
    </div>

    <!-- collection 1st div -->
    <div class="container-fluid collection">
      <div class="container-fluid save">
        <div class="container-fluid bookmarkicon">
          <button><i class="fa-regular fa-bookmark"></i></button>
        </div>
      </div>
    </div>
</div>

      <!-- line -->
      <div class="line"></div>

<!-- caption 1st div -->
<div class="container-fluid container_cap">
    <div class="container-fluid caption"><?php echo htmlspecialchars($caption) ?></div>
</div>

</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
  // Event listener for comment buttons
  document.querySelectorAll('.container-fluid.postcomment button').forEach(button => {
    button.addEventListener('click', function() {
      const postId = this.getAttribute('data-post-id');
      const userNo = this.getAttribute('data-user-no');

      // Show the modal
      var myModal = new bootstrap.Modal(document.getElementById('exampleModal_postcomment'));
      myModal.show();

      // Fetch post details
      fetch('scripts/fetch_post/fetch_post_details.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: new URLSearchParams('post_id=' + postId)
      })
      .then(response => response.text())
      .then(data => {
        document.querySelector('#modal-content-post').innerHTML = data;
      })
      .catch(error => console.error('Error fetching post details:', error));

      // Fetch comments
      fetch('scripts/fetch_post/fetch_post_comment.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: new URLSearchParams('post_id=' + postId)
      })
      .then(response => response.text())
      .then(data => {
        document.querySelector('#modal-commentpost-content').innerHTML = data;
      })
      .catch(error => console.error('Error fetching comments:', error));

      // Fetch comment form
      fetch('scripts/fetch_post/input_comment_post.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: new URLSearchParams('post_id=' + postId + '&user_no=' + userNo)
      })
      .then(response => response.text())
      .then(data => {
        const modalInputComment = document.querySelector('#modal-postinput-comment');
        modalInputComment.innerHTML = data;

        // Attach submit event listener
        modalInputComment.querySelector('form').addEventListener('submit', function(e) {
          e.preventDefault(); // Prevent form from submitting normally

          const formData = new FormData(this);
          formData.append('post_id', postId);
          formData.append('user_no', userNo);

          fetch('scripts/fetch_post/input_comment_post.php', {
            method: 'POST',
            body: formData
          })
          .then(response => response.text())
          .then(result => {
            if (result === 'success') {
              // Reload comments after successful submission
              fetch('scripts/fetch_post/fetch_post_comment.php', {
                method: 'POST',
                headers: {
                  'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: new URLSearchParams('post_id=' + postId)
              })
              .then(response => response.text())
              .then(data => {
                document.querySelector('#modal-commentpost-content').innerHTML = data;
                // Reset form
                this.reset();
              })
              .catch(error => console.error('Error fetching comments:', error));
            } else {
              console.error('Error:', result);
            }
          })
          .catch(error => console.error('Error submitting comment:', error));
        });
      })
      .catch(error => console.error('Error fetching comment form:', error));
    });
  });
});

</script>
<?php require_once "include/posttemplate/comment_modal/post_comment.php"; ?>
