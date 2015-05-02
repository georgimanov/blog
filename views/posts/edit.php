<!-- +++++ Post Section +++++ -->

<div class="container pt">
    <div class="row mt">
        <div class="col-lg-6 col-lg-offset-3 centered">
            <h3>Edit post</h3>
            <i class="alert-info">
                <?php echo !empty ($message) ? $message  : "" ; ?>
            </i>
            <hr>
        </div>
    </div>

    <div class="row mt">
        <div class="col-lg-8 col-lg-offset-2">
            <form role="form" method="post">
                <input type="hidden" name="id" value="<?php echo $post['id'];?>">
                <div class="form-group">
                    <input name="title" value="<?php echo htmlentities($post['title']);?>" class="form-control" placeholder="Title" required="required">
                    <br>
                </div>
                <div class="form-group">
                    Date published: <input type="text" name="date_pubslished" value=" <?php echo strftime('%Y-%m-%dT%H:%M:%S', strtotime($post['date_pubslished']));?>" />
                    </div>
                <div class="form-group">

                    <input name="tags" value="<?php echo htmlentities($tags_string); ?>" class="form-control" placeholder="Tags">

                    <br>
                </div>
                <div class="form-group">

                    <select name="category_id"  class="form-control">
                        <?php foreach( $categories_list as $category ): ?>
                                <option class="form-control" value="<?php echo $category['id'];?>"

                                    <?php echo ($category['id']== $post['category_id']) ? "selected" : "";?>

                                    ><?php echo htmlentities($category['name']);?>
                            <?php endforeach;?>
                    </select>
                    <br>
                </div>

                <div class="form-group">
                        <details>
                            <summary>Current content</summary>
                            <p>
                                <?php echo htmlentities($post['content']);?>
                            </p>
                        </details>

                </div>

                <textarea name="content" class="form-control" id="editor1" rows="6" placeholder="" required="required">
                    <?php echo htmlentities($post['content']);?>
                </textarea>

                <br>
                <button type="submit" class="btn btn-success">EDIT</button>
            </form>
        </div>
    </div><!-- /row -->
</div><!-- /container -->

