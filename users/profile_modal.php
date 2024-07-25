<?php



?>


<div class="modal fade" id="profilemodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <!-- <div class="modal-header">
      </div> -->

        <div class="modal-body p-0 m-0">
        
            <div class="container-fluid p-0 m-0 bodymodalprof">
                <div class="container-fluid coverphotoprof">
                  <div class="container-fluid coverphoto">
                    <!-- upload cover photo here -->
                    <div class="container-fluid imgcoverdiv"><img src=""></div>
                    <div class="container-fluid coverphotoblurd"></div>
                    <div class="container-fluid profilemodal">
                      <!-- upload profile photo here -->
                        <div class="container-fluid modalprofcon"><img src=""></div>
                    </div>
                    <button type="button" class="btn-close btncloseprof" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <!-- <div class="container-fluid profilemodal"></div> -->
                </div>
                <div class="container-fluid nbp">
                    <div class="container-fluid namebiomodalprof">
                      <!-- name/bio here -->
                      <div class="container-fluid namemodalprof">name mo</div>
                      <div class="container-fluid biomodalprof">Hello world</div>
                    </div>
                    <div class="container-fluid buttonmodalprof">
                      <div class="container-fluid profbuttonmodal">
                        <!-- profile here -->
                      <a href="users/profile.php?user_no=<?php echo $row['user_no']; ?>"><button class="btn">
                      Profile</button></a>
                      </div>
                    </div>
                </div>
            </div>
        </div>

      
      <!-- <div class="modal-footer">
      </div> -->
    </div>
  </div>
</div>