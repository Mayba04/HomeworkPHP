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
<?php include ("_header.php") ?>
<div class="container">

    <h4 class="text-center">Categories</h4>
    <?php
    $n=2;
    $list = array();
    $list[0] = [
        "id"=>1,
        "name"=>"Laptop",
        "image"=>"https://content1.rozetka.com.ua/goods/images/big/361687887.jpg"
    ];
    $list[1] = [
        "id"=>2,
        "name"=>"Phone",
        "image"=>"https://content1.rozetka.com.ua/goods/images/big/364824496.jpg"
    ];
    ?>
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
        <?php for($i=0;$i<$n;$i++) { ?>
            <tr>
                <th scope="row"><?php echo $list[$i]["id"]; ?></th>
                <td>
                    <img src="<?php echo $list[$i]["image"]; ?>"
                         height="75"
                         alt="Photo">
                </td>
                <td>
                    <?php echo $list[$i]["name"]; ?>
                </td>
                <td>
                    <a href="#" class="btn btn-info">Review</a>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>

</div>

<body>


<script src="/js/bootstrap.bundle.min.js"></script>
</body>
</html>