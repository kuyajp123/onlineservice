<?php
require_once "../include/bootsrap.php";
require_once '../include/connect.php';
require_once '../functions/common_function.php';
// Variable to track of functions
$coverphoto = "";
$profilepicture = "";

$emailInvalid = false;
$emailExist = false;
$studentNoExist = false;
$studentNoInvalid = false;
$passwordMismatch = false;

$conf_user_password = $email = $student_no = $user_password = $fname = $lname = $bday = $gender = "";

// Check if the form is submitted
if(isset($_POST['submit'])){
    $user_ip=getIPAddress();
    $email = strtolower(trim($_POST['email']));
    $student_no = $_POST['student_no'];
    $user_password = $_POST['user_password'];
    $conf_user_password = $_POST['conf_user_password'];
    $hashed_password = password_hash($user_password, PASSWORD_DEFAULT);
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $bday = $_POST['bday'];
    $gender = $_POST['gender'];
    
    
    //capitalize the word
    $formattedFirstName = formatName($fname);
    $formattedLastName = formatName($lname);

    if(!password_verify($conf_user_password, $hashed_password)){
        $passwordMismatch = true;
    }// Validate email
    elseif (!validateEmail($email)) {
        $emailInvalid = true;
    }elseif(!studentNumberValid($student_no)){
        $studentNoExist = true;
    }elseif (!validateStudentNo($student_no)) {
        $studentNoInvalid = true;
    }elseif (!checkIfEmailExists($email)){
        $emailExist = true;
    }else {
        //check email if exist
        $query_email = "select * from user_registration where email = ?";
        $stmt = mysqli_prepare($con, $query_email);
        mysqli_stmt_bind_param($stmt, 's', $email);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        $result_email = mysqli_stmt_num_rows($stmt);


        $query_student_no = "select * from user_registration where student_no = ?";
        $query_store = mysqli_prepare($con, $query_student_no);
        mysqli_stmt_bind_param($query_store, 's', $student_no);
        mysqli_stmt_execute($query_store);
        mysqli_stmt_store_result($query_store);
        $result_student_no = mysqli_stmt_num_rows($query_store);


        // Example logic to generate unique user ID
        $attempt_to_generate_ID = 0;
        while(true){
            $random_number = 10 + rand(0, 999);
            // Remove extra spaces and replace single spaces with dots
            $clean_fname = preg_replace('/\s+/', ' ', $fname); // Replace multiple spaces with a single space
            $clean_fname = str_replace(' ', '_', $clean_fname); // Replace single spaces with dots           
            $user_ID = strtolower($clean_fname) . $random_number;           
            // Remove all special characters except "@" and dots
            $clean_user_id = preg_replace('/[^a-z0-9.@_]/', '', $user_ID);           
            // Ensure only one "@" is present
            if (substr_count($clean_user_id, '@') > 1) {
                // Remove all "@" after the first one
                $parts = explode('@', $clean_user_id);
                $clean_user_id = $parts[0] . '@' . implode('', array_slice($parts, 1));
            }        
            // Ensure the user ID starts with "@"
            if ($clean_user_id[0] !== '@') {
                $clean_user_id = '@' . $clean_user_id;
            }           
            $user_id = preg_replace('/\s+/', ' ', trim($clean_user_id));

            $select_userID = "SELECT user_ID FROM user_registration WHERE user_ID = ?";
            $stmt_userID = mysqli_prepare($con, $select_userID);// 
            mysqli_stmt_bind_param($stmt_userID, "s", $user_id); //for security and specify the column that we want to retrieve
            mysqli_stmt_execute($stmt_userID);// need to execute first to operate crud operation in database
            mysqli_stmt_store_result($stmt_userID);//need to do this before counting the number of data exist in database or to display data
            $result_ID = mysqli_stmt_num_rows($stmt_userID);// counting the number of data exist in database

            

            if($result_ID == 0){
                if ($result_email > 0){
                    break;
                }if($result_student_no > 0){
                    break;
                }else {
                    $query = "INSERT INTO user_registration (user_ip, user_ID, email, student_no, user_password, fname, lname, bday, gender) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
                    $stmt_insert = mysqli_prepare($con, $query);
                    mysqli_stmt_bind_param($stmt_insert, "sssssssss", $user_ip, $user_id, $email, $student_no, $hashed_password, $formattedFirstName, $formattedLastName, $bday, $gender);
                    $sql = mysqli_stmt_execute($stmt_insert);
                    if($sql){
                        echo "<script>alert

                                                document.addEventListener('DOMContentLoaded', function() {
                            var modalHtml = `
                            <div class='modal fade' id='registrationSuccessModal' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                                <div class='modal-dialog'>
                                    <div class='modal-content'>
                                        <div class='modal-header'>
                                            <h5 class='modal-title' id='exampleModalLabel'>Registration Successful</h5>
                                        </div>

                                            
    Registration successful! 
                                                                                 
                                        
                                    </div>
                                </div>
                            </div>
                            `;
                            document.body.insertAdjacentHTML('beforeend', modalHtml);
                            var registrationSuccessModal = new bootstrap.Modal(document.getElementById('registrationSuccessModal'));
                            registrationSuccessModal.show();
                        }); </script>";
                        
                        $conf_user_password = $email = $student_no = $user_password = $fname = $lname = $bday = $gender = ''; // Reset form
                        break;
                    }
                }
            }
            $attempt_to_generate_ID++;
        }
    }
}
?>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Register</h1>
        <!-- <button id="close_button" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
      </div>
      <div class="modal-body">
      <form id="exampleModal" action="" method="post">
                <div class="mb-3 px-3">
        <label for="formGroupExampleInput" class="form-label"></label>
        <input type="email" class="form-control" name="email" id="formGroupExampleInput" value="<?php echo htmlspecialchars($email); ?>" placeholder="CVSU Email" required="required">
        </div>

        <div class="mb-3 px-3">
        <label for="formGroupExampleInput2" class="form-label"></label>
        <input type="text" class="form-control" name="student_no" id="formGroupExampleInput2" value="<?php echo htmlspecialchars($student_no); ?>" placeholder="Student Number" required="required">

        </div>

        <div class="mb-3 px-3">
        <label for="formGroupExampleInput2" class="form-label"></label>
        <input type="password" class="form-control" name="user_password" id="formGroupExampleInput2" value="<?php echo htmlspecialchars($user_password); ?>" placeholder="Password" required="required">
        
        </div>
        

        <div class="mb-3 px-3">
        <label for="formGroupExampleInput2" class="form-label"></label>
        <input type="password" class="form-control" name="conf_user_password" id="formGroupExampleInput2" value="<?php echo htmlspecialchars($conf_user_password); ?>" placeholder="Confirm Password" required="required">
        
        </div>

        <div class="row g-3 px-3 pt-2">
        <div class="col">
            <input type="text" id="fname" name="fname" class="form-control" value="<?php echo htmlspecialchars($fname); ?>"  placeholder="First name" aria-label="First name" required="required">
        </div>
        <div class="col">
            <input type="text" id="lname" name="lname" class="form-control" value="<?php echo htmlspecialchars($lname); ?>"  placeholder="Last name" aria-label="Last name" required="required">
        </div>
        </div>

        <div class="row g-3 px-3 pt-4">
        <div class="col ">
        <!-- <label for="date-input">Date of birth</label>
            <input type="date" id="bday" name="bday" class="form-control" value="<?php //echo htmlspecialchars($bday); ?>"  placeholder="Date of Birth" aria-label="Date of Birth" required="required"> -->

            <div class="container-fluid dateinput">
                <input id="datepicker" name="bday" class="input_el__l_VZt" readonly placeholder="Enter your birthdate" value="<?php echo htmlspecialchars($bday); ?>">
            </div>
        </div>

        </div>
        <div class="container gender-register">
            <div class="col pt-3">
            <label>Gender: &nbsp; &nbsp;</label>

            <div class="container-fluid genderinput">
                <input class="form-check-input" type="radio" name="gender" id="gender" value="Male" required>
                <label class="form-check-label" for="gender">Male</label>
                &nbsp; &nbsp;
                <input class="form-check-input" type="radio" name="gender" id="gender" value="Female" required>
                <label class="form-check-label" for="gender">Female</label>
                &nbsp; &nbsp;
                <input class="form-check-input" type="radio" name="gender" id="gender" value="other" required>
                <label class="form-check-label" for="gender">other</label>
                </div>
            </div>
        </div>

        <div class="col-12 t-2 pt-4 px-3">
    <button type="submit" id="btn-signup2" value="Sign up" name="submit" class="btn btn-primary">Sign up</button>
  </div>
    </form>
      </div>
    </div>
  </div>
