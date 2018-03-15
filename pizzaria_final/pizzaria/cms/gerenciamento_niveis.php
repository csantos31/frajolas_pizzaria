<?php
    
    include('verifica.php');  //SEGURANÇA
    include('conect.php');  //CONEXÃO
    
    if(isset($_GET['modo'])) //VERIFICA SEREGISTRO SERÁ EXCLUÍDO OU ALTERADO
    {
        $modo = $_GET['modo'];
        if($modo='excluir')
        {
            $codigo = $_GET['codigo'];
            $sql = "DELETE FROM tbl_nivel_de_usuario WHERE id_nivel =".$codigo;
            
            mysqli_query($conexao, $sql);
            
            echo"<script language='javascript' type='text/javascript'>alert('Usuário deletado com sucesso'); window.location.href='gerenciamento_niveis.php'; </script>";
            die();
        }
    }

?>



<html>
    <head>
        <title>Gerenciamento de níveis</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>
    <body>
        <div id="principal">
            <?php include('hd.php') ?>
            
            <main>
                <?php include('menu.php') ?>
                
                <div id="conteudo">
                    <h1>Gerenciamento de níveis</h1>
                    
                    <table id="tbl_niveis">
                        <tr>
                            <td>Nível:</td>
                            <td>Descrição:</td>
                        </tr>
                    </table>
                    
                    <?php
                    
                        include('conect.php');
                        
                        $sql = 'select * from tbl_nivel_de_usuario order by id_nivel desc';
                        $select = mysqli_query($conexao, $sql);
            
                        while($rsNiveis=mysqli_fetch_array($select)){
                    ?>
                    
                        <div class="container_ni">
                            <div class="item_container_ni">
                                <?php echo($rsNiveis['nivel']) ?>
                            </div>
                            <div class="item_container_ni">
                                <?php echo($rsNiveis['descricao']) ?>
                            </div>
                            <div class="icones_user"> 

                                <a href="cadastro_nivel.php?modo=editar&codigo=<?php echo($rsNiveis['id_nivel']) ?>">
                                    <img src="imagens/edit.png" alt="edit" title="edit">
                                </a>

                                <a href="gerenciamento_niveis.php?modo=excluir&codigo=<?php echo($rsNiveis['id_nivel']) ?>">
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