<?php
session_name('admin_session');
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: admin_login.php');
}
require_once '../include/connect.php';
require_once '../include/bootsrap.php';
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

<!-- content -->
 <?php
 $sql = "select uw.*, pr.* from user_warnings uw left join post_reports pr on uw.user_no = pr.user_no";
 $usersResult = $con->query($sql);

 ?>
    <div class="container mt-4 ">
        <h1>WARNED USERS</h1>
        <div class="container-fluid operations">
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Number of rows
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="?rows=10&page=">10</a></li>
                    <li><a class="dropdown-item" href="?rows=25&page=">25</a></li>
                    <li><a class="dropdown-item" href="?rows=50&page=">50</a></li>
                    <li><a class="dropdown-item" href="?rows=100&page=">100</a></li>
                </ul>
            </div>

                    <div class="container-fluid search">
                        <form class="d-flex" role="search" style="width: 100%;" method="GET" action="">
                            <input class="form-control me-2" type="search" name="search" placeholder="Search" aria-label="Search" value="">
                            <button class="btn btn-outline-success" type="submit">Search</button>
                        </form>
                    </div>
        </div>

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col" class="sortable" onclick="sortTable('fname')">Name<i class="fa-solid fa-sort-up"></i><i class="fa-solid fa-sort-down"></i></th>
                    <th scope="col" class="sortable" onclick="sortTable('user_no')">User No<i class="fa-solid fa-sort-up"></i><i class="fa-solid fa-sort-down"></i></th>
                    <th scope="col" class="sortable" onclick="sortTable('student_no')">Student No<i class="fa-solid fa-sort-up"></i><i class="fa-solid fa-sort-down"></i></th>
                    <th scope="col" class="sortable" onclick="sortTable('email')">Email<i class="fa-solid fa-sort-up"></i><i class="fa-solid fa-sort-down"></i></th>
                    <th scope="col" class="sortable" onclick="sortTable('warning_level')">Warning level<i class="fa-solid fa-sort-up"></i><i class="fa-solid fa-sort-down"></i></th>
                    <th scope="col">Review posts</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>

            <?php
                // while ($user = $usersResult->fetch_assoc())
                // $issue_date = htmlspecialchars($user['issue_date']);
                // $reset_date = htmlspecialchars($user['reset_date']);
                // $issue_date = new DateTime($issue_date);
                // $reset_date = new DateTime($reset_date);

                // $formattedIssueDate = $issue_date->format('F j, Y'); 
                // $formattedResetDate = $reset_date->format('F j, Y');
                ?>
                    <tr>
                        <th scope="row"></th>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>
                            <a class="Review_posts text-primary" href="../admin_area/review_post.php?user_no=">View post</a>
                        </td>

                        <td>
                        <a href="admin_action.php?user_no=" class="btn btn-primary btn-sm">Action</a>
                        </td>
                    </tr>
            </tbody>
        </table>

        
    </div>

<script>
    function sortTable(column) {
        let direction = 'asc';
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.get('sort') === column && urlParams.get('direction') === 'asc') {
            direction = 'desc';
        }
        window.location.search = `sort=${column}&direction=${direction}&rows=<?php echo $rows_per_page; ?>&page=<?php echo $page; ?>`;
    }
</script>
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


















































