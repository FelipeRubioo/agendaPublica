<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "stj";
// Create connection
$conn = new mysqli($servername, $username, $password, $database);

$query = "SELECT * FROM lg_audiencia";
$result = $conn->query($query);

//todos los resultados
$filas = $result->fetch_all(MYSQLI_ASSOC);

$eventosJSON = json_encode($filas);

$output = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $eventosJSON = $_POST['eventosJSON'];
    $eventos = json_decode($eventosJSON);

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
    for ($i=0; $i < count($eventos) ; $i++) { 
        $output .= '<tr>
                    <td>'.$eventos[$i]->extendedProps->ejercicio.'</td>
                    <td>'.$eventos[$i]->start.'</td>
                    <td>'.$eventos[$i]->extendedProps->fechaFin.'</td>
                    <td>'.$eventos[$i]->extendedProps->juez.'</td>
                    <td>link</td>
                    <td>'.$eventos[$i]->extendedProps->juzgado .'</td>
                    <td>'.$eventos[$i]->extendedProps->fechaActualizacion.'</td>
                    <td></td>
                </tr>';
    }

    $output.= '</table>';

    $archivo = fopen("Agendas.xls","w");
    fwrite($archivo, $output);
    fclose($archivo);
}
