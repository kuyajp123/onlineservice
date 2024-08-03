<?php
session_start();
require_once '../include/connect.php';
require_once './register.php';
require_once '../functions/common_function.php';

$error = ''; // Initialize error variable
$ums = ''; // Initialize $ums variable
$user_password = ''; // Initialize $user_password variable
$row = null; // Initialize $row variable

if (isset($_POST['login'])) {
    $ums = $_POST['user'];
    $user_password = $_POST['user_password'];

    $sql = "SELECT * FROM user_registration WHERE email = ? OR user_ID = ? OR student_no = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param('sss', $ums, $ums, $ums);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if ($result->num_rows > 0) {
        if (password_verify($user_password, $row['user_password'])) {
            $_SESSION['ip'] = getIPAddress();
            $_SESSION['user_no'] = $row['user_no'];
            $_SESSION['user_ID'] = $row['user_ID'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['student_no'] = $row['student_no'];
            $_SESSION['fname'] = $row['fname'];
            $_SESSION['lname'] = $row['lname'];
            $_SESSION['bday'] = $row['bday'];
            $_SESSION['gender'] = $row['gender'];
            $_SESSION['user_password'] = $row['user_password'];
            $_SESSION['profilepicture'] = $row['profilepicture'];
            $_SESSION['coverphoto'] = $row['coverphoto'];
            $current_user_no = $_SESSION['user_no'];
            $profilepicture = $_SESSION['profilepicture'];
            $coverphoto = $_SESSION['coverphoto'];
            echo "<script>window.open('../index.php?newsfeed=$current_user_no','_self')</script>";
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
<div class="bod2">
    <div class="container text-center">
        <div class="p-3 column1">
            <div class="container container2">
                <div class="row row-form">
                    <div class="col col-form content1">
                        Column
                    </div>
                    <div class="col col-form">
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="p-3 column2">Custom column padding</div>
    </div>
</div>
    <!-- show password -->
    <script src="../functions/JsFunction.js"></script>
</body>
</html>
