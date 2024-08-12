<?php
include("../functions/follow_user.php");
?>

<!-- <div class="container-fluid follow">
    <input class="btn btn-primary follow-btn" type="button" value="Follow" data-user-no="<?php echo htmlspecialchars($other_user_no); ?>" data-action="follow">
</div> -->

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('.follow-btn').on('click', function() {
        var button = $(this);
        var userNo = button.data('user-no');
        var action = button.data('action'); // Use data-action attribute

        $.ajax({
            url: '../functions/follow_user.php',
            method: 'POST',
            data: {
                followed_id: userNo,
                action: action
            },
            success: function(response) {
                var data = JSON.parse(response);
                if (data.success) {
                    if (data.action === 'follow') {
                        button.text('Unfollow').data('action', 'unfollow');
                    } else {
                        button.text('Follow').data('action', 'follow');
                    }
                } else {
                    alert(data.message);
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX request failed:', status, error);
            }
        });
    });
});
</script>
