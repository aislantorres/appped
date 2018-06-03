<html>
    <head>
        <link rel="stylesheet" type="text/css" href="./jeasyui/themes/material/easyui.css">
        <link rel="stylesheet" type="text/css" href="./jeasyui/themes/icon.css">
        <link rel="stylesheet" type="text/css" href="./jeasyui/demo/demo.css">
        <script type="text/javascript" src="./jeasyui/jquery.min.js"></script>
        <script type="text/javascript" src="./jeasyui/jquery.easyui.min.js"></script>
        <style type="text/css">
            #fm{
                margin:0;
                padding:10px 30px;
            }
            .ftitle{
                font-size:14px;
                font-weight:bold;
                padding:5px 0;
                margin-bottom:10px;
                border-bottom:1px solid #ccc;
            }
            .fitem{
                margin-bottom:5px;
            }
            .fitem label{
                display:inline-block;
                width:150px;
            }
            .fitem input{
                width:160px;
            }
        </style>
        <script type="text/javascript">
            var url;
            function newUser() {
               
            }
            function doSearch(name, value) {
                //name : valor digitado - value:nome do campo (confuso, mas Ã© assim)
                $('#grid').datagrid('load', {
                    buscar: value + '|' + name
                });
            }
            function editUser() {
                
            }
            function saveUser() {
                
            }
            
            function destroyUser() {
                
            }
            
        </script>
    </head>
    <body>
        <table id="grid" title="PRODUTOS" class="easyui-datagrid" style="width:98%;height:100%"
               url="frmProduto_get.php" pageSize="20"
               toolbar="#toolbar" pagination="true" idField="ID"
               rownumbers="true" fitColumns="true" singleSelect="true">
            <thead>
                <tr>
                    <th field="ID" width="15">ID</th>
                    <th field="PR_Codigo"  sortable="true"  width="60">Codigo</th>
                    <th field="PR_Nome"  sortable="true"  width="120">Nome</th>
                </tr>
            </thead>
        </table>
        <div id="toolbar">
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newUser()">Inserir</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editUser()">Alterar</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="destroyUser()">Excluir</a>
            <input id="busca" class="easyui-searchbox" data-options="prompt:'',menu:'#mm',searcher:doSearch" style="width:350px"></input>  
            <div id="mm" style="width:120px">  
                <div data-options="name:'PR_Nome'">Nome</div>  
                <div data-options="name:'PR_Codigo'">Codigo </div>
                <div data-options="name:'ID'">ID</div>
            </div> 

        </div>

    </body>
</html>