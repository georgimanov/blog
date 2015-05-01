<div class="container">
    <div class="row">
        <h1>List of comments</h1>
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
                            <?php echo htmlentities(substr($comment['name'], 0, 50)) . "..."; ?>
                        </td>
                        <td>
                            <?php echo htmlentities($comment['email']); ?>
                        </td>

                        <td>
                            <?php echo htmlentities($comment['date_published']); ?>
                        </td>

                        <td>
                            <a href="<?php echo DX_URL . 'comments/edit/' .$comment['id']; ?>" class="btn btn-warning" >edit</a>
                        </td>
                        <td>
                            <a href="<?php echo DX_URL . 'comments/delete/' .$comment['id'];?>" class="btn btn-danger" >delete</a>
                        </td>
                    </tr>

                <?php endforeach; ?>

                </tbody>
            </table>
        </div>
    </div>
</div>