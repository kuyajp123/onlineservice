<?php

// Function to validate email format and domain
function validateEmail($email) {
    // Define the required prefix and domain
    $prefix = 'tmc.';
    $domain = '@cvsu.edu.ph';
    
    // Check if email is valid format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return false;
    }

    // Check if email starts with the specific prefix and ends with the specific domain
    if (substr($email, 0, strlen($prefix)) !== $prefix || substr($email, -strlen($domain)) !== $domain) {
        return false;
    }

    return true;
}

// Function to Email is not reuse
function checkIfEmailExists($email){

    global $con;

    $select_query = "select email from user_registration where email = ?";
    $stmt = mysqli_prepare($con, $select_query);
    mysqli_stmt_bind_param($stmt, 's', $email);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    $num_of_email = mysqli_stmt_num_rows($stmt);

    // Check if any rows were returned
    if ($num_of_email > 0) {
        return false; // Email exists in database
    }
    return true;

}

// Function to validate student number format
function validateStudentNo($student_no) {
    // Check if student number matches the pattern 0000-000-0000
    return preg_match('/^\d{4}-\d{3}-\d{4}$/', $student_no);
}

function studentNumberValid($student_no){
    global $con;

    $query = "select student_no from user_registration where student_no = ?";
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, 's', $student_no);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    $result = mysqli_stmt_num_rows($stmt);

    if ($result > 0){
        return false;
    }
    return true;
}

// Function to format names by removing special characters and normalizing spaces
function formatName($name) {
    // Remove special characters, keep only letters and spaces
    $cleanName = preg_replace('/[^a-zA-Z\s]/', '', $name);
    
    // Remove extra spaces and trim leading/trailing spaces
    $normalizedName = preg_replace('/\s+/', ' ', trim($cleanName));
    
    // Convert the first character of each word to uppercase
    return ucwords(strtolower($normalizedName));
}


// get ip address function
function getIPAddress() {  
    //whether ip is from the share internet  
     if(!empty($_SERVER['HTTP_CLIENT_IP'])) {  
                $ip = $_SERVER['HTTP_CLIENT_IP'];  
        }  
    //whether ip is from the proxy  
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {  
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];  
     }  
  //whether ip is from the remote address  
    else{  
             $ip = $_SERVER['REMOTE_ADDR'];  
     }  
     return $ip;  
  }  
//   $ip = getIPAddress();  
//   echo $ip; 




// name username in profile
function getName($user_no = null) {
    global $con;
    $current_user_no = $_SESSION['user_no'];

    // If $user_no is not provided, use the current user's number
    if ($user_no === null) {
        $user_no = $current_user_no;
    }

    $query = "SELECT * FROM user_registration WHERE user_no = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param('i', $user_no);
    $stmt->execute();
    $result = $stmt->get_result();
    $profile = $result->fetch_assoc();

    if ($profile) {
        $fname = htmlspecialchars($profile['fname']);
        $lname = htmlspecialchars($profile['lname']);
        $user_ID = htmlspecialchars($profile['user_ID']);
        $profile_pic = htmlspecialchars($profile['profilepicture']); // Assuming this column exists in your table

        // Display profile
        echo "
        <div class='container-fluid identity'>
          <!-- Name to be uploaded here -->
          <div class='container-fluid name'>
            $fname $lname
          </div>                 
          <div class='container-fluid username'>
            $user_ID
          </div>      
          <div class='container-fluid bio'>Hello world!</div>
        </div>                    
        ";
    } else {
        echo "Profile not found.";
    }
}


 

// Function to get old profile picture filename
function getOldProfilePicture($user_no, $con) {
    $profilepicture = "";

    $sql = "SELECT profilepicture FROM user_registration WHERE user_no = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $user_no);
    $stmt->execute();
    $stmt->bind_result($profilepicture);
    $stmt->fetch();
    return $profilepicture;
}

// Function to get old cover photo filename
function getOldCoverPhoto($user_no, $con) {
    $coverphoto = "";

    $sql = "SELECT coverphoto FROM user_registration WHERE user_no = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $user_no);
    $stmt->execute();
    $stmt->bind_result($coverphoto);
    $stmt->fetch();
    return $coverphoto;
}


