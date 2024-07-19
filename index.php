<?php
require_once 'include/bootsrap.php';
require_once 'functions/common_function.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="index_style.css?v=2">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Toggle Example</title>
</head>
<body>

<div class="container-fluid acon"> <!--------1st container--------->
    <!-- ----------------------------navbar-------------------------------------------- -->
    <div class="container-fluid sticky-top bcon"> <!--------2nd container nav--------->
        <div class="container-fluid navcon"> 
            <!-- NAV -->
            <ul class="nav nav-pills mb-0" id="pills-tab" role="tablist">
  <li class="nav-item" role="presentation">
    <button class="nav-link active text-light" id="pills-bothf-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">All</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link text-light" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Friends</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link text-light" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Following</button>
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
</ul>
        </div>
    </div>
<!-- ------------------------------------------------------------------------ -->





        



    <!-- ------------------------------------------------------------------------ -->
    <div class="container-fluid ccon"> <!--------3rd container- content container-------->
        <div class="container-fluid sidenav">
            <div class="container-fluid sticky-top considenav">
                
            <div class="container-fluid profile">
                <a href="" style="color: black;">
                    <div class="container-fluid contprofname">
                        <div class="container-fluid profilepicture">
                          <!-- prifle image in sidenav -->
                            <img src="include/images/d6cdf2a5daaf96462127cc31fb621851.jpg" alt="">
                        </div>
                        <div class="container-fluid nameusername">
                          <!-- profile name in side nav -->
                            <div class="container-fluid nameko">
                                <span>John Paul Naag</span>
                            </div>
                            <!-- profile username in side nav -->
                            <div class="container-fluid username">
                                <small><span style="font-size:13px;">@johnpaul12</span></small>
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
                        <li><a href=""><div class="container-fluid post">Create post</div></a></li>
                        <li><a href=""><div class="container-fluid notification">Notification</div></a></li>
                        <li><a href=""><div class="container-fluid collect">Collection</div></a></li>
                        <li><div class="container-fluid services">
                          <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false"><div class="container">Services<i class="fa-solid fa-angle-right" style="margin-left:5px;"></i></div></a>
                            <ul class="dropdown-menu">
                              <li><a class="dropdown-item" href="#"><div class="container">Store</div></a></li>
                              <li><a class="dropdown-item" href="#"><div class="container">Books</div></a></li>
                              <li><a class="dropdown-item" href="#"><div class="container">Student Dashboard</div></a></li>
                            </ul></div></li>
                        <li><a href=""><div class="container-fluid settings">Settings</div></a></li>
                       </ul>
                      </div>
                    </div>
                </div>


                <div class="container-fluid logout">
                  <div class="container-fluid logoutcont">
                      <div class="btn-group dropup">
                        <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                          <div class="container">more</div>
                        </button>
                        <ul class="dropdown-menu">
                          <li><a class="dropdown-item" href="#"><div class="container">Profile</div></a></li>
                          <button class="logoutbut"><div class="container">Logout</div></button>
                        </ul>
                      </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- contents second div -->
          <div class="seconddive"></div>
















            <!---eto ang simula ng ipapasok mo sa loob ng div sa may comment--------->
                <div class="container-fluid content">


















             <!---eto ang simula ng ipapasok mo sa loob ng div sa may comment--------->
             <div class="container-fluid container_post">

<!-- lagayan ng pangalan 1st div -->
<div class="container-fluid name">
    
    <div class="container-fluid lgyan">
      
      <div class="container-fluid prof_pic">
        <!-- profile image inpost -->
          <div><a href=""><img src="include/images/profile.jpg" style="object-fit:contain; width: 40px;
height: 40px; border-radius: 50%;" alt=""></div></a>
      </div>
      <div class="container-fluid pangalan">
        <!-- profile name in post -->
        <div><a href="" style="font-size:1rem; text-decoration: none; color: black;">John Paul Naag</span></a>
        <!-- time in post -->
        <div><small style="font-size:13px;">Just now</small></div></div></div>
      </div>
      

    <!-- 3dots 1st div -->
    <div class="container-fluid dots">
      <div class="container-fluid dot"><i class="fa-solid fa-ellipsis fa-xl" style="color: #575b60; font-size:20px;"></i></div>
    </div>
