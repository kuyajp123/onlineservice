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

function formatName($name) {
    // Convert the first character of each word to uppercase
    return ucwords(strtolower($name));
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





function getName(){
    global $con;

    $current_user_no = $_SESSION['user_no'];
    // Retrieve the 'user_no' parameter from the URL
    $profile_user_no = isset($_GET['user_no']) ? $_GET['user_no'] : '';

    $query = "SELECT * FROM user_registration WHERE user_no = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param('i', $profile_user_no);
    $stmt->execute();
    $result = $stmt->get_result();
    $profile = $result->fetch_assoc();

    $fname = $_SESSION['fname'];
    $lname = $_SESSION['lname'];
    $user_ID = $_SESSION['user_ID'];


    
    if ($profile) {
        // Check if the profile belongs to the current user
        $current_user_no = $_SESSION['user_no'];
        if ($profile_user_no == $current_user_no) {
            echo "
            <div class='container-fluid identity'>
              <!-- Image to be uploaded profile here -->
             <div class='container-fluid profilepic'></div>
                                    
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
            echo "
            <div class='container-fluid identity'>
              <!-- Image to be uploaded profile here -->
             <div class='container-fluid profilepic'></div>
                                    
             <!-- Name to be uploaded here -->
              <div class='container-fluid name'>
              " . htmlspecialchars($profile['fname']) . " " . htmlspecialchars($profile['lname']) . "
             </div>
                                    
             <div class='container-fluid username'>
             " . htmlspecialchars($profile['user_ID'])."
            </div>
                                    
            <div class='container-fluid bio'>Hello world!</div>
            </div>                    
            ";
        }
    
    } else {
        echo "Profile not found.";
    }

}



















?>



