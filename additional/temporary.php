<?php
include("../include/connect.php");
date_default_timezone_set('America/New_York'); // Set your timezone

// Define the start and end times
$start_time = '07:00 AM';
$end_time = '07:00 PM';

// Convert start and end times to DateTime objects
$start = new DateTime($start_time);
$end = new DateTime($end_time);

// Initialize an empty string for the time slots
$time_slots = '';

// Generate time slots with a 30-minute interval
while ($start < $end) {
    $next_start = clone $start;
    $next_start->modify('+30 minutes');
    
    $time_slots .= '<tr>
    <td>' . $start->format('h:i A') . '-' . $next_start->format('h:i A') . '</td>
    <td class="mon"></td>
    <td class="tues"></td>
    <td class="wed"></td>
    <td class="thu"></td>
    <td class="fri"></td>
    <td class="sat"></td>
    <td class="sun"></td>
    </tr>';
    
    $start = $next_start;
}

// Output the complete HTML structure
echo '<div class="container-fluid schedulebody">
<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Time</th>
      <th scope="col">Mon</th>
      <th scope="col">Tues</th>
      <th scope="col">Wed</th>
      <th scope="col">Thu</th>
      <th scope="col">Fri</th>
      <th scope="col">Sat</th>
      <th scope="col">Sun</th>
    </tr>
  </thead>
  <tbody>
    ' . $time_slots . '
  </tbody>
</table>
</div>';

// Fetch data from the database
$sql = "SELECT * FROM schedules";
$stmt = $con->query($sql);



while ($row = $stmt->fetch_assoc()) {
    // Extract day and time
    $days = explode(', ', $row['days']);
    $start_time = date('h:i A', strtotime($row['start_time']));
    $end_time = date('h:i A', strtotime($row['end_time']));
    $description = $row['description']; // Assuming 'description' is a field in your schedules table

    foreach ($days as $day) {
        // Convert the day to a column class
        $day_class = strtolower(substr($day, 0, 3)); // 'mon', 'tue', etc.
        
        // Update the appropriate cells in the table
        echo '<script>
            document.addEventListener("DOMContentLoaded", function() {
                var cells = document.querySelectorAll("tr td.' . $day_class . '");
                cells.forEach(function(cell) {
                    if (cell.innerHTML === "") {
                        cell.innerHTML = "<strong>' . $description . '</strong><br>' . $start_time . ' - ' . $end_time . '";
                    }
                });
            });
        </script>';
    }
}
?>
