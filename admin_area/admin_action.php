<?php
session_name('admin_session');
session_start();
// if (!isset($_SESSION['admin_logged_in'])) {
//     header('Location: ../login.php');
//     exit;
// }
require_once '../include/connect.php';
require_once '../include/bootsrap.php';
require_once '../functions/common_function.php';

$admin = $_SESSION['admin'];
$admin_id = $_SESSION['admin_id'];
$admin_password = $_SESSION['admin_password'];

// $user_no = isset($_GET['user_no']) ? $_GET['user_no'] : null;
$user_no = isset($_GET['user_no']) ? $_GET['user_no'] : ''; // Retrieve user_no from URL parameter

// Query to fetch user information and report count
$userQuery = 'SELECT ur.fname, ur.lname, ur.user_no, ur.student_no, ur.email, 
                     ur.profilepicture, ur.coverphoto, 
                     IFNULL(COUNT(pr.report_id), 0) AS report_count,
                     aw.*, ab.*,
                     IF(COUNT(aw.warning_id) > 0, 1, 0) AS has_warning,
           			 IF(COUNT(ab.ban_id) > 0, 1, 0) AS has_ban
              FROM user_registration ur
              LEFT JOIN post_reports pr ON ur.user_no = pr.user_no
              LEFT JOIN active_warning aw ON ur.user_no = aw.user_no
              LEFT JOIN active_ban ab ON ur.user_no = ab.user_no
              WHERE ur.user_no = ?
              GROUP BY ur.user_no';

$stmt = $con->prepare($userQuery);
$stmt->bind_param('i', $user_no); // Bind the user_no parameter
$stmt->execute();
$userResult = $stmt->get_result();

if ($userResult->num_rows > 0) {
    $row = $userResult->fetch_assoc();
    // Process user data here
}

// Define the base paths for images
$profilePicBasePath = '/onlineservice/users/images/profilepicture/';
$coverPhotoBasePath = '/onlineservice/users/images/coverphoto/';

// Define default images
$defaultProfilePic = 'profile.jpg';
$defaultCoverPhoto = 'default_coverphoto.jpg';


$admin_id = $_SESSION['admin_id']; // Retrieve admin ID from the session


$warn_pass = '';
$warn_post_id = '';
$error = '';
$error1 = '';
$success = '';
$success1 = '';

$message_link = "Contact us";
$url = "https://www.facebook.com/CvSUTreceCampus";