// function to get post from database
function getPosts($con) {
    // Define the SQL query with ORDER BY clause to sort by timestamp in descending order
    $sql = "SELECT 'post' AS type, 
       p.post_id AS post_id, 
       p.user_no AS user_no, 
       u.fname AS fname, 
       u.lname AS lname, 
       p.timestamp AS timestamp, 
       p.postphoto AS postphoto, 
       p.caption AS caption
FROM posts p
JOIN user_registration u ON p.user_no = u.user_no
WHERE p.deleted_at IS NULL

UNION ALL

SELECT 'poll' AS type, 
       pl.poll_id AS poll_id, 
       pl.user_no AS user_no, 
       u.fname AS fname, 
       u.lname AS lname, 
       pl.created_at AS timestamp, 
       NULL AS postphoto, 
       pl.question AS caption
FROM polls pl
JOIN user_registration u ON pl.user_no = u.user_no
ORDER BY timestamp DESC"; // Added ORDER BY clause

    // Prepare and execute the SQL statement
    $stmt = $con->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();

    // Fetch all rows from the result set
    $rows = [];
    while ($row = $result->fetch_assoc()) {
        $rows[] = $row;
    }

    // Return the result set and the rows
    return ['result' => $result, 'rows' => $rows];
}


// get profile user in posts
function getProfilePicture($user_no, $con) {
    $profilepicture = "";

    $sql = "SELECT profilepicture FROM user_registration WHERE user_no = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $user_no);
    $stmt->execute();
    $stmt->bind_result($profilepicture);
    $stmt->fetch();
    return $profilepicture;
}


// see another user posts in another_user timeline
function getUserProfile($user_no) {
    global $con;

    $query = "SELECT fname, lname, user_ID, coverphoto, profilepicture FROM user_registration WHERE user_no = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param('i', $user_no);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}


// function to check if user is currently ban
function CheckBanStatus($user_no) {
    global $con;

    $sql = "SELECT user_no, ban_level, ban_start_date, ban_end_date FROM active_ban WHERE user_no = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $user_no);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    $currentDate = date('Y-m-d');

    if($result->num_rows > 0) {
        if($row['ban_end_date'] === NULL || $row['ban_end_date'] > $currentDate) {
            // User is banned
            session_destroy();
            return true;
        } else {
            // Ban has ended
            $query = "DELETE FROM user_bans where user_no = ?";
            $stmt = $con->prepare($query);
            $stmt->bind_param("i", $user_no);
            $stmt->execute();

            return false;
        }
    } else {
        // No ban record found
        return false;
    }

}


// function to check Warning Status
function WarningStatus($user_no){
    global $con;

    $sql = "SELECT * from active_warning where user_no = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $user_no);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    $currentDate = date('Y-m-d');

    if($result->num_rows > 0){
        if($row['reset_date'] < $currentDate){
            $query = "DELETE FROM user_warnings where user_no = ?";
            $stmt = $con->prepare($query);
            $stmt->bind_param("i", $user_no);
            $stmt->execute();
            // warning level is now remove becuase date interval for warning violation is already passed 
            return ['status' => false, 'modal' => 0];
        }else{
            return ['status' => true, 'modal' => $row['warning_level']];
        }
    }else{
        return ['status' => false, 'modal' => 0];
    }
}


































// profile modal get data
// function profileModalGetData(){
//     global $con;
//     $current_user_no = $_SESSION['user_no'];
//     // Retrieve the 'user_no' parameter from the URL
//     $profile_user_no = isset($_GET['user_no']) ? $_GET['user_no'] : '';
    
//     $query = "SELECT * FROM user_registration WHERE user_no = ?";
//     $stmt = $con->prepare($query);
//     $stmt->bind_param('i', $profile_user_no);
//     $stmt->execute();
//     $result = $stmt->get_result();
//     $profile = $result->fetch_assoc();
    
//     if ($profile_user_no == $current_user_no) {
//       $current_user_no = $_SESSION['user_no'];
//       $current_fname = $_SESSION['fname'];
//       $current_lname = $_SESSION['lname'];
//       echo"
 //                 <div class='container-fluid nbp'>
//                     <div class='container-fluid namebiomodalprof'>
//                       <!-- name/bio here -->
//                       <div class='container-fluid namemodalprof'>$current_fname $current_lname</div>
//                       <div class='container-fluid biomodalprof'>Hello world</div>
//                     </div>
//                     <div class='container-fluid buttonmodalprof'>
//                       <div class='container-fluid profbuttonmodal'>
//                         <!-- profile here -->
//                       <a href='users/profile.php?profile=$current_user_no'><button class='btn'>Profile</button></a>
//                       </div>
//                     </div>
//                 </div> -->
//       ";
//     }else{
      
        
//     }
// }















?>
