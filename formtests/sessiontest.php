<?php
session_start();

if (!isset($_SESSION['fake'])) {
    session_regenerate_id();
    $_SESSION['fake'] = 1;
}

if (!isset($_SESSION['count'])) $_SESSION['count'] = 0;
else ++$_SESSION['count'];

echo $_SESSION['count'];
