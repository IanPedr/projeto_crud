<?php
if(!empty($_GET['title']))
{

    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'financas_pessoais';

    $conection = new mysqli($servername, $username, $password, $database);

    if ($conection->connect_error) {
        die("Conexão falhou: ".$conection->connect_error);
    }

    $title = $_GET['title'];

    $sqlSelect = "SELECT * FROM transacao WHERE titulo = '$title'";

    $result = $conection->query($sqlSelect);

    if($result->num_rows > 0)
    {
        $sqlDelete = "DELETE FROM transacao WHERE titulo = '$title'";
        $resultDelete = $conection->query($sqlDelete);
    }
}

$response = array();
$response['status'] = 200;

echo json_encode($response);