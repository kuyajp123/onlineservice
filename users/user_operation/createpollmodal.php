<?php
if (isset($_POST['submit_poll'])) {
    // Sanitize and validate input
    $question = $con->real_escape_string($_POST['question']);

    // Insert the poll question into the database
    $sql = "INSERT INTO polls (user_no, question, created_at) VALUES (?, ?, NOW())";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("is", $current_user_no, $question);

    if ($stmt->execute()) {
        $poll_id = $con->insert_id;

        // Process each option
        foreach ($_POST['options'] as $index => $option_text) {
            $option_text = $con->real_escape_string($option_text);
            $image_path = '';

            // Handle file upload
            if (isset($_FILES['option_images']['name'][$index]) && $_FILES['option_images']['name'][$index] != '') {
                $file_name = $_FILES['option_images']['name'][$index];
                $file_tmp = $_FILES['option_images']['tmp_name'][$index];
                $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
                $new_file_name = uniqid() . '.' . $file_ext;
                $upload_path = 'users/user_operation/uploads/' . $new_file_name;

                if (move_uploaded_file($file_tmp, $upload_path)) {
                    $image_path = $upload_path;
                }
            }

            // Insert option into the database
            $sql = "INSERT INTO poll_options (poll_id, option_text, image_path) VALUES (?, ?, ?)";
            $stmt = $con->prepare($sql);
            $stmt->bind_param("iss", $poll_id, $option_text, $image_path);
            if ($stmt->execute()) {
            } else {
                $error =  "Error: " . $stmt->error;
            }
        }
        echo "<script>window.location.href = 'index.php?newsfeed=" . $current_user_no . "';</script>";
    } else {
        $error =  "Error: " . $con->error;
    }
}
?>


<style>
        .form-control{
          margin: 5px 5px;
        }
    </style>
<!-- Modal -->
<div class="modal fade" id="createpoll" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Create poll</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body postbody">
        <div class="container-fluid" style="margin-top:10px">
            <form action="" method="POST" id="pollForm" enctype="multipart/form-data">
                <label for="question">Add question</label>
                <textarea class="form-control" type="text" name="question" id="question" required></textarea><br><br>

                <div id="options">
                    <div class="option">
                        <label for="option1">1</label>
                        <input class="form-control" type="text" name="options[]" id="option1" required>
                        <input class="form-control" type="file" name="option_images[]" accept="image/*" id="fileInput1" style="display: none;">
                        <label for="fileInput1" class="custom-file-upload">
                            <i class="fa-regular fa-image"></i>
                        </label>
                        <button type="button" class="removeImage">x</button>
                        <img class="previewImage" src="" alt="Image preview">
                        <!-- No remove button for the first option -->
                    </div>
                </div>
                <br>
                <button type="button" id="addOption">Add Another Option</button>
                <br><br>
        </div>
      </div>

      <div class="modal-footer">
        <button type="submit" name="submit_poll" value="Create Poll" class="btn btn-primary">Post</button>
        </form>
      </div>
    </div>
  </div>
</div>


<!-- Toast Container -->
<div class="toast-container position-fixed bottom-0 end-0 p-3">
  <div id="liveToastpoll" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
  


    <div class="toast-header">
      <strong class="me-auto">Notification</strong>
      <small>Just now</small>
      <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="alert alert-danger" role="alert">
    <div class="toast-body-poll">
      
      <!-- Toast message will be inserted here -->
    </div>
    </div>
  </div>
</div>


