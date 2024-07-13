<?php
include("./connect.php");
include("./include/bootsrap.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>userpractice</title>
</head>
<body>
    <h3>Register</h3>
    <form action="" method="post">
    <label for="email">Email</label>
        <input type="email" id="email" name="email" placeholder="Email" autocomplete="off" required="required">
        <br>
        <br>

        <label for="user_password">Password</label>
        <input type="password" id="user_password" name="user_password" placeholder="Enter password"  autocomplete="off" required="required">
        <br>
        <br>

        <label for="fname">First Name</label>
        <input type="text" id="fname" name="fname" placeholder="Enter first name" autocomplete="off" required="required">
        <br>
        <br>

        <label for="lname">Last Name</label>
        <input type="text" id="lname" name="lname" placeholder="Enter last name"  autocomplete="off" required="required">
        <br>
        <br>

        <label for="bday">Birth date</label>
        <input type="date" id="bday" name="bday" placeholder="Enter last name"  autocomplete="off" required="required">
        <br>
        <br>

        <div class="form-check form-check-inline">
            Gender
  <input class="form-check-input" type="radio" name="gender" id="gender" value="Male">
  <label class="form-check-label" for="gender">Male</label>

  <input class="form-check-input" type="radio" name="gender" id="gender" value="Female">
  <label class="form-check-label" for="gender">Female</label>
</div>
<input type="text" id="gender" name="gender" placeholder="Enter Gender"  autocomplete="off">
<br>
<br>
        
        <input type="submit" value="Sign up" name="submit">
    </form>
    <br>
    <br>
    <br>
</body>
</html>
<?php
$query_student_no = "select * from user_registration where student_no = ?";
$query_store = mysqli_prepare($con, $query_student_no);
mysqli_stmt_bind_param($query_store, 's', $student_no);
mysqli_stmt_execute($query_store);
mysqli_stmt_store_result($query_store);
$result_student_no = mysqli_stmt_num_rows($query_store);

if(isset($_POST['submit'])){
    $email = $_POST['email'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $user_password = $_POST['user_password'];
    $bday = $_POST['bday'];
    $gender = $_POST['gender'];

    $select = "select * from user_registration where email = '$email'";
    $select_query = mysqli_query($con, $select);
    $result_email = mysqli_num_rows($select_query);


    $attempt_to_generate_ID = 0;
    while(true){
    $random_number = 10 + rand(0, 999);
    $user_ID = strtolower($fname) . $random_number; 

    $select_userID = "select user_ID from user_registration where user_ID = '$user_ID'";
    $result_ID = mysqli_query($con, $select_userID);

    // $xample = "select * from user_registration where user_password = '$user_password'";
    //     $xample_query = mysqli_query($con, $xample);
    //     while($row=mysqli_fetch_assoc($xample_query)){
    //         $pass= $row['user_password'];
    //     }echo "$pass";

if(mysqli_num_rows($result_ID) == 0){

if($result_email>0){
    echo "<script>alert('This email is already use')</script>";
    break;
}else{
    $query = "INSERT INTO user_registration (user_ID, email, fname, lname, user_password, bday, gender) VALUES ('$user_ID', '$email', '$fname', '$lname', '$user_password', '$bday', '$gender')";
    $sql = mysqli_query($con, $query);
        if($sql){
        echo "<script>alert('registration successful!')</script>";
        break;
        }
    }
 }
 $attempt_to_generate_ID++;
}
}

?>































<?php
session_start();
require_once "./connect.php";

$ums = $email_no_err = $general_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ums = strtolower(trim($_POST['ums']));
    $user_password = $_POST['user_password'];

    // Prepare the SQL query
    $query = "SELECT * FROM user_registration WHERE user_ID = ? OR email = ? OR student_no = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param('sss', $ums, $ums, $ums);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user) {
        // Log the password values before verification
        echo "Entered Password: " . htmlspecialchars($user_password) . "<br>";

        // Verify the password
        if ($user_password == $user['user_password']) {
            // Password is correct, set session variables
            $_SESSION['fname'] = $user['fname'];
            echo "Welcome, " . $user['fname'];
            $ums = ""; // Reset form
        } else {
            // Password is incorrect
            echo "The password is incorrect.";
        }
    } else {
        // User does not exist
        echo "The username, email, or student number does not exist in our records.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <?php require_once "./include/bootsrap.php"; ?>
</head>
<body>
    <?php if ($email_no_err): ?>
        <div class="alert alert-danger"><?php echo $email_no_err; ?></div>
    <?php endif; ?>
    <?php if ($general_err): ?>
        <div class="alert alert-danger"><?php echo $general_err; ?></div>
    <?php endif; ?>
    <form action="login.php" method="post">
        <div class="form-group">
            <label for="ums">Username, Email, or Student Number</label>
            <input type="text" id="ums" name="ums" value="<?php echo htmlspecialchars($ums); ?>" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="user_password">Password</label>
            <input type="password" id="user_password" name="user_password" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
    </form>
    <!-- Button to Open the Register Modal -->
    <button type="button" class="btn btn-primary" onclick="openRegisterModal()" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">Open modal for @mdo</button>
    </div>
</body>
</html>
