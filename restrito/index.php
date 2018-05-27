<!DOCTYPE html>	
<html lang="pt-br">
    <head>	  
        <meta charset="utf-8">	  
        <meta http-equiv="X-UA-Compatible" content="IE=edge">	  
        <meta name="viewport" content="width=device-width, initial-scale=1">	  	  
        <title>APPPD - PEDIDOS E VENDAS</title>	  	  
        <!-- Bootstrap CSS -->	   
        <link href="./css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">	  
        <link href="./css/style.css" rel="stylesheet" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous">	
        <link rel="stylesheet" href="./css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
        <link rel="stylesheet" href="./css/cssgeral.css">
        <!-- jQuery (necessario para os plugins Javascript do Bootstrap) -->	  
        <script src="./js/jquery.js"></script>	  
        <script src="./js/bootstrap.min.js"></script>	

    </head>	 
    <body>	  
        <header>
            <nav class="navbar navbar-default navbar-static">
                <div class="navbar-header">
                    <button class="pull-left navbar-toggle" type="button" data-toggle="collapse" data-target=".js-navbar-collapse" style="margin-left: 10px;">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#"></a>
                </div>
                <div class="menu collapse navbar-collapse js-navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li class="dropdown">
                            <a href="index.php?id=2" class="dropdown-toggle" >Pedido de Venda</a>

                        </li>
                        <li class="dropdown">
                            <a href="index.php?id=99" class="dropdown-toggle" >Sair</a>

                        </li>

                    </ul>
                </div>
            </nav>
        </header>
        <!---
        ####################### CLASSIFICAÇÃO DOS MENUS ########################
                TAG         NOME PROGRAMA                 FORMULARIO
                2           Pedido de Venda               frmPedidoVenda.php
        
        
        ########################################################################
        -->     
        <div class="row">
            <div class="col-xs-12 col-md-12"> 
                <?php
                $id = "1";
                if (array_key_exists('id', $_GET)) {
                    $id = $_GET["id"];
                }
                if ($id == "1") {
                    include "inicio.php";
                } else if ($id == "2") {
                    include "frmPedidoVenda.php";
                } else if ($id == "99") {
                    include "sair.php";
                } else {
                    include "frmPedidoVenda.php"; //include "inicio.php";
                }
                ?>
            </div>            
        </div>
    </body>	
</html>