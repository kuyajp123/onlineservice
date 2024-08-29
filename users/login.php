<?php
session_start();
require_once "../include/bootsrap.php";
require_once '../include/connect.php';
require_once './register.php';
require_once '../functions/common_function.php';

if(isset($_SESSION['user_no'])){
    echo "<script>window.open('../index.php?newsfeed=".urlencode($_SESSION['user_no'])."','_self')</script>";
}

$error = ''; // Initialize error variable
$ums = ''; // Initialize $ums variable
$user_password = ''; // Initialize $user_password variable
$row = null; // Initialize $row variable
$user_ban = false;

if (isset($_POST['login'])) {
    $ums = $_POST['user'];
    $user_password = $_POST['user_password'];

    $sql = "SELECT * FROM user_registration WHERE email = ? OR user_ID = ? OR student_no = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param('sss', $ums, $ums, $ums);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    

    if($result->num_rows > 0) {
        if (password_verify($user_password, $row['user_password'])) {
            $_SESSION['user_no'] = $row['user_no'];
            $current_user_no = $_SESSION['user_no'];

            if(CheckBanStatus($current_user_no)){
                $user_ban = true;

                $sql = "
                    SELECT notification_text FROM `notifications` WHERE user_no = ? AND notification_type = 'ban' 
                    ORDER BY timestamp DESC LIMIT 1";

                $stmt = $con->prepare($sql);
                $stmt->bind_param("i", $current_user_no);
                $stmt->execute();
                $result = $stmt->get_result();
                $row = $result->fetch_assoc();
                $message = $row['notification_text'];

            }else{
                $_SESSION['ip'] = getIPAddress();         
                $_SESSION['user_ID'] = $row['user_ID'];
                $_SESSION['email'] = $row['email'];
                $_SESSION['student_no'] = $row['student_no'];
                $_SESSION['fname'] = $row['fname'];
                $_SESSION['lname'] = $row['lname'];
                $_SESSION['bday'] = $row['bday'];
                $_SESSION['gender'] = $row['gender'];
                $_SESSION['profilepicture'] = $row['profilepicture'];
                $_SESSION['coverphoto'] = $row['coverphoto'];           
                $profilepicture = $_SESSION['profilepicture'];
                $coverphoto = $_SESSION['coverphoto'];
                echo "<script>window.open('../index.php?newsfeed=$current_user_no','_self')</script>";
            }


        } else {
            $error = "Incorrect password.";
        }
    } else {
        $error = "No users found.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="login_style.css?v=<?php echo time(); ?>">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <?php require_once "../include/bootsrap.php"; ?>
</head>
<body>
<div class="bod2" style="width:100%;">
    <div class="container-fluid p-0 text-center">
        <div class="column1">
            <div class="container container2">
                <div class="row row-form">
                    <div class="col col-form content1">
                        <img class="logo-img" src="logo 1.png" alt="Logo">
                    </div>
                    <div class="col col-form lagyanngform">
                        <div class="container-fluid container-form">
                            <div class="container form-container1">
                                <div class="container form-container2">
                                    <!-- Alert container with fixed height -->
                                    <div id="liveAlertPlaceholder" class="alert-container"></div>
                                    
                                    <form action="login.php" method="post">
                                        <div class="form-group">
                                            <input type="text" id="user" name="user" placeholder="Email/Username/Student number" value="<?php echo htmlspecialchars($ums); ?>" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" id="user_password" name="user_password" placeholder="Password" class="form-control" required>
                                            <span class="toggle-password"><i class="fa-solid fa-eye"></i></span>
                                        </div>
                                        <div>
                                            <button style="margin-top:15px;" type="submit" name="login" class="btn btn-primary">Login</button>
                                        </div>
                                    </form>
                                    <!-- condition if login failed -->
                                    <?php if ($error): ?>
                                        <script>
                                            let alertTimeout;

                                            const alertPlaceholder = document.getElementById('liveAlertPlaceholder');

                                            const showAlert = (message, type) => {
                                                if (alertTimeout) {
                                                    clearTimeout(alertTimeout);
                                                }
                                                
                                                while (alertPlaceholder.firstChild) {
                                                    alertPlaceholder.removeChild(alertPlaceholder.firstChild);
                                                }
                                                
                                                const wrapper = document.createElement('div');
                                                wrapper.innerHTML = [
                                                    `<div class="alert alert-${type} alert-dismissible fade show" role="alert">`,
                                                    `   <div>${message}</div>`,
                                                    '   ',
                                                    '</div>'
                                                ].join('');
                                                
                                                alertPlaceholder.append(wrapper);

                                                setTimeout(() => {
                                                    wrapper.querySelector('.alert').classList.add('show');
                                                }, 10);

                                                alertTimeout = setTimeout(() => {
                                                    const alertElement = wrapper.querySelector('.alert');
                                                    alertElement.classList.remove('show');
                                                    setTimeout(() => {
                                                        if (alertElement.parentElement) {
                                                            alertElement.parentElement.removeChild(alertElement);
                                                        }
                                                    }, 500);
                                                }, 3000);
                                            }

                                            showAlert('<?php echo $error; ?>', 'danger');
                                        </script>
                                    <?php endif; ?>
                                </div>
                                <div class="line"></div>
                                <div class="container form-container3">
                                    <!-- Button to Open the Register Modal -->
                                    <button type="button" id="btn-signup" class="btn btn-primary" onclick="openRegisterModal()" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">Sign up</button>
                                </div>
                            </div>
                            <div class="container-fluid appeal">
                                <a href="user_appeal.php" target="_blank">Click here</a> to appeal
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
        <div class="column2">
            <footer class="footer-distributed" style="padding:0;">
                <div class="footer-right">
                    <div>
                        <i class="fa fa-map-marker"></i>
                        <p><span>Brgy. Gregorio, Trece Martires City, Cavite 4109</span></p>
                    </div>
                    
                    <div>
                        <i class="fa fa-phone"></i>
                        <p>(046) 866 4981</p>
                    </div>
                    
                    <div>
                        <i class="fa fa-envelope"></i>
                        <p>cvsutrecemartires@cvsu.edu.ph</p>
                    </div>
                </div>
                
                <div class="footer-right">
                    <!-- <p class="footer-company-about">
                        <span>About the system</span>
                        wa
                    </p> -->
                    <a href="t_c.php" style="color:#fff;margin-bottom:10px;">Terms of use and Condition</a>
                    <a href="user_appeal.php" style="color:#fff;">Appeal</a>
                </div>
                
                <div class="footer-left text-center">
                    <p class="footer-company-name">Copyright © 2024 Cavite State University - Trece Martires City Campus All Rights Reserved</p>
                </div>
            </footer>
        </div>
    </div>
</div>
    <!-- show password -->
    <script src="../functions/JsFunction.js"></script>
</body>
</html>
<?php if ($user_ban): ?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var modalHtml = `
            <div class="modal fade" id="user_ban" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Account Suspension Notification</h5>
                        </div>
                        <div class="modal-body">
                            <?php echo addslashes($message); ?>
                        </div>
                        <div class="modal-footer">
                            <button type="button" id="understandButton" class="btn btn-primary">I understand</button>
                        </div>
                    </div>
                </div>
            </div>
            `;

            document.body.insertAdjacentHTML('beforeend', modalHtml);

            var user_ban = new bootstrap.Modal(document.getElementById('user_ban'), {
                backdrop: 'static',  // Prevents closing the modal by clicking outside
                keyboard: false      // Prevents closing the modal with the Esc key
            });
            user_ban.show();

            // Event listener for "I understand" button
            document.getElementById('understandButton').addEventListener('click', function() {
                user_ban.hide();
            });
        });
    </script>
<?php endif; ?>