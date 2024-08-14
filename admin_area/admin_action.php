<?php
session_name('admin_session');
session_start();
// if (!isset($_SESSION['admin_logged_in'])) {
//     header('Location: ../login.php');
//     exit;
// }
require_once '../include/connect.php';
require_once '../include/bootsrap.php';

$user_no = isset($_GET['user_no']) ? $_GET['user_no'] : null;

// Query to fetch user information and report count
$userQuery = 'SELECT ur.fname, ur.lname, ur.user_no, ur.student_no, ur.email, 
                     ur.profilepicture, ur.coverphoto, 
                     IFNULL(COUNT(pr.report_id), 0) AS report_count 
              FROM user_registration ur
              LEFT JOIN post_reports pr ON ur.user_no = pr.user_no
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
                                                    <a href="admin_logout.php">Logout</a>
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
            <div class="container-fluid actionbod">
                <div class="container-fluid actionbodchild">
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
                        <form action="" method="post">
                            <div class="container-fluid warndiv">
                                <div class="container-fluid warning">
                                    <button type="submit" name="submit_warn" class="btn btn-warning">Warn</button>
                                </div>
                                <div class="container-fluid optionalmessage">
                                    <div class="form-floating" style="width:100%;">
                                        <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px"></textarea>
                                        <label for="floatingTextarea2">Optional warning message</label>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <!-- Form for banning a user -->
                        <form action="" method="post">
                            <div class="container-fluid bandiv">
                                <div class="container-fluid warning">
                                    <button type="submit" name="submit_ban" class="btn btn-danger">Ban</button>
                                    <select name="ban_type" class="form-select" aria-label="Default select example">
                                        <option value="0" selected>Choose ban type</option>
                                        <option value="1">Ban for 7 Days</option>
                                        <option value="2">Ban for 30 Days</option>
                                        <option value="3">Permanently ban</option>
                                    </select>
                                    
                                </div>
                                <div class="container-fluid optionalmessage">
                                    <div class="form-floating" style="width:100%;">
                                        <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px"></textarea>
                                        <label for="floatingTextarea2">Optional Ban message</label>
                                    </div>
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