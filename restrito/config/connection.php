<?php

function mssql_escape($data) {
    if (is_numeric($data))
        return $data;
    $unpacked = unpack('H*hex', $data);
    return '0x' . $unpacked['hex'];
}

//anti injection
function DBEscape($dados) {
    $link = DBConnect();
    if (!is_array($dados)) {
        $dados = mssql_escape($link, $dados);
    } else {
        $arr = $dados;
        foreach ($arr as $key => $value) {
            $key = mssql_escape($link, $key);
            $value = mssql_escape($link, $value);

            $dados[$key] = $value;
        }
    }
    DBClose($link);
}

function anti_injection($string) {

    $string = trim($string);
    $string = str_replace("'", "", $string); //aqui retira aspas simples <'>
    $string = str_replace("\\", "", $string); //aqui retira barra invertida<\\>
    $string = str_replace("UNION", "", $string); //aqui retiro  o comando UNION <UNION>

    $banlist = array(" insert", " select", " update", " delete", " distinct", " having", " truncate", "replace", " handler", " like", " as ", "or ", "procedure ", " limit", "order by", "group by", " asc", " desc", "'", "union all", "=", "'", "(", ")", "<", ">", " update", "-shutdown", "--", "'", "#", "$", "%", "¨", "&", "'or'1'='1'", "--", " insert", " drop", "xp_", "*", " and");
    // ---------------------------------------------
    //if(eregi("[a-zA-Z0-9]+", $string)){
    if (preg_match("/[a-zA-Z0-9]+/", $string)) {
        $string = trim(str_replace($banlist, '', strtolower($string)));
    }

    return $string;
}

//fecha conexo
function DBClose($link) {
    mssql_close($link) or die(sqlsrv_errors($link));
}

//abre conexao mysql 
function DBConnect() {
    $conninfo = array("Database" => DB_DATABASE, "UID" => DB_USERNAME, "PWD" => DB_PASSWORD, "CharacterSet" => DB_CHARSET);
    $link = sqlsrv_connect(DB_HOSTNAME, $conninfo) or die(sqlsrv_errors());

    return $link;
}

?>