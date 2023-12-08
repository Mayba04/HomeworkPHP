<?php
global $pdo;
?>
<!doctype html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="/css/bootstrap.min.css">
</head>
<body>
<?php
include("_header.php");
include($_SERVER['DOCUMENT_ROOT'] . "/config/connection_database.php");
?>

<div class="container">
    <h4 class="text-center">Categories</h4>

    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Photo</th>
            <th scope="col">Name</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        <?php
        // Select query
        $sql = "SELECT id, name, image, description FROM categories";
        $stmt = $pdo->query($sql);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($results as $row) {
            if (isset($row["image"]) && $row["image"]) {
                $base64Image = base64_encode($row["image"]);
                $imageDataUri = "data:image/jpeg;base64," . $base64Image;
            }
            $editUrl = "_edit.php?id=" . $row["id"];
            $deleteUrl = "_delete.php?id=" . $row["id"];
            echo "<tr>
            <th scope='row'>" . htmlspecialchars($row["id"], ENT_QUOTES, 'UTF-8') . "</th>
            <td><img src='" . htmlspecialchars($imageDataUri, ENT_QUOTES, 'UTF-8') . "' height='75' alt='Photo'></td>
            <td>" . htmlspecialchars($row["name"], ENT_QUOTES, 'UTF-8') . "</td>
            <td><a href='" . htmlspecialchars($editUrl, ENT_QUOTES, 'UTF-8') . "' class='btn btn-primary'>Edit</a></td>
            <td><a href='" . htmlspecialchars($deleteUrl, ENT_QUOTES, 'UTF-8') . "' class='btn btn-primary'>Delete</a></td>
          </tr>";
        }
        ?>
        </tbody>
    </table>
</div>

<script src="/js/bootstrap.bundle.min.js"></script>
</body>
</html>
