<?php

require './config/config.php';
require './config/connection.php';
require './config/database.php';

$query = "SELECT ID,CF_RazaoSocial,CF_DmaCadastro FROM CliFor";

// DBClose($link);
 $result = DBExecute($query);

$row_count = sqlsrv_num_rows($result);
if ($row_count == false) {
    echo 'false';
} else {
    echo $row_count;
}

$row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC);

foreach ($row as $r){
    //echo $r["ID"]." - ".$r["CF_RazaoSocial"]."<br>";
}
while( $row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC) ) {
      echo $row['ID'].", ".$row['CF_RazaoSocial']."<br />";
}
?>
