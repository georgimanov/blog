<div class="container">
    <div class="row">
        <h1>List of contacts</h1>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Message</th>
                    <th>Date sent</th>
                    <th>Email</th>
                    <th>Send Email</th>
                </tr>
                </thead>
                <tbody>

                <?php foreach($contacts as $contact): ?>

                    <tr>
                        <td>
                            <?php echo $contact['id']; ?>
                        </td>

                        <td>
                            <?php echo htmlentities($contact['name']); ?>
                        </td>

                        <td>
                            <details>
                                <summary><?php echo htmlentities(substr($contact['subject'],0,140)) ; ?></summary>
                                <p>
                                    <?php echo htmlentities($contact['text']); ?>
                                </p>
                            </details>

                        </td>
                        <td>
                            <?php echo htmlentities($contact['date_sent']); ?>
                        </td>
                        <td>
                            <?php echo htmlentities($contact['email']); ?>
                        </td>

                        <td>
                            <a href="mailto:<?php echo htmlentities($contact['email']); ?>" target="_blank" class="btn btn-primary">Send Mail</a>
                        </td>

                    </tr>

                <?php endforeach; ?>

                </tbody>
            </table>
        </div>
    </div>
</div>