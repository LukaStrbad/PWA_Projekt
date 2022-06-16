<?php
include_once "connection.php";

$query = "SELECT access_level FROM users WHERE id = ?;";
$stmt = $dbc->prepare($query);
$stmt->bind_param("i", $_POST["id"]);
try {
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if (!$row) {
        exit;
    }

    if ($row["access_level"] == 0) {
        $query = "UPDATE users SET access_level = 1 WHERE id = ?;";
        $stmt = $dbc->prepare($query);
        $stmt->bind_param("i", $_POST["id"]);
        try {
            $stmt->execute();
            echo "<h1>Successfully changed access level</h1>";
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    } else {
        $query = "UPDATE users SET access_level = 0 WHERE id = ?;";
        $stmt = $dbc->prepare($query);
        $stmt->bind_param("i", $_POST["id"]);
        try {
            $stmt->execute();
            echo "<h1>Successfully changed access level</h1>";
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
} catch (Exception $e) {
    echo $e->getMessage();
}
?>