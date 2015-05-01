<!-- +++++ Comment Delete Section +++++ -->

<div id="white">
    <div class="container">
        <div class="row">

            <div class="col-lg-8 col-lg-offset-2 centered">
                <h3>Delete Comment <a href="<?php echo DX_URL . 'comments/index';?>" ># back</a> </h3>
            </div>

            <i class="alert-info">
                <?php echo !empty ($this->message) ? $this->message  : "" ; ?>
            </i>
            <div class="col-lg-8 col-lg-offset-2">
                <form role="form" method="post">
                    <div class="form-group">
                        <input name="name" type="name"
                               class="form-control"  value="<?php echo htmlentities($element['name']); ?>" id="NameInput" placeholder="Your Name" required="required" readonly>
                        <br>
                    </div>
                    <div class="form-group">
                        <input name="email" type="email" value="<?php echo htmlentities($element['email']); ?>" class="form-control" id="exampleInputEmail1" placeholder="Enter email" readonly>
                        <br>
                    </div>
                    <textarea name="content"  placeholder=" <?php echo htmlentities($element['content']); ?>" class="form-control" rows="6"  required="required" readonly></textarea>

                    <input name="id" value=" <?php echo htmlentities($element['id']); ?>" type="hidden">

                    <br>
                    <button type="submit" class="btn btn-success">DELETE</button>
                </form>
            </div>
        </div>
    </div>
</div>