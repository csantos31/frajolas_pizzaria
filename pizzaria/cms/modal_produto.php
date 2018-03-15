<?php 
    include('conect.php');  //CONEXÃO
    require_once('uploadfoto.php');

    $botao = 'Salvar';
    $name = "";
    $desc = "";
    $preco = "";

    $modo = $_GET['modo'];

    $id = '';

    if(isset($_POST['txtNome'])){
        $nome = $_POST['txtNome'];
        $categoria = $_POST['sltcategoria'];
        $preco = $_POST['txtPreco'];
        $desc = $_POST['txtDesc'];
        
        $nome_arq = basename($_FILES['flefoto']['name']);
        if(verificaExtensao($nome_arq)){
            $dir = uploadArq($nome_arq);
            moveArq('flefoto', $dir);
            
            $sql = "INSERT INTO tblproduto(nome, fotoProduto, preco, descricao, pizzaMes, idSubcategoria, ativo) VALUES ('".$nome."', '".$dir."', '".$preco."', '".$desc."', '0', '".$categoria."', '1');";    
        
        
            mysqli_query($conexao,$sql);
            echo ("<script>
                location.reload();
            </script>");
            
            echo $sql;
            
        }else{
            echo "<script> alert('Erro com a extensão do arquivo enviado'); </script>";
        }
        
        
    
        
    }

?>
<html>
    <head>
        <title>Cadastro</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="css/modal_style.css">
        <script type="text/javascript" src="js/jquery.js"></script>
        <script>
            $(document).ready(function() {

              $("#close").click(function() {
                //$(".modalContainer").fadeOut();
                $("#modalContainer_prod").slideToggle(1000);
              });
            });
            
                $("#frm_cadastro").submit(function(event){
                    //Cancela a ação do submit pelo navegador 
                    event.preventDefault();
                    
                    //RECEBE DATA-ID (substitui input hidden)
                    var id = $(this).data("id");
                    var modo = '';
                                        
                    //verifica se id = null ou tem valor para definir entre insert e update para php
                    if(id == '')
                        modo = 'inserir';
                    else
                        modo = 'update';
                   
                    
                    $.ajax({
                        type: "POST",
                        url: "modal_produto.php?modo="+modo,
                        //Cria um objeto do tipo formulario, e herda todos os elementos atuais d form no html
                        data: new FormData($('#frm_cadastro')[0]),
                        //Caso tenhamos um objeto de arquivo (imagem) precisamos configurar os atributos abaixo
                        cache: false,
                        contentType: false,
                        processData: false,
                        async: true,
                        success: function(dados){
                            console.log(dados);
                            $('#modal_prod').html(dados);
                        }
                    });
                });
	
	   </script>
    </head>
    <body>
        <div id="cadastra">
            <h2 id="close">X</h2>
            <h1>Cadastre seu produto</h1>
            <form name="frm_cadastro" enctype="multipart/form-data" data-id="<?php echo($id) ?>" id="frm_cadastro" method="post"  action="modal_produto.php">
                <input type="hidden" name="txtId" value="<?= $id ?>">
                <input placeholder="Nome" type="text" name="txtNome" value="<?= $name ?>">  
                <input placeholder="Descrição" type="text" name="txtDesc" value="<?= $desc ?>">
                <input placeholder="Preço" type="text" name="txtPreco" value="<?= $preco ?>">
                <input placeholder="Arquivo" type="file" name="flefoto">
                <p><b>Subcategoria</b></p>
                <select name="sltcategoria">

                    <?php 
                        $sql = 'select * from tblsubcategoria';
                        $select = mysqli_query($conexao, $sql);

                        while($rsCategoria=mysqli_fetch_array($select)){
                    ?>

                    <option value="<?php echo($rsCategoria['idSubcategoria']); ?>"> <?php echo($rsCategoria['nome']); ?> </option>

                    <?php
                            }

                    ?>                                
                </select><br><br>
                
                
                <input type="submit" value="<?= $botao ?>" id="btn_modal">
            </form>
        </div>
    </body>
</html>
