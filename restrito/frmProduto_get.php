<?php

require './config/config.php';
require './config/connection.php';
require './config/database.php';
include 'fGeral.php';

$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 20;
$tipo = isset($_REQUEST['buscar']) ? strval($_REQUEST['buscar']) : '';
$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'PR_Nome';
$order = isset($_POST['order']) ? strval($_POST['order']) : 'ASC';
$where = "";
$offset = ($page - 1) * $rows;

if ($tipo != "") {
    list($campo, $valor) = explode('|', $tipo);

    if ($valor <> '') {
        $where .= " AND $campo like '%$valor%' ";
    } else {
        $where = "";
    }
}

$rs = DBExecute("select ID from Produto WHERE 1=1 ".$where);
$total = sqlsrv_num_rows($rs);
$qry = DBExecute("SELECT ID,PR_Nome,PR_Codigo,DataHora  "
        . " FROM Produto "
        . " WHERE 1=1 "
        . $where
        . " ORDER BY $sort $order "
        . " OFFSET  $offset ROWS FETCH NEXT $rows ROWS ONLY ");
$result = array();
$items = array();
$result["total"] = $total;
if (sqlsrv_num_rows($qry) > 0) {    
    while( $data = sqlsrv_fetch_array( $qry, SQLSRV_FETCH_ASSOC) ) {
        array_push($items, $data);
    }
}
$result["rows"] = $items;
echo json_encode($result);
?>