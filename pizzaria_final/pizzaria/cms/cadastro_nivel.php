<?php 
    include('conect.php');
    include('verifica.php');

    //INICIALIZANDO VARIÁVEIS
    $botao='Salvar';
    $nivel="";
    $descricao="";

    //VERIFICA SE USUÁRIO DESEJA INSERIR OU ALTERAR REGISTRO
    if(isset($_GET['modo']))
    {
        $botao = "Atualizar";
        $codigo = $_GET['codigo'];
        
        $_SESSION['id'] = $codigo;
        
        $sql = "select * from tbl_nivel_de_usuario where id_nivel =".$codigo;
        
        $select = mysqli_query($conexao, $sql);
        
        if($rsConsulta=mysqli_fetch_array($select))
        {
            $nivel = $rsConsulta['nivel'];
            $descricao = $rsConsulta['descricao'];
        }
        
        
    }


    //VERIFICA SE USUÁRIO DESEJA INSERIR OU EDITAR REGISTRO
    if(isset($_POST['btn_salvar_nivel']))
    {
        $titulo = $_POST['txt_nivel'];
        $desc = $_POST['txt_descricao'];
        
        if($_POST['btn_salvar_nivel']=='Salvar')
        {
            addslashes($sql = "INSERT INTO tbl_nivel_de_usuario (nivel, descricao) 
            VALUES ('".$titulo."','".$desc."')");    
        }else if($_POST['btn_salvar_nivel']=='Atualizar')
        {
            addslashes($sql="UPDATE tbl_nivel_de_usuario SET nivel='".$titulo."', descricao='".$desc."' WHERE id_nivel =".$_SESSION['id']);
            //echo($sql);
        }
        
        
        //MANDA PARÂMETRO PARA O BANCO E REALIZA UPDATE OU INSERT
        include('queryy.php');
        header('location:gerenciamento_niveis.php'); //RECARREGA A PÁGINA
    }
?>
<html>
    <head>
        <title>Cadastro de Níveis de usuário</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>
    <body>
        <div id="principal">
            <?php include('hd.php') ?>
            <main>
                <?php include('menu.php') ?>
                <form name="frm_cadastro_nivel" method="post" action="cadastro_nivel.php">
                        <div id="conteudo">
                            <h1>Cadastro de nível</h1>
                            
                            <div class="container_cad_user">
                                <input type="text" value="<?php echo($nivel) ?>" name="txt_nivel" required placeholder="Título" class="input_data" maxlength="254">
                            </div>
                            <div class="container_cad_user">
                                <input type="text" value="<?php echo($descricao) ?>" name="txt_descricao" required placeholder="Descrição" class="input_data" maxlength="254">
                            </div>
                            <input id="bt_salva_user" type="submit" value="<?php echo($botao) ?>" name="btn_salvar_nivel">
                        </div>
                </form>                
            </main>
            <?php include('foot.php') ?>
        </div>
    </body>
</html>