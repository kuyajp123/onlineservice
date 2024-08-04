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
                <!-- Buttons to open the modal -->
           
                <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="<?php echo htmlspecialchars($post_id); ?>">
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
<script>
    // fetching post and comment in comment section modal
document.addEventListener('DOMContentLoaded', function () {
  var exampleModal = document.getElementById('exampleModal');

  exampleModal.addEventListener('show.bs.modal', function (event) {
    // Button that triggered the modal
    var button = event.relatedTarget;
    // Extract info from data-bs-* attributes
    var postId = button.getAttribute('data-bs-whatever');

    // Fetch post details
    fetch('scripts/fetch_textpost_details.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded'
      },
      body: new URLSearchParams('post_id=' + postId)
    })
    .then(response => response.text())
    .then(data => {
      var modalContent = exampleModal.querySelector('#modal-content');
      modalContent.innerHTML = data;
    })
    .catch(error => {
      console.error('Error fetching post details:', error);
    });

    // Fetch comments for the post
    fetch('scripts/fetch_textpost_comment.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded'
      },
      body: new URLSearchParams('post_id=' + postId)
    })
    .then(response => response.text())
    .then(data => {
      var modalCommentContent = exampleModal.querySelector('#modal-comment-content');
      modalCommentContent.innerHTML = data;
    })
    .catch(error => {
      console.error('Error fetching comments:', error);
    });
  });
});
</script>

<?php require_once "include/posttemplate/comment_modal/textpost_comment.php"; ?>