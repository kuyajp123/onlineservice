  <!---eto ang simula ng ipapasok mo sa loob ng div sa may comment--------->
  <div class="container-fluid containertextpostpost" data-post-id="<?php echo htmlspecialchars($post_id); ?>">

<!-- lagayan ng pangalan 1st div -->
<div class="container-fluid nametextpost">
    
    <div class="container-fluid lgyan">
      
      <div class="container-fluid prof_pic">
        <!-- profile image inpost -->
          <div><a href="#" data-open-modal="profilemodal"><img src="include/images/profile.jpg" style="object-fit:contain; width: 40px;
height: 40px; border-radius: 50%;" alt=""></div></a>
      </div>
      <div class="container-fluid pangalan">
        <!-- profile name in post -->
        <div><a href="#" data-open-modal="profilemodal" style="font-size:1rem; text-decoration: none; color: black;"><span class="pangalantextpost"><?php echo htmlspecialchars($fname . ' ' . $lname); ?></span></a>
        <!-- time in post -->
        <div><small style="font-size:13px;"><span class="timetextpost"><?php echo htmlspecialchars($formattedDate . ' at ' . $formattedTime); ?></span></small></div></div></div>
      </div>
      

    <!-- 3dots 1st div -->
    <div class="container-fluid dots">
      <button><div class="container-fluid dot"><i class="fa-solid fa-ellipsis fa-xl" style="color: #575b60; font-size:20px;"></i></div></button>
    </div>
</div>

<!-- caption 1st div -->
<div class="container-fluid captiontextpost">
<!-- caption in post -->
<div class="container-fluid textcontainerpost">
  <figure>
    <figcaption><?php echo htmlspecialchars($caption) ?></figcaption>
</figure>
</div>
    
</div>


<!-- heart,comment,share, 1st div -->
<div class="container-fluid heart">
   
    <div class="container-fluid thethree">
      <div class="container-fluid puso"><button><i class="fa-regular fa-heart"></i></button></div>
      <div class="container-fluid comment"><button><i class="fa-regular fa-comment-dots fa-flip-horizontal"></i></button></div>
      <div class="container-fluid share"><button><i class="fa-regular fa-paper-plane"></i></button></div>
    </div>

    <!-- collection 1st div -->
    <div class="container-fluid collection">
      <div class="container-fluid save">
        <div class="container-fluid bookmarkicon">
          <button><i class="fa-regular fa-bookmark"></i></button>
        </div>
      </div>
    </div>
</div>

    

</div>