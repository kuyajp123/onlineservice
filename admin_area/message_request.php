<?php
require_once '../include/connect.php';
require_once '../include/bootsrap.php';
session_name('admin_session');
session_start();

$appeal_id = isset($_GET['appeal_id']) ? intval($_GET['appeal_id']) : 0;

// echo "$appeal_id";
$matched_appeal_no = '';

$sql = "SELECT * FROM appeal where appeal_id = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("i", $appeal_id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

$timeStamp = $row['timeStamp'];
$formattedDate = new DateTime($timeStamp);
$formattedDate = $formattedDate->format('F j, Y');

$user_no = $row['user_no'];
$appeal_no = $row['appeal_no'];

$query = "SELECT * FROM active_warning uw WHERE uw.warn_appeal_id = ?";
$stmt = $con->prepare($query);
$stmt->bind_param("i", $appeal_no);
$stmt->execute();
$result_uw = $stmt->get_result();
$uw = $result_uw->fetch_assoc();

$sql = "SELECT * FROM active_ban uw WHERE uw.ban_appeal_id = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("i", $appeal_no);
$stmt->execute();
$result_ub = $stmt->get_result();
$ub = $result_ub->fetch_assoc();

function formatDate($date) {
    if ($date === null || $date === '') {
        return 'Permanent ban'; // Or an empty string or another placeholder
    }
    return date('F j, Y', strtotime($date)); // Example format: August 27, 2024
}



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appeal messages</title>
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
                <!-- side links -->

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
                                    <a href="active_ban.php">
                                        <div class="container-fluid Bannedaccounts">
                                            <div class="container-fluid Bannedaccountsicon">
                                            <i class="fa-solid fa-user-slash fa-lg"></i>
                                            </div>
                                            <div class="container-fluid Bannedaccountsname">
                                                Banned users
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
                    <div class="row">
                        <div class="col">
                            <ul>
                                <li>
                                    <a href="banned_user.php">
                                        <div class="container-fluid Bannedaccounts">
                                            <div class="container-fluid Bannedaccountsicon">
                                                <i class="fa-solid fa-ban"></i>
                                            </div>
                                            <div class="container-fluid Bannedaccountsname">
                                                Ban history
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    </div>


<!-- side links end -->
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
        <div class="container-fluid content">
            
        <div class="container-fluid messcont">
            <div class="container-fluid messcontchild">
                <div class="container contmess">
                    <div class="container-fluid headermessage">
                        <img src="logo 1.png">
                        <div class="text-center">
                        Republic of the Philippines <br>
                        <span style="font-size:2rem;"><b>CVSTAGRAM</b></span><br>
                        Cavite State University <br>
                        Trece Martires City
                        </div>
                        
                    </div>
                    <div class="container-fluid contentmessage">
                        <div class="container-fluid reqdetails">
                            <div class="container detailschild">
                                Appeal id: <b><?php echo htmlspecialchars($row['appeal_id']) ?></b> <br>
                                User no: <b><?php echo htmlspecialchars($user_no) ?></b> <br>
                                Appeal no: <b><?php echo htmlspecialchars($appeal_no) ?></b> <br>
                                Name: <b><?php echo htmlspecialchars($row['fname']. ' ' .$row['lname']) ?></b>  <br>
                                Email: <b><?php echo htmlspecialchars($row['email']) ?></b> <br>
                                Student no: <b><?php echo htmlspecialchars($row['student_no']) ?></b> <br>
                                Date: <b><?php echo htmlspecialchars($formattedDate); ?></b> <br>
                                
                            </div>
                            <div class="container detailschild">
                                
                            <?php
                            if ($result_uw->num_rows > 0) {
                                echo "Warning level: <b>" . htmlspecialchars($uw['warning_level']) . "</b><br>";
                                echo "Issue date: <b>" . formatDate($uw['issue_date']) . "</b><br>";
                                echo "Reset date: <b>" . formatDate($uw['reset_date']) . "</b><br>";
                            } else {
                                echo ' ';
                            }
                            echo "<br>";
                            if ($result_ub->num_rows > 0) {
                                echo "Ban level: <b>" . htmlspecialchars($ub['ban_level']) . "</b><br>";
                                echo "Ban start date: <b>" . formatDate($ub['ban_start_date']) . "</b><br>";
                                echo "Ban end date: <b>" . formatDate($ub['ban_end_date']) . "</b><br>";
                            } else {
                                echo ' ';
                            }
                            ?>
                            </div>
                        </div>
                        <?php
                        if ($ub !== NULL && $ub['ban_appeal_id'] !== NULL) {
                            // User has a ban and an appeal ID
                            if($appeal_no === $ub['ban_appeal_id']) {
                                $matched_appeal_no = "Ban appeal no.";
                            }else{
                                $matched_appeal_no = "No match found.";
                            }
                        } elseif ($uw !== NULL && $uw['warn_appeal_id'] !== NULL) {
                            // User has a warning appeal ID but no ban
                            if($appeal_no === $uw['warn_appeal_id']) {
                                $matched_appeal_no = "Warning appeal no.";
                            }else{
                                $matched_appeal_no = "No match found.";
                            }
                        } else {
                            // User has no ban and no warning appeal ID
                            $matched_appeal_no = "No match found.";
                        }

                        ?>
                        <div class="container-fluid text-break messagetext">
                            <div class="container-fluid actionsection">
                                <div class="container-fluid match">
                                Appeal no. matched:&nbsp;<b><?php echo htmlspecialchars($matched_appeal_no); ?></b>
                                </div>
                                <div class="container-fluid action">
                                <a href="admin_action.php?user_no=<?php echo htmlspecialchars($user_no); ?>" class="btn btn-primary btn-sm">Action</a>
                                </div>
                            </div>
                            <div class="container-fluid message">
                                <?php echo htmlspecialchars($row['appeal_message']) ?>
                            </div>
                        </div>
                    </div>
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