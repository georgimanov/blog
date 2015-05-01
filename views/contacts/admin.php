<div class="container">
    <div class="row">
        <h1>List of contacts</h1>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Content</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Date published</th>
                </tr>
                </thead>
                <tbody>

                <?php foreach($contacts as $contact): ?>

                    <tr>
                        <td>
                            <?php echo $contact['id']; ?>
                        </td>
                        <td>
                            <details>
                                <summary><?php echo htmlentities(substr($contact['content'],0,69)) . "..."; ?></summary>
                                <p>
                                    <?php echo htmlentities($contact['content']); ?>
                                </p>
                            </details>

                        </td>
                        <td>
                            <?php echo htmlentities(substr($contact['name'], 0, 50)) . "..."; ?>
                        </td>
                        <td>
                            <?php echo htmlentities($contact['email']); ?>
                        </td>

                        <td>
                            <?php echo htmlentities($contact['date_published']); ?>
                        </td>

                    </tr>

                <?php endforeach; ?>

                </tbody>
            </table>
        </div>
    </div>
</div>