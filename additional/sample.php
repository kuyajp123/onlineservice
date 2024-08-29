<?php
// if (!isset($_SESSION['admin_logged_in'])) {
//     header('Location: ../login.php');
//     exit;
// }

// Handle search input
$search = isset($_GET['search']) ? trim($_GET['search']) : '';

// Determine the sort column and direction
$sort_column = isset($_GET['sort']) ? $_GET['sort'] : 'lname';
$sort_direction = isset($_GET['direction']) && $_GET['direction'] == 'desc' ? 'desc' : 'asc';

// Determine the number of rows per page and current page
$rows_per_page = isset($_GET['rows']) ? intval($_GET['rows']) : 10;
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$offset = ($page - 1) * $rows_per_page;

// Validate sort column
$valid_columns = ['fname', 'lname', 'user_no', 'student_no', 'email', 'created_at', 'warning_level', 'ban_level', 'report_count'];
if (!in_array($sort_column, $valid_columns)) {
    $sort_column = 'lname'; // default sort column
}

// Validate rows per page
$valid_rows_per_page = [10, 25, 50, 100];
if (!in_array($rows_per_page, $valid_rows_per_page)) {
    $rows_per_page = 10; // default rows per page
}

// Fetch users and their report status with search, sorting, and pagination
$searchFilter = !empty($search) ? " AND (ur.fname LIKE '%$search%' OR ur.lname LIKE '%$search%' OR ur.email LIKE '%$search%' OR ur.student_no LIKE '%$search%' OR ur.user_no LIKE '%$search%')" : "";
$usersQuery = "SELECT ur.fname, ur.lname, ur.user_no, ur.student_no, ur.created_at, ur.email, uw.warning_level, IFNULL(COUNT(pr.report_id), 0) AS report_count 
               FROM user_warnings uw
               LEFT JOIN post_reports pr ON uw.user_no = pr.user_no
               LEFT JOIN user_registration ur ON uw.user_no = ur.user_no
               WHERE 1=1 $searchFilter
               GROUP BY ur.user_no
               ORDER BY $sort_column $sort_direction
               LIMIT $rows_per_page OFFSET $offset";
$usersResult = $con->query($usersQuery);

// Fetch total number of records for pagination
$totalQuery = "SELECT COUNT(*) AS total FROM user_registration";
$totalResult = $con->query($totalQuery);

// Check for query errors
if (!$totalResult) {
    die('Error in total records query: ' . $con->error);
}

$totalRecords = $totalResult->fetch_assoc()['total'];
$totalPages = ceil($totalRecords / $rows_per_page);
?>
    <div class="container mt-4 ">
        <h1>WARNED USERS</h1>
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
                    <th scope="col">No</th>
                    <th scope="col" class="sortable <?php echo ($sort_column == 'fname') ? ($sort_direction == 'asc' ? 'asc' : 'desc') : ''; ?>" onclick="sortTable('fname')">Name<i class="fa-solid fa-sort-up"></i><i class="fa-solid fa-sort-down"></i></th>
                    <th scope="col" class="sortable <?php echo ($sort_column == 'user_no') ? ($sort_direction == 'asc' ? 'asc' : 'desc') : ''; ?>" onclick="sortTable('user_no')">User No<i class="fa-solid fa-sort-up"></i><i class="fa-solid fa-sort-down"></i></th>
                    <th scope="col" class="sortable <?php echo ($sort_column == 'student_no') ? ($sort_direction == 'asc' ? 'asc' : 'desc') : ''; ?>" onclick="sortTable('student_no')">Student No<i class="fa-solid fa-sort-up"></i><i class="fa-solid fa-sort-down"></i></th>
                    <th scope="col" class="sortable <?php echo ($sort_column == 'email') ? ($sort_direction == 'asc' ? 'asc' : 'desc') : ''; ?>" onclick="sortTable('email')">Email<i class="fa-solid fa-sort-up"></i><i class="fa-solid fa-sort-down"></i></th>
                    <th scope="col" class="sortable <?php echo ($sort_column == 'warning_level') ? ($sort_direction == 'asc' ? 'asc' : 'desc') : ''; ?>" onclick="sortTable('warning_level')">Warning level<i class="fa-solid fa-sort-up"></i><i class="fa-solid fa-sort-down"></i></th>
                    <th scope="col">Review posts</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $line_number = $offset + 1;
                while ($user = $usersResult->fetch_assoc()): ?>
                <?php
                $timestamp = htmlspecialchars($user['created_at']);
                $created_at = new DateTime($timestamp);

                $formattedDate = $created_at->format('F j, Y'); // e.g., July 24, 2023
                $formattedTime = $created_at->format('g:i a'); // e.g., 6:27 pm
                ?>
                    <tr>
                        <th scope="row"><?php echo htmlspecialchars($line_number++); ?></th>
                        <td><?php echo htmlspecialchars($user['fname'] . ' ' . $user['lname']); ?></td>
                        <td><?php echo htmlspecialchars($user['user_no']); ?></td>
                        <td><?php echo htmlspecialchars($user['student_no']); ?></td>
                        <td><?php echo htmlspecialchars($user['email']); ?></td>
                        <td><?php echo htmlspecialchars($user['warning_level']); ?></td>
                        <td>
                        <?php if ($user['report_count'] > 0): ?>
                            <a class="Review_posts text-primary" href="../admin_area/review_post.php?user_no=<?php echo htmlspecialchars($user['user_no']); ?>">View post</a>
                            <?php else: ?>
                                <!-- leave blank here to get space for no report -->
                            <?php endif; ?>
                            
                        </td>

                        <td>
                            <?php if ($user['report_count'] > 0): ?>
                                <a href="admin_action.php?user_no=<?php echo htmlspecialchars($user['user_no']); ?>" class="btn btn-primary btn-sm">Action</a>
                            <?php else: ?>
                                <!-- leave blank here to get space for no report -->
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endwhile; ?>
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