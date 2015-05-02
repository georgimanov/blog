<div class="container">
    <div class="row">
        <h2 class="centered">List of tags</h2>
        <hr>
        <i class="alert-info">
            <?php echo !empty ($this->message) ? $this->message  : "" ; ?>
        </i>
        <h3><a href="<?php echo DX_URL. "tags/clear" ;?>" class="btn btn-primary">Clear tags</a> </h3>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                </thead>
                <tbody>

                <?php foreach($tags as $tag): ?>

                    <tr>
                        <td>
                            <?php echo $tag['id']; ?>
                        </td>
                        <td>
                           <?php echo htmlentities($tag['name']); ?>
                        </td>

                        <td>
                            <a href="<?php echo DX_URL . 'tags/edit/' . $tag['id'];?>" class="btn btn-warning">Edit</a>
                        </td>
                        <td>
                            <a href="<?php echo DX_URL . 'tags/delete/' . $tag['id'];?>" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>

                <?php endforeach; ?>

                </tbody>
            </table>
        </div>
    </div>
</div>