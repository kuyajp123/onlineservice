<?php
$current_user_no = $_SESSION['user_no'];
$error = "";
$bday = "";
$password = "";

if (isset($_POST["submit_bday"])) {
    $bday = $_POST['bday'];
    $password = $_POST['user_password'];

            if(!empty($bday)){
               // Fetch the current hashed password from the database
              $sql = "SELECT user_password FROM user_registration WHERE user_no = ?";
              $stmt = $con->prepare($sql);
              $stmt->bind_param("s", $user_no);
              $stmt->execute();
              $result = $stmt->get_result();
              $row = $result->fetch_assoc();

              $user_password = $row['user_password'];
              if (password_verify($password, $user_password)) {
                $sql = "UPDATE user_registration SET bday = ? WHERE user_no = ?";
                $stmt = $con->prepare($sql);
                $stmt->bind_param("si", $bday, $current_user_no);

                  if ($stmt->execute()) {
                      $_SESSION["bday"] = $bday;
                      echo "<script>window.location.href = 'profile.php?editdetails';</script>";
                  } else {
                      $error = "Update failed. Please try again.";
                  }
              } else {
                  $error = "Password didn't match.";
              }
            }else{
              $error = "Please select date";
            }
            
        
    
}

?>

<!-- Modal -->
<div class="modal fade" id="editbirthdate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Enter your new Birthday</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

        <div class="row g-3 px-3 pt-2">
        <div class="col">
          <form action="" method="post">
          <div class="mb-0">
            
          <div class="container-fluid dateinput">
          <input id="datepicker" name="bday" class="input_el__l_VZt" readonly placeholder="Choose date" required>
          </div>

          </div>
        </div>
        </div>
        <div class="mb-3 px-3">
        <label for="formGroupExampleInput2" class="form-label" style="padding-top:10px;">Confirmation</label>
        <input type="password" class="form-control" name="user_password" id="editnamepass" placeholder="Enter your password" required="required">
        
        </div>
        <div id="liveAlertPlaceholderbday" class="alert-container p-0 text-center"></div>
      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->
        <button type="submit" name="submit_bday" class="btn btn-primary">Change</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
  document.addEventListener('DOMContentLoaded', function () {
            // Initialize Air Datepicker
            new AirDatepicker('#datepicker', {
                buttons: ['clear'],
                dateFormat: 'yyyy-MM-dd',
                autoClose: true,
                locale: {
                    days: ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
                    daysShort: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
                    daysMin: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
                    months: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                    monthsShort: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                    today: 'Today',
                    clear: 'Clear',
                    dateFormat: 'yyyy-MM-dd',
                    timeFormat: 'HH:MM',
                    firstDay: 0
                }
            });
        });
</script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const error = "<?php echo htmlspecialchars(addslashes($error), ENT_QUOTES, 'UTF-8'); ?>";
    if (error) {
        const alertPlaceholder = document.getElementById('liveAlertPlaceholderbday');
        const exampleModal = new bootstrap.Modal(document.getElementById('editbirthdate'));

        exampleModal.show();

        if (alertPlaceholder) {
            const wrapper = document.createElement('div');
            wrapper.innerHTML = `
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    ${error}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            `;
            alertPlaceholder.innerHTML = ''; // Clear previous alerts
            alertPlaceholder.append(wrapper);

            setTimeout(() => {
                wrapper.querySelector('.alert').classList.add('show');
            }, 10);

            setTimeout(() => {
                const alertElement = wrapper.querySelector('.alert');
                alertElement.classList.remove('show');
                setTimeout(() => {
                    if (alertElement.parentElement) {
                        alertElement.parentElement.removeChild(alertElement);
                    }
                }, 500);
            }, 5000);
        }
    }
});

    </script>
<style>
        .air-datepicker {
            z-index: 1251; 
        }
        .air-datepicker-overlay {
            display: none !important;
        }
        .input_el__l_VZt{
          width: 100%;
          height: 100%;
          border: none;
          padding-left: 10px;
        }
        .dateinput{
          padding: 0;
          width: 100%;
          border-radius: 5px;
          width: 100%;
          border: 1px solid #dadde1;
        }
    </style>