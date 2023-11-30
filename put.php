<?php

// Conecte-se ao banco de dados (substitua essas informações pelas suas)
$servername = 'localhost';
$username = 'root';
$password = '';
$database = 'financas_pessoais';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

try {
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Erro de conexão com o banco de dados: ' . $e->getMessage();
    die();
}

// Verifica se a solicitação é do tipo PUT
if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    // Obtém os dados do corpo da requisição
    $data = json_decode(file_get_contents('php://input'), true);

    // Verifica se os dados necessários estão presentes
    if (isset($data['id']) && isset($data['titulo']) && isset($data['valor']) && isset($data['tipo'])) {
        $id = $data['id'];
        $titulo = $data['titulo'];
        $valor = $data['valor'];
        $tipo = $data['tipo'];

        // Atualiza o registro no banco de dados
        $stmt = $pdo->prepare("UPDATE sua_tabela SET titulo = ?, valor = ?, tipo = ? WHERE id = ?");
        $stmt->execute([$titulo, $valor, $tipo, $id]);

        // Retorna uma resposta JSON indicando sucesso
        echo json_encode(['success' => true]);
    } else {
        // Retorna uma resposta JSON indicando erro de dados ausentes
        echo json_encode(['error' => 'Dados incompletos']);
    }
} else {
    // Retorna uma resposta JSON indicando método de requisição inválido
    echo json_encode(['error' => 'Método de requisição inválido']);
}
?>