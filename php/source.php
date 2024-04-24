<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "stj";
// Create connection
$conn = new mysqli($servername, $username, $password, $database);

$query = "SELECT * FROM evento";
$result = $conn->query($query);

//todos los resultados
$filas = $result->fetch_all(MYSQLI_ASSOC);

$eventosJSON = json_encode($filas);

