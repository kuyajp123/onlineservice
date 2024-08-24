<?php
session_start();
require_once 'include/bootsrap.php';
require_once 'functions/common_function.php';
require_once 'include/connect.php';

if(!isset($_SESSION['user_ID']) && (!isset($_SESSION['email'])) && (!isset($_SESSION['student_no']))){
      header('location: ./users/login.php');
      exit();
    }

    if(CheckBanStatus($_SESSION['user_no'])){
      session_unset();
      session_destroy();
      header("Location: users/logout.php");
      exit();
    }

  $_SESSION['ip'] = getIPAddress();
  $_SESSION['user_ID'];
  $_SESSION['email'];
  $_SESSION['student_no'];
  $_SESSION['fname'];
  $_SESSION['lname'];
  $_SESSION['bday'];
  $_SESSION['gender'];
  $profilePicture = $_SESSION['profilepicture'];
  $_SESSION['coverphoto'];
  $current_user_no = $_SESSION['user_no'];

 

  


  $defaultProfilePicture = 'users/images/profilepicture/profile.jpg';

// Check if the profile picture is set in the session
if (isset($_SESSION['profilepicture']) && !empty($_SESSION['profilepicture'])) {
    $profilePicture = 'users/images/profilepicture/' . htmlspecialchars($_SESSION['profilepicture'], ENT_QUOTES, 'UTF-8');
} else {
    // Set the profile picture to the default if not set
    $profilePicture = $defaultProfilePicture;
    // Update the session with the default profile picture
    $_SESSION['profilepicture'] = basename($defaultProfilePicture);
}

$defaultCoverPhoto = 'users/images/coverphoto/defualt_photo.jpg';

// Check if the profile picture is set in the session
if (isset($_SESSION['coverphoto']) && !empty($_SESSION['coverphoto'])) {
    $coverPhoto = 'users/images/coverphoto/' . htmlspecialchars($_SESSION['coverphoto'], ENT_QUOTES, 'UTF-8');
} else {
    // Set the profile picture to the default if not set
    $coverPhoto = $defaultCoverPhoto;
    // Update the session with the default profile picture
    $_SESSION['coverphoto'] = basename($defaultCoverPhoto);
}





// Call the function to get posts
$data = getPosts($con);

// Access the result and rows
$result = $data['result'];
$rows = $data['rows'];



// getting a notification count
$query = "SELECT COUNT(*) AS unread_count FROM notifications WHERE user_no = ? AND is_opened = 0";
$stmt = $con->prepare($query);
$stmt->bind_param("i", $current_user_no);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

