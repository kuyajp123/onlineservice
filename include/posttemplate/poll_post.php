<?php
// Example variables
$loggedInUserNo = $_SESSION['user_no']; // Current logged-in user's number
$profilePic = getProfilePicture($user_no, $con);
$defaultProfilePic = 'profile.jpg';

// Fetch the user's previous vote, if any
$stmt = $con->prepare("SELECT options_id FROM poll_votes WHERE poll_id = ? AND user_no = ?");
$stmt->bind_param("ii", $poll_id, $loggedInUserNo);
$stmt->execute();
$stmt->bind_result($selectedOptionId);
$stmt->fetch();
$stmt->close();

// Fetch the total votes for each option
$vote_counts = [];
$total_votes = 0;

$votes_sql = "SELECT options_id, COUNT(*) as count FROM poll_votes WHERE poll_id = ? GROUP BY options_id";
$votes_stmt = $con->prepare($votes_sql);
$votes_stmt->bind_param("i", $poll_id);
$votes_stmt->execute();
$votes_stmt->bind_result($option_id, $count);
while ($votes_stmt->fetch()) {
    $vote_counts[$option_id] = $count;
    $total_votes += $count;
}
$votes_stmt->close();


?>

<div class="card" style="width: 100%; border:none;">
    <div class="container-fluid nametextpost" style="margin:10px 0 10px; display:flex; align-items:center;">
        <div class="container-fluid lgyan">
        <div class="container-fluid prof_pic">
        <!-- profile image inpost -->
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
                  </div></a>
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
        <!-- 3 dots section -->
        <div class="container-fluid dots">
            <div class="dropdown dot">
            <button class="btn dropdown-toggle" style="border:none;" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa-solid fa-ellipsis fa-xl" style="color: #575b60; font-size:20px;"></i>
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
                                data-post-id="<?php echo htmlspecialchars($poll_id); ?>" 
                                data-user-no="<?php echo htmlspecialchars($user_no); ?>">Report</a></li>
                            <!-- <li><a class="dropdown-item" href="#">Copy post</a></li> -->
                        <?php endif; ?>
                        </ul>
                </button>
            </div>
        </div>
    </div>
    
    <div class="container-fluid pollcont" data-poll-id="<?php echo htmlspecialchars($poll_id); ?>">
        <div class="container-fluid text-break captionpoll">
            <p><?php echo htmlspecialchars($poll_question); ?></p>
        </div>
        <div class="container-fluid">
            <a class="see-more-btn" href="#">See More</a>
        </div>
        <div class="container-fluid text-break votespoll">
        <?php foreach ($options as $index => $option) : ?>
                <?php
                $option_id = $option['id'];
                $vote_count = isset($vote_counts[$option_id]) ? $vote_counts[$option_id] : 0;
                $percentage = $total_votes > 0 ? ($vote_count / $total_votes) * 100 : 0;
                ?>
                <div class="container-fluid optiontext" data-option="option<?php echo $index + 1; ?>">
                    <label class="container-fluid optionpoll">
                        <div class="container-fluid btnradiopoll">
                            <input type="radio" style="cursor:pointer;" name="options_<?php echo htmlspecialchars($poll_id); ?>" 
                                   value="<?php echo htmlspecialchars($option['id']); ?>"
                                   <?php echo ($selectedOptionId == $option['id']) ? 'checked' : ''; ?> />
                        </div>
                        <?php if($option['image'] == NULL):?>
                            <!-- leave blank space if no image -->
                        <?php else: ?>
                            <div class="container-fluid imgpoll">
                                <img src="<?php echo htmlspecialchars($option['image']); ?>" alt="Option <?php echo $index + 1; ?> Image">
                            </div>
                        <?php endif; ?>
                        <div class="container-fluid optionprogress">
                            <span><?php echo htmlspecialchars($option['text']); ?></span>
                            <div class="progress" style="width: 100%; display: none;" role="progressbar" aria-label="Success example" aria-valuenow="<?php echo htmlspecialchars($percentage); ?>" aria-valuemin="0" aria-valuemax="100">
                                <div class="progress-bar bg-success" style="width: <?php echo htmlspecialchars($percentage); ?>%"><?php echo htmlspecialchars(number_format($percentage, 2)); ?>%</div>
                            </div>
                        </div>
                    </label>
                </div>
            <?php endforeach; ?>

