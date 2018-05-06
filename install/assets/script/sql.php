<?php
function setPassword($type, $password)
{
    $sql = new PDO("sqlite:".getRoot()."/data.db");
    $password = password_hash($password, PASSWORD_DEFAULT);
    $sql->exec("INSERT INTO accounts (account_type, password) VALUES ('".$type."', '".$password."');");
}

function updatePassword($password)
{
    $sql = new PDO("sqlite:".getRoot()."/data.db");
    $password = password_hash($password, PASSWORD_DEFAULT);
    $sql->exec("UPDATE accounts SET password='".$password."' WHERE account_type='admin';");
}

function createTables(){
    debug();
    echo "create<br>";
    $sql = new PDO("sqlite:".getRoot()."/data.db");
    echo "connected<br>";
    $sql->exec("CREATE TABLE IF NOT EXISTS accounts (id INTEGER PRIMARY KEY, account_type VARCHAR(20), password TEXT);");
    $sql->exec("CREATE TABLE IF NOT EXISTS files (id INTEGER PRIMARY KEY, file TEXT, filename TEXT, permissions VARCHAR(4));");

    $sql->exec("CREATE TABLE IF NOT EXISTS feedback (id INTEGER PRIMARY KEY, stars INTEGER, content TEXT, author VARCHAR(30), feedback_date INTEGER);");
    $sql->exec("CREATE TABLE IF NOT EXISTS settings (id INTEGER PRIMARY KEY, setting TEXT, content TEXT);");
    $sql->exec("CREATE UNIQUE INDEX settings_idx ON settings(setting);");
    echo "created<br>";
}