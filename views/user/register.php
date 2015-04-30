<div class="container">
    <div class="container col-lg-4 col-lg-offset-4">

        <form class="form-signin" method="post">
            <h2 class="form-signin-heading">Register</h2>
            <label for="inputUsername" class="sr-only">Username</label>
            <input type="text" name="username" id="inputUsername" class="form-control" placeholder="Username" required="" autofocus="">
            <label for="inputPassword" class="sr-only">Password</label>
            <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required="">
            <div class="checkbox">
                <label>
                    <input type="checkbox" value="remember-me"> Remember me
                </label>
            </div>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Register</button>
        </form>
        <p class="text-center"><a href="<?php echo DX_URL . "user/login";?>">Login</a> </p>
    </div>
</div>