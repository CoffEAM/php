<?php
require_once '\Program Files\Ampps\www\login.php';

try{
    $pdo = new PDO($attr, $user, $pass, $opts);
}
catch (PDOException $e){
    throw new PDOException($e->getMessage(), (int)$e->getCode());
}

//$query = "CREATE TABLE cats (
//    id SMALLINT NOT NULL AUTO_INCREMENT,
//    family VARCHAR(32) NOT NULL,
//    name VARCHAR(32) NOT NULL,
//    age TINYINT NOT NULL,
//    PRIMARY KEY (id)
//)";
//
//$result = $pdo->query($query);

$query = "DESCRIBE cats";
$result = $pdo->query($query);

echo "<table><tr><th>Column</th><th>Type</th><th>Null</th><th>Key</th></tr>";

while ($row = $result->fetch(PDO::FETCH_NUM)) {
    echo "<tr>";
    for ($k = 0; $k < 4; ++$k){
        echo "<td>" . htmlspecialchars($row[$k]) . "</td>";
    }
    echo "</tr>";
}
echo "</table>";

//$query = "INSERT INTO cats VALUES(NULL, 'Lion', 'Leo', 4)";
//$result = $pdo->query($query);
//$query = "INSERT INTO cats VALUES(NULL, 'Cougar', 'Growler', 2)";
//$result = $pdo->query($query);
//$query = "INSERT INTO cats VALUES(NULL, 'Cheetah', 'Charly', 3)";
//$result = $pdo->query($query);

//$query = "UPDATE cats SET name='Charlie' WHERE name='Charly'";
//$result = $pdo->query($query);

//$query = "DELETE FROM cats WHERE name='Growler'";
//$result = $pdo->query($query);

//$query = "INSERT INTO cats VALUES(NULL, 'Lynx', 'Stumpy', 5)";
//$result = $pdo->query($query);
//echo "The Insert ID was: " . $pdo->lastInsertId();

//$query = "DELETE FROM cats WHERE id=6";
//$result = $pdo->query($query);

$query = "SELECT * FROM cats";
$result = $pdo->query($query);

echo "<table><tr><th>Id</th><th>Family</th><th>Name</th><th>Age</th></tr>";

while ($row = $result->fetch(PDO::FETCH_NUM)) {
    echo "<tr>";
    for ($k = 0; $k < 4; ++$k){
        echo "<td>" . htmlspecialchars($row[$k]) . "</td>";
    }
    echo "</tr>";
}
echo "</table>";
