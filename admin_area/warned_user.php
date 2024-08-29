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
// Set default values
$rows = isset($_GET['rows']) ? intval($_GET['rows']) : 10;
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$offset = ($page - 1) * $rows;

// Handle sorting
$valid_sort_columns = ['warning_id', 'user_no', 'warn_appeal_id', 'warning_level', 'issue_date', 'reset_date'];
$sort_by = isset($_GET['sort_by']) && in_array($_GET['sort_by'], $valid_sort_columns) ? $_GET['sort_by'] : 'warning_id';
$sort_order = isset($_GET['sort_order']) && $_GET['sort_order'] == 'DESC' ? 'DESC' : 'ASC';

// Handle search
$search = isset($_GET['search']) ? $con->real_escape_string($_GET['search']) : '';

// Query for the total number of records
$totalResult = $con->query("SELECT COUNT(*) AS total FROM user_warnings WHERE 
                            warning_id LIKE '%$search%' OR 
                            user_no LIKE '%$search%' OR 
                            warn_appeal_id LIKE '%$search%' OR 
                            warning_level LIKE '%$search%' OR 
                            DATE_FORMAT(issue_date, '%Y-%m-%d') LIKE '%$search%' OR 
                            DATE_FORMAT(reset_date, '%Y-%m-%d') LIKE '%$search%'");
$totalRows = $totalResult->fetch_assoc()['total'];

// Adjusted SQL query with pagination, sorting, and search
$sql = "SELECT warning_id, user_no, warn_appeal_id, warning_level, issue_date, reset_date 
        FROM user_warnings 
        WHERE warning_id LIKE '%$search%' 
           OR user_no LIKE '%$search%' 
           OR warn_appeal_id LIKE '%$search%' 
           OR warning_level LIKE '%$search%' 
           OR DATE_FORMAT(issue_date, '%Y-%m-%d') LIKE '%$search%' 
           OR DATE_FORMAT(reset_date, '%Y-%m-%d') LIKE '%$search%'
        ORDER BY $sort_by $sort_order 
        LIMIT $offset, $rows";
$usersResult = $con->query($sql);

// Calculate total pages
$totalPages = ceil($totalRows / $rows);
?>

<div class="container mt-4">
    <h1>WARNING HISTORY</h1>
    <div class="container-fluid operations">
        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                Number of rows
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="?rows=10&page=1">10</a></li>
                <li><a class="dropdown-item" href="?rows=25&page=1">25</a></li>
                <li><a class="dropdown-item" href="?rows=50&page=1">50</a></li>
                <li><a class="dropdown-item" href="?rows=100&page=1">100</a></li>
            </ul>
        </div>
        <div class="container-fluid search">
            <form class="d-flex" role="search" style="width: 100%;" method="GET" action="">
                <input class="form-control me-2" type="search" name="search" placeholder="Search" aria-label="Search" value="<?= htmlspecialchars(isset($_GET['search']) ? $_GET['search'] : ''); ?>">
                <button class="btn btn-outline-success" type="submit">Search</button>
                <input type="hidden" name="rows" value="<?= htmlspecialchars($rows); ?>">
                <input type="hidden" name="page" value="<?= htmlspecialchars($page); ?>">
                <input type="hidden" name="sort_by" value="<?= htmlspecialchars($sort_by); ?>">
                <input type="hidden" name="sort_order" value="<?= htmlspecialchars($sort_order); ?>">
            </form>
        </div>
    </div>

    <table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th scope="col" class="sortable" onclick="sortTable('warning_id')">
                ID <i class="fa-solid fa-sort-up"></i><i class="fa-solid fa-sort-down"></i>
            </th>
            <th scope="col" class="sortable" onclick="sortTable('user_no')">
                User No <i class="fa-solid fa-sort-up"></i><i class="fa-solid fa-sort-down"></i>
            </th>
            <th scope="col" class="sortable" onclick="sortTable('warn_appeal_id')">
                Warn Appeal ID <i class="fa-solid fa-sort-up"></i><i class="fa-solid fa-sort-down"></i>
            </th>
            <th scope="col" class="sortable" onclick="sortTable('warning_level')">
                Warning Level <i class="fa-solid fa-sort-up"></i><i class="fa-solid fa-sort-down"></i>
            </th>
            <th scope="col" class="sortable" onclick="sortTable('issue_date')">
                Issue Date <i class="fa-solid fa-sort-up"></i><i class="fa-solid fa-sort-down"></i>
            </th>
            <th scope="col" class="sortable" onclick="sortTable('reset_date')">
                Reset Date <i class="fa-solid fa-sort-up"></i><i class="fa-solid fa-sort-down"></i>
            </th>
        </tr>
    </thead>
    <tbody>
            <?php
            if ($usersResult->num_rows > 0) {
                while ($row = $usersResult->fetch_assoc()) {
                    echo "<tr>";
                    echo "<th scope='row'>" . $row['warning_id'] . "</th>";
                    echo "<td>" . $row['user_no'] . "</td>";
                    echo "<td>" . $row['warn_appeal_id'] . "</td>";
                    echo "<td>" . $row['warning_level'] . "</td>";                  
                    echo "<td>" . $row['issue_date'] . "</td>";                  
                    echo "<td>" . $row['reset_date'] . "</td>";                  
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No warned users found</td></tr>";
            }
            ?>
        </tbody>
</table>

    <!-- Pagination -->
    <nav aria-label="Page navigation">
        <ul class="pagination">
            <li class="page-item <?= ($page <= 1) ? 'disabled' : ''; ?>">
                <a class="page-link" href="?rows=<?= $rows; ?>&page=<?= $page - 1; ?>&sort_by=<?= $sort_by; ?>&sort_order=<?= $sort_order; ?>">Previous</a>
            </li>
            <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                <li class="page-item <?= ($page == $i) ? 'active' : ''; ?>">
                    <a class="page-link" href="?rows=<?= $rows; ?>&page=<?= $i; ?>&sort_by=<?= $sort_by; ?>&sort_order=<?= $sort_order; ?>"><?= $i; ?></a>
                </li>
            <?php endfor; ?>
            <li class="page-item <?= ($page >= $totalPages) ? 'disabled' : ''; ?>">
                <a class="page-link" href="?rows=<?= $rows; ?>&page=<?= $page + 1; ?>&sort_by=<?= $sort_by; ?>&sort_order=<?= $sort_order; ?>">Next</a>
            </li>
        </ul>
    </nav>
</div>

<script>
function sortTable(column) {
    const url = new URL(window.location.href);
    const currentSortBy = url.searchParams.get('sort_by') || 'warning_id';
    const currentSortOrder = url.searchParams.get('sort_order') || 'ASC';

    const newSortOrder = (currentSortBy === column && currentSortOrder === 'ASC') ? 'DESC' : 'ASC';

    url.searchParams.set('sort_by', column);
    url.searchParams.set('sort_order', newSortOrder);

    window.location.href = url.toString();
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


















































