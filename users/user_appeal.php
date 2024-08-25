<?php
require_once ("../include/bootsrap.php");
require_once ('../include/connect.php');

$appeal_message = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $user_fname = $_POST['user_fname'];
    $user_lname = $_POST['user_lname'];
    $user_email = $_POST['user_email'];
    $user_std_num1 = $_POST['user_std_num1'];
    $user_std_num2 = $_POST['user_std_num2'];
    $user_std_num3 = $_POST['user_std_num3'];
    $appealNo = $_POST['appealid'];
    $appeal_message = $_POST['appeal_message'];

    $formattedStudentNo = $user_std_num1 . '-' . $user_std_num2 . '-' . $user_std_num3;

    // Check if the user exists
    $sql = "SELECT user_no, fname, lname, email, student_no FROM user_registration WHERE email = ? AND student_no = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("ss", $user_email, $formattedStudentNo);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $user_no = $row['user_no'];
        $fname = $row['fname'];
        $lname = $row['lname'];

        // Check if the user has warnings
        $warning_sql = "SELECT user_no FROM user_warnings WHERE user_no = ?";
        $warning_stmt = $con->prepare($warning_sql);
        $warning_stmt->bind_param("i", $user_no);
        $warning_stmt->execute();
        $warning_result = $warning_stmt->get_result();

        // Check if the user has bans
        $ban_sql = "SELECT user_no FROM user_bans WHERE user_no = ?";
        $ban_stmt = $con->prepare($ban_sql);
        $ban_stmt->bind_param("i", $user_no);
        $ban_stmt->execute();
        $ban_result = $ban_stmt->get_result();

        $user_warning_no = $user_ban_no = null;

        if ($warning_result->num_rows > 0) {
            $user_warning_no = $user_no; // Set warning number if exists
        }

        if ($ban_result->num_rows > 0) {
            $user_ban_no = $user_no; // Set ban number if exists
        }

        if ($user_warning_no || $user_ban_no) {
            // Insert into appeal table
            $sql = "INSERT INTO appeal (user_no, fname, lname, email, student_no, appeal_no, appeal_message, user_ban_no, user_warning_no)
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $con->prepare($sql);
            $stmt->bind_param("issssisii", $user_no, $fname, $lname, $user_email, $formattedStudentNo, $appealNo, $appeal_message, $user_ban_no, $user_warning_no);
            $stmt->execute();
            $error = "Ticket successfully sent";
        } else {
            $error = "You don't need to send a ticket because you don't have any issues right now.";
        }
    } else {
        $error = "No users found. Please check your given credentials.";
    }
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appeal</title>
    <link rel="stylesheet" href="user_appeal.css?v=<?php echo time(); ?>">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<div class="container-fluid screen">
    <div class="container-fluid nav">
        <nav class="navbar">
            <div class="container-fluid" >
                <a class="navbar-brand" href="#">
                <img src="../images/Cavite_State_University_(CvSU).png" alt="Logo" width="30" height="24" class="d-inline-block align-text-top">
                CvS Tagram
                </a>
            </div>
        </nav>
    </div>
    <div class="container-fluid contbody">
        <div class="container-fluid sidenav">
            <div class="container-fluid menubutton">
            <button onclick="toggleSidenav()"><i class="fa-solid fa-bars"></i></button>
            </div>
            <div class="container-fluid featurescont">
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
                                    <a href="">
                                        <div class="container-fluid listofusers">
                                            <div class="container-fluid listusericon">
                                            <i class="fa-solid fa-circle-exclamation"></i>
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
                                    <a href="">
                                        <div class="container-fluid Bannedaccounts">
                                            <div class="container-fluid Bannedaccountsicon">
                                            <i class="fa-solid fa-user-slash fa-lg"></i>
                                            </div>
                                            <div class="container-fluid Bannedaccountsname">
                                                Banned accounts
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
                                        <a href="">
                                            <div class="container-fluid Deletedaccounts">
                                                <div class="container-fluid Deletedaccountsicon">
                                                <i class="fa-solid fa-trash fa-lg"></i>
                                                </div>
                                                <div class="container-fluid Deletedaccountsname">
                                                    Deleted accounts
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
                                        <a href="">
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
                    </div>
                <div class="container-fluid logoutcont">
                        <div class="row">
                            <div class="col">
                                <ul>
                                    <li>
                                        <a href="">
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
        <div class="container-fluid content">
            

        <div class="container-fluid my-3">
        <h2 class="text-center mb-4">Appeal</h2>
        <div class="row d-flex align-items-center justify-content-center">
            <div class="col-lg-12 col-xl-6">
            <form id="myForm" action="" method="post">
                <!-- username field -->
                <div class="mb-3 names">
                    <div class="form-floating form-outline name">
                        <input type="text" class="form-control" id="user_fname" placeholder="First name" autocomplete="off" required name="user_fname">
                        <label for="user_fname">First name</label>
                    </div>
                    <div class="form-floating form-outline name">
                        <input type="text" class="form-control" id="user_lname" placeholder="Last name" autocomplete="off" required name="user_lname">
                        <label for="user_lname">Last name</label>
                    </div>
                </div>

                <!-- email field -->
                <div class="form-floating mb-3 form-outline">
                    <input type="email" class="form-control" id="user_email" placeholder="CVSU Email" autocomplete="off" required name="user_email">
                    <label for="user_email">CVSU Email</label>
                </div>

                <!-- student number field -->
                <span>Student Number</span>
                <div class="form-floating mb-0 stdnum form-outline">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control std_num" id="user_std_num1" placeholder="Student number1" autocomplete="off" required name="user_std_num1">
                        <label for="user_std_num1">0000</label>
                    </div>-
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control std_num" id="user_std_num2" placeholder="Student number2" autocomplete="off" required name="user_std_num2">
                        <label for="user_std_num2">000</label>
                    </div>-
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control std_num" id="user_std_num3" placeholder="Student number3" autocomplete="off" required name="user_std_num3">
                        <label for="user_std_num3">0000</label>
                    </div>
                </div>

                Enter the given appeal id here
                <div class="form-floating mb-3 form-outline name">
                        <input type="text" class="form-control appealid" id="appealid" placeholder="appeal" autocomplete="off" required name="appealid">
                        <label for="appealid">Appeal NO</label>
                    </div>

                <div class="form-floating">
                    <textarea class="form-control" name="appeal_message" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 120px; resize: none;"></textarea>
                    <label for="floatingTextarea2">Message (Optional)</label>
                </div>

                <div class="mt-3 submitappeal">
                    <input type="submit" value="Send" class="py-2 border-0 px-4" style="border-radius: 5px; color: #fff; background-color: #006400;" name="user_appeal">
                    <div class="container-fluid notification">
                        <?php echo htmlspecialchars($error); ?>
                    </div>
                </div>
            </form>




            </div>
        </div>
    </div>

        </div>
    </div>
