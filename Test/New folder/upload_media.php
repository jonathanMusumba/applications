<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Media</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h2>Upload Media</h2>
        <form action="process_upload.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="mediaTitle">Title</label>
                <input type="text" class="form-control" id="mediaTitle" name="mediaTitle" required>
            </div>
            <div class="form-group">
                <label for="mediaDescription">Description</label>
                <textarea class="form-control" id="mediaDescription" name="mediaDescription" rows="3" required></textarea>
            </div>
            <div class="form-group">
                <label for="mediaFile">Select Media File</label>
                <input type="file" class="form-control-file" id="mediaFile" name="mediaFile" accept="image/*,video/*" required>
            </div>
            <div class="form-group">
                <label for="mediaType">Media Type</label>
                <select class="form-control" id="mediaType" name="mediaType" required>
                    <option value="post">Post</option>
                    <option value="carousel">Carousel</option>
                    <option value="banner">Banner</option>
                    <!-- Add more options as needed -->
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Upload</button>
        </form>
    </div>
</body>
</html>
