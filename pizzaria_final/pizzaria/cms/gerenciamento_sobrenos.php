<?php 
    include('verifica.php');  //CONEXÃO
    include('conect.php');  //SEGURANÇA

    $botao = "Salvar";
    $unidade = "";
    $descricao = "";

    if(isset($_GET['modo']))  //VERIFICA SE REGISTRO SERÁ ALTERADO OU EXCLUÍDO
    {
        $modo = $_GET['modo'];
        if($modo == 'excluir')
        {
            $codigo = $_GET['codigo'];
            $sql = 'DELETE FROM tblunidade WHERE idUnidade = '.$codigo;
            mysqli_query($conexao,$sql);
            
            echo"<script language='javascript' type='text/javascript'>alert('Unidade deletada com sucesso'); window.location.href='gerenciamento_sobrenos.php'; </script>";
            die();
            //echo($sql);
        }else if($modo == "editar"){
            $codigo = $_GET['codigo'];
            $botao = "Atualizar";
            
            $_SESSION['id']=$codigo;
        
            $sql = "select * from tblunidade where idUnidade =".$_SESSION['id'];

            $select = mysqli_query($conexao, $sql);

            if($rsConsulta=mysqli_fetch_array($select)) 
            {
                $unidade = $rsConsulta['unidade'];
                $descricao = $rsConsulta['descricao'];
                $endereco = $rsConsulta['idEndereco'];
            }
            
        }
        
    }


    if(isset($_POST['btnSalvar'])) //VERIFICA SE REGISTRO SERÁ ALTERADO OU INSERIDO
    {
        $nome = $_POST['txt_nome_unidade'];
        $desc = $_POST['txt_descricao'];
        $endereco = $_POST['sltLocaliza'];
        
        if($_POST['btnSalvar']=='Salvar')
        {
            $sql = "INSERT INTO tblunidade (unidade, descricao, idEndereco) VALUES ('".$nome."','".$desc."','".$endereco."')";
            
        }else if($_POST['btnSalvar']=='Atualizar')
        {  
            $sql = "UPDATE tblunidade set unidade ='".$nome."', descricao ='".$desc."', idEndereco =".$endereco." WHERE idUnidade = ".$_SESSION['id'];
            
        }
        
        
        mysqli_query($conexao, $sql);
        header('location:gerenciamento_sobrenos.php');
        //echo($sql);
    }


?>

<html>
    <head>
        <title>CMS - Sobre Nós</title>
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
                <form method="post" name="frm_sobre_nos" action="gerenciamento_sobrenos.php">
                    <div id="conteudo"> <!--Conteúdo-->
                        <h1> Gerenciamento de Sobre Nós </h1>
                        <div id="about_us">
                            <img src="imagens/unit.png" title="Cadastrar Unidade" alt="Cadastrar Unidade">
                        </div>

                        <div id="container_sobre_nos">
                            <h1>Cadastro de Unidade</h1>
                            <input class="inp_about_us" type="text" required name="txt_nome_unidade" value="<?php echo($unidade) ?>" placeholder="Nome da Unidade"><br><br>

                            <textarea id="txt_descreve" name="txt_descricao" required placeholder="Descrição da Unidade"><?php echo($descricao) ?></textarea>                        
                            <p><b>Localização</b></p>
                            <select name="sltLocaliza">
                                
                                <?php 
                                    $sql = 'select * from tblendereco';
                                    $select = mysqli_query($conexao, $sql);

                                    while($rsEndereco=mysqli_fetch_array($select)){
                                ?>

                                <option value="<?php echo($rsEndereco['idEndereco']); ?>"> <?php echo($rsEndereco['logradouro']); ?> </option>

                                    <?php
                                            }

                                    ?>                                
                            </select><br><br>

                            <input id="btn_salva_unidade" type="submit" name="btnSalvar" value="<?php echo($botao) ?>">
                        </div>
                        <div id="ver_locais">
                            <h1>Localizações Salvas</h1>
                            <table id="tbl_unidades">
                                <tr>
                                    <td>Unidade</td>
                                    <td>Descrição</td>
                                </tr>
                            </table>
                            
                            <?php 
                        
                                $sql = 'select * from tblunidade order by idUnidade desc';
                                $select = mysqli_query($conexao,$sql);

                                while($rsFc=mysqli_fetch_array($select))
                                {

                            ?>
                            
                            <div class="select_unidades">
                                <div class="item_unidades"><?php echo($rsFc['unidade']) ?> </div> 
                                <div class="item_unidades"><?php echo($rsFc['descricao']) ?> </div> 
                                <div class="icones_user"> 
                                    <a href="gerenciamento_sobrenos.php?modo=editar&codigo=<?php echo($rsFc['idUnidade'])  ?>">
                                        <img src="imagens/edit.png" alt="edit" title="edit">
                                    </a>

                                    <a href="gerenciamento_sobrenos.php?modo=excluir&codigo=<?php echo($rsFc['idUnidade'])  ?>">
                                        <img src="imagens/del.png" alt="delete" title="delete">
                                    </a>                            
                                </div>
                            </div>
                            
                            <?php
                                }
                            ?>
                        </div>

                    </div>  
                </form>
            </main>
            <?php 
                include('foot.php');
            ?>
        </div>
    </body>
</html>