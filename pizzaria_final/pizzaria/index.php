<?php 
    session_write_close();
    include('cms/conect.php');

$busca = "SELECT * FROM tblproduto WHERE idProduto > 0";

    if(isset($_GET['buscarPor'])){
        $idSub = $_GET['buscarPor'];
        $busca = $busca . " AND idSubcategoria =".$idSub;
        
    }else if(isset($_POST['nome_busca'])){
        $nome = $_POST['nome_busca'];

        $busca = $busca . " AND nome LIKE  '%".$nome."';";
    }else{
        $busca = $busca . " ORDER BY RAND()";
    }
  

?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>Home</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <meta charset="utf-8">
        <link rel="icon" href="icon/favicon.ico">
        <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
        <script type="text/javascript" src="js/jquery.cycle.all.js.js"></script>
        <script type="text/javascript" src="js/arc1.js"></script>
        <script>
            function modal(idIten){
                var id = idIten;
                console.log(id);
                
                var modal = document.getElementById('pagina_modal');
                var principal = document.getElementById('principal');
                modal.style.display = 'block';
                principal.style.display = 'none';
                
                $.ajax({
                    type: "POST",
                    url: "modal_produto.php",
                    data:{id:id},
                    async: true,
                    success: function (dados){
                        console.log(dados);
                        $('#pagina_modal').html(dados);
                    }
                    
                });
            }
        </script>
    </head>
    <body>
        <div id="principal"> <!--Container Geral do site-->
            <?php 
                include("menu.php");
            ?>
            <div id="mainPagina">
                <?php 
                    include("socialmidia.php");
                ?>
                <div id="container"> <!--Container dedicado a produtos-->
                    <div id="transicao">
                        <div id="seta_esquerda">
                            <a href="#" id="previous"><img alt="seta para a esquerda" title="seta para a esquerda" src="imagens/esquerda.png"></a>
                        </div>
                        <div id="slide">
                            <ul id="list">
                                
                                <?php
                                    
                                    $sql = "SELECT * FROM tblhome WHERE status = 1";
                                
                                    $select = mysqli_query($conexao, $sql);
                                
                                    $rsSlide=mysqli_fetch_array($select);
                                    
                                ?>
                                    <li><img class="image" title="pizzas da casa" alt="pizzas da casa" src="cms/<?php echo($rsSlide['imgSlide1']) ?>"></li>
                                    <li><img class="image" title="pizzas da casa" alt="pizzas da casa" src="cms/<?php echo($rsSlide['imgSlide2']) ?>"></li>
                                    <li><img class="image" title="pizzas da casa" alt="pizzas da casa" src="cms/<?php echo($rsSlide['imgSlide3']) ?>"></li>
                            </ul>
                        </div>
                        <div id="seta_direita">
                            <a href="#" id="next"><img alt="seta para a direita" title="seta para a direita" src="imagens/direita.png"></a>
                        </div>
                    </div>
                    <div id="introduce"> <!--Mensagem subliminar, ou a expectativa dela-->
                        <?php echo($rsSlide['texto']) ?>
                    </div>
                    <div id="container2">
                        <div id="menu_lateral">
                            <?php
                                $sql = "SELECT * FROM tblcategoria";
                                $select = mysqli_query($conexao, $sql);
                                while($rsCategoria=mysqli_fetch_array($select)){

                                    $id = $rsCategoria['idCategoria'];
                            ?>        
                                <div class="teste_item">
                                     <?= $rsCategoria['nome'] ?>
                                     <?php
                                        $sqli = "SELECT * FROM tblsubcategoria WHERE idCategoria = ". $id;
                                      
                                        $selecti = mysqli_query($conexao, $sqli);
                                        while($rsSubCat=mysqli_fetch_array($selecti)){
                                    ?>
                                        <div class="subCat">
                                            <a href="index.php?buscarPor=<?= $rsSubCat['idSubcategoria']?> " >
                                                <?= $rsSubCat['nome'] ?> 
                                            </a>
                                        </div>
                                        
                                    <?php        
                                        }
                                    ?>
                                    
                                </div>
                            <?php    
                                }
                            ?>        
                        </div>
                        
                        <div id="produtos">
                            <div id="busca">
                                <form action="index.php" method="post" name="frmBusca" id="formbusca">
                                    <div id="inputBusca">
                                        <input type="text" id="inp_busca" name="nome_busca">
                                    </div>
                                     
                                        <div id="img_busca" onclick="document.getElementById('formbusca').submit()">
                                        </div>
                                   
                                </form>
                            </div>

                            <?php 
                                $go = mysqli_query($conexao, $busca);
                            
                                //echo($busca);
                            
                                foreach ($go as $item) {
                            ?>
                                <div class="teste_produto">
                                    <div class="up_produto">
                                        <div class="foto">
                                            <img src="cms/<?= $item['fotoProduto'] ?>">
                                        </div>
                                    </div>
                                    <div class="down_produto">
                                        <?= $item['nome'] ?><br>
                                        <b>Descrição:</b><br> <?= $item['descricao'] ?><br>
                                        <b>Preço:</b> <?= $item['preco'] ?><br>
                                    </div>
                                    <a href="#" class="ver" onclick="modal(<?= $item['idProduto'] ?>)">
                                        <div class="detalhes">
                                            Detalhes
                                        </div>
                                    </a>
                                </div>


                            <?php           
                                    }    

                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php 
                include ("rdp.php");
            ?>
        </div>
        <div id="pagina_modal">
            <div id="corpo_modal">
                
            </div>
        </div>
    </body>
</html>