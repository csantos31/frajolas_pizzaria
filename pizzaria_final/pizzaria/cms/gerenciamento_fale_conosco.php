<?php 

    include('verifica.php'); //VERIFICA SE EXISTE ALGUÉM LOGADO

    include('conect.php'); //CONECTA COM O BANCO

    if(isset($_GET['modo'])) //VERIFICA SE O USUÁRIO DESEJA EXCLUIR O REGISTRO
    {
        $modo = $_GET['modo'];
        if($modo == 'excluir')
        {
            $codigo = $_GET['codigo'];
            $sql = 'DELETE FROM tblfaleconosco WHERE codigo = '.$codigo;
            mysqli_query($conexao,$sql);
            
            echo"<script language='javascript' type='text/javascript'>alert('Comentário deletado com sucesso'); window.location.href='gerenciamento_fale_conosco.php'; </script>";
            die();
            //echo($sql);
        }
        
    }
?>

<html>
    <head>
        <title>CMS - Fale Conosco</title>
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
                url: "mostrar_comentario.php",
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
            <?php 
                include('hd.php');
            ?>
            <main>
                
                <?php 
                    include('menu.php');
                ?>
                
                <div id="conteudo"> <!--Conteúdo-->
                    <h1> Gerenciamento de Fale Conosco </h1>
                    
                    <table id="tbl_fale_conosco">
                        <tr>
                            <td>Nome</td>
                            <td>Celular</td>
                            <td>Profissão</td>
                        </tr>
                    </table>
                    
                    <?php 
                        
                        include('conect.php');
                        
                        $sql = 'select * from tblfaleconosco order by codigo desc';
                        $select = mysqli_query($conexao,$sql);
                    
                        while($rsFc=mysqli_fetch_array($select))
                        {
                    
                    ?>
                    
                    <div class="container_fc">
                        <div class="item_container_fc">
                            <?php 
                                echo($rsFc['nome'])
                            ?>
                        </div>
                        <div class="item_container_fc">
                            <?php 
                                echo($rsFc['celular'])
                            ?>
                        </div>
                        <div class="item_container_fc">
                            <?php 
                                echo($rsFc['profissao'])
                            ?>
                        </div>
                        <div class="icones">
                            <a href="#" class="ver"  onclick="Modal(<?php echo($rsFc["codigo"]) ?>)" >
                                <img src="imagens/look.png" alt="look" title="look" > 
                            </a>
                            | 
                            <a href="gerenciamento_fale_conosco.php?modo=excluir&codigo=<?php echo($rsFc['codigo']) ?>">
                                <img src="imagens/delete.png" title="delete" alt="delete">
                            </a>
                        </div>
                    </div>
                    
                    <?php 
                        }
                    ?>
                </div>
                                
            </main>
            <?php 
                include('foot.php');
            ?>
        </div>
    </body>
</html>