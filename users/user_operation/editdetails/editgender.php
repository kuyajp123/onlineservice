<!-- Modal -->
<div class="modal fade" id="editgender" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Enter your new Gender</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

        <div class="col pt-2">
        <form action="">
        <label>&nbsp; &nbsp; Gender &nbsp; &nbsp;</label>
        
            <input class="form-check-input" type="radio" name="gender" id="gender" value="Male" required>
            <label class="form-check-label" for="gender">Male</label>
            &nbsp; &nbsp;
            <input class="form-check-input" type="radio" name="gender" id="gender" value="Female" required>
            <label class="form-check-label" for="gender">Female</label>
        </div>
        <div class="mb-3 px-3">
        <label for="formGroupExampleInput2" class="form-label" style="padding-top:10px;">Confirmation</label>
        <input type="password" class="form-control" name="user_password" id="editnamepass" placeholder="Enter your password" required="required">
        
        </div>

      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->
        <button type="submit" class="btn btn-primary">Change</button>
        </form>
      </div>
    </div>
  </div>
</div>