<?php 
    include('conect.php');
    include('verifica.php');
?>

<html>
    <head>
        <title>Gerenciamento de conteúdo</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>
    <body>
        <div id="principal">
            <!--MENU DE GERENCIAMENTO DE CONTEÚDO-->
            <?php include('hd.php') ?>
            <main>
                <?php include('menu.php') ?>
                
                <h1>Gerenciamento de Conteúdo</h1>
                
                <a href="gerenciamento_home.php">
                    <div class="item_gerencia_conteudo">
                        <div class="foto_gerencia_conteudo">
                            <img src="imagens/ic_home.png" title="Página Home" alt="Página Home">
                        </div>
                        <div class="texto_gerencia_conteudo">
                            <p>Gerenciamento Página Home</p>
                        </div>
                    </div>
                </a>
                
                <a href="gerenciamento_sobrenos.php">
                    <div class="item_gerencia_conteudo">
                        <div class="foto_gerencia_conteudo">
                            <img src="imagens/ic_about_us.png" title="Sobre Nós" alt="Sobre Nós">
                        </div>
                        <div class="texto_gerencia_conteudo">
                            <p>Gerenciamento da página Sobre Nós</p>
                        </div>
                    </div>
                </a>
                <a href="gerenciamento_localizacao.php">
                    <div class="item_gerencia_conteudo">
                        <div class="foto_gerencia_conteudo">
                            <img src="imagens/ic_endereco.png" title="Localizações" alt="Localizações">
                        </div>
                        <div class="texto_gerencia_conteudo">
                            <p>Gerenciamento Localizações</p>
                        </div>
                    </div>
                </a>                
                <a href="gerenciamento_historia.php">
                    <div class="item_gerencia_conteudo">
                        <div class="foto_gerencia_conteudo">
                            <img src="imagens/ic_history.png" title="História" alt="História">
                        </div>
                        <div class="texto_gerencia_conteudo">
                            <p>Gerenciamento Página História</p>
                        </div>
                    </div>
                </a>
            </main>
            <?php include('foot.php') ?>
        </div>    
    </body>
</html>