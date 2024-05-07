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

$output = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    //$eventosJSON = $_POST['eventosJSON'];
    //$eventos = json_decode($eventosJSON);

   //echo $eventos[0]->start;

    $output .= '<table>
                    <tr>
                        <th>Ejercicio</th>
                        <th>Fecha de Inicio del Periodo que se Informa</th>
                        <th>Fecha de Término del Periodo que se Informa</th>
                        <th>Nombre del Juez o Magistrado</th>
                        <th>Hipervinculo a la agenda de audiencias</th>
                        <th>Juzgado</th>
                        <th>Fecha de Actualizacion</th>
                        <th>Nota</th>
                    </tr>
                ';
    
    $output .= '<tr>
                    <td>2024</td>
                    <td>22-05-2024</td>
                    <td>23-05-2024</td>
                    <td>Felipe Rubio</td>
                    <td>link</td>
                    <td>Segundo mercantil</td>
                    <td>24-05-2024</td>
                    <td></td>
                </tr>';

    $output.= '</table>';

    $archivo = fopen("Agendas.xls","w");
    fwrite($archivo, $output);
    fclose($archivo);
    
}
