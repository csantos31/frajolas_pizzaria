<?php 

    include('verifica.php');
    include('conect.php');

    if(isset($_GET['modo']))
    {
        $modo = $_GET['modo'];
        if($modo='excluir')
        {
            $codigo = $_GET['codigo'];
            $sql = "DELETE FROM tbl_usuario WHERE codigo =".$codigo;
            
            mysqli_query($conexao, $sql);
            
            echo"<script language='javascript' type='text/javascript'>alert('Usuário deletado com sucesso'); window.location.href='gerenciamento_usuarios.php'; </script>";
            die();
        }
    }


?>

<html>
    <head>
        <title>Gerenciamento de usuários</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <script type="text/javascript" src="js/jquery.js"></script>
        <script>
            $(document).ready(function() {

              $(".ver").click(function() {
                $(".modalContainer").slideToggle(2000);
                //slideToggle
                //toggle
                //FadeIn
              });
            });

	
	
        function Modal(idIten){
            $.ajax({
                type: "POST",
                url: "mostrar_usuario.php",
                data: {id:idIten},
                success: function(dados){
                    $('.modal').html(dados);
                }
            });
        }
        </script>
    </head>
    <body>
        <div class="modalContainer">
            <div class="modal">

            </div>
        </div>
        <div id="principal">
            <?php include('hd.php') ?>
            <main>
                <?php include('menu.php') ?>
                
                <div id="conteudo">
                    <h1>Gerenciamento de Usuários</h1>
                    <table id="tbl_usuarios">
                        <tr>
                            <td>Nome:</td>
                            <td>Celular:</td>
                            <td>E-Mail:</td>
                        </tr>
                    </table>
                    
                    <?php
                    
                        include('conect.php');
                        
                        $sql = 'select * from tbl_usuario order by codigo desc';
                        $select = mysqli_query($conexao, $sql);
            
                        while($rsUsuario=mysqli_fetch_array($select)){
                    ?>
                    
                    <div class="container_us">
                        <div class="item_container_us">
                            <?php echo($rsUsuario['nome']) ?>
                        </div>
                        <div class="item_container_us">
                            <?php echo($rsUsuario['celular']) ?>
                        </div>
                        <div class="item_container_us">
                            <?php echo($rsUsuario['email']) ?>
                        </div>
                        <div class="icones_user"> 
                            
                            <a href="#" class="ver"  onclick="Modal(<?php echo($rsUsuario["codigo"]) ?>)">
                                <img src="imagens/see.png" alt="look" title="look">
                            </a>
                            
                            <a href="adm_usuario.php?modo=editar&codigo=<?php echo($rsUsuario['codigo']) ?>">
                                <img src="imagens/edit.png" alt="edit" title="edit">
                            </a>
                            
                            <a href="gerenciamento_usuarios.php?modo=excluir&codigo=<?php echo($rsUsuario['codigo']) ?>">
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