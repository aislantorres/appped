<?php
	

	//anti injection
	function DBEscape($dados){
		$link = DBConnect();
		if(!is_array($dados)){
			$dados = mysqli_real_escape_string($link,$dados);
		} else {
			$arr = $dados;
			foreach ($arr as $key => $value) {
				$key = mysqli_real_escape_string($link,$key);
				$value = mysqli_real_escape_string($link,$value);

				$dados[$key] = $value;
			}

		}
		DBClose($link);
	}
	function anti_injection($string){

		$string = trim($string);
        $string =str_replace("'","",$string);//aqui retira aspas simples <'>
        $string =str_replace("\\","",$string);//aqui retira barra invertida<\\>
        $string =str_replace("UNION","",$string);//aqui retiro  o comando UNION <UNION>
       
        $banlist = array(" insert", " select", " update", " delete", " distinct", " having", " truncate", "replace"," handler", " like", " as ", "or ", "procedure ", " limit", "order by", "group by", " asc", " desc","'","union all", "=", "'", "(", ")", "<", ">", " update", "-shutdown",  "--", "'", "#", "$", "%", "¨", "&", "'or'1'='1'", "--", " insert", " drop", "xp_", "*", " and");
        // ---------------------------------------------
        //if(eregi("[a-zA-Z0-9]+", $string)){
        if(preg_match("/[a-zA-Z0-9]+/", $string)){
                $string = trim(str_replace($banlist,'', strtolower($string)));
        }
       
        return $string;
}

	//fecha conexo
	function DBClose($link){
		@mysqli_close($link) or die(mysqli_error($link));
	}
	//abre conexao mysql 
	function DBConnect(){
		$link = @mysqli_connect(DB_HOSTNAME,DB_USERNAME,DB_PASSWORD,DB_DATABASE) or die(mysqli_connect_error());
		mysqli_set_charset($link,DB_CHARSET) or die(mysqli_error($link));
		
		return $link;
	}
?>