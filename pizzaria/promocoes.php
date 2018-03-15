<!DOCTYPE html> 
<?php
    include('cms/conect.php');

?>

<html lang="pt-br">
    <head>
        <title>Promoções</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="icon" href="icon/favicon.ico">
        <meta charset="utf-8">
    </head>
    <body>
        <div id="principal"> <!--Página dedicada as promoções-->
            <?php 
                include("menu.php");
            ?>
            <div id="mainPagina">
                <?php 
                    include("socialmidia.php");
                ?>
                <div id="container">
                    <div id="container2"> <!--Promoções-->
                        <div id="produtos_promo">
                            
                            <div id="desconto">
                                Pizzas com desconto!
                            </div>
                            <?php 
                                $sql = "select pd.*, pm.* from tblpromocao as pm, tblproduto as pd where pm.idProduto = pd.idProduto;";

                                $select = mysqli_query($conexao, $sql);
                                while($rsLista=mysqli_fetch_array($select)){
                                    $valor = $rsLista['preco'];
                                    $desconto = $rsLista['desconto']; 
                                    $preco = $valor - ( $valor * $desconto / 100); 
                            ?>
                            <div class="teste_produto">
                                <div class="up_produto">
                                    <div class="foto">
                                        <img src="cms/<?php echo($rsLista['fotoProduto']) ?>" title="Promoção" alt="Promoção">
                                    </div>
                                </div>
                                <div class="down_produto">
                                    <b>Nome: <?php echo($rsLista['nome']) ?></b><br>
                                    <b>Descrição: <?php echo($rsLista['descricao']) ?></b><br>
                                    <b>Preço: <?php echo("R$ " . $preco . " Reais"); ?> </b><br>
                                </div>
                            </div>
                            <?php
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php 
                include("rdp.php");
            ?>
        </div>
    </body>
</html>