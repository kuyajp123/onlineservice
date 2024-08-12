<?php
if (isset($_POST['submit_sched'])) {
    // Get form data
    $name = $_POST['name'];
    $description = $_POST['description'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $start_hour = $_POST['start_hour'];
    $start_minute = $_POST['start_minute'];
    $start_ampm = $_POST['start_ampm'];
    $end_hour = $_POST['end_hour'];
    $end_minute = $_POST['end_minute'];
    $end_ampm = $_POST['end_ampm'];
    $days = $_POST['days'];
    $color = $_POST['color'];
    
    // Convert time to 24-hour format
    $start_time = ($start_ampm == 'pm' && $start_hour != 12) ? ($start_hour + 12) . ':' . $start_minute : $start_hour . ':' . $start_minute;
    $end_time = ($end_ampm == 'pm' && $end_hour != 12) ? ($end_hour + 12) . ':' . $end_minute : $end_hour . ':' . $end_minute;
    
    // Insert into database
    $sql = "INSERT INTO schedules (user_no, date_start, date_end, start_time, end_time, days, name, description, color)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("issssssss", $current_user_no, $start_date, $end_date, $start_time, $end_time, $days, $name, $description, $color);
    $stmt->execute();
    echo "<script>window.open('profile.php?schedule','_self')</script>";
}
?>
 <form class="was-validated" method="post">
          <div class="container-fluid nametitle">
              <div class="container-fluid kahitano1">Name</div>
              <div class="container-fluid kahitano">
                    <input type="text" name="name" class="form-control" placeholder="Enter name" required>
                    <div class="invalid-feedback" style="padding:0;margin:0;">
                      Please choose name
                    </div>
              </div> 
          </div>
          <div class="container-fluid description">
              <div class="container-fluid kahitano1">Description</div>
              <div class="container-fluid kahitano">
                <input type="text" name="description" class="form-control" placeholder="Description (optional)">
              </div>
          </div>
          <div class="container-fluid date">
              <div class="container-fluid kahitano1">Date</div>
              <div class="container-fluid kahitano3">
                <div class="container-fluid" style="padding:0;margin:0;">
                <input id="start_date" name="start_date" class="form-control" placeholder="Enter Start date" required>
                    <div class="invalid-feedback" style="padding:0;margin:0;">
                      Please choose start date
                    </div>
                </div>
                <div class="container-fluid" style="padding:0;margin:0;">
              <input id="end_date" name="end_date" class="form-control" placeholder="Enter End date" required>
                    <div class="invalid-feedback" style="padding:0;margin:0;">
                      Please choose end date
                    </div>
                  </div>
              </div>
          </div>
          <div class="container-fluid time">
              <div class="container-fluid kahitano1">From</div>
                  <div class="container-fluid kahitano">
                  <div class="container-fluid kahitano3">
                    <div class="container-fluid" style="padding:0;margin:0;">
                        <select class="form-select" name="start_hour" aria-label="Default select example" required>
                          <option value="1">1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                          <option value="4">4</option>
                          <option value="5">5</option>
                          <option value="6">6</option>
                          <option value="7">7</option>
                          <option value="8">8</option>
                          <option value="9">9</option>
                          <option value="10">10</option>
                          <option value="11">11</option>
                          <option value="12">12</option>
                        </select>
                        <div class="invalid-feedback" style="padding:0;margin:0;">
                          Please choose hour
                        </div>
                    </div>
                    :
                    <div class="container-fluid" style="padding:0;margin:0;">
                          <select class="form-select" name="start_minute" aria-label="Default select example">
                            <option value="00">00</option>
                            <option value="30">30</option>
                          </select>
                        <div class="invalid-feedback" style="padding:0;margin:0;">
                          Please choose Minutes
                        </div>
                      </div>
                      <div class="container-fluid" style="padding:0;margin:0;">
                          <select class="form-select" name="start_ampm" aria-label="Default select example">
                            <option value="am">am</option>
                            <option value="pm">pm</option>
                          </select>
                        <div class="invalid-feedback" style="padding:0;margin:0;">
                          Please choose Minutes
                        </div>
                      </div>
                  </div>
              </div>
              
          </div>

          <div class="container-fluid time">
              <div class="container-fluid kahitano1">To</div>
                  <div class="container-fluid kahitano">
                  <div class="container-fluid kahitano3">
                    <div class="container-fluid" style="padding:0;margin:0;">
                        <select class="form-select" name="end_hour" aria-label="Default select example" required>
                          <option value="1">1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                          <option value="4">4</option>
                          <option value="5">5</option>
                          <option value="6">6</option>
                          <option value="7">7</option>
                          <option value="8">8</option>
                          <option value="9">9</option>
                          <option value="10">10</option>
                          <option value="11">11</option>
                          <option value="12">12</option>
                        </select>
                        <div class="invalid-feedback" style="padding:0;margin:0;">
                          Please choose hour
                        </div>
                    </div>
                    :
                    <div class="container-fluid" style="padding:0;margin:0;">
                          <select class="form-select" name="end_minute" aria-label="Default select example">
                            <option value="00">00</option>
                            <option value="30">30</option>
                          </select>
                        <div class="invalid-feedback" style="padding:0;margin:0;">
                          Please choose Minutes
                        </div>
                      </div>
                      <div class="container-fluid" style="padding:0;margin:0;">
                          <select class="form-select" name="end_ampm" aria-label="Default select example">
                            <option value="am">am</option>
                            <option value="pm">pm</option>
                          </select>
                        <div class="invalid-feedback" style="padding:0;margin:0;">
                          Please choose Minutes
                        </div>
                      </div>
                  </div>
              </div>
              
          </div>
          
          
          
          <div class="container-fluid day">
              <div class="container-fluid kahitano1">Day</div>
                  <div class="container-fluid kahitano7">
                      <div class="container-fluid kahitano5">
                          <select class="form-select frm1" name="days" aria-label="Default select example">
                              <option value="Monday">Monday</option>
                              <option value="Tuesday">Tuesday</option>
                              <option value="Wednesday">Wednesday</option>
                              <option value="Thursday">Thursday</option>
                              <option value="Friday">Friday</option>
                              <option value="Saturday">Saturday</option>
                          </select>
                      </div>
                      Color:
                      <div class="container-fluid kahitano5">
                          <select class="form-select frm1" name="color" aria-label="Default select example">
                              <option value="blue">Blue</option>
                              <option value="gray">Gray</option>
                              <option value="green">Green</option>
                              <option value="red">Red</option>
                              <option value="yellow">Yellow</option>
                              <option value="aqua">Aqua</option>
                              <option value="white">White</option>
                              <option value="dark">Dark</option>
                          </select>
                      </div>
                  </div>

                <div class="container-fluid kahitano4">
                <button type="submit" name="submit_sched" class="btn btn-primary btn-sm">Save</button>
                </div>
          </div>
      </form>


  <script>
  // Initialize AirDatepicker for start date
  new AirDatepicker('#start_date', {
    autoClose: true,
    position({$datepicker, $target, $pointer}) {
      let coords = $target.getBoundingClientRect(),
          dpHeight = $datepicker.clientHeight,
          dpWidth = $datepicker.clientWidth;

      let top = coords.y + coords.height / 2 + window.scrollY - dpHeight / 2;
      let left = coords.x + coords.width / 2 - dpWidth / 2;

      $datepicker.style.left = `${left}px`;
      $datepicker.style.top = `${top}px`;

      $pointer.style.display = 'none';
    },
    buttons: ['clear'],
    dateFormat: 'yyyy-MM-dd',
    locale: {
      days: ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
      daysShort: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
      daysMin: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
      months: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
      monthsShort: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
      today: 'Today',
      clear: 'Clear',
      dateFormat: 'yyyy-MM-dd',
      timeFormat: 'HH:mm', // Corrected time format
      firstDay: 0
    }
  });

  // Initialize AirDatepicker for end date
  new AirDatepicker('#end_date', {
    autoClose: true,
    position({$datepicker, $target, $pointer}) {
      let coords = $target.getBoundingClientRect(),
          dpHeight = $datepicker.clientHeight,
          dpWidth = $datepicker.clientWidth;

      let top = coords.y + coords.height / 2 + window.scrollY - dpHeight / 2;
      let left = coords.x + coords.width / 2 - dpWidth / 2;

      $datepicker.style.left = `${left}px`;
      $datepicker.style.top = `${top}px`;

      $pointer.style.display = 'none';
    },
    buttons: ['clear'],
    dateFormat: 'yyyy-MM-dd',
    locale: {
      days: ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
      daysShort: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
      daysMin: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
      months: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
      monthsShort: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
      today: 'Today',
      clear: 'Clear',
      dateFormat: 'yyyy-MM-dd',
      timeFormat: 'HH:mm', // Corrected time format
      firstDay: 0
    }
  });
</script>

