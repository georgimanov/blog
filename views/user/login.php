<div class="container">
    <div class="col-md-4 col-md-offset-4 ">
        <form class="form-signin" method="post">
            <h2 class="form-signin-heading">Please sign in</h2>


            <label for="inputUsername" class="sr-only">Username</label>
            <input type="text" name="username" id="inputUsername" class="form-control" placeholder="Username" required="" autofocus="">
            <label for="inputPassword" class="sr-only">Password</label>
            <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required="">
            <div class="checkbox">
                <label>
                    <input type="checkbox" value="remember-me"> Remember me
                </label>
            </div>


        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
                <p class="text-center"><a href="<?php echo DX_URL . "user/register";?>">Register</a></p>
        </form>

        <div class="row">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true" class="justifycenter"><?php echo ( (! empty ($message)) ? $message : "");?>&times;</span>
            </button>
        </div>
    </div>
</div>