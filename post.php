<?php

    $method = $_SERVER['REQUEST_METHOD'];

    if ($method == 'POST') {
        $raw_data = file_get_contents("php://input"); // Read the raw JSON data
        $data_received = json_decode($raw_data);

        $titulo_v = $data_received->titulo;
        $valor_v = $data_received->valor;

        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "financas_pessoais";

        try {
            $connection = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // returns a json response saying that connected in the db
            // echo json_encode(array(
            //     "status_code" => 200,
            //     "detail" => "Connected successfully"));

            // $sqlInsertData = "INSERT INTO transacao (titulo, valor) VALUES
            //     ($titulo_v, $valor_v)";
            $sqlInsertData = "INSERT INTO transacao (titulo, valor) VALUES (:titulo, :valor)";
            $stmt = $connection->prepare($sqlInsertData);        
            if ($stmt) {
                // Bind parameters
                $stmt->bindParam(':titulo', $titulo_v, PDO::PARAM_STR);
                $stmt->bindParam(':valor', $valor_v, PDO::PARAM_STR);

                if ($stmt->execute()) {
                    echo json_encode(array(
                        "status_code" => 200,
                        "detail"=> "Data inserted successfully"
                    ));
                } else {
                    echo "Error: " . implode(" - ", $stmt->errorInfo());
                }
            } else {
                echo "Error: Unable to prepare the statement";
            }
            // $sqlInsertData = "INSERT INTO transacao (titulo, valor) VALUES (%s, %s)";
            // $stmt = $connection->prepare($sqlInsertData);
            
            // if ($stmt) {
            //     // Bind parameters and execute the statement
            //     $stmt->bind_param("ss", $titulo_v, $valor_v); // 's' for string, 'd' for double (float)
            //     if ($stmt->execute()) {
            //         echo "Data inserted successfully";
            //     } else {
            //         echo "Error: " . $stmt->error;
            //     }
            //     $stmt->close(); // Close the prepared statement
            // } else {
            //     echo "Error: " . $connection->error;
            // }
    
                // if($connection->query($sqlInsertData) === TRUE) {
                //     echo "Dados inseridos";
                // } else {
                //     echo "Erro ao inserir dados" . $connection->error;
                // }

        } catch(PDOException $e) {
            echo "Connection in db failed: " . $e->getMessage();
        }


        


        // creates a JSON Response with the data received
        // $data_returned = json_encode(array(
        //     "message" => "Data received successfully",
        //     "title" => $title,
        //     "amount" => $amount
        // ));
        // echo $data_returned;

    } else  {
        echo "Você fez uma requisição GET... EU SÓ ACEITO POST!";
    }

?>