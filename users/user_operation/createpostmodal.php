
<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="createpost" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Share your amazing story</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body postbody">
        <div class="modal-body bodypost">
            <div class="container-fluid chil1">
              <div class="container-fluid category">Select Category</div>
              <div class="container-fluid store">
                <select class="form-select" aria-label="Default select example">
                  <option selected>All</option>
                  <option value="1">Friends</option>
                  <option value="2">Followers</option>
                </select>
              </div>
              <div class="container-fluid bookspost">
                <select class="form-select" aria-label="Default select example">
                  <option selected>all</option>
                  <option value="1">Store</option>
                  <option value="2">Books</option>
                </select>
              </div>
            </div>
            <div class="container-fluid chil2">
              <div class="container-fluid addcaptionpost">Add Captions</div>
              <div class="container-fluid captionpost">
                <div class="mb-3">
                  <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                </div>
              </div>
            </div>
            <div class="container-fluid chil3">
              <div class="mb-3">
                <label for="formFile" class="form-label" style="margin-left:10px;margin-top:10px;">Upload your photo here</label>
                <input class="form-control" type="file" id="formFile">
              </div>
            </div>
        </div>
      </div>

      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->
        <button type="button" class="btn btn-primary">Post</button>
      </div>
    </div>
  </div>
</div>