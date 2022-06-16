<?php
include_once "connection.php";
$editMode = ($_POST["submit-button"] == "Edit");

$title = $_POST['article-title'];
$subtitle = $_POST['subtitle'];
$article_subtitle = $_POST['article-subtitle'];
$content = $_POST['content'];
$category = $_POST['category'];
$hidden = isset($_POST['hidden']);

$baseFilename = basename($_FILES['file']['name']);
$file_path = "img/" . $baseFilename;

$upload_file = true;

if ($baseFilename == "") {
    $upload_file = false;

    if ($editMode) {
        echo "File will not be updated";
    }
}

if (isset($_POST["submit-button"]) && $upload_file) {
    $check = false;
    try {
        $check = getimagesize($_FILES["file"]["tmp_name"]);
    } catch (ValueError $e) {
        $upload_file = false;
    }
    if ($check === false) {
        $upload_file = false;
        echo "File is not an image.";
    }
}

if (file_exists($file_path) && $upload_file) {
    $upload_file = false;

    $query = "SELECT * FROM news WHERE img = ?;";
    $stmt = $dbc->prepare($query);
    $stmt->bind_param("s", $baseFilename);
    try {
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        // If no article has the same image, we can upload the new one with the same name
        if (!$row) {
            $upload_file = true;
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }

    if (!$upload_file) {
        echo "File already exists.";
        exit;
    }
}

$fileType = strtolower(pathinfo($file_path, PATHINFO_EXTENSION));
if ($fileType != "jpg" && $fileType != "png" && $fileType != "jpeg" && $fileType != "gif" && $fileType != "webp" && $upload_file) {
    $upload_file = false;
    echo "Sorry, only JPG, JPEG, PNG, GIF & WEBP files are allowed.";
    exit;
}

if ($upload_file) {
    if (move_uploaded_file($_FILES["file"]["tmp_name"], $file_path)) {
        echo "The file " . htmlspecialchars(basename($_FILES["file"]["name"])) . " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
        exit;
    }
}

if (!$editMode) {
    $query = "INSERT INTO news (title, subtitle, article_subtitle, content, category_id, img, hidden) VALUES (?, ?, ?, ?, ?, ?, ?);";
    $stmt = $GLOBALS["dbc"]->prepare($query);

    $stmt->bind_param("ssssisi", $title, $subtitle, $article_subtitle, $content, $category, $baseFilename, $hidden);

    try {
        $stmt->execute();
        echo "<br>Successfully added article!";
    } catch (Exception $e) {
        echo "<br>Error: " . $e->getMessage();
    }
} else {
    $query = "UPDATE news 
    SET title = ?, 
    subtitle = ?, 
    article_subtitle = ?, 
    content = ?, 
    category_id = ?,"
        . ($upload_file ? " img = ?," : "")
        . "hidden = ? 
    WHERE id = ?;";

    $stmt = $GLOBALS["dbc"]->prepare($query);

    if ($upload_file) {
        $stmt->bind_param("ssssisii", $title, $subtitle, $article_subtitle, $content, $category, $baseFilename, $hidden, $_POST["id"]);
    } else {
        $stmt->bind_param("ssssiii", $title, $subtitle, $article_subtitle, $content, $category, $hidden, $_POST["id"]);
    }

    try {
        $stmt->execute();
        echo "<br>Successfully updated article!";
    } catch (Exception $e) {
        echo "<br>Error: " . $e->getMessage();
    }
}
