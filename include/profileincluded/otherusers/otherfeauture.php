<?php


$other_user_no = $_GET['user_no'];
    if ($other_user_no) {
      echo"
<!-- other profile feature user -->
                <div class='container-fluid features'>
                    <div class='container-fluid contbuttons'>
                      <div class='container-fluid buttonlinks'>
                       <ul>
                        <li><a href='other_profile.php?user_no=".htmlspecialchars($other_user_no)."'><div class='container-fluid post'>Post</div></a></li>
                        <li><a href='other_profile.php?othereditdetails=".htmlspecialchars($other_user_no)."'><div class='container-fluid notification'>View details</div></a></li>
                       </ul>
                      </div>
                    </div>
                </div>
                ";
    }