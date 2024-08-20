<?php
require_once 'include/connect.php';
// Example variables
$loggedInUserNo = $_SESSION['user_no']; // Current logged-in user's number
$profilePic = getProfilePicture($user_no, $con);

$defaultProfilePic = 'profile.jpg';
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
                        <img src="users/images/profilepicture/<?php echo !empty($profilePic) ? $profilePic : $defaultProfilePic; ?>"  style="object-fit:contain; width: 40px; height: 40px; border-radius: 50%;" alt="">
                        </a>
                    <?php else: ?>
                        <!-- Link to the other user's profile -->
                        <a href="users/other_profile.php?user_no=<?php echo htmlspecialchars($user_no); ?>" style="font-size:1rem; text-decoration: none; color: black;">
                        <img src="users/images/profilepicture/<?php echo !empty($profilePic) ? $profilePic : $defaultProfilePic; ?>"  style="object-fit:contain; width: 40px; height: 40px; border-radius: 50%;" alt="">
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
                    <!-- <li><a class="dropdown-item" href="#">Copy post</a></li>
                    <li><a class="dropdown-item" href="#">Delete post</a></li> -->
                    <li><a class="dropdown-item" href="#">Under maintenance</a></li>
                <?php else: ?>
                    <!-- Pass the post_id and user_no as data attributes for the report option -->
                    <li><a class="dropdown-item" href="#" 
                        data-bs-toggle="modal" 
                        data-bs-target="#reportmodal2"
                        data-post-id="<?php echo htmlspecialchars($post_id); ?>" 
                        data-user-no="<?php echo htmlspecialchars($user_no); ?>">Report</a></li>
                    <!-- <li><a class="dropdown-item" href="#">Copy post</a></li> -->
                <?php endif; ?>
                </ul>
            </div>
        </div>
    </div>
    <script src="functions/JsFunction.js"></script>
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
            <div class="container-fluid puso">
                <button type="button" class="heart-btn3" data-post-id="<?php echo htmlspecialchars($post_id); ?>" data-user-no="<?php echo htmlspecialchars($loggedInUserNo); ?>">
                    <i class="fa-regular fa-heart"></i>
                </button>
                <span class="reaction-count">0</span>
            </div>

            <div class="container-fluid imagecomment">
        <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal_imagepost" data-bs-whatever="<?php echo htmlspecialchars($post_id); ?>">
            <i class="fa-regular fa-comment-dots fa-flip-horizontal"></i>
            </button>
        </div>

            <div class="container-fluid share">
                <!-- <button><i class="fa-regular fa-paper-plane"></i></button> -->
            </div>
        </div>
        <!-- Collection section -->
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
<?php include 'include/posttemplate/report_modal/report_post.php'; ?>
<script>
    // JavaScript to handle modal report data
    document.addEventListener('DOMContentLoaded', function () {
    var reportModal = document.getElementById('reportmodal2');

    reportModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget; // Button that triggered the modal
        var postId = button.getAttribute('data-post-id');
        var userNo = button.getAttribute('data-user-no');
        var reporterUserNo = '<?php echo $loggedInUserNo; ?>'; // Pass the current user's number

        var modalPostIdInput = reportModal.querySelector('#modal_post_id');
        var modalUserNoInput = reportModal.querySelector('#modal_user_no');
        var modalReporterUserNoInput = reportModal.querySelector('#modal_reporter_user_no');

        modalPostIdInput.value = postId;
        modalUserNoInput.value = userNo;
        modalReporterUserNoInput.value = reporterUserNo;
    });
});
</script>
<script>
  document.addEventListener('DOMContentLoaded', function () {
    var exampleModal = document.getElementById('exampleModal_imagepost');
    var commentPollInterval = 1000;

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

        // Fetch and update comments
        function updateComments() {
            fetchComments(postId);
        }

        updateComments(); // Initial fetch
        var commentPolling = setInterval(updateComments, commentPollInterval);

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

                            // Optionally, update comments immediately after submitting
                            updateComments();
                        } else {
                            console.error('Error:', data.message);
                        }
                    })
                    .catch(error => console.error('Error:', error));
                });
            }
        })
        .catch(error => console.error('Error fetching input comment form:', error));

        // Clear interval when modal is hidden
        exampleModal.addEventListener('hide.bs.modal', function () {
            clearInterval(commentPolling);
        });
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
    // Fetch initial heart reaction states
    document.querySelectorAll('.heart-btn3').forEach(button => {
        const postId = button.getAttribute('data-post-id');
        const userNo = button.getAttribute('data-user-no');
        const icon = button.querySelector('i');
        const countSpan = button.nextElementSibling;

        fetch('scripts/fetch_heart_textpost/get_heart_status.php', {
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
                // Update the heart icon and count based on fetched data
                if (data.reacted) {
                    icon.classList.remove('fa-regular');
                    icon.classList.add('fa-solid');
                    icon.style.color = '#ff0000';
                } else {
                    icon.classList.remove('fa-solid');
                    icon.classList.add('fa-regular');
                    icon.style.color = '';
                }
                
                // Update the reaction count and visibility
                const heartCount = data.heartCount;
                countSpan.textContent = heartCount;

                if (heartCount > 0) {
                    countSpan.style.display = 'inline'; // Show the count if greater than 0
                } else {
                    countSpan.style.display = 'none'; // Hide the count if 0
                }
            } else {
                console.error('Error:', data.message);
            }
        })
        .catch(error => console.error('Error:', error));
    });

    // Handle heart button clicks
    document.querySelectorAll('.heart-btn3').forEach(button => {
        button.addEventListener('click', function () {
            const postId = this.getAttribute('data-post-id');
            const userNo = this.getAttribute('data-user-no');
            const icon = this.querySelector('i');
            const countSpan = this.nextElementSibling;

            // Check if the button is already in the process of toggling
            if (this.classList.contains('toggling')) return;

            this.classList.add('toggling'); // Add a class to indicate toggling

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
                    
                    // Update the reaction count and visibility
                    const heartCount = data.heartCount;
                    countSpan.textContent = heartCount;

                    if (heartCount > 0) {
                        countSpan.style.display = 'inline'; // Show the count if greater than 0
                    } else {
                        countSpan.style.display = 'none'; // Hide the count if 0
                    }
                } else {
                    console.error('Error:', data.message);
                }
            })
            .catch(error => console.error('Error:', error))
            .finally(() => {
                this.classList.remove('toggling'); // Remove the class after request is done
            });
        });
    });
});

</script>

<?php include 'include/posttemplate/comment_modal/imagepost_comment.php'; ?>