<?php 

$servername = 'localhost';
$username = 'root';
$password = '';
$database = 'financas_pessoais';

$conection = new mysqli($servername, $username, $password, $database);

if ($conection->connect_error) {
    die("Conexão falhou: ".$conection->connect_error);
}

$sqlSelectData = "SELECT titulo, valor FROM transacao";
$result = $conection->query($sqlSelectData);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
        // echo  $row['titulo'] . " R$" . $row['valor'] . ',00' . "<br>";
    }
    
    echo json_encode(array(
        "status_code"=> 200,
        "dados"=> $data
    ));

    // imprime na tela
    // echo "<br><br>Transacoes: <br>";
    // while($row = $result->fetch_assoc()) {
    //     echo  $row['titulo'] . " R$" . $row['valor'] . ',00' . "<br>";
    // }
} else {
    echo "nenhuma transação encontrada";
}

?>