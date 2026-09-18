<?php
    // Defaults match the mysql service in docker-compose.yml for local dev.
    // In production (e.g. Railway), these are supplied via environment variables.
    $db_host = getenv('MYSQLHOST') ?: 'db';
    $db_user = getenv('MYSQLUSER') ?: 'freespace';
    $db_pass = getenv('MYSQLPASSWORD') ?: 'freespace';
    $db_name = getenv('MYSQLDATABASE') ?: 'freespace';
    $db_port = getenv('MYSQLPORT') ?: 3306;

    $db = new mysqli($db_host, $db_user, $db_pass, $db_name, (int)$db_port);

    if ($db->connect_error) {
        die('Connection failed: ' . $db->connect_error);
    }
?>