<script>
        let optionCount = 1;

        // Function to add a new option field with an image input
        function addOption() {
            optionCount++;
            const newOption = document.createElement('div');
            newOption.className = 'option';
            newOption.innerHTML = `
                <label for="${optionCount}">${optionCount}</label>
                <input class="form-control" type="text" name="options[]" id="option${optionCount}" required>
                <input class="form-control" type="file" name="option_images[]" accept="image/*" id="fileInput${optionCount}" style="display: none;">
                <label for="fileInput${optionCount}" class="custom-file-upload">
                    <i class="fa-regular fa-image"></i>
                </label>
                <button type="button" class="removeImage">x</button>
                <img class="previewImage" src="" alt="Image preview">
                <button type="button" class="removeOption">-</button>
            `;
            document.getElementById('options').appendChild(newOption);
            // Ensure new option's file input works correctly
            updateOptions();
        }

        // Function to remove an option field
        function removeOption(event) {
            if (optionCount > 1) {  // Prevent removing the last option
                event.target.parentElement.remove();
                optionCount--;
                // Update the labels and IDs for the remaining options
                updateOptions();
            }
        }

        // Function to update option labels and IDs after removal
        function updateOptions() {
            const options = document.querySelectorAll('.option');
            options.forEach((option, index) => {
                const label = option.querySelector('label');
                const input = option.querySelector('input[type="text"]');
                const fileInput = option.querySelector('input[type="file"]');
                const fileLabel = option.querySelector('label.custom-file-upload');
                const removeButton = option.querySelector('.removeImage');
                const removeOptionButton = option.querySelector('.removeOption');
                const previewImage = option.querySelector('.previewImage');

                label.setAttribute('for', `option${index + 1}`);
                label.textContent = `${index + 1}`; //removed "option"
                input.setAttribute('id', `option${index + 1}`);
                fileInput.setAttribute('id', `fileInput${index + 1}`);
                fileInput.setAttribute('name', `option_images[]`);
                fileLabel.setAttribute('for', `fileInput${index + 1}`);

                // Hide "Remove Image" button initially
                removeButton.style.display = 'none';

                // Show "Remove" button if it's not the first option
                removeOptionButton.style.display = 'inline';

                // Hide image preview initially
                previewImage.style.display = 'none';
            });
        }

        // Function to clear the file input field (remove the image)
        function removeImage(event) {
            const fileInput = event.target.previousElementSibling;
            const previewImage = event.target.nextElementSibling;
            fileInput.value = '';  // Clear the file input value
            previewImage.src = ''; // Clear the image preview
            previewImage.style.display = 'none';  // Hide the image preview
            event.target.style.display = 'none';  // Hide the "Remove Image" button
        }

        // Function to show the "Remove Image" button and image preview when an image is selected
        function handleFileInputChange(event) {
            const removeImageButton = event.target.parentElement.querySelector('.removeImage');
            const previewImage = event.target.parentElement.querySelector('.previewImage');
            if (event.target.files.length > 0) {
                const file = event.target.files[0];
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImage.src = e.target.result;
                    previewImage.style.display = 'inline'; // Show the image preview
                };
                reader.readAsDataURL(file);
                removeImageButton.style.display = 'inline'; // Show the "Remove Image" button
            } else {
                removeImageButton.style.display = 'none'; // Hide the "Remove Image" button
                previewImage.style.display = 'none'; // Hide the image preview
            }
        }

        // Event listener to add a new option
        document.getElementById('addOption').addEventListener('click', addOption);

        // Event delegation for remove buttons
        document.getElementById('options').addEventListener('click', function(event) {
            if (event.target.classList.contains('removeOption')) {
                removeOption(event);
            } else if (event.target.classList.contains('removeImage')) {
                removeImage(event);
            }
        });

        // Event delegation for file input changes
        document.getElementById('options').addEventListener('change', function(event) {
            if (event.target.type === 'file') {
                handleFileInputChange(event);
            }
        });
    </script>

    <!-- // toast message popup on creating post -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    <?php if (!empty($error)): ?>
        // Set the toast message
        var toastBody = document.querySelector('#liveToastpoll .toast-body-poll');
        toastBody.textContent = '<?php echo addslashes($error); ?>';

        // Initialize and show the toast
        var toastEl = document.getElementById('liveToastpoll');
        var toast = new bootstrap.Toast(toastEl, { delay: 5000 }); // 5 seconds delay

        // Show the toast
        toast.show();
    <?php endif; ?>
});
</script>