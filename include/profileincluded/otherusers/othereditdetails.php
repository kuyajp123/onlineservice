<?php
$other_user_no = isset($_GET['user_no']) ? $_GET['user_no'] : null;

if ($other_user_no) {
    $sql = "SELECT * FROM user_registration WHERE user_no = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param('i', $other_user_no);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    $timestamp = htmlspecialchars($row['bday']);
    $bday = new DateTime($timestamp);
    $formattedDate = $bday->format('F j, Y');

    $query = "SELECT info_name, is_hidden FROM user_info_visibility WHERE user_no = ? AND info_name IN ('bday', 'gender')";
    $stmt = $con->prepare($query);
    $stmt->bind_param('i', $other_user_no);
    $stmt->execute();
    $result = $stmt->get_result();

    $visibility = [
        'bday' => 0,
        'gender' => 0
    ];

    while ($row1 = $result->fetch_assoc()) {
        $visibility[$row1['info_name']] = $row1['is_hidden'];
    }
?>
    <div class="container-fluid edicont">
        <div class="container-fluid editdetails">Details</div>
        <div class="container-fluid nameedit">
            <div>Name</div>
            <div><?php echo htmlspecialchars($row['fname'] . " " . $row['lname']); ?></div>
        </div>
        <div class="container-fluid usernameedit">
            <div>Username</div>
            <div><?php echo htmlspecialchars($row['user_ID']); ?></div>
        </div>
        <?php if ($visibility['bday'] == 1): ?>
    <!-- Do nothing or add any message if needed when birthdate is hidden -->
        <?php else: ?>
            <div class='container-fluid birthdate'>
                <div>Birthdate</div>
                <div>
                    <?php echo htmlspecialchars($formattedDate); ?>
                </div>
            </div>
        <?php endif; ?>
        <?php if ($visibility['gender'] == 1): ?>
            <!-- Gender is hidden -->
            <?php echo " "; ?>
        <?php else: ?>
            <div class="container-fluid gender">
                <div>Gender</div>
                <div>
                    <?php 
                    $gender = $row['gender'];

                    if ($gender == 'prefered-not-to-say') {
                        echo 'Prefered not to say';
                    } else {
                        echo htmlspecialchars($gender); // Ensure the gender is safely output
                    }
                    ?>
                </div>
            </div>
        <?php endif; ?>

        <div class="container-fluid lineedit"></div>
        <div class="container-fluid birthdate">
            <div>Student Number</div>
            <div><?php echo htmlspecialchars($row['student_no']); ?></div>
        </div>
        <div class="container-fluid birthdate">
            <div>Email</div>
            <div><?php echo htmlspecialchars($row['email']); ?></div>
        </div>
        
    </div>
<?php
}
?>
