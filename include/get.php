<?php
$response = new Response();

// Filtrando contas (se aplicável)
$where = [];

if (isset($_POST['filter_empresa']) && !empty($_POST['filter_empresa'])) {
    $empresa = $_POST['filter_empresa'];
    $where[] = "e.id_empresa=$empresa";
}

if (isset($_POST['filter_valor_condicao']) && isset($_POST['filter_valor']) && !empty($_POST['filter_valor'])) {
    $valor_condicao = $_POST['filter_valor_condicao'];
    $valor = floatval(str_replace(',', '.', $_POST['filter_valor']));
    if ($valor_condicao == 'maior') {
        $where[] = "c.valor > '$valor'";
    } elseif ($valor_condicao == 'menor') {
        $where[] = "c.valor < '$valor'";
    } else {
        $where[] = "c.valor = '$valor'";
    }
}

if (isset($_POST['filter_data_pagar']) && !empty($_POST['filter_data_pagar'])) {
    $data_pagar = $_POST['filter_data_pagar'];
    $where[] = "c.data_pagar = '$data_pagar'";
}

// Montando a query com os filtros aplicados
$sql = "SELECT c.*, e.nome FROM tbl_conta_pagar c JOIN tbl_empresa e ON c.id_empresa = e.id_empresa";
if (count($where) > 0) {
    $sql .= " WHERE " . implode(" AND ", $where);
}

$query = $pdo->prepare($sql);
$query->execute();
$contas = $query->fetchAll();

// Buscar empresas
$select = $pdo->prepare("SELECT * FROM tbl_empresa WHERE id_empresa");
$select->execute();
$empresas = $select->fetchAll();
