<!-- +++++ Category Add Section +++++ -->

<div class="container pt">
    <div class="row mt">
        <div class="col-lg-6 col-lg-offset-3 centered">
            <h3>Add new category <a href="<?php echo DX_URL . 'categories/admin'; ?>"># back</a></h3>
            <hr>
            <div class="row">
                <i class="alert-info">
                    <?php echo !empty ($this->message) ? $this->message  : "" ; ?>
                </i>
            </div>
        </div>
    </div>
    <div class="row mt">
        <div class="col-lg-8 col-lg-offset-2">

            <form role="form" method="post">

                <div class="form-group">
                    <input name="name" class="form-control" placeholder="Name" required="required">
                    <br>
                </div>

                <br>
                <button type="submit" class="btn btn-success">SUBMIT</button>
            </form>
        </div>


    </div><!-- /row -->
</div><!-- /container -->