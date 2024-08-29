<?php
session_name('admin_session');
session_start();
// if (!isset($_SESSION['admin_logged_in'])) {
//     header('Location: ../login.php');
//     exit;
// }
require_once '../include/connect.php';
require_once '../include/bootsrap.php';

// Fetch users and their report status
$usersQuery = 'SELECT ur.fname, ur.lname, ur.user_no, ur.student_no, ur.email, pr.report_reason, pr.post_id, IFNULL(COUNT(pr.report_id), 0) AS report_count 
               FROM user_registration ur
               LEFT JOIN post_reports pr ON ur.user_no = pr.user_no
               GROUP BY ur.user_no';
$usersResult = $con->query($usersQuery);
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
            <div class="container-fluid navtexticon">
                <a class="navbar-brand px-2" href="#">
                <img src="../images/Cavite_State_University_(CvSU).png" alt="Logo" width="50" height="40" class="d-inline-block align-text-top">
                CvSTagram 
                </a>
            </div>
        </nav>
    </div>
    <div class="container-fluid contbody">
    <div class="container-fluid sidenav">
    <div class="container-fluid menubutton">
        <button onclick="toggleSidenav()">
            <i class="fa-solid fa-bars"></i>
        </button>
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
                                    <a href="active_warn.php">
                                        <div class="container-fluid listofusers">
                                            <div class="container-fluid listusericon">
                                            <i class="fa-solid fa-triangle-exclamation"></i>
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
                                    <a href="banned_user.php">
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
                    <!-- <div class="row">
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
                        </div> -->
                        <div class="row">
                            <div class="col">
                                <ul>
                                    <li>
                                        <a href="request.php">
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
                        <div class="row">
                        <div class="col">
                            <ul>
                                <li>
                                    <a href="warned_user.php">
                                        <div class="container-fluid listofusers">
                                            <div class="container-fluid listusericon">
                                            <i class="fa-solid fa-circle-exclamation"></i>
                                            </div>
                                            <div class="container-fluid listofusersname">
                                                Warning history
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
                            <a href="admin_logout.php">
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
        </div>
        <div class="container-fluid content">
            







        <?php
// Check if user_no is set in the URL
$user_no = isset($_GET['user_no']) ? intval($_GET['user_no']) : 0;

// Fetch reported posts for the specified user
$query = "SELECT 
    pr.report_id,
    pr.reporter_user_no,
    pr.report_reason,
    pr.report_date,
    p.post_id,
    ur.user_no,
    ur.fname,
    ur.lname,
    p.postphoto,
    p.caption
FROM 
    post_reports pr
JOIN 
    posts p ON pr.post_id = p.post_id
JOIN 
    user_registration ur ON pr.user_no = ur.user_no
WHERE
    ur.user_no = ?";
$stmt = $con->prepare($query);
$stmt->bind_param('i', $user_no);
$stmt->execute();
$reports = $stmt->get_result();
?>
    <div class="container mt-4">
        <!-- <a href="../admin_area/list_of_users.php">Back</a> -->
        <h1>Reported Posts for User <?php echo htmlspecialchars($user_no); ?></h1>
        <a href="admin_action.php?user_no=<?php echo htmlspecialchars($user_no); ?>"><button class="btn btn-primary">Action</button></a>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th scope="col">Report ID</th>
                    <th scope="col">Reporter User No</th>
                    <th scope="col">Reason</th>
                    <th scope="col">Date</th>
                    <th scope="col">Post ID</th>
                    <th scope="col">Post Photo</th>
                    <th scope="col">Caption</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($report = $reports->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($report['report_id']); ?></td>
                        <td><?php echo htmlspecialchars($report['reporter_user_no']); ?></td>
                        <td><?php echo htmlspecialchars($report['report_reason']); ?></td>
                        <td><?php echo htmlspecialchars($report['report_date']); ?></td>
                        <td><?php echo htmlspecialchars($report['post_id']); ?></td>
                        <td>
                            <?php if ($report['postphoto']): ?>
                                <img src="../include/posts_images/<?php echo htmlspecialchars($report['postphoto']); ?>" alt="Post Photo" width="100">
                            <?php else: ?>
                                No Photo
                            <?php endif; ?>
                        </td>
                        <td><?php echo htmlspecialchars($report['caption']); ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>




            <?php
            // if (isset($_GET['list_of_users'])) {
            //     include '../admin_area/list_of_users.php';                       
            // }
            // if (isset($_GET['user_no'])) {
            //     $user_no = htmlspecialchars($_GET['user_no']);
            //     include '../admin_area/review_post.php';
            // }
            ?>
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



