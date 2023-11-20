<?php 

$servername = 'localhost';
$username = 'root';
$password = '';
$database = 'financas_pessoais';

$conection = new mysqli($servername, $username, $password, $database);

if ($conection->connect_error) {
    die("Conexão falhou: ".$conection->connect_error);
}

$sqlSelectData = "SELECT titulo, valor, tipo FROM transacao";
$result = $conection->query($sqlSelectData);

$total_entrada = 0;
$total_saida = 0;

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        if ($row['tipo'] == 'entrada') {
            $total_entrada += $row['valor'];
        }

        if ($row['tipo'] == 'saida') {
            $total_saida += $row['valor'];
        }
        $data[] = $row;

        // echo  $row['titulo'] . " R$" . $row['valor'] . ',00' . "<br>";
    }

    
    echo json_encode(array(
        "status_code"=> 200,
        "dados"=> $data,
        "total_entrada"=> $total_entrada,
        "total_saida"=> $total_saida,
        "total" => $total_entrada - $total_saida
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