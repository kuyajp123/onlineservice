<table>
    <thead>
        <tr>
            <th>No</th>
            <th>User No</th>
            <th>Student No</th>
            <th>Email</th>
            <th>Reports</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($user = $usersResult->fetch_assoc()): ?>
            <?php if($user){
                $line_number++;
            } ?>
            <tr>
                <td><?php echo htmlspecialchars($line_number); ?></td>
                <td><?php echo htmlspecialchars($user['user_no']); ?></td>
                <td><?php echo htmlspecialchars($user['student_no']); ?></td>
                <td><?php echo htmlspecialchars($user['email']); ?></td>
                <td><?php echo htmlspecialchars($user['report_count']); ?></td>
                <td>
                    <?php if ($user['report_count'] > 0): ?>
                        <a href="warn_user.php?user_no=<?php echo htmlspecialchars($user['user_no']); ?>">Warn</a>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>