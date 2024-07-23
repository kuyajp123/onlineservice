<!-- menu navbar -->
<button class="btn " type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
<i class="fa-solid fa-bars" style="color: #ffffff;font-size:25px;"></i>
</button>

<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="offcanvasExampleLabel">Offcanvas</h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body" style="overflow: hidden;">
    <div>
        <!-- side nav mobile mode -->
        <div class="container-fluid sidenavmobile">
            <div class="container-fluid sticky-top considenav">
                
            <div class="container-fluid profile">
                <a href="#" style="color: black;" data-open-modal="profilemodal">
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
                      <div class="container-fluid searchbar">
                          <form class="d-flex" role="search">
                            <input class="form-control me-2" type="search" placeholder="@" aria-label="Search">
                            <button class="btn btn-outline-success" type="submit">Search</button>
                          </form>
                        </div>
                       <ul>
                        <li><a href=""><div class="container-fluid post">Create post</div></a></li>
                        <li><a href=""><div class="container-fluid notification">Notification</div></a></li>
                        <li><a href=""><div class="container-fluid collect">Collection</div></a></li>
                        <li><div class="container-fluid services" style="padding:0;">
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
                      <div class="btn-group dropup dropdown-center">
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
        <!-- side nav mobile mode -->
    </div>
    <div class="dropdown mt-3">
    </div>
  </div>
</div>