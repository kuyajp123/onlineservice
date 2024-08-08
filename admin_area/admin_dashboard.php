<?php
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
    <style>
        .table th, .table td {
            text-align: center;
        }
    </style>
</head>
<body>
<div class="container mt-4">
    <h1>List of Users</h1>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Name</th>
                <th scope="col">User No</th>
                <th scope="col">Student No</th>
                <th scope="col">Email</th>
                <th scope="col">Reports</th>
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
                        <?php else: ?>
                            No action
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

