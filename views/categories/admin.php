<div class="container">
    <div class="row">
        <h2 class="centered">List of categories</h2>
        <hr>
        <i class="alert-info">
            <?php echo !empty ($this->message) ? $this->message  : "" ; ?>
        </i>
        <h3><a href="<?php echo DX_URL. "categories/add" ;?>" class="btn btn-primary">Add new category</a> </h3>
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

                <?php foreach($categories as $element): ?>

                    <tr>
                        <td>
                            <?php echo $element['id']; ?>
                        </td>
                        <td>
                           <?php echo htmlentities($element['name']); ?>
                        </td>

                        <td>
                            <a href="<?php echo DX_URL . 'categories/edit/' . $element['id'];?>" class="btn btn-warning">Edit</a>
                        </td>
                        <td>
                            <a href="<?php echo DX_URL . 'categories/delete/' . $element['id'];?>" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>

                <?php endforeach; ?>

                </tbody>
            </table>
        </div>
    </div>
</div>