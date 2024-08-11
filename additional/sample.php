<?php
date_default_timezone_set('America/New_York'); // Change to your timezone

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
    <th>' . $start->format('h:i A') . '-' . $next_start->format('h:i A') . '</th>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
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
?>
