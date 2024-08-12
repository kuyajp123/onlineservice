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
            <div class='card-header headercard'>
                Schedule
                <button type='button' class='btn btn-link' data-bs-toggle='modal' data-bs-target='#deleteModal' data-schedule-id='$schedule_id'>
                    <div class='container-fluid trashsasched'>
                        <i class='fa-solid fa-trash text-danger'></i>
                    </div>
                </button>
            </div>
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
                        Add another schedule <br>
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
} else {
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

if (isset($_POST['remove_sched'])) {
    $schedule_id = $_POST['schedule_id'];

    // Prepare and execute delete statement
    $sql = "DELETE FROM schedules WHERE schedule_id = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $schedule_id);
    $stmt->execute();

    // Redirect to avoid resubmission
   echo "<script>window.open('profile.php?schedule','_self')</script>";
}
?>
<!-- Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="deleteModalLabel">Confirm Deletion</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Are you sure you want to delete this schedule?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <form id="deleteScheduleForm" method="POST">
          <input type="hidden" name="schedule_id" id="scheduleIdToDelete">
          <button type="submit" name="remove_sched" class="btn btn-danger">Delete</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- JavaScript -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    var deleteModal = document.getElementById('deleteModal');
    deleteModal.addEventListener('show.bs.modal', function(event) {
        var button = event.relatedTarget;
        var scheduleId = button.getAttribute('data-schedule-id');
        var modal = document.getElementById('deleteModal');
        var scheduleIdInput = modal.querySelector('#scheduleIdToDelete');
        scheduleIdInput.value = scheduleId;
    });
});
</script>

