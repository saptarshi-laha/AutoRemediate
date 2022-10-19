<?php

if(isset($_SERVER['REMOTE_ADDR']) && isset($_SERVER['HTTP_X_FORWARDED_FOR']) && isset($_SERVER['HTTP_CLIENT_IP'])) {
    error_log("Remote Address Data - " . $_SERVER['REMOTE_ADDR'] . ". X-Forwarded Data - " . $_SERVER['HTTP_X_FORWARDED_FOR'] . ". HTTP IP Data - " . $_SERVER['HTTP_CLIENT_IP'] . ". (initDatabases.php)");
}
else if(isset($_SERVER['REMOTE_ADDR']) && isset($_SERVER['HTTP_X_FORWARDED_FOR'])){
    error_log("Remote Address Data - " . $_SERVER['REMOTE_ADDR'] . ". X-Forwarded Data - " . $_SERVER['HTTP_X_FORWARDED_FOR'] . ". (initDatabases.php)");
}
else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']) && isset($_SERVER['HTTP_CLIENT_IP'])){
    error_log("X-Forwarded Data - " . $_SERVER['HTTP_X_FORWARDED_FOR'] . ". HTTP IP Data - " . $_SERVER['HTTP_CLIENT_IP'] . ". (initDatabases.php)");
}
else if(isset($_SERVER['REMOTE_ADDR']) && isset($_SERVER['HTTP_CLIENT_IP'])){
    error_log("Remote Address Data - " . $_SERVER['REMOTE_ADDR'] . ". HTTP IP Data - " . $_SERVER['HTTP_CLIENT_IP'] . ". (initDatabases.php)");
}
else if(isset($_SERVER['REMOTE_ADDR'])){
    error_log("Remote Address Data - " . $_SERVER['REMOTE_ADDR'] . ". (initDatabases.php)");
}
else if(isset($_SERVER['HTTP_X_FORWARDED_FOR'])){
    error_log("X-Forwarded Data - " . $_SERVER['HTTP_X_FORWARDED_FOR'] . ". (initDatabases.php)");
}
else if(isset($_SERVER['HTTP_CLIENT_IP'])){
    error_log("HTTP IP Data - " . $_SERVER['HTTP_CLIENT_IP'] . ". (initDatabases.php)");
}

include "../Shared/connectionStrings.php";

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

        $sql = "CREATE TABLE IF NOT EXISTS MSSP_Users(ID INT(255) AUTO_INCREMENT PRIMARY KEY NOT NULL, Email VARCHAR(256) NOT NULL UNIQUE, Password VARCHAR(1000) NOT NULL, Role INT(1) NOT NULL DEFAULT 1);
CREATE TABLE IF NOT EXISTS Client_List(ID INT(255) AUTO_INCREMENT PRIMARY KEY NOT NULL, ClientID VARCHAR(10) NOT NULL UNIQUE, ClientName VARCHAR(500) NOT NULL);
CREATE TABLE IF NOT EXISTS Client_Users(ID INT(255) AUTO_INCREMENT PRIMARY KEY NOT NULL, ClientID VARCHAR(10) NOT NULL UNIQUE, Email VARCHAR(256) NOT NULL UNIQUE, Password VARCHAR(1000) NOT NULL);
CREATE TABLE IF NOT EXISTS AES_KEY(ID INT(255) AUTO_INCREMENT PRIMARY KEY NOT NULL, ClientID VARCHAR(10) NOT NULL UNIQUE, Email VARCHAR(256) NOT NULL UNIQUE, AES VARCHAR(1024) NOT NULL);
CREATE TABLE IF NOT EXISTS RSA_KEY(ID INT(255) AUTO_INCREMENT PRIMARY KEY NOT NULL, ClientID VARCHAR(10) NOT NULL UNIQUE, Email VARCHAR(256) NOT NULL UNIQUE, Public VARCHAR(1024) NOT NULL, Private VARCHAR(1024) NOT NULL);";
        $pdo->exec($sql);
        error_log("Created Tables & Default User Entry ($mysql_username_user) (initDatabases.php)");

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