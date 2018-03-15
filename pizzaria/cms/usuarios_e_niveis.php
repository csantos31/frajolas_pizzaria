<?php 
    include('conect.php');
    include('verifica.php');
?>

<html>
    <head>
        <title>Usuários e Níveis</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>
    <body>
        <div id="principal">
            <?php include('hd.php') ?>
            
            <main>
                <?php include('menu.php') ?>
                <div id="conteudo">
                    <h1>Níveis e Usuários</h1>
                    
                    <a href="adm_usuario.php">
                        <div class="item_niveis_e_usuarios">
                            <div class="foto_n_e_u">
                                <img src="imagens/new_user.png" title="Novo Usuário" alt="Novo Usuário">
                            </div>
                            <div class="texto_n_e_u">
                                <p>CADASTRAR NOVO USUÁRIO</p>
                            </div>
                        </div>
                    </a>
                    
                    <a href="cadastro_nivel.php">
                        <div class="item_niveis_e_usuarios">
                            <div class="foto_n_e_u">
                                <img src="imagens/niveis.png" title="Novo nível de usuário" alt="Novo nível usuário">
                            </div>
                            <div class="texto_n_e_u">
                                <p>CADASTRAR NOVO NÍVEL</p>
                            </div>
                        </div>
                    </a>
                    
                    <a href="gerenciamento_usuarios.php">
                        <div class="item_niveis_e_usuarios">
                            <div class="foto_n_e_u">
                                <img src="imagens/users2.png" title="Gerenciar usuários" alt="Gerenciar Usuários">
                            </div>
                            <div class="texto_n_e_u">
                                <p>GERENCIAR USUÁRIOS</p>
                            </div>
                        </div>
                    </a>
                    <a href="gerenciamento_niveis.php">
                        <div class="item_niveis_e_usuarios">
                            <div class="foto_n_e_u">
                                <img src="imagens/settings.png" title="Gerenciar usuários" alt="Gerenciar Usuários">
                            </div>
                            <div class="texto_n_e_u">
                                <p>GERENCIAR NÍVEIS</p>
                            </div>
                        </div>
                    </a>                        
                </div>
            </main>
            <?php include('foot.php') ?>
        </div>
    </body>
</html>