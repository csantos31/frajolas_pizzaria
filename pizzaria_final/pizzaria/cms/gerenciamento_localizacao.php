<?php 
    include('verifica.php'); //VERIFICA SE EXISTE ALGUÉM LOGADO
    include('conect.php'); //ESTABELECE CONEXÃO

    $botao = "Salvar";
    $logradouro = "";
    $cidade = "";
    $numero = "";


    if(isset($_GET['modo'])) //VERIFICA SE REGISTRO SERÁ ALTERADO OU EXCLUÍDO
    {
        $modo = $_GET['modo'];
        if($modo == 'excluir')
        {
            $codigo = $_GET['codigo'];
            $sql = 'DELETE FROM tblendereco WHERE idEndereco = '.$codigo;
            mysqli_query($conexao,$sql);
            
            echo"<script language='javascript' type='text/javascript'>alert('Localização deletada com sucesso'); window.location.href='gerenciamento_localizacao.php'; </script>";
            die();
            //echo($sql);
        }else if($modo == "editar"){
            $codigo = $_GET['codigo'];
            $botao = "Atualizar";
            
            $_SESSION['id']=$codigo;
        
            $sql = "select * from tblendereco where idEndereco =".$_SESSION['id'];

            $select = mysqli_query($conexao, $sql);

            if($rsConsulta=mysqli_fetch_array($select)) 
            {
                $logradouro = $rsConsulta['logradouro'];
                $cidade = $rsConsulta['cidade'];
                $numero = $rsConsulta['numero'];
            }
            
        }
        
    }


    if(isset($_POST['btnSalvar'])) //VERIFICA SE REGISTRO SERÁ INSERIDO OU ALTERADO
    {
        $estado = $_POST['sltEstado'];
        $cidade = $_POST['txt_cidade'];
        $logradouro = $_POST['txt_logradouro'];
        $numero = $_POST['txt_numero'];
        
        if($_POST['btnSalvar']=="Salvar")
        {
            $sql = "INSERT INTO tblendereco (idEstado, cidade, logradouro, numero) VALUES ('".$estado."','".$cidade."','".$logradouro."','".$numero."')";
            
        }else if($_POST['btnSalvar']=="Atualizar")
        {
            $sql = "UPDATE tblendereco SET idEstado = ".$estado.", cidade = '".$cidade."', logradouro = '".$logradouro."', numero = '".$numero."' WHERE idEndereco = ".$_SESSION['id'];
            
        }
        
        
        
        //echo($sql);
        
        mysqli_query($conexao, $sql); //MANDA COMANDO PARA O BANCO
        
        header('location:gerenciamento_localizacao.php'); //REDIRECIONA PARA A MESMA PÁGINA
    }

?>

<html>
    <head>
        <title>CMS - Localizações</title>
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
                
                <form method="post" name="frm_localizacao" action="gerenciamento_localizacao.php">
                    <div id="conteudo"> <!--Conteúdo-->
                        <h1> Gerenciamento de Localizações </h1>
                        <div id="about_us">
                            <img src="imagens/location.png" title="Cadastrar Localização" alt="Cadastrar Localização">
                        </div>

                        <div id="container_sobre_nos">
                            <h1>Cadastro de Localização</h1>                        
                            <p><b>Endereço:</b></p>

                            <p>Estado:</p>
                            <select name="sltEstado">

                                <?php 
                                    $sql = 'select * from tblestado';
                                    $select = mysqli_query($conexao, $sql);

                                    while($rsEstado=mysqli_fetch_array($select)){
                                ?>

                                <option value="<?php echo($rsEstado['idEstado']); ?>"> <?php echo($rsEstado['sigla']); ?> </option>

                                    <?php
                                            }

                                    ?>
                            </select><br><br>

                            <input class="inp_about_us"  type="text" required name="txt_cidade" value="<?php echo($cidade) ?>" placeholder="Cidade">
                            <input type="text"id="logra" required name="txt_logradouro" value="<?php echo($logradouro) ?>" placeholder="Logradouro">
                            <input class="inp_about_us" type="text" required name="txt_numero" value="<?php echo($numero) ?>" placeholder="Nº"><br>

                            <input id="btn_salva_localizacao" type="submit" name="btnSalvar" value="<?php echo($botao) ?>">

                        </div>
                        <div id="ver_locais">
                            <h1>Localizações Salvas</h1>
                            <table id="tbl_locais">
                                <tr>
                                    <td>Cidade</td>
                                    <td>Logradouro</td>
                                    <td>Número</td>
                                </tr>
                            </table>
                            
                            <?php 
                        
                                $sql = 'select * from tblendereco order by idEndereco desc';
                                $select = mysqli_query($conexao,$sql);

                                while($rsFc=mysqli_fetch_array($select))
                                {

                            ?>
                            
                            <div class="select_locais">
                                <div class="item_locais"><?php echo($rsFc['cidade']) ?> </div> 
                                <div class="item_locais"><?php echo($rsFc['logradouro']) ?> </div> 
                                <div class="item_locais"><?php echo($rsFc['numero']) ?> </div>
                                <div class="icones_user"> 
                                    <a href="gerenciamento_localizacao.php?modo=editar&codigo=<?php echo($rsFc['idEndereco'])  ?>">
                                        <img src="imagens/edit.png" alt="edit" title="edit">
                                    </a>

                                    <a href="gerenciamento_localizacao.php?modo=excluir&codigo=<?php echo($rsFc['idEndereco'])  ?>">
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