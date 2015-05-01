<div class="container">
    <div class="row">
        <h2>List of comments for post:</h2>
        <hr>
            <div class="container">
                Id: <?php echo htmlentities($post['id']); ?> <br>
                Title: <?php echo htmlentities($post['title']); ?> <br>
                Publiesh: <?php echo htmlentities($post['date_pubslished']); ?> <br>
                User : <?php echo htmlentities($post['username']) ;?> <br>
                <a href="<?php echo DX_URL . 'posts/admin';?>" class="text-right">#back </a>
            </div>
        <hr>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Content</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Date published</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                </thead>
                <tbody>

                <?php foreach($comments as $comment): ?>

                    <tr>
                        <td>
                            <?php echo $comment['id']; ?>
                        </td>
                        <td>
                            <details>
                                <summary><?php echo htmlentities(substr($comment['content'],0,69)) . "..."; ?></summary>
                                <p>
                                    <?php echo htmlentities($comment['content']); ?>
                                </p>
                            </details>

                        </td>
                        <td>
                            <?php echo htmlentities($comment['name'])?>
                        </td>
                        <td>
                            <?php echo htmlentities($comment['email']); ?>
                        </td>

                        <td>
                            <?php echo htmlentities($comment['date_published']); ?>
                        </td>

                        <td>
                            <a href="<?php echo DX_URL . 'comments/edit/' .$comment['id'];?>" >edit</a>
                        </td>
                        <td>
                            <a href="<?php echo DX_URL . 'comments/delete/' .$comment['id'];?>"" >delete</a>
                        </td>
                    </tr>

                <?php endforeach; ?>

                </tbody>
            </table>
        </div>
    </div>
</div>