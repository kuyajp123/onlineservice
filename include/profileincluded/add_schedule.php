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
    $days = implode(', ', $_POST['days']); // Days selected by user
    
    // Convert time to 24-hour format
    $start_time = ($start_ampm == 'pm' && $start_hour != 12) ? ($start_hour + 12) . ':' . $start_minute : $start_hour . ':' . $start_minute;
    $end_time = ($end_ampm == 'pm' && $end_hour != 12) ? ($end_hour + 12) . ':' . $end_minute : $end_hour . ':' . $end_minute;
    
    // Insert into database
    $sql = "INSERT INTO schedules (user_no, date_start, date_end, start_time, end_time, days, name, description)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("isssssss", $user_no, $start_date, $end_date, $start_time, $end_time, $days, $name, $description);
    $stmt->execute();
}
?>

  <div class="container-fluid addboddy">
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
                <input type="text" name="description" class="form-control">
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
                          <select class="form-select frm1" name="days[]" aria-label="Default select example">
                              <option value="Mon">Monday</option>
                              <option value="Tue">Tuesday</option>
                              <option value="Wed">Wednesday</option>
                              <option value="Thu">Thursday</option>
                              <option value="Fri">Friday</option>
                              <option value="Sat">Saturday</option>
                          </select>
                          <!-- The button will be appended by JavaScript -->
                      </div>
                  </div>

                <div class="container-fluid kahitano4">
                <button type="submit" name="submit_sched" class="btn btn-primary btn-sm">Save</button>
                </div>
          </div>
      </form>
  </div>


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
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const container = document.querySelector('.kahitano5');
    let selectionCount = 1; // Initial count with one selection
    
    function createSelectElement() {
        const select = document.createElement('select');
        select.className = 'form-select';
        select.setAttribute('aria-label', 'Default select example');
        select.innerHTML = `
            <option value="Mon">Monday</option>
            <option value="Tue">Tuesday</option>
            <option value="Wed">Wednesday</option>
            <option value="Thu">Thursday</option>
            <option value="Fri">Friday</option>
            <option value="Sat">Saturday</option>
        `;
        return select;
    }

    function createButton() {
        const button = document.createElement('button');
        button.type = 'button';
        button.className = 'btn btn-primary btn-sm';
        button.innerHTML = '<i class="fa-solid fa-plus"></i>';
        button.addEventListener('click', handleButtonClick);
        return button;
    }

    function handleButtonClick(event) {
        const button = event.currentTarget;
        
        if (selectionCount < 4 && button.innerHTML.includes('plus')) {
            // Add a new selection
            const newSelect = createSelectElement();
            const newButton = createButton();
            
            container.appendChild(newSelect);
            container.appendChild(newButton);
            selectionCount++;
        } else if (selectionCount > 1 && button.innerHTML.includes('minus')) {
            // Remove the last selection
            const selects = container.querySelectorAll('.form-select');
            const buttons = container.querySelectorAll('.btn');
            
            if (selects.length > 1) {
                container.removeChild(selects[selects.length - 1]);
                container.removeChild(buttons[buttons.length - 1]);
                selectionCount--;
            }
        }
        
        // Toggle button icon
        button.innerHTML = button.innerHTML.includes('plus') 
            ? '<i class="fa-solid fa-minus"></i>' 
            : '<i class="fa-solid fa-plus"></i>';
    }

    // Initial setup
    const initialButton = createButton();
    initialButton.addEventListener('click', handleButtonClick);
    container.appendChild(initialButton);
});

</script>
