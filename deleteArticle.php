<?php
include_once "connection.php";

$query = "DELETE FROM news WHERE id = ?;";
$stmt = $dbc->prepare($query);
$stmt->bind_param("i", $_POST["id"]);
try {
    $stmt->execute();
    echo "<h1>Successfully deleted</h1>";
} catch (Exception $e) {
    echo $e->getMessage();
}
?>