if(isset($_POST['submit_warn'])){
    $warn_pass = $_POST['warn_pass'];
    $user_no = $_POST['user_no'];
    $warn_post_id = intval($_POST['warn_post_id']);

    if($warn_pass == $admin_password){

        //getting the count user_warnings including post and post_reports to insert notif and warning level
        $query = 'SELECT ur.fname, ur.lname, 
			p.caption, p.postphoto, p.timestamp, 
            pr.post_id, pr.report_reason, pr.report_date,
            aw.warning_id, aw.reset_date, aw.warning_level
            FROM user_registration ur
            LEFT JOIN posts p ON ur.user_no = p.user_no
            LEFT JOIN post_reports pr ON p.post_id = pr.post_id
            LEFT JOIN user_warnings aw ON ur.user_no = aw.user_no
            WHERE pr.report_id = ?';

        $stmt = $con->prepare($query);
        $stmt->bind_param('i', $warn_post_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if($result->num_rows > 0){
            $warn_appeal_id = mt_rand(100000, 999999);

            $timestamp = htmlspecialchars($user['report_date']);
            $report_date = new DateTime($timestamp);

            $formattedReportDate = $report_date->format('F j, Y'); // e.g., July 24, 2023
            $formattedReportTime= $report_date->format('g:i a'); // e.g., 6:27 pm

            $msgwarning = "
            Subject: Warning: Violation of Community Standards<br><br>

            Dear ".$user['fname']." ".$user['lname'].",<br><br>

            We hope this message finds you well. This is a formal warning regarding recent activity on your account that has been found to be in violation of our community standards.<br><br>

            <h2>$warn_appeal_id</h2>

            Violation Details:<br><br>

            Reported Date: $formattedReportDate<br>
            Description: Multiple report counts<br>
            Community Standard Violated: ".$user['report_reason']."<br><br>

            As this is a serious matter, we ask that you review our community guidelines to ensure that your future actions align with our standards. Repeated violations may result in further action, including temporary suspension or permanent banning of your account.<br><br>

            Please note that this warning will be recorded in your account history. Should you receive additional warnings, the consequences may escalate as outlined in our community guidelines.<br><br>

            If you believe this warning was issued in error, or if you have any questions, you may contact our support team at <a href=\"$url\" target='_blank' style='text-decoration: underline; color:#0000EE;'>$message_link</a> and indicate this reference number: $warn_appeal_id within the next 7 days.<br><br>

            We value your participation in our community and hope to see you continue to contribute positively.<br><br>

            Thank you for your attention to this matter.<br><br>

            Best regards,<br>
            CvSTagram Team<br>
            <a href=\"$url\" target='_blank' style='text-decoration: underline; color:#0000EE;'>Visit our Facebook page</a><br>
            ";


            // $current_date = date('Y-m-d');

            $query = "SELECT * FROM active_warning WHERE user_no = ?";
            $stmt2 = $con->prepare($query);
            $stmt2->bind_param("i", $user_no);
            $stmt2->execute();
            $result2 = $stmt2->get_result();
            $warning = $result2->fetch_assoc();

            $warning_level = $warning['warning_level'] ?? 0;

            if ($result2->num_rows === 0) {
                // No existing active warning for the user, so start with warning level 1
                $warning_level = 1;
            
                // Step 1: Insert into user_warnings table
                $query1 = "INSERT INTO `user_warnings` (`user_no`, `warn_appeal_id`, `warning_level`, `issue_date`, `reset_date`)
                           VALUES (?, ?, ?, CURDATE(), DATE_ADD(CURDATE(), INTERVAL 15 DAY))";
            
                $stmt1 = $con->prepare($query1);
                $stmt1->bind_param('iii', $user_no, $warn_appeal_id, $warning_level);
            
                if ($stmt1->execute()) {
                    // Step 2: Get the last inserted warning_id
                    $warning_id = $con->insert_id;
            
                    // Step 3: Insert into active_warning table using the retrieved warning_id
                    $query2 = "INSERT INTO `active_warning` (`warning_id`, `user_no`, `warn_appeal_id`, `warning_level`, `issue_date`, `reset_date`)
                               VALUES (?, ?, ?, ?, CURDATE(), DATE_ADD(CURDATE(), INTERVAL 15 DAY))";
            
                    $stmt2 = $con->prepare($query2);
                    $stmt2->bind_param('iiii', $warning_id, $user_no, $warn_appeal_id, $warning_level);
            
                    if ($stmt2->execute()) {
                        $success = "Warning inserted successfully into both tables.";
                    } else {
                        $error = "Failed to insert into active_warning table: " . $stmt2->error;
                    }
                } else {
                    $error = "Error inserting warning into user_warnings table: " . $stmt1->error;
                }
            } else {
            
                // Update the existing active_warning entry first
                $query_update = "UPDATE `active_warning` 
                SET `warn_appeal_id` = ?, `warning_level` = `warning_level` + 1, `issue_date` = CURDATE(), `reset_date` = DATE_ADD(CURDATE(), INTERVAL 15 DAY)
                WHERE `user_no` = ?";

                $stmt_update = $con->prepare($query_update);
                $stmt_update->bind_param('ii', $warn_appeal_id, $user_no);

                if ($stmt_update->execute()) {
                // Retrieve the incremented warning_level from active_warning
                $query_select = "SELECT `warning_level` FROM `active_warning` WHERE `user_no` = ?";
                $stmt_select = $con->prepare($query_select);
                $stmt_select->bind_param('i', $user_no);
                $stmt_select->execute();
                $stmt_select->bind_result($warning_level);
                $stmt_select->fetch();
                $stmt_select->close();

                // Now insert the new warning into user_warnings table
                $query_insert = "INSERT INTO `user_warnings` (`user_no`, `warn_appeal_id`, `warning_level`, `issue_date`, `reset_date`)
                    VALUES (?, ?, ?, CURDATE(), DATE_ADD(CURDATE(), INTERVAL 15 DAY))";

                $stmt_insert = $con->prepare($query_insert);
                $stmt_insert->bind_param('iii', $user_no, $warn_appeal_id, $warning_level);

                if ($stmt_insert->execute()) {
                $success = "Warning updated and new warning inserted successfully.";
                } else {
                $error = "Error inserting new warning into user_warnings table: " . $stmt_insert->error;
                }
                } else {
                $error = "Failed to update active_warning table: " . $stmt_update->error;
                }
            }


            $caption = $user['caption'];
            $postphoto = $user['postphoto'];

            // Prepare the INSERT query with placeholders
            $sql = "INSERT INTO notifications (user_no, admin_id, notification_photo, notification_caption, notification_type, notification_text, timestamp) VALUES (?, ?, ?, ?, 'warning', ?, NOW())";

            $stmt2 = $con->prepare($sql);
            $stmt2->bind_param('iisss', $user_no, $admin_id, $postphoto, $caption, $msgwarning);
            if($stmt2->execute()) {
                $success1 = "Notification inserted successfully.";
                echo "<script>window.open('admin_action.php?user_no=" . $user_no . "','_self');</script>";
            } else {
                $error1 = "Error inserting notification: " . $stmt2->error;
            }

        } else {
            $error1 = 'Theres no data retrieved';
        }
    } else {
        $error1 = 'password didn\'t match';
    }
}

$ban_type = '';
$ban_pass = '';

if(isset($_POST['submit_ban'])){
    $ban_type = intval($_POST['ban_type']);
    $ban_pass = $_POST['ban_pass'];

    if($ban_type == 0){
        $error = 'please choose ban type';
    }else{
        
        if($ban_pass == $admin_password){
        //getting the count user_warnings including post and to insert notif and banning level
        $query = 'SELECT ur.fname, ur.lname, ur.student_no, ur.email, 
        aw.warning_level, aw.issue_date, aw.reset_date, 
        ab.ban_id, ab.ban_level, ab.ban_start_date, ab.ban_end_date
        FROM user_registration ur
        LEFT JOIN user_warnings aw ON ur.user_no = aw.user_no
        LEFT JOIN user_bans ab ON ur.user_no = ab.user_no
        WHERE ur.user_no = ?
        GROUP BY ur.user_no';

        $stmt_ban = $con->prepare($query);
        $stmt_ban->bind_param('i', $user_no);
        $stmt_ban->execute();
        $result = $stmt_ban->get_result();
        $user = $result->fetch_assoc();

        if($result->num_rows > 0){
            
            $timestamp = date('Y-m-d');
            $report_date = new DateTime($timestamp);

            $formattedReportDate = $report_date->format('F j, Y'); // e.g., July 24, 2023
            $formattedReportTime= $report_date->format('g:i a'); // e.g., 6:27 pm

            $start_date = new DateTime(); // Today's date
           
            //7 days ban
            if($ban_type == 1){
                $start_date->add(new DateInterval('P7D'));
                $end_days_ban = $start_date->format('F j, Y'); // e.g., July 24, 2023
                $end_days_ban2 = $start_date->format('Y-m-d');
            }elseif($ban_type == 2){
                $start_date->add(new DateInterval('P30D'));
                $end_days_ban = $start_date->format('F j, Y'); // e.g., July 24, 2023
                $end_days_ban2 = $start_date->format('Y-m-d');
            }else{
                $end_days_ban2 = NULL;
                $end_days_ban = 'Permanent ban';
            }

            $ban_appeal_id = mt_rand(100000, 999999);

            $ban_msg = "
            Subject: Violation of Community Standards<br><br>

            Dear ".strtoupper($user['fname'])." ".strtoupper($user['lname']).",<br><br>

            We hope this message finds you well. This email is to inform you that your account has been suspended due to a violation of our community guidelines.<br><br>

            <h2>$ban_appeal_id</h2>

            Details of Suspension:<br><br>

            Date: $formattedReportDate<br>
            Violation Reason: Violate community standards<br>
            Ban Level: $ban_type<br>
            Ban Start Date: $formattedReportDate<br>
            Ban End Date: $end_days_ban<br><br>

            We take our community standards very seriously and aim to ensure a positive experience for all users. This action was taken following a thorough review of the reports and your recent activity. If you believe this decision was made in error, or if you have any questions regarding this suspension, please contact our support team at <a href=\"$url\" target='_blank' style='text-decoration: underline; color:#0000EE;'>$message_link</a> and provide the following reference number for further assistance: $ban_appeal_id.<br><br>

            Please take this time to review our community guidelines to avoid any future issues. We appreciate your understanding and cooperation.<br><br>

            Thank you for your attention to this matter.<br><br>

            Best regards,<br>
            CvSTagram<br>
            <a href=\"$url\" target='_blank' style='text-decoration: underline; color:#0000EE;'>Visit our Facebook page</a><br>
            ";

            if($ban_msg){

                $query = "SELECT * FROM `active_ban` WHERE user_no = ?";
                $stmt = $con->prepare($query);
                $stmt->bind_param("i", $user_no);
                $stmt->execute();
                $result = $stmt->get_result();
                
                if($result->num_rows === 0){
                    $sql = "INSERT INTO user_bans (user_no, ban_appeal_id, ban_level, ban_start_date, ban_end_date)
                    VALUES (?, ?, ?, ?, ?)";
                    $stmt = $con->prepare($sql);
                    $stmt->bind_param("iiiss", $user_no, $ban_appeal_id, $ban_type, $timestamp, $end_days_ban2);

                    
                    if($stmt->execute()){
                        $ban_id = $con->insert_id;

                        $query = "INSERT INTO active_ban (ban_id, user_no, ban_appeal_id, ban_level, ban_start_date, ban_end_date)
                        VALUES (?, ?, ?, ?, ?, ?)";
                        $stmt = $con->prepare($query);
                        $stmt->bind_param("iiiiss", $ban_id, $user_no, $ban_appeal_id, $ban_type, $timestamp, $end_days_ban2);
                        $stmt->execute();

                        $success = 'Successfully updated';                 
                    }else{
                        $error = "error";
                    }
                }else{
                    $query_update = "UPDATE `active_ban` 
                    SET `ban_id` = ?, `user_no` = ?, `ban_appeal_id` = ?, `ban_level` = ?, `ban_start_date` = ?, `ban_end_date` = ?
                    WHERE `user_no` = ?";
                    $stmt = $con->prepare($query_update);
                    $stmt->bind_param("iiiissi", $user['ban_id'], $user_no, $ban_appeal_id, $ban_type, $timestamp, $end_days_ban2, $user_no);
                    $stmt->execute();

                    if($stmt->execute() ){
                        $sql = "INSERT INTO user_bans (user_no, ban_appeal_id, ban_level, ban_start_date, ban_end_date)
                        VALUES (?, ?, ?, ?, ?)";
                        $stmt = $con->prepare($sql);
                        $stmt->bind_param("iiiss", $user_no, $ban_appeal_id, $ban_type, $timestamp, $end_days_ban2);
                        $stmt->execute();
                        
                        $success = "Successfully inserted";
                    }
                }
                
            }else{
                $error = 'no message contructed';
            }

            $sql = "INSERT INTO notifications (user_no, admin_id, notification_type, notification_text, timestamp) VALUES (?, ?, 'ban', ?, NOW())";

            $stmt2 = $con->prepare($sql);
            $stmt2->bind_param('iis', $user_no, $admin_id, $ban_msg);
            
            if ($stmt2->execute()) {
                $success2 = "Notification inserted successfully.";
                echo "<script>window.open('admin_action.php?user_no=" . $user_no . "','_self');</script>";
            } else {
                $error = "Error inserting notification: " . $stmt2->error;
            }

        }else{
            $error = 'no users found';
        }
    }else{
        $error = 'Password didnt match';
    }

    }
    
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin dashboard</title>
    <link rel="stylesheet" href="admin_dashbaord.css?v=<?php echo time(); ?>">
</head>
<body>

<div class="container-fluid screen">
    <div class="container-fluid nav">
        <nav class="navbar">
            <div class="container-fluid navtexticon">
                <a class="navbar-brand px-2" href="#">
                <img src="../images/Cavite_State_University_(CvSU).png" alt="Logo" width="50" height="40" class="d-inline-block align-text-top">
                CvSTagram 
                </a>
            </div>
        </nav>
    </div>
    <div class="container-fluid contbody">
    <div class="container-fluid sidenav">
    <div class="container-fluid menubutton">
        <button onclick="toggleSidenav()">
            <i class="fa-solid fa-bars"></i>
        </button>
    </div>
    <div class="container-fluid featurescont">
    <!-- side links -->

    <div class="container-fluid buttonlinkside">
                <div class="row">
                        <div class="col">
                            <ul>
                                <li>
                                    <a href="list_of_users.php">
                                        <div class="container-fluid listofusers">
                                            <div class="container-fluid listusericon">
                                                 <i class="fa-solid fa-users fa-lg"></i>
                                            </div>
                                            <div class="container-fluid listofusersname">
                                                List of users
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <ul>
                                <li>
                                    <a href="active_warn.php">
                                        <div class="container-fluid listofusers">
                                            <div class="container-fluid listusericon">
                                            <i class="fa-solid fa-triangle-exclamation"></i>
                                            </div>
                                            <div class="container-fluid listofusersname">
                                                Warned users
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <ul>
                                <li>
                                    <a href="active_ban.php">
                                        <div class="container-fluid Bannedaccounts">
                                            <div class="container-fluid Bannedaccountsicon">
                                            <i class="fa-solid fa-user-slash fa-lg"></i>
                                            </div>
                                            <div class="container-fluid Bannedaccountsname">
                                                Banned users
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                        <div class="row">
                            <div class="col">
                                <ul>
                                    <li>
                                        <a href="request.php">
                                            <div class="container-fluid Deletedaccounts">
                                                <div class="container-fluid Deletedaccountsicon">
                                                <i class="fa-solid fa-envelope fa-lg"></i>
                                                </div>
                                                <div class="container-fluid Deletedaccountsname">
                                                        Requests
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="row">
                        <div class="col">
                            <ul>
                                <li>
                                    <a href="warned_user.php">
                                        <div class="container-fluid listofusers">
                                            <div class="container-fluid listusericon">
                                            <i class="fa-solid fa-circle-exclamation"></i>
                                            </div>
                                            <div class="container-fluid listofusersname">
                                                Warning history
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <ul>
                                <li>
                                    <a href="banned_user.php">
                                        <div class="container-fluid Bannedaccounts">
                                            <div class="container-fluid Bannedaccountsicon">
                                                <i class="fa-solid fa-ban"></i>
                                            </div>
                                            <div class="container-fluid Bannedaccountsname">
                                                Ban history
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    </div>


<!-- side links end -->
        <div class="container-fluid logoutcont">
            <div class="row">
                <div class="col">
                    <ul>
                        <li>
                            <a href="admin_logout.php">
                                <div class="container-fluid Deletedaccounts" style="border-radius: 10px;">
                                    <div class="container-fluid Deletedaccountsicon">
                                        <i class="fa-solid fa-power-off"></i>
                                    </div>
                                    <div class="container-fluid Deletedaccountsname">
                                        Logout
                                    </div>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
        </div>
        <div class="container-fluid content">
            <div class="container-fluid actionbod">
                <div class="container-fluid actionbodchild">
                <a href="review_post.php?user_no=<?php echo htmlspecialchars($user_no) ?>">Back</a>
                    <?php if ($row) { 
                        // Determine the profile and cover photo paths
                        $profilePicPath = !empty($row['profilepicture']) ? $profilePicBasePath . $row['profilepicture'] : $profilePicBasePath . $defaultProfilePic;
                        $coverPhotoPath = !empty($row['coverphoto']) ? $coverPhotoBasePath . $row['coverphoto'] : $coverPhotoBasePath . $defaultCoverPhoto;
                    ?>
                    <div class="container-fluid coverphotobod">
                        <div class="container-fluid coverphoto">
                            <div class="container-fluid coverphotodiv">
                                <img src="<?php echo $coverPhotoPath; ?>" alt="Cover Photo">
                            </div>
                            <div class="container-fluid profilephoto">
                                <img src="<?php echo $profilePicPath; ?>" alt="Profile Picture">
                            </div>
                        </div>
                    </div>
                    <div class="container-fluid profilephotobod">
                        <div class="row ko">
                            <div class="container-fluid name">
                                User no: <?php echo htmlspecialchars($user_no); ?>
                            </div>
                        </div>
                        <div class="row ko">
                            <div class="container-fluid name">
                                Name: <?php echo htmlspecialchars($row['fname'] . ' ' . $row['lname']); ?>
                            </div>
                        </div>
                        <div class="row ko">
                            <div class="container-fluid email">
                                CVSU Email: <?php echo htmlspecialchars($row['email']); ?>
                            </div>
                        </div>
                        <div class="row ko">
                            <div class="container-fluid student_no">
                                Student Number: <?php echo htmlspecialchars($row['student_no']); ?>
                            </div>
                        </div>
                    </div>
                    <?php } else { ?>
                        <p>No user data found.</p>
                    <?php } ?>

                    
                    <div class="container-fluid doaction">
                        <!-- Form for warning a user -->

                            <div class="container-fluid warndiv">
                                <div class="container-fluid warning">
                                    <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal"  class="btn btn-warning" data-user-no="<?php echo htmlspecialchars($user_no); ?>" data-admin-id="<?php echo htmlspecialchars($admin_id); ?>">Warn</button>
                                </div>
                                <div class="container-fluid optionalmessage">
                                <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal2" class="btn btn-danger" data-user-no="<?php echo htmlspecialchars($user_no); ?>" data-admin-id="<?php echo htmlspecialchars($admin_id); ?>">Ban</button>
                                        <?php echo $success ?>
                                        <?php echo $success1 ?>
                                        <?php echo $error ?>
                                        <?php echo $error1 ?>
                                </div>
                            </div>
  

                        <!-- Form for banning a user -->
                        <div class="container-fluid bandiv">
                            <?php if($row['has_warning']) { ?>
                                <div class="container-fluid warning2">
                                <?php //echo "Warning level: " .$row['warning_level']; ?>
                                    <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal3"  class="btn btn-warning" data-user-no="<?php echo htmlspecialchars($user_no); ?>" data-admin-id="<?php echo htmlspecialchars($admin_id); ?>">Remove warning</button>
                                    <div>
                                        <?php echo $success ?>
                                        <?php echo $success1 ?>
                                        <?php echo $error ?>
                                        <?php echo $error1 ?>
                                    </div>
                                </div>
                                
                            <?php } else { ?>
                                <!-- put space if there's no warning -->
                                <div class="container-fluid empty-warning-space"></div>
                            <?php } ?>

                            <?php if($row['has_ban']) { ?>
                                <div class="container-fluid optionalmessage2">
                                    <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal4" class="btn btn-danger" data-user-no="<?php echo htmlspecialchars($user_no); ?>" data-admin-id="<?php echo htmlspecialchars($admin_id); ?>">Unban</button>
                                </div>
                            <?php } else { ?>
                                <!-- put space if there's no ban -->
                                <div class="container-fluid empty-ban-space"></div>
                            <?php } ?>
                        </div>

                    </div>



                </div>
            </div>
        </div>
    </div>
</div>

<?php include('admin_modal.php') ?>
</body>
</html>
<script>
        // Function to toggle the sidenav and save the state
        function toggleSidenav() {
        const sidenav = document.querySelector('.sidenav');
        const content = document.querySelector('.content');
    
        if (sidenav.classList.contains('hidden')) {
            sidenav.classList.remove('hidden');
            content.classList.remove('expanded');
            localStorage.setItem('sidenavState', 'open'); // Save state as 'open'
        } else {
            sidenav.classList.add('hidden');
            content.classList.add('expanded');
            localStorage.setItem('sidenavState', 'hidden'); // Save state as 'hidden'
        }
    }
    
    // Function to load the saved state from localStorage
    function loadSidenavState() {
        const sidenav = document.querySelector('.sidenav');
        const content = document.querySelector('.content');
        const savedState = localStorage.getItem('sidenavState');
    
        // Temporarily disable transitions
        sidenav.classList.add('no-transition');
        content.classList.add('no-transition');
    
        if (savedState === 'hidden') {
            sidenav.classList.add('hidden');
            content.classList.add('expanded');
        } else {
            sidenav.classList.remove('hidden');
            content.classList.remove('expanded');
        }
    
        // Re-enable transitions after a short delay
        setTimeout(() => {
            sidenav.classList.remove('no-transition');
            content.classList.remove('no-transition');
        }, 100); // Adjust delay if needed
    }
    
    // Load the sidenav state when the page loads
    window.onload = loadSidenavState;
</script>
<script>
// Listen for the modal to be shown
$('#exampleModal, #exampleModal2, #exampleModal3, #exampleModal4').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); // Button that triggered the modal
    var userNo = button.data('user-no'); // Extract info from data-* attributes
    var adminId = button.data('admin-id');

    // Now you can use userNo and adminId within the modal
    console.log("User No: " + userNo);
    console.log("Admin ID: " + adminId);

    // Example: Set these values in hidden inputs within the modal (if needed)
    $(this).find('input[name="user_no"]').val(userNo);
    $(this).find('input[name="admin_id"]').val(adminId);
});


</script>