</div> 


<?php if ($emailInvalid || $studentNoInvalid || $emailExist || $studentNoExist || $conf_user_password): ?>
    <script>
        var exampleModal = new bootstrap.Modal(document.getElementById('exampleModal'));
        exampleModal.show();
    </script>
    <?php endif; ?>




    <?php if ($emailInvalid): ?>
        
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var modalHtml = `
                <div class="modal fade" id="emailInvalid" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Invalid Email</h5>
                            </div>
                            <div class="modal-body text-center">

  Please use your CVSU Email!
                                
                                
                            </div>

                        </div>
                    </div>
                </div>
                `;
                document.body.insertAdjacentHTML('beforeend', modalHtml);
                var emailInvalid = new bootstrap.Modal(document.getElementById('emailInvalid'));
                emailInvalid.show();
            });
        </script>
    <?php endif; ?>

    <?php if ($emailExist): ?>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var modalHtml = `
                <div class="modal fade" id="emailExist" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Invalid Email</h5>
                            </div>
                            <div class="modal-body text-center">
                                
  This email is already used!
                                
                                    
                                
                            </div>                       
                        </div>
                    </div>
                </div>
                `;
                document.body.insertAdjacentHTML('beforeend', modalHtml);
                var emailExist = new bootstrap.Modal(document.getElementById('emailExist'));
                emailExist.show();
            });
        </script>
    <?php endif; ?>
    

    <?php if ($studentNoExist): ?>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var modalHtml = `
                <div class="modal fade" id="studentNo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Invalid Student Number</h5>
                            </div>
                            <div class="modal-body text-center">

                                
  This Student number is already used!
                               
                                                                    
                            </div>                       
                        </div>
                    </div>
                </div>
                `;
                document.body.insertAdjacentHTML('beforeend', modalHtml);
                var studentNo = new bootstrap.Modal(document.getElementById('studentNo'));
                studentNo.show();
            });
        </script>
    <?php endif; ?>

    <?php if ($studentNoInvalid): ?>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var modalHtml = `
                <div class="modal fade" id="studentNoInvalid" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Invalid Student Number</h5>
                            </div>
                            <div class="modal-body text-center">

                               
  Please provide the right Format of Student Number!
  
                                

                            </div>
                        </div>
                    </div>
                </div>
                `;
                document.body.insertAdjacentHTML('beforeend', modalHtml);
                var studentNoInvalid = new bootstrap.Modal(document.getElementById('studentNoInvalid'));
                studentNoInvalid.show();
            });
        </script>
    <?php endif; ?>
    <?php if ($passwordMismatch): ?>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var modalHtml = `
                <div class="modal fade" id="conf_user_password" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Password did not match</h5>
                            </div>
                            <div class="modal-body text-center">

                               
Please double check your password 
                                

                            </div>
                        </div>
                    </div>
                </div>
                `;
                document.body.insertAdjacentHTML('beforeend', modalHtml);
                var conf_user_password = new bootstrap.Modal(document.getElementById('conf_user_password'));
                conf_user_password.show();
            });
        </script>
    <?php endif; ?>
</body>
</html>
<script>
  document.addEventListener('DOMContentLoaded', function () {
            // Initialize Air Datepicker
            new AirDatepicker('#datepicker', {
                buttons: ['clear'],
                dateFormat: 'yyyy-MM-dd',
                autoClose: true,
                locale: {
                    days: ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
                    daysShort: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
                    daysMin: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
                    months: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                    monthsShort: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                    today: 'Today',
                    clear: 'Clear',
                    dateFormat: 'yyyy-MM-dd',
                    timeFormat: 'HH:MM',
                    firstDay: 0
                }
            });
        });
</script>
