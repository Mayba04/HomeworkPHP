<?php global$pdo;?> <!doctype html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Category</title>
    <link rel="stylesheet" href="/css/bootstrap.min.css">
</head>
<body>
<?php include("_header.php");

include($_SERVER['DOCUMENT_ROOT']."/config/connection_database.php");
$categoryId = $_GET['id'];
$sql = "SELECT id, name, image, description FROM categories WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$categoryId]);
$category = $stmt->fetch(PDO::FETCH_ASSOC);

// PHP script to handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $description = $_POST['description'];
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK)
    {
        $imageContent = file_get_contents($_FILES['image']['tmp_name']);
    } else {
        $imageContent = $category['image'];
    }

    $sql = "UPDATE categories SET name = ?, image = ?, description = ? WHERE id = ?";
    $stmt = $pdo->prepare($sql);

    $stmt->execute([$name, $imageContent, $description, $categoryId]);

    header("Location: /");
    exit;
}

if ($categoryId)
{
    if (!$category)
    {
        die("Category not found.");
    } else {
        if (!empty($category["image"])) {
            $base64Image = base64_encode($category["image"]);
            $imageDataUri = "data:image/jpeg;base64," . $base64Image;
            $category["image"] = $imageDataUri;
        }
    }
}
else
{
    die("No category ID provided.");
}
?>

<div class="container py-3">
    <h1 class="text-center">Edit Category</h1>
    <form class="col-md-6 offset-md-3 needs-validation" method="post" enctype="multipart/form-data" novalidate>
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" name="name" id="name" value="<?php echo $category['name']; ?>" required>
            <div class="invalid-feedback">
                Please provide a category name.
            </div>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <input type="text" class="form-control" name="description" id="description" value="<?php echo $category['description'];?>" required>
            <div class="invalid-feedback">
                Please provide a description.
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <img id="selectedImage" src="<?php echo $category['image']; ?>"
                     alt="Selected photo" width="100%" style="cursor:pointer;">
            </div>
            <div class="col-md-8">
                <div class="mb-3">
                    <label for="image" class="form-label">Image</label>
                    <input type="file" class="form-control" name="image" id="image">
                    <div class="invalid-feedback">
                        Please select a photo.
                    </div>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>

<script src="/js/bootstrap.bundle.min.js"></script>
<script src="js/validation.js"></script>
</body>
</html>