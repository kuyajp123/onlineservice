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





?>
<!-- <script>
    function validateForm($gender) {
    var genders = document.getElementsByName('gender');
    var genderSelected = false;

    for (var i = 0; i < genders.length; i++) {
        if (genders[i].checked) {
            genderSelected = true;
            break;
        }
    }

    if (!genderSelected) {
        showAlert('Please select a gender.');
        return false; // Prevent form submission
    }

    return true; // Allow form submission
}

function showAlert(message) {
    var alertPlaceholder = document.getElementById('liveAlertPlaceholder');
    var wrapper = document.createElement('div');
    wrapper.innerHTML = [
        '<div class="alert alert-warning alert-dismissible" role="alert">',
        '   <div>' + message + '</div>',
        '   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>',
        '</div>'
    ].join('');
    alertPlaceholder.append(wrapper);
}

</script> -->

