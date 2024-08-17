<?php  
include("../include/connect.php");



// SQL query to reset warning levels after 15 days
$sql = "DELETE FROM user_warnings WHERE reset_date < CURDATE()";

// Execute the query
if ($con->query($sql) === TRUE) {
    echo "Warnings reset successfully.";
} else {
    echo "Error resetting warnings: " . $con->error;
}

$query = "DELETE FROM user_bans WHERE ban_end_date < CURDATE()";

if ($con->query($query) === TRUE) {
    echo "Unban user successfully.";
} else {
    echo "Error resetting warnings: " . $con->error;
}
?>