</div>
    </div>
    <div class="card-body pollactions">
        <!-- Actions -->
    <div class="container-fluid heart">
        <div class="container-fluid thethree">
            <!-- Heart Reaction Section -->
            <div class="container-fluid puso">
                <button type="button" class="heart-btn-poll" data-poll-id="<?php echo htmlspecialchars($poll_id); ?>" data-user-no="<?php echo htmlspecialchars($loggedInUserNo); ?>">
                    <i class="fa-regular fa-heart"></i>
                </button>
                <span class="reaction-count">0</span>
            </div>

            <div class="container-fluid comment">
                <!-- Button to open the modal -->
                <button type="button" data-bs-toggle="modal" data-bs-target="#examplePollModal" data-bs-whatever="<?php echo htmlspecialchars($poll_id); ?>">
                    <i class="fa-regular fa-comment-dots fa-flip-horizontal"></i>
                </button>

                
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
    </div>
</div>


            <!-- Image Modal -->
<div id="imageModal" class="modal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-body">
        <img id="modalImage" src="" alt="Full Image" class="img-fluid">
      </div>
    </div>
  </div>
</div>

            <script>
  function toggleSeeMore(container, limit) {
    const captionPoll = container.querySelector('.captionpoll');
    const seeMoreBtn = container.querySelector('.see-more-btn');
    const text = captionPoll.textContent;

    // Check if the text length exceeds the limit
    if (text.length > limit) {
      captionPoll.style.overflow = 'hidden';
      captionPoll.style.height = 'auto';
      captionPoll.style.maxHeight = '50px'; // Limit height to simulate the "see more" functionality
      seeMoreBtn.style.display = 'block';

      seeMoreBtn.addEventListener('click', function () {
        if (captionPoll.style.maxHeight) {
          captionPoll.style.maxHeight = '';
          seeMoreBtn.textContent = 'See Less';
        } else {
          captionPoll.style.maxHeight = '50px';
          seeMoreBtn.textContent = 'See More';
        }
      });
    }
  }

  // Use the function for each poll container
  document.querySelectorAll('.pollcont').forEach(function (container) {
    toggleSeeMore(container, 100); // Set your character limit here, e.g., 100
  });
</script>
<script>
 document.querySelectorAll('.pollcont').forEach(poll => {
    const pollId = poll.getAttribute('data-poll-id');
    const options = poll.querySelectorAll('.optiontext');

    options.forEach(option => {
        option.addEventListener('click', function() {
            options.forEach(el => el.classList.remove('selected'));
            this.classList.add('selected');
            this.querySelector(`input[name="options_${pollId}"]`).checked = true;

            // Send the vote to the server
            const optionId = this.querySelector('input').value;
            const userNo = "<?php echo $loggedInUserNo; ?>";

            fetch('scripts/fetch_poll_vote/save_vote.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    poll_id: pollId,
                    selected_option_id: optionId,
                    user_no: userNo
                })
            })
            .then(response => response.json())
            .then(data => {
                console.log('Vote saved:', data);

                // Fetch the updated vote counts and update progress bars
                fetch(`scripts/fetch_poll_vote/get_vote_counts.php?poll_id=${pollId}`)
                    .then(response => response.json())
                    .then(data => {
                        console.log('Vote counts:', data);
                        updateProgressBars(poll, data);
                    })
                    .catch(error => {
                        console.error('Error fetching vote counts:', error);
                    });
            })
            .catch(error => {
                console.error('Error saving vote:', error);
            });
        });
    });

    // Function to update progress bars based on the fetched vote counts
    function updateProgressBars(poll, voteCounts) {
        const totalVotes = Object.values(voteCounts).reduce((a, b) => a + b, 0);

        poll.querySelectorAll('.optiontext').forEach(option => {
            const optionId = option.querySelector('input').value;
            const voteCount = voteCounts[optionId] || 0;
            const percentage = totalVotes > 0 ? (voteCount / totalVotes) * 100 : 0;

            const progressBar = option.querySelector('.progress');
            progressBar.style.display = 'block';
            progressBar.querySelector('.progress-bar').style.width = `${percentage}%`;
            progressBar.querySelector('.progress-bar').textContent = `${percentage.toFixed(2)}%`;
        });
    }

    // Initial update of progress bars
    fetch(`scripts/fetch_poll_vote/get_vote_counts.php?poll_id=${pollId}`)
        .then(response => response.json())
        .then(data => {
            updateProgressBars(poll, data);
        })
        .catch(error => {
            console.error('Error fetching vote counts:', error);
        });
});


