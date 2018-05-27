<html lang="pt-br">
    <head> <link href="cssBar.css" rel="stylesheet"/>
    </head><body>

        <?php
        echo '<link href="cssBar.css" rel="stylesheet"/>';

        function removerAcento($str) {
            $str = str_replace('\'', '\\\'', $str);
            $de = "ÀÁÃÂÉÊÍÓÕÔÚÜÇÑàáãâéêíóõôúüçñ";
            $para = "AAAAEEIOOOUUCNaaaaeeiooouucn";
            return strtr($str, $de, $para);
        }

        function retornaData($data, $tipo) {
            if ($tipo == 1) { //converte de AAAA-MM-DD para DD/MM/AAAA
                if ($data != "") {
                    list($ano, $mes, $dia) = explode('-', $data);
                    return $dia . '/' . $mes . '/' . $ano;
                } else {
                    return "-";
                }
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
            } else if ($tipo == 6) { //converte AAAA-MM-DD 00:00:00 para DD/MM/AAAA
                list($date, $hora) = explode(' ', $data);
                list($ano, $mes, $dia) = explode('-', $date);
                return $dia . '/' . $mes . '/' . $ano;
            } else if ($tipo == 7) { //converte AAAA-MM-DD 00:00:00 para AAAA-MM-DD
                list($date, $hora) = explode(' ', $data);
                list($ano, $mes, $dia) = explode('-', $date);
                return $ano . '-' . $mes . '-' . $dia;
            }
        }

//retorna o primeiro dia do mes: passar a data no formato dia/mes/ano : parametro formato pode ser passado como d/m/Y ou Y/m/d
        function primeiroDiaMes($data, $formato) {
            list($dia, $mes, $ano) = explode('/', $data);
            return date($formato, mktime(0, 0, 0, $mes, "01", $ano));
            /* if ($formato == "1") { //formato 1 = retorna dia/mes/ano
              return "01/".$mes."/".$ano;
              } else { //formato 2 = retorna ano-mes-dia
              return $ano."-".$mes."-01";
              } */
        }

