<?php
require_once '\Program Files\Ampps\www\login.php';

echo <<<_END
<html>
<head>
<title>Авторизация</title>
</head>
<body>
<pre>
    Введите имя пользователя и пароль: <br>
    <form method='post' action="">
        Логин <input type="text" name="user"> <br>
        Пароль <input type="password" name="pass"> <br>
        <input type="submit" value="Авторизоваться"> <br>
    </form>
    </pre>
</body>
</html>

_END;


try {
    $pdo = new PDO($attr, $user, $pass, $opts);
}
catch (PDOException $e) {
    throw new PDOException($e->getMessage(), (int)$e->getCode());
}

if (isset($_POST['user']) && isset($_POST['pass'])) {
    $un_temp = sanitize($pdo, $_POST['user']);
    $pw_temp = sanitize($pdo, $_POST['pass']);
    $query = 'SELECT * FROM users WHERE username = ' . $un_temp;
    $result = $pdo->query($query);

    if (!$result->rowCount()) {
        die("User not found");
    }

    $row = $result->fetch();
    $fn = $row['forename'];
    $sn = $row['surname'];
    $un = $row['username'];
    $pw = $row['password'];

    if (password_verify(str_replace( "'", "", $pw_temp), $pw)) {
        echo htmlspecialchars("$fn $sn : Hi $fn, 
        you are logged in as '$un'");
    } else die("Invalid username or password");
}

//if (isset($_SERVER['PHP_AUTH_USER']) && isset($_SERVER['PHP_AUTH_PW'])) {
//    $un_temp = sanitize($pdo, $_SERVER['PHP_AUTH_USER']);
//    $pw_temp = sanitize($pdo, $_SERVER['PHP_AUTH_PW']);
//    $query = 'SELECT * FROM users WHERE username = ' . $un_temp;
//    $result = $pdo->query($query);
//
//    if (!$result->rowCount()) {
//        die("User not found");
//    }
//
//    $row = $result->fetch();
//    $fn = $row['forename'];
//    $sn = $row['surname'];
//    $un = $row['username'];
//    $pw = $row['password'];
//
//    if (password_verify(str_replace( "'", "", $pw_temp), $pw)) {
//        echo htmlspecialchars("$fn $sn : Hi $fn,
//        you are logged in as '$un'");
//    } else die("Invalid username or password");
//}
//else {
//    header('WWW-Authenticate: Basic realm="Access denied"');
//    header('HTTP/1.0 401 Unauthorized');
//    die ("Please enter username and password");
//}

function sanitize($pdo, $str) {
    $str = htmlentities($str);
    return $pdo->quote($str);
}
