<?php
require_once '../include/connect.php';
require_once '../include/bootsrap.php';

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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review Reported Posts</title>
    <link rel="stylesheet" href="admin_dashbaord.css?v=<?php echo time(); ?>">
</head>
<body>
    <div class="container mt-4">
        <a href="../admin_area/list_of_users.php">Back</a>
        <h1>Reported Posts for User <?php echo htmlspecialchars($user_no); ?></h1>
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
</body>
</html>