//retorna ultimo dia do mes passar a data no formato dia/mes/ano : parametro formato pode ser passado como d/m/Y ou Y/m/d
        function ultimoDiaMes($data, $formato) {
            list($dia, $mes, $ano) = explode('/', $data);
            return date($formato, mktime(0, 0, 0, $mes + 1, 0, $ano));
        }

        function dia11($data, $formato) {
            list($dia, $mes, $ano) = explode('/', $data);
            return date($formato, mktime(0, 0, 0, $mes, "11", $ano));
        }

        function dia10atual($data, $formato) {
            list($dia, $mes, $ano) = explode('/', $data);
            return date($formato, mktime(0, 0, 0, $mes, "10", $ano));
        }

        function dia10seguinte($data, $formato) {
            list($dia, $mes, $ano) = explode('/', $data);
            return date($formato, mktime(0, 0, 0, $mes + 1, "10", $ano));
        }

        function dbacha($sql, $retorno) {
            /* $link = DBConnect();
              $result = @mysqli_query($link,$sql) or die(mysqli_error());
              $row=mysqli_fetch_assoc($result);
              mysqli_free_result($result);
              $campo=$row[$retorno];
              DBClose($link); */
            $qtemp = DBExecute($sql . " LIMIT 0,1");
            foreach ($qtemp as $r) {
                $campo = $r[$retorno];
            }
            return $campo;
        }

        function soNumero($str) {
            return preg_replace("/[^0-9]/", "", $str);
        }

        function validaCPF($cpf = null) {
// Verifica se um número foi informado
            if (empty($cpf)) {
                return false;
            }// Elimina possivel mascara
            $cpf = soNumero($cpf);
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

        function strtofloat($val) {
            preg_match("#^([\+\-]|)([0-9]*)(\.([0-9]*?)|)(0*)$#", trim($val), $o);
            return $o[1] . sprintf('%d', $o[2]) . ($o[3] != '.' ? $o[3] : '');
        }

        function formatar($tipo = "", $string, $size = 10) {
            $string = preg_replace("/[^0-9]/", "", $string);

            if ($tipo == "fone") {
                if ($size === 10) {
                    $string = '(' . substr($tipo, 0, 2) . ') ' . substr($tipo, 2, 4)
                            . '-' . substr($tipo, 6);
                } else if ($size === 11) {
                    $string = '(' . substr($tipo, 0, 2) . ') ' . substr($tipo, 2, 5)
                            . '-' . substr($tipo, 7);
                }
            } else if ($tipo == 'cep') {
                $string = substr($string, 0, 5) . '-' . substr($string, 5, 3);
            } else if ($tipo == 'cpf') {
                $string = substr($string, 0, 3) . '.' . substr($string, 3, 3) .
                        '.' . substr($string, 6, 3) . '-' . substr($string, 9, 2);
            } else if ($tipo == 'cnpj') {
                $string = substr($string, 0, 2) . '.' . substr($string, 2, 3) .
                        '.' . substr($string, 5, 3) . '/' .
                        substr($string, 8, 4) . '-' . substr($string, 12, 2);
            } else if ($tipo == 'rg') {
                $string = substr($string, 0, 2) . '.' . substr($string, 2, 3) .
                        '.' . substr($string, 5, 3);
            } else {
                $string = 'É ncessário definir um tipo(fone, cep, cpg, cnpj, rg)';
            }
            return $string;
        }

        function formataLinhaDig($string) {
            $campo1 = substr($string, 0, 5) . "." . substr($string, 5, 5);
            $campo2 = substr($string, 10, 5) . "." . substr($string, 15, 6);
            $campo3 = substr($string, 21, 5) . "." . substr($string, 26, 6);
            $campo4 = substr($string, 32, 1);
            $campo5 = substr($string, 33, 14);
            return $campo1 . " " . $campo2 . " " . $campo3 . " " . $campo4 . " " . $campo5;
        }

//apaga arquivos com mais de um dia no servidor com a extensao definida
        function apagaAntigo($pasta, $extensao) {
            $date = strtotime('-30 day', time());
            foreach (glob($pasta . '/*.' . $extensao) as $file) {
                $filetime = filemtime($file);
                if ($date > $filetime) {
                    unlink($file);
                }
            }
        }

        function EnviaEmail($para, $assunto, $texto, $fatura, $altText) {
            //DADOS SMTP
            require("mail/class.phpmailer.php");
            // Inicia a classe PHPMailer

            $mail = new PHPMailer();
            // Define os dados do servidor e tipo de conexão

            $qry2 = DBExecute(" SELECT * FROM config ");
            foreach ($qry2 as $data) {

                $var1 = $data["cf_chave"];

                switch ($var1) {
                    case "CH_EmailHost": $host = $data["cf_valor"];
                        break;
                    case "CH_EmailSMTPSecure": $seg = $data["cf_valor"];
                        break;
                    case "CH_EmailPorta": $porta = $data["cf_valor"];
                        break;
                    case "CH_EmailAuth": $aut = $data["cf_valor"];
                        break;
                    case "CH_EmailUsername": $user = $data["cf_valor"];
                        break;
                    case "CH_EmailSenha": $senha = $data["cf_valor"];
                        break;
                    case "CH_EmailFrom": $email = $data["cf_valor"];
                        break;
                    case "CH_EmailFromName": $nome = $data["cf_valor"];
                        break;
                }
            }



            $mail->IsSMTP(); // Define que a mensagem será SMTP
            $mail->SMTPSecure = strtolower($seg); //'ssl'; // secure transfer enabled REQUIRED for GMail        
            $mail->SMTPDebug = 1;
            $mail->Port = $porta; //465;  
            $mail->CharSet = 'UTF-8';
            $mail->Host = $host; //"br48.hostgator.com.br"; // Endereço do servidor SMTP
            if ($aut == "1") {
                $pode = true;
            } else {
                $pode = false;
            }
            $mail->SMTPAuth = $pode; //true; // Usa autenticação SMTP? (opcional)
            $mail->Username = $user; //'contato@caixavirtual.com'; // Usuário do servidor SMTP
            $mail->Password = $senha; //'shirak12'; // Senha do servidor SMTP

            $mail->From = $email; //'contato@caixavirtual.com'; // Seu e-mail

            $mail->FromName = $nome; //"Email"; // Seu nome
            $mail->AddAddress($para);

            //$mail->AddAddress('contato@consultarelab.com.br');
            //$mail->AddAddress('aislantorres@gmail.com');
            $mail->IsHTML(true); // Define que o e-mail será enviado como HTML

            $mail->Subject = $assunto; // Assunto da mensagem

            $mail->Body = $texto;
            $mail->AltBody = $altText;
            $mail->AddAttachment($fatura);      // attachment "img/logo.png"
            $enviado = $mail->Send();

            $mail->ClearAllRecipients();

            $mail->ClearAttachments();

            $retornou = "";
            if ($enviado) {
                $retornou = "E-mail enviado com sucesso!";
            } else {
                $retornou = "Não foi possível enviar o e-mail. Informações do erro: " . $mail->ErrorInfo;
            }
            return $retornou;
        }

        function diasUteisNovo($vencto, $atual) {
            /* $data_inicio = new DateTime($vencto);
              $data_fim = new DateTime($atual); */
            $data_inicio = strtotime($vencto);
            $data_fim = strtotime($atual);
            $dias = 0;
            $fimSem = 0;
            // Resgata diferença entre as datas
            if ($data_fim > $data_inicio) {
                $inicio = $data_inicio;
                $fim = $data_fim;
                while ($inicio <= $fim) {
                    $diaSem = date("N", $inicio);
                    if ($diaSem > 5) {
                        $fimSem++;
                    }
                    $inicio += 86400;
                    $dias++;
                }
                /* $dateInterval = $data_inicio->diff($data_fim);
                  $dias = $dateInterval->days; */
                $dias = $dias - $fimSem;
                if ($dias < 0) {
                    $dias = 0;
                }
            } else {
                $dias = 0;
            }
            return $dias;
        }

        function diasUteis($inicio, $fim) {
            $begin = ($inicio);
            $end = ($fim);

            //$holidays = array('01/01', '25/12', ...);
            $holidays = array();
            $weekends = 0;
            $no_days = 0;
            $holidayCount = 0;
            while ($begin < $end) {
                $no_days++; // no of days in the given interval
                if (in_array(date("d/m", $begin), $holidays)) {
                    $holidayCount++;
                }
                $what_day = date("N", $begin);
                if ($what_day > 5) { // 6 and 7 are weekend days
                    $weekends++;
                };
                $begin += 86400; // +1 day
            };
            $working_days = $no_days - $weekends - $holidayCount;

            return $working_days;
        }

        function diasUteis1($inicio, $fim) {
            $begin = ($inicio);
            $end = ($fim);

            //$holidays = array('01/01', '25/12', ...);
            $holidays = array();
            $weekends = 0;
            $no_days = 0;
            $holidayCount = 0;
            while ($begin < $end) {
                $no_days++; // no of days in the given interval
                if (in_array(date("d/m", $begin), $holidays)) {
                    $holidayCount++;
                }
                $what_day = date("N", $begin);

                $begin += 86400; // +1 day
            };
            $working_days = $no_days - $weekends - $holidayCount;

            return $working_days;
        }
        
        function proximoDiaUtil($data, $saida = 'd/m/Y') { // Formato de entrada da $data: AAAA-MM-DD

            $timestamp = strtotime($data);
            $dia = date('N', $timestamp);
            if ($dia >= 6) {
                $timestamp_final = $timestamp + ((8 - $dia) * 3600 * 24);
            } else {
                $timestamp_final = $timestamp;
            }
            return date($saida, $timestamp_final);
        }

        function qtdDiasUteis($hoje, $vencto) { //passar datas no formato yyyyy-mm-dd
            $proxDia = proximoDiaUtil($vencto);
            $proxDia = retornaData($proxDia, 2);
            //$inicio = new DateTime($vencto);
            $inicio = new DateTime($proxDia);
            $fim = new DateTime($hoje);
            $fim->modify('+1 day');
            $diasUt = 0;

            $interval = new DateInterval('P1D');
            $periodo = new DatePeriod($inicio, $interval, $fim);

            foreach ($periodo as $data) {
                $tdy = strtotime($data->format("d-m-Y"));
                //if (date('N', $tdy) <= 5) {
                    $diasUt++;
                //}
            }
            return $diasUt;
        }

        function calculaMultaJuros($valor, $multa, $juros, $vencto, $id, $pode) {
            $data = date("d-m-Y");

            $vencto1 = retornaData($vencto, 7);
            $vencto = retornaData($vencto, 5);
            $valor = $valor * 1.00;
            $multa = 2 * 1.00;
            $juros = 0.33 * 1.00;
            $dia1 = strtotime($vencto); //dd-mm-aaaa
            $dia2 = strtotime($data);
			$venctoFimSemana = date('N',$dia1);

            $valorFinal = 0;
            $nDias = ($dia2 - $dia1) / 86400;

            if ($dia2 > $dia1) {
                $nDias = qtdDiasUteis(date("Y-m-d"), $vencto1);
                /* if (date('N', $dia1) > 5) {
                  $nDias = 0;
                  } else {
                  $nDias = (diasUteis1($dia1, $dia2));
                  } */
            } else {
                $nDias = 0;
            }
            if ($nDias < 0) {
                $nDias = 0;
            }
			if (($nDias == 1) && ($venctoFimSemana > 5)) {
				$nDias = 0;
			}
			
            $valorFinal = 0;
            if ($nDias >= 1) {
                $nMeses = (int) ($nDias / 30);
                if ($nMeses == 0) {
                    $nMeses = (int) ((($dia2 - $dia1) / 86400) / 30);
                }
                if ($nMeses == 0) {
                    $nMeses = 1;
                }
                $multaFinal = (($valor * $multa / 100) * $nMeses);
                $jurosFinal = (($valor * $juros / 100) * $nDias);
                $valorFinal = ($valor + $jurosFinal) + $multaFinal;

                if ($pode == TRUE) {
                    $atual = DBExecute("UPDATE titulo SET tl_valor = " . $valorFinal . ", tl_dataVencto = '" . date("Y-m-d H:i:s") . "' WHERE tl_id = " . $id);
                }
            }
            return $valorFinal;
        }

        function gravarArquivo($texto, $nome, $pasta) { //enviar nome da pasta com a barra ex ./files/
            //Variável arquivo armazena o nome e extensão do arquivo.
            $arquivo = $nome;

            //Variável $fp armazena a conexão com o arquivo e o tipo de ação.
            $fp = fopen($pasta . $arquivo, "a+");

            //Escreve no arquivo aberto.
            fwrite($fp, $texto);

            //Fecha o arquivo.
            fclose($fp);
        }

        function fSoNumero($str) {
            return preg_replace("/[^0-9]/", "", $str);
        }

        function removeNumero($string) {
            $nova = str_replace(array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9'), '', $string);
            return $nova;
        }

        function fAlfaNum($string) { //retorna apenas letras e numeros
            $s = preg_replace("[^a-zA-Z0-9_]", "", strtr($string, "áàãâéêíóôõúüçÁÀÃÂÉÊÍÓÔÕÚÜÇ ", "aaaaeeiooouucAAAAEEIOOOUUC_"));
            $s = strtr($s, "_", "");
            return $s;
        }

        /*
          function caracteresEsquerda($string, $num)
          {
          return substr($string, 0, $num);
          }
          function caracteresDireita($string, $num)
          {
          return substr($string, strlen($string)-$num, $num);
          }

          function getImagemCodigoDeBarras($val)
          {
          $codigo = $val;

          $barcodes = array('00110', '10001', '01001', '11000', '00101', '10100', '01100', '00011', '10010', '01010');

          for ($f1 = 9; $f1 >= 0; $f1--) {
          for ($f2 = 9; $f2 >= 0; $f2--) {

          $f = ($f1 * 10) + $f2;
          $texto = '';

          for ($i = 1; $i < 6; $i++) {
          $texto .= substr($barcodes[$f1], ($i - 1), 1) . substr($barcodes[$f2], ($i - 1), 1);
          }

          $barcodes[$f] = $texto;
          }
          }
          // Guarda inicial
          $retorno = '<div class="barcode">' .
          '<div class="black thin"></div>' .
          '<div class="white thin"></div>' .
          '<div class="black thin"></div>' .
          '<div class="white thin"></div>';

          if (strlen($codigo) % 2 != 0) {
          $codigo = "0" . $codigo;
          }
          $ft = "";
          // Draw dos dados
          while (strlen($codigo) > 0) {

          $i = (int) round(caracteresEsquerda($codigo, 2));
          $codigo = caracteresDireita($codigo, strlen($codigo) - 2);
          $f = $barcodes[$i];
          $ft .= $f;
          for ($i = 1; $i < 11; $i += 2) {

          if (substr($f, ($i - 1), 1) == "0") {
          $f1 = 'thin';
          } else {
          $f1 = 'large';
          }

          $retorno .= "<div class='black {$f1}'></div>";

          if (substr($f, $i, 1) == "0") {
          $f2 = 'thin';
          } else {
          $f2 = 'large';
          }

          $retorno .= "<div class='white {$f2}'></div>";
          }
          }
          return $ft;
          // Final
          $retorno . '<div class="black large"></div>' .
          '<div class="white thin"></div>' .
          '<div class="black thin"></div>' .
          '</div>';


          } */
        ?>
    </body>
</html>