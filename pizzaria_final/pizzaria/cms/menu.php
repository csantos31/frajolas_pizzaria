<div id="menu_cms"> <!--Menu-->
    <div id="menu">
        
        <a href="adm_content.php">
            <div class="item_menu">
                <div class="foto_menu">
                    <img alt="content" title="content" src="imagens/adm.png">
                </div>
                <div class="desc">
                    <p>Adm. Conteúdo</p>
                </div>
            </div>
        </a>
        
        <a href="gerenciamento_fale_conosco.php">
            <div class="item_menu">
                <div class="foto_menu">
                    <img src="imagens/faleconosco.png" title="contact us" alt="contact us">
                </div>
                <div class="desc">
                    <p>Adm. Fale Conosco</p>
                </div>
            </div>
        </a>
        
        <a href="adm_produtos.php">
            <div class="item_menu">
                <div class="foto_menu">
                    <img src="imagens/produto.png" alt="products" title="products">
                </div>
                <div class="desc">
                    <p>Adm. Produtos</p>
                </div>
            </div>
        </a>
        
        <a href="usuarios_e_niveis.php">
            <div class="item_menu">
            <div class="foto_menu">
                <img src="imagens/users.png" alt="users" title="users">
            </div>
            
            <div class="desc">
                <p>Adm. Usuários</p>
            </div>
        </div>
        </a>
    </div>
    <div id="bem_vindo">
        <?php
            $sessao_nome = $_SESSION['nome'];
        ?>
        
        <p>Bem Vindo(a): <?php echo($sessao_nome); ?></p>
    </div>
    <div id="log_off">
        <a href="?sair">
            <p>Logout</p>
        </a>
        
        <?php 
            if(isset($_REQUEST['sair']))
            {
                session_destroy();
                header ('location: ../index.php');
            }
        ?>
        
    </div>
</div>