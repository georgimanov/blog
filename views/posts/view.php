<?php
$picture = 'default_user.png';

if($user['username'] === 'georgi'){
    $picture = 'user.png';
}
?>

<div id="white">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">

<!--                //TODO: post['user_id'];-->
<!--                //TODO: $user['username'] => post['username'];-->
                <p>
                    <img src="<?php echo DX_URL;?>/views/assets/img/<?php echo $picture;?>" alt="Profile pictyre" width="50px" height="50px"> <ba
                        ><?php echo $user['username']; ?></ba>
                </p>
                <p><bd><?php echo date("d-F-Y",strtotime($post['date_pubslished'])); ?></bd></p>
                <h4><?php echo $post['title']; ?></h4>
                <!--                                    <p><img class="img-responsive" src="assets/img/blog01.jpg" alt=""></p>-->
                <p><?php echo $post['content']; ?></p>
                <br>
                <p>
                    <bt>TAGS:
                        <?php foreach($tags as $tag): ?>
                            <a href="<?php echo DX_URL . "posts/index?tag=" . strtoupper($tag['name']);?>">
                                <?php echo $tag['name']; ?></a>
                        <?php endforeach; ?>
                    </bt>
                </p>
                <hr>
                <p><a href="<?php echo DX_URL . "posts/index";?>"># Back</a></p>
            </div>

        </div><!-- /row -->
    </div> <!-- /container -->
</div><!-- /white -->

<div id="grey">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <?php foreach($comments as $comment): ?>
                    <p><img src="<?php echo DX_URL;?>/views/assets/img/<?php echo $picture;?>" alt="Profile pictyre" width="50px" height="50px"> <ba><?php echo $comment['name']; ?></ba></p>
                    <p><?php echo $comment['content']; ?></p>
                    <p>
                        <bt>
                            Date:
                            <bd>
                                <?php echo date("d-F-Y",strtotime($comment['date_published'])); ?>
                            </bd>
                        </bt>
                        <bt>
                            <?php
                            if ( ! empty ( $comment['email'] ) ) {
                                printf("Email: <a href='mailto:%s' target='_top' >%s</a>", $comment['email'], $comment['email']);
                            };
                            ?>
                        </bt>
                    </p>
                    <hr>
                <?php endforeach; ?>
            </div>

        </div>
    </div>
</div>
<?php include_once "comment.php" ?>
