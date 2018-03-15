<?php 
    include('conect.php');
    include('verifica.php');
?>

<html>
    <head>
        <title>Gerenciamento de Produtos</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>
    <body>
        <div id="principal">
            <!--MENU PARA GERENCIAMENTO DE PRODUTOS-->
            <?php include('hd.php') ?>
            <main>
                <?php include('menu.php') ?>
                
                <h1>Gerenciamento de Produtos</h1>
                <a href="gerenciamento_produtos.php"> 
                    <div class="item_gerencia_conteudo">
                        <div class="foto_gerencia_conteudo">
                            <img src="imagens/prod.png" title="Cadastro de produtos" alt="Cadastro de produtos">
                        </div>
                        <div class="texto_gerencia_conteudo">
                            <p>Gerenciamento de Produtos</p>
                        </div>
                    </div>

                </a>
                                
                <a href="pizza_do_mes.php">
                    <div class="item_gerencia_conteudo">
                        <div class="foto_gerencia_conteudo">
                            <img src="imagens/ic_pizza_mes.png" title="Pizza do Mês" alt="Pizza do Mês">
                        </div>
                        <div class="texto_gerencia_conteudo">
                            <p>Gerenciamento da Pizza do Mês</p>
                        </div>
                    </div>
                </a>
                
                <a href="gerenciamento_promocao.php">
                    <div class="item_gerencia_conteudo">
                        <div class="foto_gerencia_conteudo">
                            <img src="imagens/cad_prod.png" title="Promoções" alt="Promoções">
                        </div>
                        <div class="texto_gerencia_conteudo">
                            <p>Gerenciamento Promoções</p>
                        </div>
                    </div>
                </a>               
                
                
            </main>
            <?php include('foot.php') ?>
        </div>    
    </body>
</html>