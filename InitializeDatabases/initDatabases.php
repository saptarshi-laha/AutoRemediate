<?php

include "connectionStrings.php";

try {
    $pdo = new PDO($mysql_connectionString_root, $mysql_username_root, $mysql_password_root);

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    error_log("PDO Connection Successful ($mysql_username_root) (initDatabases.php)");

    $sql = "DROP DATABASE IF EXISTS AutoRemediateDB;
    DROP USER IF EXISTS '$mysql_username_user'@'localhost';
    FLUSH PRIVILEGES;";
    $pdo->exec($sql);
    error_log("Dropped Previous Database & User Entries ($mysql_username_root) (initDatabases.php)");

    $sql = "CREATE DATABASE IF NOT EXISTS AutoRemediateDB;
    CREATE USER IF NOT EXISTS '$mysql_username_user'@'localhost' IDENTIFIED BY '$mysql_password_user';
    GRANT ALL ON AutoRemediateDB.* TO '$mysql_username_user'@'localhost';
    FLUSH PRIVILEGES;";
    $pdo->exec($sql);
    error_log("Created New Database & User Entries ($mysql_username_root) (initDatabases.php)");

    $pdo = null;
    error_log("PDO Connection Closed Successfully! ($mysql_username_root) (initDatabases.php)");

    try {
        $pdo = new PDO($mysql_connectionString_user_AutoRemediateDB, $mysql_username_user, $mysql_password_user);

        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        error_log("PDO Connection Successful ($mysql_username_user) (initDatabases.php)");

        //Insert Table Information Here

        $pdo = null;
        error_log("PDO Connection Closed Successfully! ($mysql_username_user) (initDatabases.php)");

        }
        catch (PDOException $e){
            error_log("PDOException ($mysql_username_user) (initDatabases.php) ".$e->getMessage());
        }

    //Success HTML Here


} catch (PDOException $e) {
    error_log("PDOException ('$mysql_username_root') (initDatabases.php) ".$e->getMessage());

    //Error HTML Here!
}