document.querySelectorAll('.imgpoll img').forEach(img => {
  img.addEventListener('click', function () {
    const modalImage = document.getElementById('modalImage');
    modalImage.src = this.src;
    const imageModal = new bootstrap.Modal(document.getElementById('imageModal'));
    imageModal.show();
  });
});
</script>



<!-- comment and heart script -->
<script>
 document.addEventListener('DOMContentLoaded', function () {
    var exampleModal = document.getElementById('examplePollModal');
    var commentPollInterval = 1000; // Polling interval for comments

    exampleModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var pollId = button.getAttribute('data-bs-whatever');

        // Fetch poll details
        fetch('scripts/fetch_poll_vote/fetch_poll_details.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: new URLSearchParams('poll_id=' + pollId)
        })
        .then(response => response.text())
        .then(data => {
            var modalContent = exampleModal.querySelector('#modal-content');
            modalContent.innerHTML = data;
        })
        .catch(error => {
            console.error('Error fetching poll details:', error);
        });

        // Fetch and update comments
        function updateComments() {
            fetchComments(pollId);
        }

        updateComments(); // Initial fetch
        var commentPolling = setInterval(updateComments, commentPollInterval);

        // Fetch input comment form
        fetch('scripts/fetch_poll_vote/input_comment_pollpost.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: new URLSearchParams('poll_id=' + pollId)
        })
        .then(response => response.text())
        .then(data => {
            var modalInputComment = exampleModal.querySelector('#modal-input-comment');
            modalInputComment.innerHTML = data;

            // Attach submit event listener to the form
            var form = modalInputComment.querySelector('form');
            if (form) {
                form.addEventListener('submit', function (e) {
                    e.preventDefault(); // Prevent default form submission

                    var formData = new FormData(form);

                    fetch('scripts/fetch_poll_vote/input_comment_pollpost.php', {
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
        .catch(error => {
            console.error('Error fetching input comment form:', error);
        });

        // Clear interval when modal is hidden
        exampleModal.addEventListener('hide.bs.modal', function () {
            clearInterval(commentPolling);
        });
    });

    function fetchComments(pollId) {
        fetch('scripts/fetch_poll_vote/fetch_pollpost_comment.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: new URLSearchParams('poll_id=' + pollId)
        })
        .then(response => response.text())
        .then(data => {
            var modalCommentContent = exampleModal.querySelector('#modal-comment-content');
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
    document.querySelectorAll('.heart-btn-poll').forEach(button => {
        const pollId = button.getAttribute('data-poll-id');
        const userNo = button.getAttribute('data-user-no');
        const icon = button.querySelector('i');
        const countSpan = button.nextElementSibling;

        fetch('scripts/fetch_heart_textpost/poll_heart_status.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: new URLSearchParams({
                poll_id: pollId,
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
                
                // Update the heart count and its visibility
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
    document.querySelectorAll('.heart-btn-poll').forEach(button => {
        button.addEventListener('click', function () {
            const pollId = this.getAttribute('data-poll-id');
            const userNo = this.getAttribute('data-user-no');
            const icon = this.querySelector('i');
            const countSpan = this.nextElementSibling;

            // Check if the button is already in the process of toggling
            if (this.classList.contains('toggling')) return;

            this.classList.add('toggling'); // Add a class to indicate toggling

            // Toggle heart icon and send AJAX request
            fetch('scripts/fetch_heart_textpost/poll_heart_toggle.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: new URLSearchParams({
                    poll_id: pollId,
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

                    // Update the heart count and its visibility
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

<?php require 'include\posttemplate\comment_modal\poll_comment.php' ?>