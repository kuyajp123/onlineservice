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
        <div class="container-fluid birthdate">
            <div>Birthdate</div>
            <div><?php echo htmlspecialchars($formattedDate); ?></div>
        </div>
        <div class="container-fluid gender">
             <div>Gender</div>
             <div><?php $gender = $row['gender'];
             
             if($gender == 'prefered-not-to-say'){
                 echo 'Prefered not to say';
              }else{
                 echo $gender;
             }
            ?></div>
        </div>
        <div class="container-fluid lineedit"></div>
    </div>
<?php
}
?>
