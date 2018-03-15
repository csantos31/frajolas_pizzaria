<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>Sobre nós</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="icon" href="icon/favicon.ico">
    </head>
    <body>
        <div id="principal_historia">
            <?php 
                include("menu.php");
            ?>
            <div id="mainPagina">
                <div id="superior_historia">
                    <div id="align">
                        <img src="imagens/logo.jpg" alt="Frajola's pizzaria" title="Frajola's pizzaria">
                    </div>
                </div>
                <div id="texto_historia">
                    <h1>Sobre nós</h1>
                    
                    <?php 
                        $sql = "SELECT * FROM tblunidade order by unidade";
            
                        $select = mysqli_query($conexao, $sql);
                        while($rsUnidade=mysqli_fetch_array($select))
                        {
                            
                    ?>
                    
                    <div class="titulo_sobre">
                        <h2><?php echo($rsUnidade['unidade']) ?></h2>
                    </div>
                    <p>
                        <?php echo($rsUnidade['descricao']) ?>
                    </p>
                    
                    <?php
                        }
                    ?>
                </div>
            </div>
            <?php 
                include("rdp.php");
            ?>
        </div>
    </body>
</html>