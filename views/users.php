<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Users List</title>
    </head>
    <?php include('topNavigation.php'); ?>
    <br>
    <body>
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Balance</th>
            </tr>
            <?php foreach ($users as $user) : ?>
                <tr>
                    <td><?php echo $user->get_id(); ?></td>
                    <td><?php echo $user->get_name(); ?></td>
                    <td><?php echo $user->get_balance(); ?></td>
                </tr>
            <?php endforeach; ?>
        </table>

        <br>

        <h2>Add or Update User</h2>
        <form action="users.php" method="post">
            <label>Name:</label>
            <input type="text" name="name"><br>

            <label>Balance:</label>
            <input type="text" name="balance"><br>

            <div id="idField" style="display: none;">
                <label>ID:</label>
                <input type="text" name="id"><br>
            </div>

            <input type="hidden" name="action" value="insert_or_update">

            <input type="radio" id="addRadio" name="insert_or_update" value="insert" checked> Add<br>
            <input type="radio" id="updateRadio" name="insert_or_update" value="update"> Update<br>

            <label>&nbsp;</label>
            <input type="submit" value="Submit">
        </form>

        <br>

        <h2>Delete User</h2>
        <form action="users.php" method="post">
            <label>ID:</label>
            <input type="text" name="id"><br>
            <input type="hidden" name="action" value="delete">
            <label>&nbsp;</label>
            <input type="submit" value="Delete User">
        </form>
        
        <script>
            const addRadio = document.getElementById('addRadio');
            const updateRadio = document.getElementById('updateRadio');
            const idField = document.getElementById('idField');

            function toggleIdField() {
                if (updateRadio.checked) {
                    idField.style.display = 'block';
                } else {
                    idField.style.display = 'none';
                }
            }

            addRadio.addEventListener('change', toggleIdField);
            updateRadio.addEventListener('change', toggleIdField);

            toggleIdField();
        </script>
    </body>
    <br>
    <?php include('footer.php'); ?>
</html>