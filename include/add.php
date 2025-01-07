<?php
require dirname(__DIR__) . "/db/conect.php"; // Arquivo de conexão ao banco de dados
require "response.php"; // Class para a reposta

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $get = $_GET['s'];
    $response = new Response();
    if ($get == "conta") {
        // Adicionar conta a pagar
        $res = $pdo->prepare("INSERT INTO tbl_conta_pagar (valor, data_pagar, pago, id_empresa) VALUES (:v, :d, :p, :id)");
        $res->bindValue(":v",  floatval(str_replace(',','.',$_POST['valor'])));
        $res->bindValue(":d",  $_POST['data_pagar']);
        $res->bindValue(":p",  0);
        $res->bindValue(":id",  $_POST['id_empresa']);
        
        $response->create("popup", $res->execute() ?  "Nova conta a pagar adicionada" : "Erro ao adicionar conta a pagar");
    } elseif ($get == "empresa") {
        // Adicionar empresa
        $res = $pdo->prepare("INSERT INTO tbl_empresa (nome) VALUES (:n)");
        $res->bindValue(":n", $_POST["nome"]);

        $response->create("popup", $res->execute() ?  "Nova empresa adicionada" : "Erro ao adicionar empresa");
    }
    $response->redirect("/");
}
