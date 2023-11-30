<?php
if(!empty($_GET['id']))
{
    include_once('configurar_banco_de_dados.php');

    $id = $_GET['id'];
    $sqlSelect = "SELECT * FROM financas_pessoais WHERE id= $id";

    $result = $conexao->query($sqlSelect);

    if($result->num_rows > 0)
    {
        $sqlSelect = "DELETE FROM transacao WHERE id = $id";
        $resultDelete = $conexao->query($sqlDelete);
    }
}
    header('Location: ');