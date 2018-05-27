<?php

/*  funcoes genericas utilizando apenas php bruto sem ligação com banco de dados ou estilos css 
 */

function retData($data, $tipo) {
    if ($tipo == 1) { //converte de AAAA-MM-DD para DD/MM/AAAA
        list($ano, $mes, $dia) = explode('-', $data);
        return $dia . '/' . $mes . '/' . $ano;
    } else if ($tipo == 2) { //converte de DD/MM/AAAA para AAAA-MM-DD
        list($dia, $mes, $ano) = explode('/', $data);
        return $ano . '-' . $mes . '-' . $dia;
    } else if ($tipo == 3) { //converte de DD/MM/AAAA para AAAA-MM-DD
        list($date, $hora) = explode(' ', $data);
        list($ano, $mes, $dia) = explode('-', $date);
        return $dia . '/' . $mes . '/' . $ano . ' ' . $hora;
    } else if ($tipo == 4) { //converte de DD/MM/AAAA para AAAA-MM-DD
        list($date, $hora) = explode(' ', $data);
        list($ano, $mes, $dia) = explode('-', $date);
        return $dia . '/' . $mes . '/' . $ano;
    } else if ($tipo == 5) { //converte AAAA-MM-DD 00:00:00 para DD-MM-AAAA
        list($date, $hora) = explode(' ', $data);
        list($ano, $mes, $dia) = explode('-', $date);
        return $dia . '-' . $mes . '-' . $ano;
    }
}
function iif($condicao ,$verdadeiro,$falso){
    if ($condicao) {
        return $verdadeiro;
    } else {
        return $falso;
    }
}
function valCPF($cpf = null) {
// Verifica se um número foi informado
    if (empty($cpf)) {
        return false;
    }// Elimina possivel mascara
    $cpf = TsoNumero($cpf);
    //$cpf = str_pad($cpf, 11, '0', STR_PAD_LEFT);
    // Verifica se o numero de digitos informados é igual a 11 
    if (strlen($cpf) != 11) {
        return false;
    } else if ($cpf == '00000000000' ||
            $cpf == '11111111111' ||
            $cpf == '22222222222' ||
            $cpf == '33333333333' ||
            $cpf == '44444444444' ||
            $cpf == '55555555555' ||
            $cpf == '66666666666' ||
            $cpf == '77777777777' ||
            $cpf == '88888888888' ||
            $cpf == '99999999999') {
        return false;
        // Calcula os digitos verificadores para verificar se o
        // CPF é válido
    } else {

        for ($t = 9; $t < 11; $t++) {

            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf{$c} * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf{$c} != $d) {
                return false;
            }
        }

        return true;
    }
}

function TsoNumero($str) {
    return preg_replace("/[^0-9]/", "", $str);
}

function buscaString($string, $busca) {
    if (strstr($string, $busca)) {
        return true;
    } else {
        return false;
    }
}

function fLetraNumero($string) { //retorna apenas letras e numeros    
    $chars = array(".", "-", "_", " ", "@", "#", "!", "?", "~", "^", "´", "`", "{", "[", "$", "%", "¨", "&", "*", "(", ")", "+", "=", "}", "]", "º", "ª", "/", "\\", ",", ";", ":");
    return str_replace($chars, "", $string);
}
function d10Anterior($data, $formato) {
    list($dia, $mes, $ano) = explode('/', $data);
    return date($formato, mktime(0, 0, 0, $mes - 1, "10", $ano));
}

function d10Atual($data, $formato) {
    list($dia, $mes, $ano) = explode('/', $data);
    return date($formato, mktime(0, 0, 0, $mes, "10", $ano));
}

function d10Seguinte($data, $formato) {
    list($dia, $mes, $ano) = explode('/', $data);
    return date($formato, mktime(0, 0, 0, $mes + 1, "10", $ano));
}

function qualDia10($true) {
    $dia10Atual = d10Atual(date("d/m/Y"), "Y-m-d");
    $dia10Seg = d10Seguinte(date("d/m/Y"), "Y-m-d");
    $qualDia10 = "";
    if (strtotime(date("Y-m-d")) <= strtotime($dia10Atual)) {
        $qualDia10 = $dia10Atual;
    } else {
        $qualDia10 = $dia10Seg;
    }
    return $qualDia10;
}

?>
