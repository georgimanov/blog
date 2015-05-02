<div class="container">
    <div class="container col-lg-4 col-lg-offset-4">

        <form class="form-signin" method="post">
            <div class="form-group">
                <h2 class="form-signin-heading">Register</h2>
                <hr>
                <i class="alert-info">
                    <?php echo !empty( $message ) ? $message  : "" ; ?>
                </i>
            </div>
            <div class="form-group">
                <label for="username" >Username [2-45]</label>
                <input type="text" name="username" id="username" class="form-control" placeholder="Username" required="" autofocus="" minlength="2" maxlength="45">
            </div>
            <div class="form-group">
                <label for="password" >Password [6-45]</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="Password" required="" minlength="6" maxlength="45">
            </div>

            <div class="form-group">
                <label for="email" >Email (optional)</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="Email" minlength="3" maxlength="45">
            </div>

            <button class="btn btn-lg btn-primary btn-block" type="submit">Register</button>
        </form>
        <p class="text-center"><a href="<?php echo DX_URL . "user/login";?>">Login</a> </p>
    </div>
</div>