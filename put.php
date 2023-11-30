<?php

$servername = 'localhost';
$username = 'root';
$password = '';
$database = 'financas_pessoais';

$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

            // Recupera o título da URL
            $title = $_GET['title'];
            $value = $_GET['value'];
            $type = $_GET['type'];

            // Atualiza o registro no banco de dados
            $stmt = $conn->prepare("UPDATE transacao SET titulo = ?, valor = ?, tipo = ? WHERE titulo = ?");
            $stmt->bind_param("ssss", $title, $value, $type, $title);
            $stmt->execute();

            // Retorna uma resposta JSON indicando sucesso
            echo json_encode(['status' => 200]);

$conn->close();
?>
