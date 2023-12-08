<?php global$pdo;?> <!doctype html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Delete Category</title>
    <link rel="stylesheet" href="/css/bootstrap.min.css">
</head>
<?php
include("_header.php");
include($_SERVER['DOCUMENT_ROOT'] . "/config/connection_database.php");
$categoryId = $_GET['id'];
$sql = "SELECT id, name, image, description FROM categories WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$categoryId]);
$category = $stmt->fetch(PDO::FETCH_ASSOC);

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    if ($categoryId)
    {
        $sql = "DELETE FROM categories WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$categoryId]);
        header("Location: /");
        exit;
    }
    else
    {
        die("No category ID provided.");
    }
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
<body>
<div class="container mt-5">
    <div class="card">
        <div class="card-header bg-warning text-white">
            <h3 class="card-title">Warning!</h3>
        </div>
        <div class="card-body text-center">
            <h5 class="card-text">Do you really want to delete the category "<?php echo htmlspecialchars($category['name']); ?>"?</h5>
            <div>
                <img src="<?php echo $category['image']; ?>" alt="Selected photo" class="img-thumbnail my-3" style="max-width: 300px;">
            </div>
            <form method="post">
                <input type="hidden" name="category_id" value="<?php echo htmlspecialchars($category['id']); ?>">
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </div>
    </div>
</div>

<script src="/js/bootstrap.bundle.min.js"></script>
</body>
</html>