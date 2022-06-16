<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php
    require_once "connection.php";
    $article_id = $_GET['id'];
    $query = "SELECT * FROM news WHERE id = ?";
    $stmt = $dbc->prepare($query);
    $stmt->bind_param("i", $article_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $row = $result->fetch_assoc();
    ?>
    <title><?php echo $row['title'] ?></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="style/article.css">
    <link rel="stylesheet" href="style/shared.css">
</head>

<body>
    <?php
    include_once "header.php";
    ?>

    <div class="container g-0">
        <article class="container-fluid g-0">
            <?php
            echo '<h1 class="title">' . $row['title'] . '</h1>';
            echo '<img src="img/' . $row['img'] . '" alt="img' . $row['id'] . '">';
            echo '<p class="content">';
            echo '<span class="bold">' . $row['article_subtitle'] . '</span>';
            $content = str_replace("\n", "<br>", $row['content']);
            echo $content . '</p>';
            ?>
        </article>
    </div>

    <?php
    include_once "footer.html";
    ?>
</body>

</html>