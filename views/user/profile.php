<div class="container">
    <div class="col-lg-6 col-lg-offset-3 centered">
        <h3>Profile</h3>
        <hr>
        <div class="col-lg-3">
            <img src="<?php echo DX_URL;?>/views/assets/img/default_user.png" alt="Georgi Manov">
        </div>
        <div class="col-lg-9 text-right">
            <p>Username: <?php echo $user['username']; ?></p>
            <p>Email: <?php echo empty($user['email']) ? "not provided" : $user['email']; ?></p>
        </div>
        <div class="clearfix">
        </div>
        <hr>
    </div>
</div>