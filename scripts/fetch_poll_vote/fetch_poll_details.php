<?php
session_start();
require_once '../../include/connect.php';
require_once '../../functions/common_function.php';

$defaultProfilePic = 'profile.jpg';

if (isset($_POST['poll_id'])) {
    $poll_id = $_POST['poll_id'];
    $loggedInUserNo = $_SESSION['user_no'];

    $query = "SELECT p.user_no, p.question, u.fname, u.lname, p.created_at
              FROM polls p
              JOIN user_registration u ON p.user_no = u.user_no
              WHERE p.poll_id = ?";
    
    $stmt = $con->prepare($query);
    $stmt->bind_param("i", $poll_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $post = $result->fetch_assoc();
        $user_no = $post['user_no'];
        $poll_question = $post['question'];
        $fname = $post['fname'];
        $lname = $post['lname'];
        $timestamp = $post['created_at'];

        $profilePic = getProfilePicture($user_no, $con);
        $dateTime = new DateTime($timestamp);
        $formattedDate = $dateTime->format('F j, Y');
        $formattedTime = $dateTime->format('g:i a');

        // Fetch the user's previous vote
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
    }
}
?>

<div class="card" style="width: 100%; border:none;">
    <div class="container-fluid nametextpost" style="margin:10px 0 10px; display:flex; align-items:center;">
        <div class="container-fluid lgyan">
            <div class="container-fluid prof_pic">
                <div>
                    <?php if ($user_no == $loggedInUserNo): ?>
                        <a href="users/profile.php?sideprof" style="font-size:1rem; text-decoration: none; color: black;">
                            <img src="users/images/profilepicture/<?php echo !empty($profilePic) ? $profilePic : $defaultProfilePic; ?>" style="object-fit:contain; width: 40px; height: 40px; border-radius: 50%;" alt="">
                        </a>
                    <?php else: ?>
                        <a href="users/other_profile.php?user_no=<?php echo htmlspecialchars($user_no); ?>" style="font-size:1rem; text-decoration: none; color: black;">
                            <img src="users/images/profilepicture/<?php echo !empty($profilePic) ? $profilePic : $defaultProfilePic; ?>" style="object-fit:contain; width: 40px; height: 40px; border-radius: 50%;" alt="">
                        </a>
                    <?php endif; ?>
                </div>
            </div>
            <div class="container-fluid pangalan">
                <div>
                    <?php if ($user_no == $loggedInUserNo): ?>
                        <a href="users/profile.php?sideprof"><span class="pangalantextpost"><?php echo htmlspecialchars($fname . ' ' . $lname); ?></span></a>
                    <?php else: ?>
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
        <div class="container-fluid dots">
            <div class="dropdown dot">
                <button class="btn btn-secondary dropdown-toggle bg-white" style="border:none;" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa-solid fa-ellipsis-vertical"></i>
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Edit</a></li>
                    <li><a class="dropdown-item" href="#">Delete</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="container-fluid text-break captionpoll">
            <p><?php echo htmlspecialchars($poll_question); ?></p>
        </div>
        <div class="container-fluid">
            <a class="see-more-btn" href="#">See More</a>
        </div>
    <div class="container-fluid">
        <?php if (!empty($options)): ?>
            <ul>
                <?php foreach ($options as $option): ?>
                    <li>
                        <label>
                            <input type="radio" name="poll_option" value="<?php echo htmlspecialchars($option['options_id']); ?>" <?php echo $option['options_id'] == $selectedOptionId ? 'checked' : ''; ?>>
                            <?php echo htmlspecialchars($option['option_text']); ?>
                        </label>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
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