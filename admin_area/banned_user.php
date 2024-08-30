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
        <button onclick="toggleSidenav()">
            <i class="fa-solid fa-bars"></i>
        </button>
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
        </div>
        <div class="container-fluid content">

<!-- content -->
<?php
// Handle search input
$search = isset($_GET['search']) ? trim($_GET['search']) : '';

// Determine the sort column and direction
$sort_column = isset($_GET['sort']) ? $_GET['sort'] : 'ban_id';
$sort_direction = isset($_GET['direction']) && $_GET['direction'] == 'desc' ? 'desc' : 'asc';

// Determine the number of rows per page and current page
$rows_per_page = isset($_GET['rows']) ? intval($_GET['rows']) : 10;
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$offset = ($page - 1) * $rows_per_page;

// Validate sort column
$valid_columns = ['ban_id', 'user_no', 'ban_appeal_id', 'ban_level', 'ban_start_date', 'ban_end_date'];
if (!in_array($sort_column, $valid_columns)) {
    $sort_column = 'ban_id'; // default sort column
}

// Validate rows per page
$valid_rows_per_page = [10, 25, 50, 100];
if (!in_array($rows_per_page, $valid_rows_per_page)) {
    $rows_per_page = 10; // default rows per page
}

$searchFilter = !empty($search) ? " AND (ban_id LIKE '%$search%' OR user_no LIKE '%$search%' OR ban_appeal_id LIKE '%$search%' OR ban_start_date LIKE '%$search%' OR ban_end_date LIKE '%$search%')" : "";

$query = "SELECT ban_id, user_no, ban_appeal_id, ban_level, ban_start_date, ban_end_date from user_bans
WHERE 1=1 $searchFilter
               ORDER BY $sort_column $sort_direction
               LIMIT $rows_per_page OFFSET $offset";
$usersResult = $con->query($query);

// Fetch total number of records for pagination
$totalQuery = "SELECT COUNT(*) AS total FROM user_bans";
$totalResult = $con->query($totalQuery);

$totalRecords = $totalResult->fetch_assoc()['total'];
$totalPages = ceil($totalRecords / $rows_per_page);

// Check for query errors
if (!$totalResult) {
    die('Error in total records query: ' . $con->error);
}   
?>

    <div class="container mt-4 ">
        <h1>BAN HISTORY</h1>
        <div class="container-fluid operations">
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Number of rows
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="?rows=10&page=<?php echo $page; ?>">10</a></li>
                    <li><a class="dropdown-item" href="?rows=25&page=<?php echo $page; ?>">25</a></li>
                    <li><a class="dropdown-item" href="?rows=50&page=<?php echo $page; ?>">50</a></li>
                    <li><a class="dropdown-item" href="?rows=100&page=<?php echo $page; ?>">100</a></li>
                </ul>
            </div>

                    <div class="container-fluid search">
                        <form class="d-flex" role="search" style="width: 100%;" method="GET" action="">
                            <input class="form-control me-2" type="search" name="search" placeholder="Search" aria-label="Search" value="<?php echo htmlspecialchars($search); ?>">
                            <button class="btn btn-outline-success" type="submit">Search</button>
                        </form>
                    </div>
        </div>

        <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th scope="col" class="sortable <?php echo ($sort_column == 'ban_id') ? ($sort_direction == 'asc' ? 'asc' : 'desc') : ''; ?>" onclick="sortTable('fname')">ID<i class="fa-solid fa-sort-up"></i><i class="fa-solid fa-sort-down"></i></th>

                <th scope="col" class="sortable <?php echo ($sort_column == 'user_no') ? ($sort_direction == 'asc' ? 'asc' : 'desc') : ''; ?>" onclick="sortTable('user_no')">User no<i class="fa-solid fa-sort-up"></i><i class="fa-solid fa-sort-down"></i></th>

                <th scope="col" class="sortable <?php echo ($sort_column == 'ban_appeal_id') ? ($sort_direction == 'asc' ? 'asc' : 'desc') : ''; ?>" onclick="sortTable('ban_appeal_id')">Ban appeal no<i class="fa-solid fa-sort-up"></i><i class="fa-solid fa-sort-down"></i></th>

                <th scope="col" class="sortable <?php echo ($sort_column == 'ban_level') ? ($sort_direction == 'asc' ? 'asc' : 'desc') : ''; ?>" onclick="sortTable('ban_level')">Ban level<i class="fa-solid fa-sort-up"></i><i class="fa-solid fa-sort-down"></i></th>

                <th scope="col" class="sortable <?php echo ($sort_column == 'ban_start_date') ? ($sort_direction == 'asc' ? 'asc' : 'desc') : ''; ?>" onclick="sortTable('ban_start_date')">Ban start date<i class="fa-solid fa-sort-up"></i><i class="fa-solid fa-sort-down"></i></th>

                <th scope="col" class="sortable <?php echo ($sort_column == 'ban_end_date') ? ($sort_direction == 'asc' ? 'asc' : 'desc') : ''; ?>" onclick="sortTable('ban_end_date')">Ban end date<i class="fa-solid fa-sort-up"></i><i class="fa-solid fa-sort-down"></i></th>
            </tr>
        </thead>
                <tbody>
                    <?php
                        if ($usersResult) {
                            while ($row = $usersResult->fetch_assoc()) {
                                echo "<tr>";
                                echo "<th scope='row'>" . htmlspecialchars($row['ban_id']) . "</th>";
                                echo "<td>" . htmlspecialchars($row['user_no']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['ban_appeal_id']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['ban_level']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['ban_start_date']) . "</td>";
                                if($row['ban_end_date'] === NULL){
                                    echo "<td> Permanent </td>";
                                }else{
                                    echo "<td>" . htmlspecialchars($row['ban_end_date']) . "</td>";
                                }
                                echo "</tr>";
                            }
                        } else {
                            echo "No results found or an error occurred.";
                        }
                    ?>
                </tbody>
        </table>

        <nav aria-label="Page navigation">
            <ul class="pagination">
            <li class="page-item <?php if ($page <= 1) echo 'disabled'; ?>">
                    <a class="page-link" href="?rows=<?php echo $rows_per_page; ?>&page=<?php echo max(1, $page - 1); ?>&sort=<?php echo $sort_column; ?>&direction=<?php echo $sort_direction; ?>">Previous</a>
                </li>
                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <li class="page-item <?php if ($i == $page) echo 'active'; ?>">
                        <a class="page-link" href="?rows=<?php echo $rows_per_page; ?>&page=<?php echo $i; ?>&sort=<?php echo $sort_column; ?>&direction=<?php echo $sort_direction; ?>"><?php echo $i; ?></a>
                    </li>
                <?php endfor; ?>
                <li class="page-item <?php if ($page >= $totalPages) echo 'disabled'; ?>">
                    <a class="page-link" href="?rows=<?php echo $rows_per_page; ?>&page=<?php echo min($totalPages, $page + 1); ?>&sort=<?php echo $sort_column; ?>&direction=<?php echo $sort_direction; ?>">Next</a>
                </li>
            </ul>
        </nav>

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


















































