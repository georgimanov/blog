<!-- +++++ Post Section +++++ -->

<div class="container pt">
    <div class="row mt">
        <div class="col-lg-6 col-lg-offset-3 centered">
            <h3>Add new post</h3>
            <hr>
        </div>
    </div>
    <div class="row mt">
        <div class="col-lg-8 col-lg-offset-2">
            <form role="form" method="post">
                <div class="form-group">
                    <input name="title" class="form-control" placeholder="Title" required="required">
                    <br>
                </div>
                <div class="form-group">
                    <input name="tags" class="form-control" placeholder="Tags">
                    <br>
                </div>
                <div class="form-group">

                    <select name="category_id"  class="form-control">
                        <?php foreach( $categories_list as $category ): ?>
                        <option class="form-control" value="<?php echo $category['id'];?>"><?php echo $category['name'];?>
                            <?php endforeach;?>
                    </select>
                    <br>
                </div>

                <textarea name="content" class="form-control" id="editor1" rows="6" placeholder="Enter your text here" required="required">
                </textarea>
                    <script>
                        // Replace the <textarea id="editor1"> with a CKEditor
                        // instance, using default configuration.
                        CKEDITOR.replace( 'content' );
                    </script>
                <br>
                <button type="submit" class="btn btn-success">SUBMIT</button>
            </form>
        </div>
    </div><!-- /row -->
</div><!-- /container -->