$unread_count = $row['unread_count'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="index_style.css?v=<?php echo time(); ?>">
<link rel="stylesheet" href="users/profilemodal.css?v=3">
<link rel="stylesheet" href="./users/user_operation/createpost.css?v=3">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News feed</title>
    
</head>
<body>

<div class="container-fluid acon"> <!--------1st container--------->
    <!-- ----------------------------navbar-------------------------------------------- -->
    <div class="container-fluid sticky-top bcon"> <!--------2nd container nav--------->

<!--  for mobile -->
<div class="container-fluid navmobilecon">
<!-------------------------------------------- sidenav  mobile-------------------------------- -->
<?php include 'include/navbar/sidenav.php' ?>
<!---------------------------------- newfeed preferences mobile-------------------------------- -->
<?php include 'include/navbar/newsfeed.php' ?>
</div>


    <!-- navbar for desktop -->
        <div class="container-fluid navcon"> 
            <!-- NAV -->
             <div class="container-fluid temporary"></div>
            <!-- <ul class="nav nav-pills mb-0" id="pills-tab" role="tablist">
  <li class="nav-item" role="presentation">
    <button class="nav-link active text-light" id="pills-bothf-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true"><i class="fa-solid fa-eye-slash" style="color: #ffffff;"></i></button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link text-light" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Friends</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link text-light" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Following</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link text-light" id="pills-bothf-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">All</button>
  </li>
</ul>

<span><i class="fa-solid fa-circle fa-xs" style="color: #ffffff;font-size:5px; margin: 0 10px;"></i></span>

<ul class="nav nav-pills mb-0" id="pills-tab" role="tablist">
  
<li class="nav-item" role="presentation">
    <button class="nav-link text-light" id="pills-bothsb-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">All</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link active text-light" id="pills-store-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Store</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link text-light" id="pills-books-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Books</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link text-light" id="pills-bothf-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true"><i class="fa-solid fa-eye-slash" style="color: #ffffff;"></i></button>
  </li>
</ul> -->


        </div>

    </div><!--------bcon last div--------->
<!-- ------------------------------------------------------------------------ -->


        



    <!-- ------------------------------------------------------------------------ -->
    <div class="container-fluid ccon"> <!--------3rd container- content container-------->
        <div class="container-fluid sidenav">
            <div class="container-fluid sticky-top considenav">

          <!-- sidenav and modal for profile -->
          <div class="container-fluid profile">
    <a href="users/profile.php?sideprof=<?php echo urlencode($current_user_no); ?>" style="color: black;" class="sidemodal" data-open-modal="profilemodal">
        <div class="container-fluid contprofname">
            <div class="container-fluid profilepicture">
                <!-- Profile image in sidenav -->
                <img src="<?php echo htmlspecialchars($profilePicture, ENT_QUOTES, 'UTF-8'); ?>">
            </div>
            <div class="container-fluid nameusername">
                <div class="container-fluid nameko">
                    <span>
                        <?php
                        if (isset($_SESSION['fname']) && isset($_SESSION['lname'])) {
                            echo htmlspecialchars($_SESSION['fname']) . ' ' . htmlspecialchars($_SESSION['lname']);
                        }
                        ?>
                    </span>
                </div>
                <!-- Profile username in sidenav -->
                <div class="container-fluid username">
                    <small>
                        <span style="font-size:13px;">
                            <?php
                            if (isset($_SESSION['user_ID'])) {
                                echo htmlspecialchars($_SESSION['user_ID']);
                            }
                            ?>
                        </span>
                    </small>
                </div>
            </div>
        </div>
    </a>
</div>
            

                <div class="container-fluid linesidenav"></div>


                <div class="container-fluid features">
                    <div class="container-fluid contbuttons">
                      <div class="container-fluid buttonlinks">
                       <ul>
                                <!-- search bar -->
                        <div class="container-fluid searchbar">
                          <form class="d-flex" role="search">
                            <input class="form-control me-2" type="search" placeholder="Under construction" aria-label="Search">
                            <button class="btn btn-outline-success" type="submit">Search</button>
                          </form>
                        </div>
                        <li><a href="#" data-open-modal="createpost"><div class="container-fluid post">Create post</div></a></li>
                        <li>
                          <a href="#" class="notification-icon" data-bs-target="#exampleModalToggle" data-bs-toggle="modal">
                            <div class="container-fluid notification">Notification &nbsp;
                              <?php if ($unread_count > 0): ?>
                                <span class="badge text-bg-danger"><?= $unread_count ?></span>
                              <?php endif; ?>
                            </div>
                          </a>
                        </li>
                        <li><a href="additional/under_maitenance.php"><div class="container-fluid collect">Collection</div></a></li>
                        <!-- <li><div class="container-fluid services" style="padding:0;">
                          <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false"><div class="container" >Under construction<i class="fa-solid fa-angle-right" style="margin-left:5px;"></i></div></a>
                            <ul class="dropdown-menu">
                              <li><a class="dropdown-item" href="#"><div class="container">Store</div></a></li>
                              <li><a class="dropdown-item" href="#"><div class="container">Books</div></a></li>
                              <li><a class="dropdown-item" href="https://trece.cvsu.edu.ph/student/dashboard"><div class="container">Student Dashboard</div></a></li>
                            </ul></div></li> -->
                        <!-- <li><a href="additional/under_maitenance.php"><div class="container-fluid settings">Settings</div></a></li> -->
                       </ul>
                      </div>
                    </div>
                </div>


                <div class="container-fluid logout">
                  <div class="container-fluid logoutcont">
                      <div class="btn-group dropup dropdown-center">
                        <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                          <div class="container">more</div>
                        </button>
                        <ul class="dropdown-menu">
                          <li><a class="dropdown-item" href="users/profile.php?sideprof=<?php echo urlencode($current_user_no); ?>"><div class="container">Profile</div></a></li>
                          <a href="users/logout.php"><button class="logoutbut" name="logoutbut"><div class="container">Logout</div></button></a>
                        </ul>
                      </div>
                    </div>
                </div>
            </div>
        </div>

        <?php
        
        ?>


        <!-- contents second div -->
          <div class="seconddive"></div>
















            <!---eto ang simula ng ipapasok mo sa loob ng div sa may comment--------->
            <div class="container-fluid content">



<?php      

// Loop through each post
foreach ($rows as $row):
  // Extract data
  $post_id = htmlspecialchars($row['post_id']);
  $user_no = htmlspecialchars($row['user_no']);
  $fname = htmlspecialchars($row['fname']);
  $lname = htmlspecialchars($row['lname']);
  $timestamp = htmlspecialchars($row['timestamp']);
  $postphoto = htmlspecialchars($row['postphoto']);
  $caption = htmlspecialchars($row['caption']);

  // Create DateTime object
  $dateTime = new DateTime($timestamp);

  // Format date and time
  $formattedDate = $dateTime->format('F j, Y'); // e.g., July 24, 2023
  $formattedTime = $dateTime->format('g:i a'); // e.g., 6:27 pm

  // Determine which template to include
  $hasText = !empty(trim($caption));
  $hasImage = !empty(trim($postphoto));

  if ($hasText && $hasImage) {
      // Post with both text and image
      require 'include/posttemplate/post.php';
  } elseif ($hasText) {
      // Post with text only
      require 'include/posttemplate/textpost.php';
  } elseif ($hasImage) {
      // Post with image only
      require 'include/posttemplate/imagepost.php';
  }
endforeach;
?>

      



</div>
               <!---------ilalagay mo dito sa loob nato ang bagong .container_post eto ang pinaka huling div-------------->



               <div class=" container-fluid invi"></div>
               

        <div class="container-fluid olservices">
            <div class="container-fluid sticky-top conolservice">
              <!-- services -->
                <div class="container-fluid cvsustore"></div>
                <div class="container-fluid books"></div>
            </div>
        </div>
    </div>
    <!-- ------------------------------------------------------------------------ -->
</div>


















<!-- create post modal -->
 <?php include 'users/user_operation/createpostmodal.php'; ?>
 <?php include 'users/user_operation/notification_modal.php'; ?>
 
<!-- modal profile -->
<script src="functions/JsFunction.js"></script>

</body>

</html>
<script>
function updateNotificationCount() {
    fetch('get_unread_count.php')
        .then(response => response.json())
        .then(data => {
            console.log('Unread count:', data.unread_count);
            let badge = document.querySelector('.badge');
            const notificationContainer = document.querySelector('.notification');

            if (data.unread_count > 0) {
                if (!badge) {
                    // Badge does not exist, create it
                    console.log('Badge does not exist, creating new one');
                    badge = document.createElement('span');
                    badge.classList.add('badge', 'text-bg-danger');
                    notificationContainer.appendChild(badge);
                }

                // Update the badge count and make sure it is visible
                badge.innerText = data.unread_count;
                badge.style.display = 'inline-block';
                badge.style.visibility = 'visible';
            } else {
                // If unread_count is 0 and the badge exists, hide it
                if (badge) {
                    console.log('No unread notifications, hiding badge');
                    badge.style.display = 'none';
                }
            }
        })
        .catch(error => console.error('Error:', error));
}

// Initial update
updateNotificationCount();

// Periodic update every 5 seconds
setInterval(updateNotificationCount, 5000);

// Update notification when read
function handleNotificationClick(event) {
    event.preventDefault(); // Prevent the default action

    // Make an AJAX request to update notifications
    fetch('update_notifications.php')
        .then(response => response.text())
        .then(data => {
            if (data.trim() === 'success') {
                // Hide the badge after successfully updating the notification status
                const badges = document.querySelectorAll('.badge');
                badges.forEach(badge => {
                    if (badge) {
                        badge.style.display = 'none';
                    }
                });
            } else {
                console.error('Failed to update notifications');
            }
        })
        .catch(error => console.error('Error:', error));
}

// Attach event listener to all elements with the notification-icon class
document.querySelectorAll('.notification-icon').forEach(icon => {
    icon.addEventListener('click', handleNotificationClick);
});
</script>




