<div class="container">
    <div class="row">
        <h2 class="centered">List of posts</h2>
        <hr>
        <h3><a href="<?php echo DX_URL. "posts/add" ;?>" class="btn btn-primary">Add new post</a> </h3>
        <div class="table-responsive">
            <table class="table table-hover">

                <thead>
                <tr>
                    <th>Id</th>
                    <th>Username</th>
                    <th>Date published</th>
                    <th>Title</th>
                    <th>Visits</th>
                    <th>Comments</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                </thead>

                <tbody>

                <?php foreach($posts as $post): ?>

                    <tr>
                        <td>
                            <?php echo $post['id']; ?>
                        </td>
                        <td>
                            <?php echo $post['username']; ?>
                        </td>
                        <td>
                            <?php echo $post['date_pubslished']; ?>
                        </td>
                        <td>
                            <details>
                                <summary><?php echo $post['title']; ?></summary>
                                <p>
                                    <?php echo substr($post['content'],0,250) . "..."; ?>

                                </p>
                            </details>

                        </td>
                        <td>
                            <?php echo $post['visits_count']; ?>
                        </td>
                        <td>
                            <a href="#" class="btn btn-info">Comments</a>
                        </td>
                        <td>
                            <a href="#" class="btn btn-warning">Edit</a>
                        </td>
                        <td>
                            <a href="#" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>

                </tbody>
            </table>
        </div>
    </div>
</div>