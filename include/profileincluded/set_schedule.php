<?php
// Fetch schedules from database
// $sql = "SELECT * FROM schedules WHERE user_no = ?";
// $stmt = $con->prepare($sql);
// $stmt->bind_param("i", $current_user_no);
// $stmt->execute();
// $result = $stmt->get_result();
// $row = $result->fetch_assoc();

// if($result ->num_rows > 0){
// $start_date  = $row["date_start"];
// $end_date  = $row["date_end"];
// $start_time  = $row["start_time"];
// $end_time  = $row["end_time"];
// $day  = $row["day"];
// $name  = $row["name"];
// $description  = $row["description"];

// }else{
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
// }
?>


