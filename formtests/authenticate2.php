<?php
require_once '/Users/aziz0/OneDrive/Документы/Main/WebDev/Test1/login.php';

try {
    $pdo = new PDO($attr, $user, $pass, $opts);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

if (isset($_SERVER['PHP_AUTH_USER']) && isset($_SERVER['PHP_AUTH_PW'])) {
    $un_temp = sanitize($pdo, $_SERVER['PHP_AUTH_USER']);
    $pw_temp = sanitize($pdo, $_SERVER['PHP_AUTH_PW']);
    $query = "SELECT * FROM users WHERE username = " . $un_temp;
    $result = $pdo->query($query);

    if (!$result->rowCount()) die ("User not found");

    $row = $result->fetch();
    $fn = $row['forename'];
    $sn = $row['surname'];
    $un = $row['username'];
    $pw = $row['password'];

    if (password_verify(str_replace("'", "", $pw_temp), $pw)){
        session_start();
        $_SESSION['forename'] = $fn;
        $_SESSION['surname'] = $sn;

        echo htmlspecialchars("$fn $sn : Привет, $fn, теперь вы зарегистрированы под именем '$un'");
        die ("<p><a href='continue.php'>Щелкните для продолжения</a></p>");
    }
    else die("Неверная комбинация имя пользователя - пароль");
}
else {
    header('WWW-Authenticate: Basic realm="Restricted Area"');
    header('HTTP/1.0 401 Unauthorized');
    die ("Пожалуйста, введите имя пользователя и пароль");
}

function sanitize($pdo, $str) {
    $str = htmlentities($str);
    return $pdo->quote($str);
}

