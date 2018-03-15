<?php 
    //INCLUDE DE ARQUIVO QUE ESTABELECE CONEXÃO COM BANCO DE DADOS
    include('conect.php');

    //VERIFICA SE EXISTE UM USUÁRIO LOGADO, CASO NÃO EXISTA, O USUÁRIO É REDIRECIONADO PARA A HOME (DO SITE COMUM)
    include('verifica.php');

    //INICIALIZANDO VARIÁVEIS QUE SERÃO APRESENTADAS PARA USUÁRIO QUANDO ELE FOR REALIZAR UPDATE
    $botao = 'Salvar';
    $nome  = null;
    $celular = null;
    $telefone = null;
    $email = null;
    $username = null;
    $password = null;
    $nivel_usuario = null;
    $sexo = null;
    $dt_nasc = null;
    $chkfeminino = null;
    $chkmasculino = null;


    //VERIFICA SE O USUÁRIO CLICOU NA VARIÁVEL RESPONSÁVEL POR EXCLUIR E EDITAR REGISTRO NO BANCO
    if(isset($_GET['modo']))
    {
        //VERIFICOU QUE USUÁRIO DESEJA EDITAR
        $botao = "Atualizar";
        $codigo = $_GET['codigo'];
                
        $_SESSION['id']=$codigo;
        
        $sql = "select * from tbl_usuario where codigo =".$codigo;
        
        $select = mysqli_query($conexao, $sql);
            
        if($rsConsulta=mysqli_fetch_array($select)) 
        {
            $nome = $rsConsulta['nome'];
            $celular = $rsConsulta['celular'];
            $telefone = $rsConsulta['telefone'];
            $email = $rsConsulta['email'];
            $username = $rsConsulta['username'];
            $password = $rsConsulta['password'];
            $nivel_usuario = $rsConsulta['id_nivel'];
            $sexo = $rsConsulta['sexo'];
            $dt_nasc = $rsConsulta['dt_nasc_user'];
            
            //$dt = explode(" ",$dt_nasc);
            
            //$data = $dt[0];
            //$hora = $dt[1];
            
            $chkfeminino = "";
            $chkmasculino = "";
            
            //$dt2 = explode("-",$data);
        
            
            
            if($sexo == 'f')
            {
                $chkfeminino = "checked";
            }else{
                $chkmasculino = "checked";
            }
            
            
        }
        
    }



    //VERIFICA SE USUÁRIO PRESSIONOU O BOTÃO RESPONSÁVEL POREDITAR OU INSERIR REGISTRO
    if(isset($_POST['btn_salvar_usuario']))
    {
        $nome = $_POST['txt_nome_user'];
        $celular = $_POST['txt_celular_user'];
        $telefone = $_POST['txt_telefone_user'];
        $email = $_POST['txt_email_user'];
        $sexo = $_POST['rbosexo_user'];
        $dt_nasc = $_POST['txt_dt_nasc'];
        $username = $_POST['txt_username'];
        $password = $_POST['txt_password'];
        $nivel_usuario = $_POST['slt_nivel'];
        
        //VERIFICA SE O USUÁRIO DESEJA INSERIR OU ALTERAR REGISTRO
        if($_POST['btn_salvar_usuario']=='Salvar')
        {
            addslashes($sql = "INSERT INTO tbl_usuario (nome, celular, telefone, email, sexo, dt_nasc_user, username, password, id_nivel)
        
            VALUES('".$nome."','".$celular."','".$telefone."','".$email."','".$sexo."','".$dt_nasc."','".$username."','".$password."','".$nivel_usuario."')");
             
        }else if($_POST['btn_salvar_usuario']=='Atualizar')
        {
            addslashes($sql = "UPDATE tbl_usuario SET nome='".$nome."',celular='".$celular."',telefone='".$telefone."',email='".$email."',sexo='".$sexo."',dt_nasc_user='".$dt_nasc."',username='".$username."',password='".$password."',id_nivel=".$nivel_usuario." WHERE codigo = ".$_SESSION['id']);
           
        }
        
        include('queryy.php');   
        header('location:gerenciamento_usuarios.php');
    }


?>

<html>
    <head>
        <title>Adm. Usuários</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>
    <body>
        <div id="principal">
            <?php 
                include('hd.php');
            ?>
            
            <main>
                <?php 
                    include('menu.php');
                ?>
                <form name="frm_cadastro_usuario" method="post" action="adm_usuario.php">
                    <div id="conteudo">
                        <h1>Cadastro de usuário</h1>
                        
                        <div class="container_cad_user">
                            <div id="foto_perfil">
                            
                            </div>
                        </div>
                        <div class="container_cad_user">
                            <input type="text" value="<?php echo($nome) ?>" name="txt_nome_user" required placeholder="Nome" class="input_data" maxlength="254">
                        </div>
                        <div class="container_cad_user">
                            <input type="number" value="<?php echo($celular) ?>" name="txt_celular_user" required placeholder="Celular" class="input_data" maxlength="15">
                        </div>
                        <div class="container_cad_user">
                            <input type="number" value="<?php echo($telefone) ?>" name="txt_telefone_user" required placeholder="Telefone" class="input_data" maxlength="15">
                        </div>
                        <div class="container_cad_user">
                            <input type="email" value="<?php echo($email) ?>" name="txt_email_user" required placeholder="E-Mail" class="input_data" maxlength="254">
                        </div>
                        <div class="container_cad_user">
                            <p>Sexo:</p>
                            <input <?php echo($chkfeminino) ?> type="radio" name="rbosexo_user" value="f">Feminino
                            <input type="radio" <?php echo($chkmasculino) ?> name="rbosexo_user" value="m">Masculino
                        </div>
                        <div class="container_cad_user">
                            <p>Data de Nascimento</p>
                            <input type="date" value="<?php echo($dt_nasc ) ?>" name="txt_dt_nasc" required class="input_data">
                        </div>
                        <div class="container_cad_user">
                            <p>Dados para login</p>
                            
                            <input type="text" value="<?php echo($username) ?>" name="txt_username" required placeholder="Username" maxlength="15" class="dados_para_login">
                            
                            <input type="text" value="<?php echo($password) ?>" name="txt_password" required placeholder="Password" maxlength="15" class="dados_para_login">
                        </div>
                        <div class="container_cad_user">
                            <p>Nivel de usuário</p>
                            <select name="slt_nivel">
                                <?php 
                                    $sql = 'select * from tbl_nivel_de_usuario';
                                    $select = mysqli_query($conexao, $sql);
                                                                        
                                    while($rsConsulta=mysqli_fetch_array($select)){
                                ?>
                                <option value="<?php echo($rsConsulta['id_nivel']); ?>"> <?php echo($rsConsulta['nivel']); ?> </option>
                                
                                <?php
                                        }
                                    
                                ?>
                            </select>
                        </div>
                        <input id="bt_salva_user" type="submit" value="<?php echo($botao) ?>" name="btn_salvar_usuario">
                    </div>
                </form>
            </main>
            <?php 
                include('foot.php');
            ?>
        </div>
    </body>
</html>