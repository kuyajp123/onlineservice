<?php
require_once '../include/connect.php';
require_once "../include/bootsrap.php";
require_once '../functions/common_function.php';

// Variable to track of functions
$emailInvalid = false;
$emailExist = false;
$studentNoExist = false;
$studentNoInvalid = false;

$email = $student_no = $user_password = $fname = $lname = $bday = $gender = "";
$email_no_err = $general_err = "";

// Check if the form is submitted
if(isset($_POST['submit'])){
    $user_ip=getIPAddress();
    $email = strtolower(trim($_POST['email']));
    $student_no = $_POST['student_no'];
    $user_password = $_POST['user_password'];
    $hashed_password = password_hash($user_password, PASSWORD_DEFAULT);
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $bday = $_POST['bday'];
    $gender = $_POST['gender'];
    
    
    //capitalize the word
    $formattedFirstName = formatName($fname);
    $formattedLastName = formatName($lname);

    // Validate email
    if (!validateEmail($email)) {
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
            $user_ID = strtolower($fname) . $random_number; 
            $strReplace = str_replace(' ', '.', $user_ID);
            $user_id = "@" . $strReplace;

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

                                            <div class='alert alert-success' role='alert'>
    Registration successful! 
                                            </div>                                          
                                        
                                    </div>
                                </div>
                            </div>
                            `;
                            document.body.insertAdjacentHTML('beforeend', modalHtml);
                            var registrationSuccessModal = new bootstrap.Modal(document.getElementById('registrationSuccessModal'));
                            registrationSuccessModal.show();
                        }); </script>";
                        
                        $email = $student_no = $user_password = $fname = $lname = $bday = $gender = ''; // Reset form
                        break;
                    }
                }
            }
            $attempt_to_generate_ID++;
        }
    }
}
?>
<style>
    #btn-signup2{
        background-color:#00A400;
        border:none;
    }
</style>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Register</h1>
        <!-- <button id="close_button" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
      </div>
      <div class="modal-body">
      <?php if ($email_no_err): ?>
                    <div class="alert alert-danger"><?php echo $email_no_err; ?></div>
                <?php endif; ?>
                <?php if ($general_err): ?>
                    <div class="alert alert-danger"><?php echo $general_err; ?></div>
                <?php endif; ?>
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
        <label for="date-input">Date of birth</label>
            <input type="date" id="bday" name="bday" class="form-control" value="<?php echo htmlspecialchars($bday); ?>"  placeholder="Date of Birth" aria-label="Date of Birth" required="required">
        </div>
        <div class="col pt-2">
        <label>Gender &nbsp; &nbsp;</label><br>
        
            <input class="form-check-input" type="radio" name="gender" id="gender" value="Male" required>
            <label class="form-check-label" for="gender">Male</label>
            &nbsp; &nbsp;
            <input class="form-check-input" type="radio" name="gender" id="gender" value="Female" required>
            <label class="form-check-label" for="gender">Female</label>
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


<?php if ($emailInvalid || $studentNoInvalid || $emailExist || $studentNoExist): ?>
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
                                <div class='alert alert-warning' role='alert'>
     Please use your CVSU Email!
                                </div>
                                
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
                                <div class='alert alert-warning' role='alert'>
  This email is already used!
                                </div>
                                    
                                
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

                                <div class='alert alert-warning' role='alert'>
  This Student number is already used!
                                </div>
                                                                    
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

                                <div class='alert alert-warning' role='alert'>
  Please provide the right Format of Student Number!
                                </div>

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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
