<?php while ($row = $result->fetch_assoc()): ?>
    <?php
    // Extract data
    $post_id = htmlspecialchars($row['post_id']);
    $user_no = htmlspecialchars($row['user_no']);
    $fname = htmlspecialchars($row['fname']);
    $lname = htmlspecialchars($row['lname']);
    // $profile_pic = htmlspecialchars($row['profile_pic']);
    $timestamp = htmlspecialchars($row['timestamp']);
    $postphoto = htmlspecialchars($row['postphoto']);
    $caption = htmlspecialchars($row['caption']);

    // Create DateTime object
    $dateTime = new DateTime($timestamp);

    // Format date and time
    $formattedDate = $dateTime->format('F j, Y'); // e.g., July 24, 2023
    $formattedTime = $dateTime->format('g:i a'); // e.g., 6:27 pm

    // Determine which template to include
    $hasText = !empty(trim($caption));
    $hasImage = !empty(trim($postphoto));

    if ($hasText && $hasImage) {
        // Post with both text and image
        require 'include/posttemplate/post.php';
    }
    elseif ($hasText) {
        // Post with text only
        require 'include/posttemplate/textpost.php';
    } elseif ($hasImage) {
        // Post with image only
        // You can create a separate template for image-only posts if needed
        require 'include/posttemplate/imagepost.php';
    }
    ?>

<?php endwhile; ?>






<!-- post creation -->
<?php

// Initialize an empty string for error messages
$error = "";
$postphoto = "";

// Prepare SQL query to fetch user data
$sql = "SELECT * FROM user_registration WHERE user_ID = ? OR email = ? OR student_no = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param('sss', $_SESSION['user_ID'], $_SESSION['email'], $_SESSION['student_no']);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();


$_SESSION['user_no'] = $row['user_no'];

if (isset($_POST['submit'])) {
    // Initialize flags to check if any content is provided
    $is_relation_set = isset($_POST['relation']) && !empty($_POST['relation']);
    $is_services_set = isset($_POST['services']) && !empty($_POST['services']);
    $is_caption_set = isset($_POST['caption']) && !empty(trim($_POST['caption']));
    $is_postphoto_set = isset($_FILES['postphoto']['name']) && !empty($_FILES['postphoto']['name']);

    // Check if category fields (relation and services) are empty
    if (!$is_relation_set || !$is_services_set) {
        $error = "Please provide a category to post.";
    }

    // Check if both caption and postphoto are empty
    if (!$is_caption_set && !$is_postphoto_set) {
        $error = "Please provide content for your post.";
    }

    // If no errors, process the post
    if (empty($error)) {
      $user_no = $_SESSION['user_no'];
      $relation = $_POST['relation'];
      $services = $_POST['services'];
      $caption = $_POST['caption'];
      $postphoto = isset($_FILES['postphoto']['name']) ? $_FILES['postphoto']['name'] : '';


      // Handle file upload
      if ($postphoto) {
        $tmp_postphoto = $_FILES['postphoto']['tmp_name'];
        $upload_path = "include/posts_images/$postphoto";

        if (move_uploaded_file($tmp_postphoto, $upload_path)) {
            $sql = "INSERT INTO posts (user_no, relation, services, caption, postphoto) VALUES (?, ?, ?, ?, ?)";
            $stmt = $con->prepare($sql);
            $stmt->bind_param('issss', $user_no, $relation, $services, $caption, $postphoto);
            $stmt->execute();

            echo "<script>window.open('index.php','_self')</script>";
        } else {
            $error = "Failed to upload photo.";
        }
    } else {
        // Insert post without photo
        $sql = "INSERT INTO posts (user_no, relation, services, caption, postphoto) VALUES (?, ?, ?, ?, '')";
        $stmt = $con->prepare($sql);
        $stmt->bind_param('isss', $user_no, $relation, $services, $caption);
        $stmt->execute();
    }
  }
}


?>