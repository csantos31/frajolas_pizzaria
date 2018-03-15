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
                
                <h1>Grenciando produtos...</h1>
                
                <a href="gerenciamento_categorias.php">
                    <div class="item_gerencia_conteudo">
                        <div class="foto_gerencia_conteudo">
                            <img src="imagens/categoria.png" title="Subcategorias" alt="Subcategorias">
                        </div>
                        <div class="texto_gerencia_conteudo">
                            <p>Gerenciar categorias</p>
                        </div>
                    </div>
                </a>  
                
                 <a href="gerenciamento_subcategorias.php">
                    <div class="item_gerencia_conteudo">
                        <div class="foto_gerencia_conteudo">
                            <img src="imagens/categoria.png" title="Categorias" alt="Categorias">
                        </div>
                        <div class="texto_gerencia_conteudo">
                            <p>Gerenciar subcategorias</p>
                        </div>
                    </div>
                </a>
                
                <a href="gerenciamento_produto.php">
                    <div class="item_gerencia_conteudo">
                        <div class="foto_gerencia_conteudo">
                            <img src="imagens/prod.png" title="Cadastro de produtos" alt="Cadastro de produtos">
                        </div>
                        <div class="texto_gerencia_conteudo">
                            <p>Gerenciar produtos</p>
                        </div>
                    </div>
                </a>
                
                <a href="estatisticas.php">
                    <div class="item_gerencia_conteudo">
                        <div class="foto_gerencia_conteudo">
                            <img src="imagens/graph.png" title="Ver acessos" alt="Ver acessos">
                        </div>
                        <div class="texto_gerencia_conteudo">
                            <p>Estatísticas de acesso</p>
                        </div>
                    </div>
                </a>
            </main>
            <?php include('foot.php') ?>
        </div>    
    </body>
</html>