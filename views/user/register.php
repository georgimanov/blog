<div class="container">
    <div class="container col-lg-4 col-lg-offset-4">

        <form class="form-signin" method="post">
            <h2 class="form-signin-heading">Register</h2>
            <div class="form-group">
                <label for="username" >Username</label>
                <input type="text" name="username" id="username" class="form-control" placeholder="Username" required="" autofocus="">
            </div>
            <div class="form-group">
                <label for="password" >Password</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="Password" required="">
            </div>

            <div class="form-group">
                <label for="email" >Email</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="Email" >
            </div>

            <button class="btn btn-lg btn-primary btn-block" type="submit">Register</button>
        </form>
        <p class="text-center"><a href="<?php echo DX_URL . "user/login";?>">Login</a> </p>
    </div>

    <div class="row">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true" class="justifycenter"><?php echo ( (! empty ($message)) ? $message : "");?>&times;</span>
        </button>
    </div>
</div>