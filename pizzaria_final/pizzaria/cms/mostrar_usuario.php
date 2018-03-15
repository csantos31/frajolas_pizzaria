<?php 
    
    include('verifica.php');

    include('conect.php');

    //MOSTRA USUÁRIO PELA MODAL
        
       
    $codigo = "";
    $codigo = $_POST['id'];

    $sql = "select u.*, n.nivel from tbl_usuario as u inner join tbl_nivel_de_usuario as n where u.id_nivel = n.id_nivel and codigo =".$codigo;

    $select = mysqli_query($conexao,$sql);

    if($rsConsulta=mysqli_fetch_array($select))
    {
        $nome = $rsConsulta['nome'];
        $celular = $rsConsulta['celular'];
        $telefone = $rsConsulta['telefone'];
        $email = $rsConsulta['email'];
        $dt_nasc = $rsConsulta['dt_nasc_user'];
        $username = $rsConsulta['username'];
        $nivel = $rsConsulta['nivel'];
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
        <title>Ver Usuário</title>
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
            
            <label>Celular:</label>
            <div class="container_label">
                <?php echo($celular); ?>
            </div>
            
            <label>Telefone:</label>
            <div class="container_label">
                <?php echo($telefone); ?>
            </div>
            
            <label>E-Mail:</label>
            <div class="container_label">
                <?php echo($email); ?>
            </div>
            
            <label>Data de nascimento:</label>
            <div class="container_label">
                <?php echo($dt_nasc); ?>
            </div>
            
            <label>Sexo:</label>
            <div class="container_label">
                <input <?php echo($chkfeminino) ?> type="radio" name="rbosexo" value="f">Feminino
                <input <?php echo($chkmasculino) ?> type="radio" name="rbosexo" value="m">Masculino
            </div>
            
            <label>Username:</label>
            <div class="container_label">
                <?php echo($username); ?>
            </div>
            
            <label>Nível:</label>
            <div class="container_label">
                <?php echo($nivel); ?>
            </div>
        </div>
    </body>
</html>