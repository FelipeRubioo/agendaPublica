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

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $eventosJSON = $_POST['eventosJSON'];
    $eventos = json_decode($eventosJSON);

    echo $eventos[0]->start;

    // $filename = basename($_GET['file']);
    // $filepath = 'destination/' . $filename;
    //creamos archivo
    $nombreArchivo = "Agenda.csv";
    $texto = "mensaje de prueba";
    $Archivo = fopen($nombreArchivo, "w");
    fwrite($Archivo, $texto);
    fclose($Archivo);

    // Set headers for file download
    header('Content-Disposition: attachment; filename='.$nombreArchivo);
    header('Content-Length: ' . filesize($nombreArchivo));
    readfile($nombreArchivo);
    exit();
    //fwrite("Agenda.csv", $texto);
    //Define Headers
    /* header("Cache-Control: public");
    header("Content-Description: FIle Transfer");
    header("Content-Disposition: attachment; filename= $nombreArchivo ");
    header("Content-Type: application/zip");
    header("Content-Transfer-Emcoding: binary");

    readfile($nombreArchivo); */
    
}