</div>

<!-- image 1st div -->
<div class="container-fluid image">
<!-- image in post -->
<div class="container-fluid image_container"><img src="include/images/Home (1).png" alt=""></div>
    
</div>


<!-- heart,comment,share, 1st div -->
<div class="container-fluid heart">
   
    <div class="container-fluid thethree">
      <div class="container-fluid puso"><i class="fa-regular fa-heart"></i></div>
      <div class="container-fluid comment"><i class="fa-regular fa-comment-dots fa-flip-horizontal"></i></div>
      <div class="container-fluid share"><i class="fa-regular fa-paper-plane"></i></div>
    </div>

    <!-- collection 1st div -->
    <div class="container-fluid collection">
      <div class="container-fluid save">
        <div class="container-fluid bookmarkicon">
          <i class="fa-regular fa-bookmark"></i>
        </div>
      </div>
    </div>
</div>

      <!-- line -->
      <div class="line"></div>

<!-- caption 1st div -->
<div class="container-fluid container_cap">
    <div class="container-fluid caption">This is post with image</div>
</div>

</div>













<!--------------------------------------- second post ------------------------------------------------------->

















  <!---eto ang simula ng ipapasok mo sa loob ng div sa may comment--------->
  <div class="container-fluid container_post">

<!-- lagayan ng pangalan 1st div -->
<div class="container-fluid name">
    
    <div class="container-fluid lgyan">
      
      <div class="container-fluid prof_pic">
        <!-- profile image inpost -->
          <div><a href=""><img src="include/images/d6cdf2a5daaf96462127cc31fb621851.jpg" style="object-fit:contain; width: 40px;
height: 40px; border-radius: 50%;" alt=""></div></a>
      </div>
      <div class="container-fluid pangalan">
        <!-- profile name in post -->
        <div><a href="" style="font-size:1rem; text-decoration: none; color: black;">John Paul Naag</span></a>
        <!-- time in post -->
        <div><small style="font-size:13px;">Just now</small></div></div></div>
      </div>
      

    <!-- 3dots 1st div -->
    <div class="container-fluid dots">
      <div class="container-fluid dot"><i class="fa-solid fa-ellipsis fa-xl" style="color: #575b60; font-size:20px;"></i></div>
    </div>
</div>

<!-- image 1st div -->
<div class="container-fluid image">
<!-- image in post -->
<div class="container-fluid image_container"><img src="include/images/profile.jpg" alt=""></div>
    
</div>


<!-- heart,comment,share, 1st div -->
<div class="container-fluid heart">
   
    <div class="container-fluid thethree">
      <div class="container-fluid puso"><i class="fa-regular fa-heart"></i></div>
      <div class="container-fluid comment"><i class="fa-regular fa-comment-dots fa-flip-horizontal"></i></div>
      <div class="container-fluid share"><i class="fa-regular fa-paper-plane"></i></div>
    </div>

    <!-- collection 1st div -->
    <div class="container-fluid collection">
      <div class="container-fluid save">
        <div class="container-fluid bookmarkicon">
          <i class="fa-regular fa-bookmark"></i>
        </div>
      </div>
    </div>
</div>

      <!-- line -->
      <div class="line"></div>

<!-- caption 1st div -->
<div class="container-fluid container_cap">
    <div class="container-fluid caption">This is post with image</div>
</div>

</div>



































               </div>
               <!---------ilalagay mo dito sa loob nato ang bagong .container_post eto ang pinaka huling div-------------->
























               



               <div class=" container-fluid invi"></div>
               

        <div class="container-fluid olservices">
            <div class="container-fluid sticky-top conolservice">
                <div class="container-fluid cvsustore">cvsustore</div>
                <div class="container-fluid books">books</div>
            </div>
        </div>
    </div>
    <!-- ------------------------------------------------------------------------ -->
</div>

</body>

</html>

