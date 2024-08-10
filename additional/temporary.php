<?php
session_start();
// if (!isset($_SESSION['admin_logged_in'])) {
//     header('Location: ../login.php');
//     exit;
// }
require_once '../include/connect.php';
require_once '../include/bootsrap.php';

// Determine the sort column and direction
$sort_column = isset($_GET['sort']) ? $_GET['sort'] : 'lname';
$sort_direction = isset($_GET['direction']) && $_GET['direction'] == 'desc' ? 'desc' : 'asc';

// Validate sort column
$valid_columns = ['fname', 'lname', 'user_no', 'student_no', 'email', 'report_count'];
if (!in_array($sort_column, $valid_columns)) {
    $sort_column = 'lname'; // default sort column
}

// Fetch users and their report status with sorting
$usersQuery = "SELECT ur.fname, ur.lname, ur.user_no, ur.student_no, ur.email, pr.report_reason, pr.post_id, IFNULL(COUNT(pr.report_id), 0) AS report_count 
               FROM user_registration ur
               LEFT JOIN post_reports pr ON ur.user_no = pr.user_no
               GROUP BY ur.user_no
               ORDER BY $sort_column $sort_direction";
$usersResult = $con->query($usersQuery);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List of Users</title>

    <style>
        .table th, .table td {
            text-align: center;
        }
        .sortable {
            cursor: pointer;
            position: relative;
        }
        .sortable i {
            position: absolute;
            right: 0;
            top: 50%;
            transform: translateY(-50%);
            margin-left: 10px;
            font-size: 0.8em;
        }
        .asc i.fa-sort-up {
            color: black;
        }
        .desc i.fa-sort-down {
            color: black;
        }
        .sortable i {
            opacity: 0;
        }
        .sortable.asc i.fa-sort-up {
            opacity: 1;
        }
        .sortable.desc i.fa-sort-down {
            opacity: 1;
        }
        .sortable:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<div class="container mt-4">
<div class="btn-group">
  <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
    Small button
  </button>
  <ul class="dropdown-menu">
    ...
  </ul>
</div>
    <h1>List of Users</h1>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col" class="sortable <?php echo ($sort_column == 'fname') ? ($sort_direction == 'asc' ? 'asc' : 'desc') : ''; ?>" onclick="sortTable('fname')">Name<i class="fa-solid fa-sort-up"></i><i class="fa-solid fa-sort-down"></i></th>
                <th scope="col" class="sortable <?php echo ($sort_column == 'user_no') ? ($sort_direction == 'asc' ? 'asc' : 'desc') : ''; ?>" onclick="sortTable('user_no')">User No<i class="fa-solid fa-sort-up"></i><i class="fa-solid fa-sort-down"></i></th>
                <th scope="col" class="sortable <?php echo ($sort_column == 'student_no') ? ($sort_direction == 'asc' ? 'asc' : 'desc') : ''; ?>" onclick="sortTable('student_no')">Student No<i class="fa-solid fa-sort-up"></i><i class="fa-solid fa-sort-down"></i></th>
                <th scope="col" class="sortable <?php echo ($sort_column == 'email') ? ($sort_direction == 'asc' ? 'asc' : 'desc') : ''; ?>" onclick="sortTable('email')">Email<i class="fa-solid fa-sort-up"></i><i class="fa-solid fa-sort-down"></i></th>
                <th scope="col" class="sortable <?php echo ($sort_column == 'report_count') ? ($sort_direction == 'asc' ? 'asc' : 'desc') : ''; ?>" onclick="sortTable('report_count')">Reports<i class="fa-solid fa-sort-up"></i><i class="fa-solid fa-sort-down"></i></th>
                <th scope="col">Posts</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $line_number = 1;
            while ($user = $usersResult->fetch_assoc()): ?>
                <tr>
                    <th scope="row"><?php echo htmlspecialchars($line_number++); ?></th>
                    <td><?php echo htmlspecialchars($user['fname'] . ' ' . $user['lname']); ?></td>
                    <td><?php echo htmlspecialchars($user['user_no']); ?></td>
                    <td><?php echo htmlspecialchars($user['student_no']); ?></td>
                    <td><?php echo htmlspecialchars($user['email']); ?></td>
                    <td><?php echo htmlspecialchars($user['report_count']); ?></td>
                    <td><?php echo htmlspecialchars($user['post_id']); ?></td>
                    <td>
                        <?php if ($user['report_count'] > 0): ?>
                            <a href="warn_user.php?user_no=<?php echo htmlspecialchars($user['user_no']); ?>" class="btn btn-warning btn-sm">Warn</a>
                            <a href="ban_user.php?user_no=<?php echo htmlspecialchars($user['user_no']); ?>" class="btn btn-danger btn-sm">Ban</a>
                        <?php else: ?>
                            No action
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endwhile; ?>
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
        window.location.search = `sort=${column}&direction=${direction}`;
    }
</script>

</body>
</html>
