<?php
try {
    $GLOBALS["dbc"] = new mysqli('localhost', 'root', '', 'projekt');
} catch (Exception $e) {
    echo '<h1>Baza podataka nije dostupna</h1>';
    exit;
}

if (!$dbc) {
    exit;
}
?>