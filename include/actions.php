<?php
require dirname(__DIR__) . "/db/conect.php"; // Arquivo de conexão ao banco de dados
require "response.php"; // Class para a reposta

date_default_timezone_set('America/Sao_Paulo');
$response = new Response;
if (!isset($_GET['s']) && !isset($_GET['id'])) {
    $response->create("popup", "Nenhum parâmetros foi enviado");
} else {
    $get = $_GET['s'];
    $id = $_GET['id'];

    if ($get == "editar") {
        // Atualizar dados 
        $query = $pdo->prepare("UPDATE tbl_conta_pagar SET id_empresa=:em, data_pagar=:d, pago=:p, valor=:v WHERE id_conta_pagar=:id");
        $query->bindValue(":em", $_POST['id_empresa']);
        $query->bindValue(":d", $_POST['data_pagar']);
        $query->bindValue(":p", $_POST['pago']);
        $query->bindValue(":v", floatval(str_replace(',','.',$_POST['valor'])));
        $query->bindValue(":id", $id);

        $response->create("popup", $query->execute() ?  "Conta editada com sucesso" : "Erro ao editar conta");
    } elseif ($get == "pago") {
        // Buscar informacoes de conta
        $select = $pdo->prepare("SELECT * FROM tbl_conta_pagar WHERE id_conta_pagar=:id ");
        $select->bindValue(":id", $id);
        $select->execute();
        $conta = $select->fetch();

        $valor = $conta['valor'];
        $data_atual = date('Y-m-d');
        $data_pagar = $conta['data_pagar'];

        if ($data_atual < $data_pagar)  $valor = $valor * 0.95; // Desconto de 5%
        elseif ($data_atual > $data_pagar) $valor = $valor * 1.10; // Acréscimo de 10%

        // Atualizar dados 
        $query = $pdo->prepare("UPDATE tbl_conta_pagar SET pago=:p, valor=:v WHERE id_conta_pagar=:id");
        $query->bindValue(":p", 1);
        $query->bindValue(":v", $valor);
        $query->bindValue(":id", $id);

        $response->create("popup", $query->execute() ?  "Conta marcada como paga" : "Erro ao marcar conta como paga");
    } elseif ($get == "delete") {
        // Apagar conta
        $query = $pdo->prepare("DELETE FROM tbl_conta_pagar WHERE id_conta_pagar=:id");
        $query->bindValue(":id", $id);

        $response->create("popup", $query->execute() ?  "Conta apagada com sucesso" : "Erro ao conta apagar conta");
    }
}
$response->redirect("/");
