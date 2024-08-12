<?php
// Fetch schedules from database
$sql = "SELECT * FROM schedules WHERE user_no = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("i", $current_user_no);
$stmt->execute();
$result = $stmt->get_result();

// Check if there are any schedules
if ($result->num_rows > 0) {
    // Loop through each schedule
    while ($row = $result->fetch_assoc()) {
        // Extract schedule details
        $schedule_id = $row["schedule_id"];
        $start_date = date('F j, Y', strtotime($row["date_start"])); // Format date as "August 12, 2024"
        $end_date = date('F j, Y', strtotime($row["date_end"])); // Format date as "August 12, 2024"
        $start_time = date('h:i A', strtotime($row["start_time"]));
        $end_time = date('h:i A', strtotime($row["end_time"]));
        $days = $row["days"]; // Days like "Monday, Tuesday"
        $name = $row["name"];
        $description = $row["description"];
        $color = $row["color"];

        // Determine card class based on color
        switch ($color) {
            case 'gray':
                $card_class = 'text-bg-secondary';
                break;
            case 'blue':
                $card_class = 'text-bg-primary';
                break;
            case 'green':
                $card_class = 'text-bg-success';
                break;
            case 'red':
                $card_class = 'text-bg-danger';
                break;
            case 'yellow':
                $card_class = 'text-bg-warning';
                break;
            case 'aqua':
                $card_class = 'text-bg-info';
                break;
            case 'white':
                $card_class = 'text-bg-light';
                break;
            case 'dark':
                $card_class = 'text-bg-dark';
                break;
            default:
                $card_class = 'text-bg-light'; // Default if color is unknown
                break;
        }

        // Generate the card HTML
        echo "
        <div class='card $card_class mb-3' style='max-width: 18rem;'>
            <div class='card-header'>Schedule</div>
            <div class='card-body'>
                <h5 class='card-title'>$name</h5>
                <p class='card-text'>$description</p>
                <p class='card-text'>$start_date to $end_date</p>
                <p class='card-text'>Time: $start_time - $end_time</p>
                <p class='card-text'>Days: $days</p>
            </div>
        </div>
        ";
    }
    echo "
        <div class='card border-dark mb-3' style='max-width: 18rem;'>
            <div class='card-body text-center'>
                <div class='container-fluid addivcont'>
                    <div class='container-fluid adddivdesc'>
                        Add another schedules <br>
                    </div>
                    <div class='container-fluid' style='padding: 0;'>
                        <div class='container-fluid adddivadd'>Add</div>
                        <div class='container-fluid buttondiv'>
                            <a href='profile.php?add_schedule'>
                                <button>
                                    <i class='fa-solid fa-plus text-primary fs-2'></i>
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        ";
}else{
echo "
<div class='container-fluid adddiv'>
    <div class='container-fluid addivcont'>
        <div class='container-fluid adddivdesc'>
            You don't have any schedules yet <br>
        </div>
        <div class='container-fluid' style='padding: 0;'>
            <div class='container-fluid adddivadd'>Add</div>
            <div class='container-fluid buttondiv'>
                <a href='profile.php?add_schedule'>
                    <button>
                        <i class='fa-solid fa-plus text-primary'></i>
                    </button>
                </a>
            </div>
        </div>
    </div>
</div>
";
}
?>