<?php
global $pdo;
?><!doctype html>
<html lang="us">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create</title>
    <link rel="stylesheet" href="/css/bootstrap.min.css">
</head>
<body>

<?php
include("_header.php");
include($_SERVER['DOCUMENT_ROOT']."/config/connection_database.php");

// PHP script to handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $image = $_POST['image'];
    $description = $_POST['description'];
    echo "$name $image $description\n";

    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $imageContent = file_get_contents($_FILES['image']['tmp_name']);

        $sql = "INSERT INTO categories (name, image, description) VALUES (?, ?, ?)";
        $stmt = $pdo->prepare($sql);

        $stmt->execute([$name, $imageContent, $description]);
        header("Location: /");
        exit;
    } else {
        echo "Error: Please upload an image.";
        exit;
    }
}

?>
<div class="container py-3">
    <h1 class="text-center">Add a category</h1>
    <form class="col-md-6 offset-md-3 needs-validation" enctype="multipart/form-data" id="categoryForm" novalidate method="post">
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" name="name" id="name" required>
            <div class="invalid-feedback">
                Please provide a category name.
            </div>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <input type="text" class="form-control" name="description" id="description" required>
            <div class="invalid-feedback">
                Please provide a description.
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <img id="selectedImage" src="https://t4.ftcdn.net/jpg/04/70/29/97/360_F_470299797_UD0eoVMMSUbHCcNJCdv2t8B2g1GVqYgs.jpg"
                     alt="Selected photo" width="100%" style="cursor:pointer;">
            </div>
            <div class="col-md-8">
                <div class="mb-3">
                    <label for="image" class="form-label">Image File</label>
                    <input type="file" class="form-control" name="image" id="image" required>
                    <div class="invalid-feedback">
                        Please select a photo.
                    </div>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Add</button>
    </form>
</div>
<script src="/js/bootstrap.bundle.min.js"></script>
<script src="js/validation.js"></script>
</body>
</html>