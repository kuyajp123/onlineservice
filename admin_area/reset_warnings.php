<?php  
include("../include/connect.php");



// SQL query to reset warning levels after 15 days
$sql = "UPDATE user_warnings 
        SET warning_level = 0 
        WHERE reset_date <= CURDATE()";

// Execute the query
if ($con->query($sql) === TRUE) {
    echo "Warnings reset successfully.";
} else {
    echo "Error resetting warnings: " . $con->error;
}

// Close the connection
$con->close();
?>
