<?php

    $method = $_SERVER['REQUEST_METHOD'];

    if ($method == 'POST') {
        $raw_data = file_get_contents("php://input"); // Read the raw JSON data
        $data_received = json_decode($raw_data);

        $titulo_v = $data_received->titulo;
        $valor_v = $data_received->valor;
        $tipo_v = $data_received->tipo;

        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "financas_pessoais";

        try {
            $connection = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sqlInsertData = "INSERT INTO transacao (titulo, valor, tipo) VALUES (:titulo, :valor, :tipo)";
            $stmt = $connection->prepare($sqlInsertData);        
            if ($stmt) {
                // Bind parameters
                $stmt->bindParam(':titulo', $titulo_v, PDO::PARAM_STR);
                $stmt->bindParam(':valor', $valor_v, PDO::PARAM_STR);
                $stmt->bindParam(':tipo', $tipo_v, PDO::PARAM_STR);

                

                if ($stmt->execute()) {
                    echo json_encode(array(
                        "status_code" => 200,
                        "detail"=> "Data inserted successfully",
                        "dados"=> $data_received
                    ));
                } else {
                    echo "Error: " . implode(" - ", $stmt->errorInfo());
                }
            } else {
                echo "Error: Unable to prepare the statement";
            }

        } catch(PDOException $e) {
            echo "Connection in db failed: " . $e->getMessage();
        }

    } else  {
        echo "Você fez uma requisição GET... EU SÓ ACEITO POST!";
    }

?>