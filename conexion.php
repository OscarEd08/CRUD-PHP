<?php

$host = "localhost";
$user = "root";
$password = "";
$dbname = "parcial";

$conn = mysqli_connect($host, $user, $password, $dbname);

if (!$conn) {
    die("Error de conexión: " . mysqli_connect_error());
}