<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CropsPlanted CRUD</title>
</head>
<body>
    <h2>CropsPlanted Records</h2>

    <a href="create.php">Add New Record</a>

    <table border="1">
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Body</th>
            <th>Image</th>
            <th>Created By</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>

        <?php
            // Loop through records and display them in the table
            // You should replace this with actual data retrieval logic
            foreach ($records as $record) {
                echo "<tr>";
                echo "<td>{$record['id']}</td>";
                echo "<td>{$record['post_title']}</td>";
                echo "<td>{$record['body']}</td>";
                echo "<td>{$record['image']}</td>";
                echo "<td>{$record['createdby']}</td>";
                echo "<td>{$record['status']}</td>";
                echo "<td>
                        <a href='show.php?id={$record['id']}'>View</a>
                        <a href='edit.php?id={$record['id']}'>Edit</a>
                        <a href='delete.php?id={$record['id']}'>Delete</a>
                      </td>";
                echo "</tr>";
            }
        ?>
    </table>
</body>
</html>