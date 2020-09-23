<?php

function friendlyError($e) {
    return "<div class=\"error-message center\">".
            "<b>Error</b><br>".
            "Please contact system administrator. ".
            "<pre>Error message: <br>".$e."</pre>".
        "</div>";
}

$db_name = "apurbzz_lab_6";
$db_host = "localhost";
$db_username = "apurbzz";
$db_passwd = "fit2104";
$dsn = "mysql:host=$db_host;dbname=$db_name";

try {
    $dbh = new PDO($dsn, $db_username, $db_passwd);
} catch (PDOException $e) {
    die(friendlyError($e->getMessage()));
}