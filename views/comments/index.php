<div class="container">
    <div class="row">
        <h1>List of comments</h1>
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
                            <summary><?php echo substr($comment['content'],0,69) . "..."; ?></summary>
                            <p>
                                <?php echo $comment['content']; ?>
                            </p>
                        </details>

                    </td>
                    <td>
                        <?php echo $comment['name']; ?>
                    </td>
                    <td>
                        <?php echo $comment['email']; ?>
                    </td>

                    <td>
                        <?php echo $comment['date_published']; ?>
                    </td>

                    <td>
                        <a href="#" >edit</a>
                    </td>
                    <td>
                        <a href="#" >delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>

            </tbody>
        </table>
    </div>
</div>