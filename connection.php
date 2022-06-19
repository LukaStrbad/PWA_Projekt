<?php
try {
    $GLOBALS["dbc"] = new mysqli('localhost', 'root', '', 'pwa_projekt_luka_strbad');
} catch (Exception $e) {
    echo '<h1>Baza podataka nije dostupna</h1>';
    exit;
}

if (!$dbc) {
    exit;
}
?>