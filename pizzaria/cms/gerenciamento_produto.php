 <?php
    
    include('verifica.php');  //SEGURANÇA
    include('conect.php');  //CONEXÃO

$icon = "";

    if(isset($_GET['codigo'])){
        $id = $_GET['codigo'];
        
        $sql = 'DELETE FROM tblproduto WHERE idProduto ='. $id;
        
        if(mysqli_query($conexao, $sql)){
            echo 'success';
        }else{
            echo "<script> alert('Este produto não pode ser apagado pois é associado a uma promoção'); </script>";
        }
        
    }

    if(isset($_GET['idItem'])){
        $id = $_GET['idItem'];
        
        $sql = "SELECT * FROM tblproduto WHERE idProduto =".$id;
        $select = mysqli_query($conexao, $sql);
        if($rsResult=mysqli_fetch_array($select)){
            $ativo = $rsResult['ativo'];
            
            if($ativo=='1'){
                $sql = 'UPDATE tblproduto SET ativo = 0 WHERE idProduto ='.$id;
            }else{
                $sql = 'UPDATE tblproduto SET ativo = 1 WHERE idProduto ='.$id;
            }
            
            mysqli_query($conexao, $sql);
            
        }
         
    }

?>
<html>
    <head>
        <title>Gerenciamento de produtos</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <script type="text/javascript" src="js/jquery.js"></script>
        
        <script>
            var modal = document.getElementById('modalContainer_prod');
            
            $(document).ready(function(){
                $("#bt_cat").click(function(){
                    $("#modalContainer_prod").fadeIn(2000);
                });
                
            });
            
            $(document).ready(function(){
                $(".edit").click(function(){
                    $("#modalContainer_prod").fadeIn(2000);
                });
                
            });
            
            function novo(){
                $.ajax({
                    type: "POST",
                    url: "modal_produto.php?modo=inserir",
                    success: function(dados){
                                $('#modal_prod').html(dados);
                            }
                    
                });
            }
            
            function excluir(codigo){
                $.ajax({
                    type: "GET",
                    url: "gerenciamento_produto.php",
                    data:{codigo:codigo},
                    success: function (dados){
                        console.log(dados);
                        $('#principal').html(dados);
                    }
                    
                });
                
            }
            
            function inativar(idItem){
                $.ajax({
                    type: "GET",
                    url: "gerenciamento_produto.php",
                    data:{idItem:idItem},
                    success: function (dados){
                        console.log(dados);
                        $('#principal').html(dados);
                    }
                    
                });
                
            }
           

        </script>
        
    </head>
    <body>
        <div id="modalContainer_prod">
            <div id="modal_prod">
            </div>
        </div>
        <div id="principal">
            <?php include('hd.php') ?>
            
            <main>
                <?php include('menu.php') ?>
                
                <div id="conteudo">
                    <input id="bt_cat" onclick="novo()" type="button" value="Inserir Produto" name="btncategoria">                   
                    <h1>Gerenciamento de produtos</h1>                
                    <?php
                    
                        include('conect.php');
                        
                        $sql = 'select * from tblproduto order by idProduto desc';
                        $select = mysqli_query($conexao, $sql);
            
                        while($rsProduto=mysqli_fetch_array($select)){
                            ($rsProduto['ativo']==1) ? $icon = 'defineoff.png' : $icon = 'btdefine.png';
                    ?>
                    
                        <div class="container_home">
                            <div class="item_container_home"> <img src="<?php echo($rsProduto['fotoProduto']) ?>"> </div>
                            <div class="item_categoria"> <p> <?php echo($rsProduto['nome']) ?> </p> </div>
                            <div class="item_categoria"> <p> <?php echo($rsProduto['descricao']) ?> </p> </div>
                            <div class="icones_categoria">
                                <a href="#" onclick="inativar(<?= $rsProduto['idProduto'] ?>)">
                                    <img src="imagens/<?= $icon ?>" alt="edit" title="edit">
                                </a>
                                <a id="excluir" onclick="excluir(<?= $rsProduto['idProduto'] ?>)">
                                    <img src="imagens/del.png" alt="delete" title="delete">
                                </a>                            
                            </div>
                        </div>
                    <?php 
                        }
                    ?>
                </div>
            </main>
            <?php include('foot.php') ?>
        </div>
    </body>
</html>