<?php
require_once 'C:\Program Files\Ampps\www\login.php';

try {
    $pdo = new PDO($attr, $user, $pass, $opts);
}
catch (PDOException $e) {
    throw new PDOException($e->getMessage(), $e->getCode());
}

$query = 'CREATE TABLE IF NOT EXISTS users (
    forename VARCHAR(30) NOT NULL,
    surname VARCHAR(30) NOT NULL,
    username VARCHAR(30) NOT NULL,
    password VARCHAR(255) NOT NULL)';

$result = $pdo->query($query);

$query = 'ALTER TABLE users MODIFY password VARCHAR(255)';
$result = $pdo->query($query);

$forename = 'Bill';
$surname = 'Smith';
$username = 'bsmith';
$password = 'mysecret';
$hash = password_hash($password, PASSWORD_DEFAULT);
add_user($pdo, $forename, $surname, $username, $hash);

$forename = 'Pauline';
$surname = 'Jones';
$username = 'pjones';
$password = 'acrobat';
$hash = password_hash($password, PASSWORD_DEFAULT);

add_user($pdo, $forename, $surname, $username, $hash);

function add_user($pdo, $fn, $sn, $un, $pw) {
    $stmt = $pdo->prepare('INSERT INTO users VALUES(?,?,?,?)');
    $stmt->bindParam(1, $fn, PDO::PARAM_STR, 32);
    $stmt->bindParam(2, $sn, PDO::PARAM_STR, 32);
    $stmt->bindParam(3, $un, PDO::PARAM_STR, 32);
    $stmt->bindParam(4, $pw, PDO::PARAM_STR, 255);

    $stmt->execute([$fn, $sn, $un, $pw]);
}
