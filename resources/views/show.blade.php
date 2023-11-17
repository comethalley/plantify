<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Plantifeed Record</title>
</head>
<body>
    <h2>View Plantifeed Record</h2>

    @foreach ($plantifeed as $perplantifeed)
    {{ $perplantifeed->id }}
    @endforeach

    <p><strong>Title:</strong> <?php echo $record['post_title']; ?></p>
    <p><strong>Body:</strong> <?php echo $record['body']; ?></p>
    <p><strong>Image:</strong> <?php echo $record['image']; ?></p>
    <p><strong>Created By:</strong> <?php echo $record['createdby']; ?></p>
    <p><strong>Status:</strong> <?php echo $record['status']; ?></p>

    <a href="index.php">Back to Records</a>
</body>
</html>
