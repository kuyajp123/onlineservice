<?php

$remove_warnpass = '';
$remove_banpass = '';

if(isset($_POST['remove_warn'])){
  $remove_warnpass = $_POST['remove_warnpass'];

  if($remove_warnpass == $admin_password){
    $sql = "DELETE FROM active_warning WHERE user_no = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $user_no);
    if( $stmt->execute() ){
      echo '<script>window.open("admin_action.php?user_no=' . htmlspecialchars($user_no) . '", "_self")</script>';
    }else{
      $error = "there was a problem removing warning";
    }
  }else{
    $error = 'password didnt match';
  }
}

if(isset($_POST['remove_ban'])){
  $remove_banpass = $_POST['remove_banpass'];

  if($remove_banpass == $admin_password){
    $sql = "DELETE FROM active_ban WHERE user_no = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $user_no);
    if( $stmt->execute() ){
      echo '<script>window.open("admin_action.php?user_no=' . htmlspecialchars($user_no) . '", "_self")</script>';
    }else{
      $error = "there was a problem removing ban";
    }
  }else{
    $error = 'password didnt match';
  }
}

?>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Warn user</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        <form action="" method="post">
            <input type="hidden" name="user_no" value="<?php echo htmlspecialchars($user_no) ?>">
          <input type="hidden" name="admin_id" value="<?php echo htmlspecialchars($admin_id) ?>">
      </div>
      <div class="modal-body">
          
        <div class="container-fluid warnmodalbod">
            Enter report ID
            <div class="container-fluid">
                <input type="text" class="form-control" value="<?php echo htmlspecialchars($warn_post_id) ?>" name="warn_post_id">
            </div>
            Enter your password to confirm
            <input type="password" name="warn_pass" class="form-control">
        </div>  
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" name="submit_warn" class="btn btn-primary">Save changes</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal2 -->
<div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Ban user</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        <form action="" method="post">
        <input type="hidden" name="user_no" value="<?php echo htmlspecialchars($user_no) ?>">
        <input type="hidden" name="admin_id" value="<?php echo htmlspecialchars($admin_id) ?>">
      </div>
      <div class="modal-body">
        
        <div class="container-fluid warnmodalbod">
            
                                    <select name="ban_type" class="form-select" aria-label="Default select example">
                                        <option value="0" selected>Choose ban type</option>
                                        <option value="1">Ban for 7 Days</option>
                                        <option value="2">Ban for 30 Days</option>
                                        <option value="3">Permanently ban</option>
                                    </select>
            Enter your password to confirm
            <input type="password" name="ban_pass" class="form-control">
        </div>  
          
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" name="submit_ban" class="btn btn-primary">Save changes</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- Modal3 -->
<div class="modal fade" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Remove user warning</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        <form action="" method="post">
        <input type="hidden" name="user_no" value="<?php echo htmlspecialchars($user_no) ?>">
        <input type="hidden" name="admin_id" value="<?php echo htmlspecialchars($admin_id) ?>">
      </div>
      <div class="modal-body">
        
        <div class="container-fluid warnmodalbod">
            Enter your password to confirm
            <input type="password" name="remove_warnpass" class="form-control">
        </div>  
          
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" name="remove_warn" class="btn btn-primary">Save changes</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- Modal4 -->
<div class="modal fade" id="exampleModal4" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Unban user</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        <form action="" method="post">
        <input type="hidden" name="user_no" value="<?php echo htmlspecialchars($user_no) ?>">
        <input type="hidden" name="admin_id" value="<?php echo htmlspecialchars($admin_id) ?>">
      </div>
      <div class="modal-body">
        <div class="container-fluid warnmodalbod">
            Enter your password to confirm
            <input type="password" name="remove_banpass" class="form-control">
        </div>  
          
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" name="remove_ban" class="btn btn-primary">Save changes</button>
        </form>
      </div>
    </div>
  </div>
</div>