</div>
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

<!-- function for student number -->
<script>
    document.getElementById('user_std_num1').addEventListener('input', function(e) {
        if (this.value.length > 4) {
            this.value = this.value.slice(0, 4); // Limit to 4 digits
        }
    });

    document.getElementById('user_std_num2').addEventListener('input', function(e) {
        if (this.value.length > 3) {
            this.value = this.value.slice(0, 3); // Limit to 3 digits
        }
    });

    document.getElementById('user_std_num3').addEventListener('input', function(e) {
        if (this.value.length > 4) {
            this.value = this.value.slice(0, 4); // Limit to 4 digits
        }
    });

    document.getElementById('appealid').addEventListener('input', function(e) {
        if (this.value.length > 6) {
            this.value = this.value.slice(0, 6); // Limit to 6 digits
        }
    });

    // Optional: Prevent non-numeric input
    const inputs = document.querySelectorAll('.std_num');
    inputs.forEach(input => {
        input.addEventListener('input', function() {
            this.value = this.value.replace(/[^0-9]/g, ''); // Remove any non-numeric characters
        });
    });
    const inputs1 = document.querySelectorAll('.appealid');
    inputs1.forEach(input => {
        input.addEventListener('input', function() {
            this.value = this.value.replace(/[^0-9]/g, ''); // Remove any non-numeric characters
        });
    });
</script>
<script>
document.addEventListener("DOMContentLoaded", function() {
    const emailInput = document.getElementById('user_email');
    const form = document.getElementById('myForm');

    emailInput.addEventListener('input', function() {
        const emailValue = emailInput.value;
        const prefix = 'tmc.';
        const domain = '@cvsu.edu.ph';

        // Check if email starts with the specific prefix and ends with the specific domain
        const isValid = emailValue.startsWith(prefix) && emailValue.endsWith(domain);

        // If email is invalid, show the tooltip
        if (!isValid) {
            emailInput.setAttribute('data-bs-toggle', 'tooltip');
            emailInput.setAttribute('title', 'You must use your CVSU Email.');
            emailInput.classList.add('is-invalid');

            // Initialize the tooltip if not already done
            let tooltipInstance = bootstrap.Tooltip.getInstance(emailInput);
            if (!tooltipInstance) {
                tooltipInstance = new bootstrap.Tooltip(emailInput);
            }
            tooltipInstance.show();
        } else {
            const tooltipInstance = bootstrap.Tooltip.getInstance(emailInput);
            if (tooltipInstance) {
                tooltipInstance.hide();
            }
            emailInput.removeAttribute('data-bs-toggle');
            emailInput.removeAttribute('title');
            emailInput.classList.remove('is-invalid');
        }
    });

    emailInput.addEventListener('blur', function() {
        const tooltipInstance = bootstrap.Tooltip.getInstance(emailInput);
        if (tooltipInstance) {
            tooltipInstance.hide();
        }
    });

    form.addEventListener('submit', function(event) {
        const emailValue = emailInput.value;
        const prefix = 'tmc.';
        const domain = '@cvsu.edu.ph';

        // Check if email starts with the specific prefix and ends with the specific domain
        const isValid = emailValue.startsWith(prefix) && emailValue.endsWith(domain);

        if (!isValid) {
            event.preventDefault(); // Prevent form submission
            emailInput.setAttribute('data-bs-toggle', 'tooltip');
            emailInput.setAttribute('title', 'You must use your CVSU Email.');
            emailInput.classList.add('is-invalid');

            // Initialize the tooltip if not already done
            let tooltipInstance = bootstrap.Tooltip.getInstance(emailInput);
            if (!tooltipInstance) {
                tooltipInstance = new bootstrap.Tooltip(emailInput);
            }
            tooltipInstance.show();
        }
    });
});
</script>