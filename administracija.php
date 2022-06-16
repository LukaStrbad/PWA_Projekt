<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BZ Berlin</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="style/shared.css">
    <link rel="stylesheet" href="style/administracija.css">

</head>

<body>
    <?php
    session_start();
    include_once "header.php";
    include_once "connection.php";

    $query = "SELECT access_level FROM users WHERE username = ?;";
    $stmt = $dbc->prepare($query);
    $stmt->bind_param("s", $_SESSION["username"]);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    $_SESSION["access_level"] = $row["access_level"];
    ?>

    <div class="container">
        <?php
        if (isset($_SESSION["username"]) && isset($_SESSION["access_level"])) {
            if ($_SESSION["access_level"] == 1) {
                echo "<h3>Hello " . $_SESSION["username"] . "! You're not an administrator</h3>";
            } else if ($_SESSION["access_level"] == 0) {
                echo "<h3>Hello " . $_SESSION["username"] . "!</h3>";

                echo '<a href="unos.php" class="button">Enter a new article</a>';

                $query = "SELECT news.*, category.name AS categoryName FROM news INNER JOIN category ON news.category_id = category.id;";
                $result = $dbc->query($query);

                echo "<h4>News</h4>";
                echo "<table id='news'>";
                echo "<tr>";
                echo "<th>Options</th>";
                echo "<th>Title</th>";
                echo "<th>Subtitle</th>";
                echo "<th>Article subtitle</th>";
                echo "<th>Content</th>";
                echo "<th>Image</th>";
                echo "<th>Category</th>";
                echo "<th>Date</th>";
                echo "<th>Hidden</th>";
                echo "</tr>";

                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td><a href='unos.php?id=" . $row["id"] . "'>Edit</a> | <a href='' onclick='deleteArticle(" . $row["id"] . ")'>Delete</a></td>";
                    echo "<td>" . $row["title"] . "</td>";
                    echo "<td>" . $row["subtitle"] . "</td>";
                    echo "<td>" . $row["article_subtitle"] . "</td>";
                    echo "<td>" . $row["content"] . "</td>";
                    echo "<td><img src='img/" . $row["img"] . "' alt='" . $row["title"] . "'></td>";
                    echo "<td>" . $row["categoryName"] . "</td>";
                    echo "<td>" . $row["creation_date"] . "</td>";
                    echo "<td>" . ($row["hidden"] ? "Yes" : "No") . "</td>";

                    echo "</tr>";
                }
                echo "</table>";

                echo "<h4>Users</h4>";
                echo "<table id='users'>";
                echo "<tr>";
                echo "<th>Options</th>";
                echo "<th>Name</th>";
                echo "<th>Surname</th>";
                echo "<th>Username</th>";
                echo "<th>Access level</th>";
                echo "</tr>";

                $query = "SELECT * FROM users;";
                $result = $dbc->query($query);

                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    $question = $row["access_level"] == 0 ? "Remove administrator privileges" : "Promote user to administrator";
                    echo "<td><a href='' onclick='changeLevel(" . $row["id"] . ")'>$question</a> | <a href='' onclick='deleteUser(" . $row["id"] . ")'>Delete user</a></td>";
                    echo "<td>" . $row["name"] . "</td>";
                    echo "<td>" . $row["surname"] . "</td>";
                    echo "<td>" . $row["username"] . "</td>";
                    echo "<td>" . ($row["access_level"] == 0 ? "Administrator" : "User") . "</td>";

                    echo "</tr>";
                }
                echo "</table>";
            }
            echo '<a href="logout.php" class="button">Logout</a>';
        } else {
            echo "<h3>You're not supposed to be here!</h3>";
        }
        ?>

        <script>
            function deleteArticle(id) {
                event.preventDefault();

                if (confirm("Are you sure you want to delete this article?")) {
                    let xhr = new XMLHttpRequest();
                    xhr.open("POST", "deleteArticle.php", true);

                    xhr.onload = function() {
                        console.log(xhr.responseText);
                        window.location.reload();
                    }

                    let formData = new FormData();
                    formData.append("id", `${id}`);
                    xhr.send(formData);
                }
            }

            function deleteUser(id) {
                event.preventDefault();

                if (confirm("Are you sure you want to delete this user?")) {
                    let xhr = new XMLHttpRequest();
                    xhr.open("POST", "deleteUser.php", true);

                    xhr.onload = function() {
                        console.log(xhr.responseText);
                        window.location.reload();
                    }

                    let formData = new FormData();
                    formData.append("id", `${id}`);
                    xhr.send(formData);
                }
            }

            function changeLevel(id) {
                event.preventDefault();

                if (confirm("Are you sure you want to change this user's access level?")) {
                    let xhr = new XMLHttpRequest();
                    xhr.open("POST", "changeAccessLevel.php", true);

                    xhr.onload = function() {
                        console.log(xhr.responseText);
                        window.location.reload();
                    }

                    let formData = new FormData();
                    formData.append("id", `${id}`);
                    xhr.send(formData);
                }
            }
        </script>
    </div>

    <?php
    include_once "footer.html";
    ?>
</body>

</html>