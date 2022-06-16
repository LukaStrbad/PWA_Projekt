<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BZ Berlin</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="style/index.css">
    <link rel="stylesheet" href="style/shared.css">

</head>

<body>
    <?php
    include_once "header.php";
    include_once "connection.php";

    function section($row)
    {
        // Replaces spaces with -
        $name = str_replace(' ', '-', $row['name']);

        echo '<section id="' . $name . '" class="container g-0">';
        echo '<div class="container-fluid title">';
        $right_arrow = file_get_contents("img/right-arrow.svg");
        echo '<a href="index.php?category=' . $row['id'] . '">' . $row['name'] . $right_arrow . '</a>';
        echo '</div>';

        echo '<div class="container articles">';
        echo '<div class="row g-0">';

        $query = "SELECT id, title, subtitle, img FROM news WHERE category_id = ? AND hidden = false ORDER BY creation_date DESC";
        if (!isset($_GET["category"])) {
            $query = $query . " LIMIT 0,3";
        }
        $stmt = $GLOBALS["dbc"]->prepare($query);
        $stmt->bind_param("i", $row['id']);
        $stmt->execute();

        $result = $stmt->get_result();
        $count = 0;

        while ($article_row = $result->fetch_assoc()) {
            article($article_row);
            $count++;

            if (isset($_GET["category"])) {
                if ($count % 3 == 0) {
                    echo '</div>';
                    echo '<div class="row g-0">';
                }
            }
        }

        echo '</div>';
        echo '</div>';
        echo '</section>';
    }

    function article($row)
    {
        echo '<a href="article.php?id=' . $row['id']
            . '" class="article-link col-12 col-md-4">';
        echo '<article>';
        echo '<img src="img/' . $row['img'] . '" alt="img' . $row['id'] . '">';
        echo '<h6 class="subtitle">' . $row['subtitle'] . '</h6>';
        echo '<h4 class="title">' . $row['title'] . '</h4>';
        echo '</article>';
        echo '</a>';
    }

    $result = null;
    if (isset($_GET["category"])) {
        $query = "SELECT * FROM category WHERE id = ?;";
        $stmt = $GLOBALS["dbc"]->prepare($query);
        $stmt->bind_param("i", $_GET["category"]);
        $stmt->execute();

        $result = $stmt->get_result();
    } else {
        $query = "SELECT * FROM category;";
        $result = $dbc->query($query);
    }

    while ($row = $result->fetch_assoc()) {
        section($row);
    }

    ?>

    <?php
    include_once "footer.html";
    ?>
</body>

</html>