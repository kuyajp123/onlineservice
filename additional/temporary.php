<?php
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
            $upload_path = "../include/posts_images/$postphoto";

            if (move_uploaded_file($tmp_postphoto, $upload_path)) {
                $sql = "INSERT INTO posts (user_no, relation, services, caption, postphoto) VALUES (?, ?, ?, ?, ?)";
                $stmt = $con->prepare($sql);
                $stmt->bind_param('issss', $user_no, $relation, $services, $caption, $postphoto);
                $stmt->execute();

                echo "<script>window.open('../users/profile.php?sideprof','_self')</script>";
            } else {
                $error = "Failed to upload photo.";
            }
        } else {
            // Insert post without photo
            $sql = "INSERT INTO posts (user_no, relation, services, caption, postphoto) VALUES (?, ?, ?, ?, '')";
            $stmt = $con->prepare($sql);
            $stmt->bind_param('isss', $user_no, $relation, $services, $caption);
            $stmt->execute();
            echo "<script>window.open('../users/profile.php?sideprof','_self')</script>";
        }
      }
?>