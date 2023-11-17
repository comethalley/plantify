<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Plantifeed Record</title>
</head>
<body>
    <h2>Create Plantifeed Record</h2>

    <form action="store.php" method="post">
        <label for="post_title">Title:</label>
        <input type="text" name="post_title" required><br>

        <label for="body">Body:</label>
        <textarea name="body" required></textarea><br>

        <label for="image">Image:</label>
        <input type="text" name="image" required><br>

        <label for="createdby">Created By:</label>
        <input type="text" name="createdby" required><br>

        <label for="status">Status:</label>
        <input type="text" name="status" required><br>

        <input type="submit" value="Create Record">
    </form>

    <a href="index.php">Back to Records</a>
</body>
</html>
