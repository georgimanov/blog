<!-- +++++ Comment Section +++++ -->

<div id="white">
    <div class="container">
        <div class="row">

            <div class="col-lg-8 col-lg-offset-2 centered">
                <h3>Add Comment</h3>
            </div>
            <div class="col-lg-8 col-lg-offset-2">
                <form role="form" method="post" action="<?php echo DX_URL . 'comments/add'; ?>">
                    <div class="form-group">
                        <input name="name" type="name" class="form-control" id="NameInputEmail1" placeholder="Your Name" required="required">
                        <br>
                    </div>
                    <div class="form-group">
                        <input name="email" type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                        <br>
                    </div>
                    <input name="post_id" type="hidden" value="<?php echo $post['id']; ?>"/>
                    <textarea name="content" class="form-control" rows="6" placeholder="Enter your text here" required="required"></textarea>
                    <br>
                    <button type="submit" class="btn btn-success">SUBMIT</button>
                </form>
            </div>
        </div>
    </div>
</div>