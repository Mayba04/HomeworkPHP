<!doctype html>
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
<?php include ("_header.php") ?>
<div class="container py-3">
    <h1 class="text-center">Add a category</h1>
    <form class="col-md-6 offset-md-3 needs-validation" id="categoryForm" novalidate>
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" name="name" id="name" required>
            <div class="invalid-feedback">
                Please provide a category name.
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <img id="selectedImage" src="https://t4.ftcdn.net/jpg/04/70/29/97/360_F_470299797_UD0eoVMMSUbHCcNJCdv2t8B2g1GVqYgs.jpg"
                     alt="Selected photo" width="100%" style="cursor:pointer;">
            </div>
            <div class="col-md-8">
                <div class="mb-3">
                    <label for="image" class="form-label">Choose a photo</label>
                    <input class="form-control"  type="file" id="image" name="image" accept="image/*" required>
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