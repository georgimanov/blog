<!-- +++++ Post Section +++++ -->

<div class="container pt">
    <div class="row mt">
        <div class="col-lg-6 col-lg-offset-3 centered">
            <h3>Delete post <a href="<?php echo DX_URL . 'posts/admin';?>">#back</a> </h3>
            <hr>
            <p>To delete this post, simply press the delete button below</p>
            <i class="alert-info">
                <?php echo !empty ($this->message) ? $this->message  : "" ; ?>
            </i>

        </div>
    </div>

    <div class="row mt">
        <div class="col-lg-8 col-lg-offset-2">
            <form role="form" method="post">
                <input type="hidden" name="id" value="<?php echo $post['id'];?>">
                <div class="form-group">
                    <label form="title">Title</label>
                    <input name="title" id="title" value="<?php echo $post['title'];?>" class="form-control" placeholder="Title" required="required" readonly>
                </div>
                <div class="form-group">
                    <label form="date_pubslished">Date published: </label>
                    <input type="text" name="date_pubslished"id="date_pubslished" class="form-control"  value=" <?php echo strftime('%Y-%m-%dT%H:%M:%S', strtotime($post['date_pubslished']));?>"  readonly/>
                </div>
                <div class="form-group">
                    <label form="tags">Tags: </label>
                    <input name="tags" value="<?php echo $tags_string; ?>" class="form-control" placeholder="Tags" readonly>
                </div>
                <div class="form-group">

                    <?php foreach( $categories_list as $category ): ?>
                        <?php if ($category['id']== $post['category_id']):?>
                            <label form="category">Category</label>
                            <input name="category" value="<?php echo $category['name'] ;?>" class="form-control" readonly>
                            <?php break; endif;?>
                    <?php endforeach;?>
                    </select>
                    <br>
                </div>

                <label for="content">Content</label>
                <textarea name="content" class="form-control" id="editor1" rows="6" placeholder="" required="required" readonly>
                    <?php echo ($post['content']);?>
                </textarea>

                <br>
                <button type="submit" class="btn btn-success">DELETE</button>
            </form>
        </div>
    </div><!-- /row -->
</div><!-- /container -->

