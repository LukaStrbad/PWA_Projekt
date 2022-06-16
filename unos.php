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

</head>

<body>
    <?php
    session_start();
    include_once "header.php";
    include_once "connection.php";

    if ($_SESSION["access_level"] != 0) {
        echo "<h1>You don't have access to this page</h1>";
        include_once "footer.html";
        exit;
    }
    ?>

    <div class="container">
        <?php
        // Default array with empty values
        $row = array(
            "title" => "",
            "subtitle" => "",
            "article_subtitle" => "",
            "content" => "",
            "img" => "",
            "category_id" => "",
            "hidden" => "",
        );
        if (isset($_GET["id"])) {
            echo "<h3 id='edit-mode'>You're in edit mode</h3>";
            $query = "SELECT * FROM news WHERE id = ?;";
            $stmt = $dbc->prepare($query);
            $stmt->bind_param("i", $_GET["id"]);
            try {
                $stmt->execute();
                $result = $stmt->get_result();
                $row = $result->fetch_assoc();

                if (!$row) {
                    echo "<h1>Error</h1>";
                    include_once "footer.html";
                }
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        }
        ?>
        <form action="skripta.php" method="post" enctype="multipart/form-data">
            <label for="title">Title:</label>
            <textarea name="article-title" id="article-title" cols="30" rows="2"><?php echo $row["title"]; ?></textarea>
            <span id="title-error" class="error"></span>

            <label for="subtitle">Subtitle:</label>
            <input type="text" name="subtitle" id="subtitle" value="<?php echo $row["subtitle"]; ?>">
            <span id="subtitle-error" class="error"></span>

            <label for="article-subtitle">Short description:</label>
            <textarea name="article-subtitle" id="article-subtitle" cols="30" rows="3"><?php echo $row["article_subtitle"]; ?></textarea>
            <span id="article-subtitle-error" class="error"></span>

            <label for="contnet">Content:</label>
            <textarea name="content" id="content" cols="60" rows="10"><?php echo $row["content"]; ?></textarea>
            <span id="content-error" class="error"></span>

            <label for="file">Image:</label>
            <input type="file" name="file" id="file">
            <span id="file-error" class="error"><?php if (isset($_GET["id"])) {
                                                    echo "NOTE: Select a new file to replace the old one";
                                                } ?></span>

            <label for="category">Category</label>
            <select name="category" id="category">
                <?php
                $query = "SELECT * FROM category;";
                $result = $dbc->query($query);

                while ($categoryRow = $result->fetch_assoc()) {
                    echo '<option value="' . $categoryRow['id'] . '"' .
                        ($row["category_id"] == $categoryRow["id"] ? "selected" : "") . '>'
                        . ucwords($categoryRow['name']) . '</option>';
                }
                ?>
            </select>
            <span id="category-error" class="error"></span>

            <label for="hidden">Hidden</label>
            <input type="checkbox" name="hidden" id="hidden" <?php echo ($row["hidden"] ? "checked" : ""); ?>>

            <input name="submit-button" id="submit-button" type="submit" class="button" value="<?php echo (isset($_GET["id"]) ? "Edit" : "Submit"); ?>" onclick="sendForm()">
        </form>

        <script>
            function sendForm() {
                let send = true;
                let editMode = !!document.getElementById("edit-mode");

                let title = document.getElementById("article-title");

                if (title.value.length < 5 || title.value.length > 30) {
                    document.getElementById("title-error").innerHTML = "Title must be between 5 and 30 characters";
                    title.classList.add("error");
                    send = false;
                } else {
                    document.getElementById("title-error").innerHTML = "";
                    title.classList.remove("error");
                }

                let subtitle = document.getElementById("subtitle");

                if (subtitle.value.length < 5 || subtitle.value.length > 30) {
                    document.getElementById("subtitle-error").innerHTML = "Subtitle must be between 5 and 30 characters";
                    subtitle.classList.add("error");
                    send = false;
                } else {
                    document.getElementById("subtitle-error").innerHTML = "";
                    subtitle.classList.remove("error");
                }

                let articleSubtitle = document.getElementById("article-subtitle");

                if (articleSubtitle.value.length < 10 || articleSubtitle.value.length > 100) {
                    document.getElementById("article-subtitle-error").innerHTML = "Article subtitle must be between 10 and 100 characters";
                    articleSubtitle.classList.add("error");
                    send = false;
                } else {
                    document.getElementById("article-subtitle-error").innerHTML = "";
                    articleSubtitle.classList.remove("error");
                }

                let content = document.getElementById("content");

                if (content.value.length == 0) {
                    document.getElementById("content-error").innerHTML = "Content must not be empty";
                    content.classList.add("error");
                    send = false;
                } else {
                    document.getElementById("content-error").innerHTML = "";
                    content.classList.remove("error");
                }

                let file = document.getElementById("file");

                if (editMode && file.value.trim() == "") {
                    document.getElementById("file-error").innerHTML = "";
                    file.classList.remove("error");
                } else if (!file.value.endsWith(".jpg") &&
                    !file.value.endsWith(".png") &&
                    !file.value.endsWith(".jpeg") &&
                    !file.value.endsWith(".gif") &&
                    !file.value.endsWith(".webp")) {
                    document.getElementById("file-error").innerHTML = "File must be jpg, png, jpeg, gif or webp";
                    file.classList.add("error");
                    send = false;
                } else {
                    document.getElementById("file-error").innerHTML = "";
                    file.classList.remove("error");
                }

                let category = document.getElementById("category");

                if (category.value != 1 && category.value != 2) {
                    document.getElementById("category-error").innerHTML = "Category must be selected";
                    category.classList.add("error");
                    send = false;
                } else {
                    document.getElementById("category-error").innerHTML = "";
                    category.classList.remove("error");
                }

                event.preventDefault();

                if (send) {
                    let xhr = new XMLHttpRequest();
                    xhr.open("POST", "skripta.php", true);

                    let formData = new FormData(document.querySelector("form"));
                    formData.append("submit-button", document.getElementById("submit-button").value);
                    if (editMode) {
                        formData.append("id", "<?php echo (isset($_GET["id"]) ? $_GET["id"] : ""); ?>");
                    }

                    xhr.onload = function() {
                        let id = "<?php
                                    if (isset($_GET["id"])) {
                                        echo $_GET["id"];
                                    } else {
                                        $query = "SELECT id FROM news ORDER BY creation_date DESC LIMIT 1;";
                                        $result = $dbc->query($query);
                                        $row = $result->fetch_assoc();
                                        echo $row["id"];
                                    } ?>";
                        if (xhr.status == 200) {
                            console.log(xhr.responseText);
                            window.location.href = `article.php?id=${id}`;
                        } else {
                            alert("Error: " + xhr.status);
                        }
                    }

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