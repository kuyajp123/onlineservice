<?php if (!empty($posts)): ?>
    <?php foreach ($posts as $post): ?>
        <?php
        // Extract data
        $post_id = htmlspecialchars($post['post_id']);
        $user_no = htmlspecialchars($post['user_no']);
        $timestamp = htmlspecialchars($post['timestamp']);
        $postphoto = htmlspecialchars($post['postphoto']);
        $caption = htmlspecialchars($post['caption']);

        // Create DateTime object
        $dateTime = new DateTime($timestamp);

        // Format date and time
        $formattedDate = $dateTime->format('F j, Y');
        $formattedTime = $dateTime->format('g:i a');

        // Determine if there is text or an image
        $hasText = !empty(trim($caption));
        $hasImage = !empty(trim($postphoto));
        ?>
        
        <div class="card" style="width: 18rem;">
            <?php if ($hasImage): ?>
                <img src="../include/posts_images/<?php echo $postphoto; ?>" class="card-img-top" alt="Post Image">
            <?php endif; ?>
            
            <div class="card-body">
                <?php if ($hasText): ?>
                    <p class="card-text"><?php echo nl2br(htmlspecialchars($caption)); ?></p>
                <?php endif; ?>
                <p class="card-text"><small class="text-muted"><?php echo $formattedDate . ' at ' . $formattedTime; ?></small></p>
                <a href="#" class="btn btn-primary">View Post</a>
            </div>
        </div>
        
    <?php endforeach; ?>
<?php else: ?>
    <p>No posts available.</p>
<?php endif; ?>