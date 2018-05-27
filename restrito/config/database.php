<?php
	//delete
	function DBDelete($table, $where = null){
		$where = ($where) ? " WHERE {$where} " : null;
		$query = "DELETE FROM {$table}{$where}";
		return DBExecute($query);
	}
	//alterar
	function DBUpdate($tabela,array $dados, $where = null){
		foreach ($dados as $key => $value){
			$fields[] = "{$key} = '{$value}'";
		}
		$fields = implode(',', $fields);
		$where = ($where) ? " WHERE {$where} " : null;
		$query = "UPDATE {$tabela} SET  {$fields} {$where}";
		return DBExecute($query);
	}
	//lendo registros
	function DBRead($table,$params=NULL,$fields = "*"){
		$params = ($params) ? " {$params} " : NULL;
		$query = "SELECT {$fields} FROM {$table}{$params}";
		$result = DBExecute($query);
		if(!mysqli_num_rows($result))
			return false;
		else {
			while ($res = mysqli_fetch_assoc($result)){
				$data[] = $res;
			}
		}
		return $data;
	}
	//inserir no db
	function DBCreate($table, array $data){
		$fields = implode(',',array_keys($data));
		$values = "'".implode("', '",$data)."'";
		$query = "INSERT INTO {$table} ({$fields}) VALUES ({$values}) ";
		return DBExecute($query);
	}
        
        //recebe uma query e retorna o valor do campo especificado em $retorno. Retorna somente um campo
        function DBBusca($query,$retorno){
            $qry = DBExecute($query." LIMIT 0,1");
            $ret = "";
            foreach ($qry as $row) {
                $ret =$row[$retorno];
            }
            
            //$row = mysqli_fetch_array($rs);
            return $ret;
	}
        
	//executa query
	function DBExecute($query){
		$link = DBConnect();
		$result = @mysqli_query($link,$query) or die(mysqli_error());		
		DBClose($link);
		return $result;
	}
        
        
?> 