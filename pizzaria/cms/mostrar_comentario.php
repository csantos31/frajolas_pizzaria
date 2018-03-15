<?php 

    include('verifica.php');

    include('conect.php');

    //JANELA RESPONSÁVEL POR MOSTRAR REGISTRO EXISTENTE NA TABELA FALE CONOSCO
    $codigo = "";
    $codigo = $_POST['id'];

        $sql = "SELECT * FROM tblfaleconosco WHERE codigo = ".$codigo;

        $select = mysqli_query($conexao,$sql);

        if($rsConsulta=mysqli_fetch_array($select))
        {
            $nome = $rsConsulta['nome'];
            $telefone = $rsConsulta['telefone'];
            $celular = $rsConsulta['celular'];
            $email = $rsConsulta['email'];
            $homepage = $rsConsulta['homepage'];
            $facebook = $rsConsulta['facebook'];
            $sugestao = $rsConsulta['sugestao'];
            $informacaoproduto = $rsConsulta['informacaoproduto'];
            $profissao = $rsConsulta['profissao'];
            $sexo = $rsConsulta['sexo'];

            $chkmasculino = "";
            $chkfeminino = "";

            if($sexo == 'f')
            {
                $chkfeminino = "checked";   
            }
            else{
                $chkmasculino = "checked"; 
            }

        }

            
    
?>


<html>
    <head>
        <title>Adm. Fale Conosco</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <script type="text/javascript" src="js/jquery.js"></script>
        <script>
            $(document).ready(function() {

              $(".fechar").click(function() {
                //$(".modalContainer").fadeOut();
                $(".modalContainer").slideToggle(1000);
              });
            });
	
	   </script>
        
        
    </head>
    <body>
        <div class="fx">
            <a href="#" class="fechar">Fechar</a>
        </div>
    
        <div id="mostrar_comentario">
            <label>Nome:</label>
            <div class="container_label">
                <?php echo($nome); ?>
            </div>
            
            <label>Telefone:</label>
            <div class="container_label">
                <?php echo($telefone); ?>
            </div>
            
            <label>Celular:</label>
            <div class="container_label">
                <?php echo($celular); ?>
            </div>
            
            <label>E-Mail:</label>
            <div class="container_label">
                <?php echo($email); ?>
            </div>
            
            <label>Homepage:</label>
            <div class="container_label">
                <?php echo($homepage); ?>
            </div>
            
            <label>Facebook:</label>
            <div class="container_label">
                <?php echo($facebook); ?>
            </div>
            
            <label>Sugestão:</label>
            <div class="container_label">
                <?php echo($sugestao); ?>
            </div>
            
            <label>Informação do produto:</label>
            <div class="container_label">
                <?php echo($informacaoproduto); ?>
            </div>
            
            <label>Profissão:</label>
            <div class="container_label">
                <?php echo($profissao); ?>
            </div>
            
            <label>Sexo:</label>
            <div class="container_label">
                <input <?php echo($chkfeminino) ?> type="radio" name="rbosexo" value="f">Feminino
                <input <?php echo($chkmasculino) ?> type="radio" name="rbosexo" value="m">Masculino
            </div>                        
        </div>
    </body>
</html>