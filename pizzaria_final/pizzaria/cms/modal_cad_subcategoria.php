<?php 
    include('conect.php');  //CONEXÃO

    $botao = 'Salvar';
    $name = "";

    $modo = $_GET['modo'];

    $id = '';

    if($modo=='editar'){
        $botao = 'Editar';
        
        $id = $_GET['id'];
        
        $sql = 'SELECT * FROM tblsubcategoria WHERE idSubcategoria ='. $id;
        
        $select = mysqli_query($conexao, $sql);
        
        if($rsConsulta=mysqli_fetch_array($select)){
            $name = $rsConsulta['nome'];
        }
        
    }

    if(isset($_POST['txtNome'])){
        $nome = $_POST['txtNome'];
        $id = $_POST['txtId'];
        $categoria = $_POST['sltcategoria'];
        
        if($_GET['modo']=='update'){
            $sql = "UPDATE tblsubcategoria SET nome='".$nome."', idCategoria =".$categoria." WHERE idSubcategoria =".$id.";";    
        }else{
            $sql = "INSERT INTO tblsubcategoria(nome, idCategoria) VALUES('".$nome."','".$categoria."');";    
        }
        
        mysqli_query($conexao,$sql);
        echo ("<script>
            location.reload();
        </script>");
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
                        url: "modal_cad_subcategoria.php?modo="+modo,
                        //Cria um objeto do tipo formulario, e herda todos os elementos atuais d form no html
                        data: new FormData($('#frm_cadastro')[0]),
                        //Caso tenhamos um objeto de arquivo (imagem) precisamos configurar os atributos abaixo
                        cache: false,
                        contentType: false,
                        processData: false,
                        async: true,
                        success: function(dados){
                            $('#modal_prod').html(dados);
                        }
                    });
                });
	
	   </script>
    </head>
    <body>
        <div id="cadastra">
            <h2 id="close">X</h2>
            <h1>Cadastre sua subcategoria</h1>
            <form name="frm_cadastro" data-id="<?php echo($id) ?>" id="frm_cadastro" method="post"  action="modal_cad_subcategoria.php">
                <input type="hidden" name="txtId" value="<?= $id ?>">
                <input type="text" name="txtNome" value="<?= $name ?>">  
                
                <p><b>Localização</b></p>
                <select name="sltcategoria">

                    <?php 
                        $sql = 'select * from tblcategoria';
                        $select = mysqli_query($conexao, $sql);

                        while($rsCategoria=mysqli_fetch_array($select)){
                    ?>

                    <option value="<?php echo($rsCategoria['idCategoria']); ?>"> <?php echo($rsCategoria['nome']); ?> </option>

                    <?php
                            }

                    ?>                                
                </select><br><br>
                
                
                <input type="submit" value="<?= $botao ?>" id="btn_modal">
            </form>
        </div>
    </body>
</html>
