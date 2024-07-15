<div>
    <form action="login.php" method="post">
                <div class="form-group">
                    <label for="user">Username</label>
                    <input type="text" id="user" name="user" value="<?php echo isset($_POST['user']) ? htmlspecialchars($_POST['user']) : ''; ?>" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="user_password">Password</label>
                    <input type="password" id="user_password" name="user_password" class="form-control" required>
                </div>
                <button type="submit" name="login" class="btn btn-primary">Login</button>
    </form>
        <!-- Button to Open the Register Modal -->
        <button type="button" class="btn btn-primary" onclick="openRegisterModal()" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">Open modal for @mdo</button>
</div>