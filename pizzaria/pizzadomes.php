<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>Pizza do mês</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="icon" href="icon/favicon.ico">
    </head>
    <body>
        <div id="principal">
            <?php 
                include("menu.php")
            ?>
            <div id="mainPagina">
                
                <?php
                                    
                    $sql = "SELECT * FROM tblproduto WHERE pizzaMes = 1";

                    $select = mysqli_query($conexao, $sql);

                    $rsPm=mysqli_fetch_array($select);

                ?>
                
                <div id="pizza_do_mes"> <!--Pizza do mês-->
                    <h1>Pizza do mês</h1>
                    <img alt="pizza do mês" title="pizza do mês" src="cms/<?php echo($rsPm['fotoProduto']) ?>">
                    <p>Nome:</p>
                    <p><?php echo($rsPm['nome']) ?></p>
                    <p>Descrição</p>
                    <p><?php echo($rsPm['descricao']) ?></p>
                    <p>Preço:</p>
                    <p><?php echo($rsPm['preco']) ?></p>
                </div> 
            </div>
            <?php 
                include("rdp.php")
            ?>
        </div>
    </body>
</html>