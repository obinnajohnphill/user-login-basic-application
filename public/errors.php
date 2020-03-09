<?php  if (isset($_SESSION['wrong_username_password'])) : ?>
    <div class="error">
            <p><?php echo $_SESSION['wrong_username_password'];?></p>
    </div>
<?php  endif ?>