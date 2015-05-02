<!-- +++++ Comment Edit Section +++++ -->

<div id="white">
    <div class="container">
        <div class="row">

            <div class="col-lg-8 col-lg-offset-2 centered">
                <h3>Edit Comment <a href="<?php echo DX_URL . 'comments/index';?>" ># back</a> </h3>
                <i class="alert-info">
                    <?php echo !empty ($message) ? $message  : "" ; ?>
                </i>
            </div>

            <div class="col-lg-8 col-lg-offset-2">
                <form role="form" method="post">
                    <div class="form-group">
                        <input name="name" type="name"
                               class="form-control"  value="<?php echo htmlentities($element['name']); ?>" id="NameInput" placeholder="Your Name" required="required" >
                        <br>
                    </div>
                    <div class="form-group">
                        <input name="email" type="email" value="<?php echo htmlentities($element['email']); ?>" class="form-control" id="exampleInputEmail1" placeholder="Enter email" >
                        <br>
                    </div>

<!--                    <div class="form-group">-->
<!--                        <details>-->
<!--                            <summary>Content</summary>-->
<!--                            <p>--><?php //echo htmlentities($element['content']); ?><!--</p>-->
<!--                        </details>-->
<!--                    </div>-->
                    <textarea name="content"  placeholder="" class="form-control" rows="6"  required="required" >
                        <?php echo htmlentities($element['content']); ?>
                    </textarea>

                    <input name="id" value=" <?php echo $element['id']; ?>" type="hidden">

                    <br>
                    <button type="submit" class="btn btn-success">EDIT</button>
                </form>
            </div>
        </div>
    </div>
</div>