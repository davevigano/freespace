<?php
    // Copy this file to db.php (gitignored) and adjust credentials if needed.
    // The defaults below match the mysql service in docker-compose.yml.
    $db = new mysqli('db', 'freespace', 'freespace', 'freespace');

    if ($db->connect_error) {
        die('Connection failed: ' . $db->connect_error);
    }
?>
