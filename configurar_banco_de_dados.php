<?php 

$servername = 'localhost';
$username = 'root';
$password = '';
$database = 'financas_pessoais';


$conexao = new mysqli($servername, $username, $password);

if (mysqli_query($conexao, "CREATE DATABASE IF NOT EXISTS financas_pessoais")) {
    // echo "db created";

    $conection = new mysqli($servername, $username, $password, $database);

    $sqlCreateTable = "CREATE TABLE transacao (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        titulo VARCHAR(50) NOT NULL,
        valor VARCHAR(50) NOT NULL
    )";

    if ($conection->query($sqlCreateTable) === TRUE) {
        echo "Tabela criada com sucesso";
    } else {
        echo "Erro ao criar tabela". $conection->error;
    }

} else {
    echo "error creating database";
}
?>
<!-- 
// $servername = 'localhost';
// $username = 'root';
// $password = '';
// $database = 'financas_pessoais';

// $conection = new mysqli($servername, $username, $password, $database);

// if ($conection->connect_error) {
//     die("Conexão falhou: ".$conection->connect_error);
// }

// $sqlCreateTable = "CREATE TABLE transacao (
//     id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
//     titulo VARCHAR(50) NOT NULL,
//     valor VARCHAR(50) NOT NULL
// )";

// if ($conection->query($sqlCreateTable) === TRUE) {
//     echo "Tabela criada com sucesso";
// } else {
//     echo "Erro ao criar tabela". $conection->error;
// }

// $sqlInsertData = "INSERT INTO super_heroes (nome, poder) VALUES 
// ('homem-aranha', 'agilidade e teias de aranha'),
// ('mulher-maravilha', 'força e habilidade divina'),
// ('homem-de-ferro', 'tecnologia avançada e armadura'),
// ('flash', 'super velocidade'),
// ('thor', 'poderes divinos e martelo mágico')";

// if($conection->query($sqlInsertData) === TRUE) {
//     echo "Dados inseridos";
// } else {
//     echo "Erro ao inserir dados" . $conection->error;
// }

// $sqlSelectData = "SELECT nome, poder FROM super_heroes";
// $result = $conection->query($sqlSelectData);

// if ($result->num_rows > 0) {
//     echo "<br><br>Super-heroes: <br>";
//     while($row = $result->fetch_assoc()) {
//         echo "Nome: " . $row['nome'] . " Poder: " . $row['poder'] . "<br><br>";
//     }
// } else {
//     echo "nenhum super heroi encontrado";
// }

// ?> -->