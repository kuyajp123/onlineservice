<?php
require_once 'include/connect.php';
// Example variables
$loggedInUserNo = $_SESSION['user_no']; // Current logged-in user's number
$profilePic = getProfilePicture($user_no, $con);
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
                        <!-- Display other user's name -->
                        <a href="users/other_profile.php?user_no=<?php echo htmlspecialchars($user_no); ?>" style="font-size:1rem; text-decoration: none; color: black;">
                            <span class="pangalantextpost"><?php echo htmlspecialchars($fname . ' ' . $lname); ?></span>
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
            <div class="dropdown dot">
                <button class="btn btn-secondary dropdown-toggle bg-white" style="border:none;" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa-solid fa-ellipsis fa-xl" style="color: #575b60; font-size:20px;"></i>
                </button>
                <ul class="dropdown-menu">
                    <?php if($user_no == $loggedInUserNo): ?>
                        <li><a class="dropdown-item" href="#">Copy post</a></li>
                        <li><a class="dropdown-item" href="#">Delete post</a></li>
                    <?php else: ?>
                        <!-- Pass the post_id as a data attribute for the report option -->
                        <li><a class="dropdown-item" href="#" data-post-id="<?php echo htmlspecialchars($post_id); ?>" data-bs-toggle="modal" data-bs-target="#reportmodal2" data-bs-whatever="<?php echo htmlspecialchars($post_id); ?>">Report</a></li>
                        <li><a class="dropdown-item" href="#">Copy post</a></li>
                    <?php endif; ?>
                </ul>
            </div>
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
            <div class="container-fluid puso"><button type="button" class="heart-btn3" data-post-id="<?php echo htmlspecialchars($post_id); ?>" data-user-no="<?php echo htmlspecialchars($loggedInUserNo); ?>">
                    <i class="fa-regular fa-heart"></i>
                </button></div>

            <div class="container-fluid imagecomment">
        <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal_imagepost" data-bs-whatever="<?php echo htmlspecialchars($post_id); ?>">
            <i class="fa-regular fa-comment-dots fa-flip-horizontal"></i>
            </button>
        </div>

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
<?php
// getting first name of user in report modal
$query = 'SELECT ur.fname
FROM user_registration ur
JOIN posts p ON ur.user_no = p.user_no
WHERE p.post_id = ?';

$stmt = $con->prepare($query);
$stmt->bind_param('i', $post_id);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
$fnameOfPost = $row['fname'];
}

include 'include/posttemplate/report_modal/report_imagepost.php';
?>

<script>
   document.addEventListener('DOMContentLoaded', function () {
  var exampleModal = document.getElementById('exampleModal_imagepost');

  exampleModal.addEventListener('show.bs.modal', function (event) {
    var button = event.relatedTarget;
    var postId = button.getAttribute('data-bs-whatever');

    // Fetch post details
    fetch('scripts/fetch_imagepost/fetch_image_details.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded'
      },
      body: new URLSearchParams('post_id=' + postId)
    })
    .then(response => response.text())
    .then(data => {
      var modalContent = exampleModal.querySelector('#modal-content-image');
      modalContent.innerHTML = data;
    })
    .catch(error => console.error('Error fetching post details:', error));

    // Fetch comments for the post
    fetchComments(postId);

    // Fetch input comment form
    fetch('scripts/fetch_imagepost/input_comment_image.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded'
      },
      body: new URLSearchParams('post_id=' + postId)
    })
    .then(response => response.text())
    .then(data => {
      var modalInputComment = exampleModal.querySelector('#modal-imageinput-comment');
      modalInputComment.innerHTML = data;

      // Attach submit event listener to the form
      var form = modalInputComment.querySelector('form');
      if (form) {
        form.addEventListener('submit', function (e) {
          e.preventDefault(); // Prevent default form submission

          var formData = new FormData(form);

          fetch('scripts/fetch_imagepost/input_comment_image.php', {
            method: 'POST',
            body: formData
          })
          .then(response => response.json())
          .then(data => {
            if (data.status === 'success') {
              // Clear the input field
              form.reset();

              // Update comments section with new data
              fetchComments(postId);
            } else {
              console.error('Error:', data.message);
            }
          })
          .catch(error => console.error('Error:', error));
        });
      }
    })
    .catch(error => console.error('Error fetching input comment form:', error));
  });

  function fetchComments(postId) {
    fetch('scripts/fetch_imagepost/fetch_image_comment.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded'
      },
      body: new URLSearchParams('post_id=' + postId)
    })
    .then(response => response.text())
    .then(data => {
      var modalCommentContent = exampleModal.querySelector('#modal-commentimage-content');
      modalCommentContent.innerHTML = data;
    })
    .catch(error => console.error('Error fetching comments:', error));
  }
});
</script>

<!-- fetching heart reaction in post -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.heart-btn3').forEach(button => {
        button.addEventListener('click', function () {
            const postId = this.getAttribute('data-post-id');
            const userNo = this.getAttribute('data-user-no');
            const icon = this.querySelector('i');
            const countSpan = this.nextElementSibling; // Assumes count span is right after the button

            // Toggle heart icon and send AJAX request
            fetch('scripts/fetch_heart_textpost/heart_toggle_textpost.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: new URLSearchParams({
                    post_id: postId,
                    user_no: userNo
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Update the heart icon and count
                    if (data.reacted) {
                        icon.classList.remove('fa-regular');
                        icon.classList.add('fa-solid');
                        icon.style.color = '#ff0000';
                    } else {
                        icon.classList.remove('fa-solid');
                        icon.classList.add('fa-regular');
                        icon.style.color = '';
                    }
                    // Always display the heart count, even if it's 0
                    countSpan.textContent = data.heartCount;
                } else {
                    console.error('Error:', data.message);
                }
            })
            .catch(error => console.error('Error:', error));
        });
    });
});

</script>

<?php include 'include/posttemplate/comment_modal/imagepost_comment.php'; ?>