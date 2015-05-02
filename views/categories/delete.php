<!-- +++++ Category Edit Section +++++ -->

<div class="container pt">
    <div class="row mt">
        <div class="col-lg-6 col-lg-offset-3 centered">
            <h3>Delete category <a href="<?php echo DX_URL . 'categories/admin'; ?>"># back</a></h3>
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
                    <input name="name" value="<?php echo htmlentities($element['name']); ?>" class="form-control" placeholder="Name" required="required">
                    <input name="id" value="<?php echo $element['id']; ?>" type="hidden">
                    <br>

                </div>
                <br>
                <button type="submit" class="btn btn-success">Delete</button>
            </form>
        </div>
    </div><!-- /row -->
</div><!-- /container -->