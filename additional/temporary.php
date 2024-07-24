<?php

if (isset($_POST['submit'])) {

  $select = "SELECT * FROM user_registration WHERE email = ? OR user_ID = ? OR student_no = ?";
  $stmt = $con->prepare($select);
  $stmt->bind_param('sss', $_SESSION['email'], $_SESSION['user_ID'], $_SESSION['student_no']);
  $stmt->execute();
  $result = $stmt->get_result();
  $row = $result->fetch_assoc();

  $_SESSION['user_no'] = $row['user_no'];
  

    // Check if form data is present
    if (isset($_POST['ff']) || isset($_POST['sb']) || isset($_POST['caption']) || isset($_FILES['postphoto'])) {
        $user_no = $_SESSION['user_no'];
        $ff = $_POST['ff'];
        $sb = $_POST['sb'];
        $caption = $_POST['caption'];
        $postphoto = $_FILES['postphoto']['name'];
        

        // Handle file upload
        $tmp_postphoto = $_FILES['postphoto']['tmp_name'];
        $upload_path = "./include/posts_images/$postphoto";

        if (move_uploaded_file($tmp_postphoto, $upload_path)) {
            // Prepare SQL statement
            $sql = "INSERT INTO posts (user_no, ff, sb, caption, postphoto) VALUES (?, ?, ?, ?, ?)";
            $stmt = $con->prepare($sql);

            if ($stmt) {
                $stmt->bind_param('issss',$user_no, $ff, $sb, $caption, $postphoto);
                if ($stmt->execute()) {
                    header('location: index.php');
                } else {
                    echo "Error executing statement: " . $stmt->error;
                }
            } else {
                echo "Error preparing statement: " . $con->error;
            }
        } else {
            echo "Error uploading file.";
        }
    } else {
        echo "Form data is missing.";
    }
}
?>