<details>
    <summary class="text-center">Filters show/hide</summary>

<aside class="container">
    <div class="col-md-3">
        <div class="categories text-left">
            <h4>Categories:

                <dl>
                    <dt>
                        <span class="badge"><?php echo $all_categories['count']; ?></span>
                        <a href="<?php echo DX_URL . "posts/index";?>">All</a>
                    </dt>
                    <?php foreach( $categories_list as $category ): ?>
                        <dd>
                        <span class="badge"><?php echo $category['count'];?></span>

                        <a href="<?php echo DX_URL . "posts/index?category=" . strtolower($category['name']);?>">
                                <?php echo $category['name'];?>
                            </a>
                        </dd>
                    <?php endforeach;?>
                </dl>
            </h4>
        </div>
    </div>

    <div class="col-md-3">
        <div class="categories text-left">
            <h4>Top tags:
<!--                <a href="--><?php //echo DX_URL . "posts/index";?><!--">All</a>-->
                <dl>
                    <?php foreach( $tags_list as $tag ): ?>
                        <dd >
                            <span class="badge"><?php echo $tag['occurances'];?></span>
                            <a href="<?php echo DX_URL . "posts/index?tag=" . strtolower($tag['name']);?>">
                        <span>
                            <?php echo $tag['name'];?>
                        </span>
                                </a>
                        </dd>
                    <?php endforeach;?>
                </dl>
            </h4>
        </div>
    </div>

    <div class="col-md-3">
        <div class="categories text-left">
            <h4>Posts by dates:
                <ul>
<!--                    <li><a href="--><?php //echo DX_URL . "posts/index";?><!--">All</a></li>-->
                    <?php foreach( $dates_list as $item ): ?>
                        <li>
                            <a href="<?php echo DX_URL . "posts/index?year=" . $item['date']['year'] . "&month=" . $item['date']['month'] ;?>">
                                <?php echo  $item['date']['year'] . '-' .$item['date']['month'] ; ?>
                            </a>
                        </li>
                        <ul>
                            <?php foreach( $item['posts'] as $post ): ?>
                                <li>
                                    <a href="<?php echo DX_URL . "posts/view/" . $post['id'];?>">
                                        <?php echo $post['title']; ?>
                                    </a>
                                </li>
                            <?php endforeach;?>
                        </ul>
                    <?php endforeach;?>
                </ul>
            </h4>
        </div>
    </div>

    <div class="col-md-3">
        <div class="well centered">
            <h4>Search by tag</h4>
                <form role="form" method="get">
                        <input name="tag" type="text" class="form-control" id="usr">
                        <button type="submit" class="btn btn-default">Submit</button>
                </form>
            </div>
            <!-- /.input-group -->
        </div>
    </div>
</aside>
</details>