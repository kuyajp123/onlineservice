<?php
// Fetch data from the database
$sql = "SELECT * FROM schedules WHERE user_no = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("i", $user_no);
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
    // Extract day and time
    $days = explode(', ', $row['days']);
    $start_time = date('g:i a', strtotime($row['start_time']));
    $end_time = date('g:i a', strtotime($row['end_time']));
    
    foreach ($days as $day) {
        echo "<tr>";
        echo "<td>{$start_time} - {$end_time}</td>";
        echo "<td>{$day}</td>";
        // Add other columns as needed
        echo "</tr>";
    }
}
?>