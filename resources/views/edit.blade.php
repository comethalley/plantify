<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Plantifeed Record</title>
</head>
<body>
    <h2>Edit Plantifeed Record</h2>

    <form action="update.php" method="post">
        <input type="hidden" name="id" value="<?php echo $record['id']; ?>">

        <label for="post_title">Title:</label>
        <input type="text" name="post_title" value="<?php echo $record['post_title']; ?>" required><br>

        <label for="body">Body:</label>
        <textarea name="body" required><?php echo $record['body']; ?></textarea><br>

        <label for="image">Image:</label>
        <input type="text" name="image" value="<?php echo $record['image']; ?>" required><br>

        <label for="createdby">Created By:</label>
        <input type="text" name="createdby" value="<?php echo $record['createdby']; ?>" required><br>

        <label for="status">Status:</label>
        <input type="text" name="status" value="<?php echo $record['status']; ?>" required><br>

        <input type="submit" value="Update Record">
    </form>

    <a href="index.php">Back to Records</a>
</body>
</html>
