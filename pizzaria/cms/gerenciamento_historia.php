<?php 
    include('conect.php');  //CONEXÃO COM O BANCO 
    include('verifica.php'); //VERIFICA EXISTÊNCIA DE USUÁRIO LOGADO
    require_once('uploadfoto.php'); //IMPORTA FUNÇÃO DE ARQUIVO EXTERNO REFERENTE A UPLOAD DE IMAGEM

    $botao = "Salvar";
    $titulo = null;
    $texto = null;


    if(isset($_GET['modo2'])) //VERIFICA SE USUÁRIO DESEJA APAGAR OU TORNAR TRUE REGISTRO EXISTENTE REFERENTE AS IMAGENS
    {
        $modo2 = $_GET['modo2']; //EXCLUI REGISTRO
        if($modo2 == 'excluir')
        {
            $codigo2 = $_GET['codigo2'];
            $sql = "DELETE FROM tblimghistoria WHERE idImgHistoria =".$codigo2;
            mysqli_query($conexao, $sql);
            // echo($sql);
            echo"<script language='javascript' type='text/javascript'>alert('Registro deletado com sucesso'); window.location.href='gerenciamento_historia.php'; </script>";
            die();
            
        }else if($modo2 == 'verdadeiro') //TORNA REGISTRO VERDADEIRO
        {
            $codigo2 = $_GET['codigo2'];
            $sql = "UPDATE tblimghistoria set status = 0";
            mysqli_query($conexao,$sql);
            $sql = "UPDATE tblimghistoria SET status = 1 where idImgHistoria = ".$codigo2;
            mysqli_query($conexao,$sql);
            
            echo"<script language='javascript' type='text/javascript'>alert('Alterado com sucesso'); window.location.href='gerenciamento_historia.php'; </script>";
            die();
        }
    }


    if(isset($_POST['btnFotos'])) //VERIFICA QUE USUÁRIO DESEJA INSERIR GALERIA
    {
        
        //CHAMA A FUNÇÃO EXTERNA DE UPLOAD DE IMAGEM PARA CADA BOTÃO REFERENTE AS IMAGENS
        $nome_arq1 = basename($_FILES['flefoto1']['name']);
        $nome_arq2 = basename($_FILES['flefoto2']['name']);
        $nome_arq3 = basename($_FILES['flefoto3']['name']);
        $nome_arq4 = basename($_FILES['flefoto4']['name']);
        $nome_arq5 = basename($_FILES['flefoto5']['name']);
        $nome_arq6 = basename($_FILES['flefoto6']['name']);
        $nome_arq7 = basename($_FILES['flefoto7']['name']);
        $nome_arq8 = basename($_FILES['flefoto8']['name']);
        $nome_arq9 = basename($_FILES['flefoto9']['name']);
        
        
        //VERIFICA EXTENSÃO DAS IMAGENS POR OUTRA FUNÇÃO EXTERNA
        if( verificaExtensao($nome_arq1) && verificaExtensao($nome_arq2) && verificaExtensao($nome_arq3) && verificaExtensao($nome_arq4) && verificaExtensao($nome_arq5) && verificaExtensao($nome_arq6) && verificaExtensao($nome_arq7) && verificaExtensao($nome_arq8) && verificaExtensao($nome_arq9)){    
            
           /* echo($nome_arq1." ".$nome_arq2." ".$nome_arq3." ".$nome_arq4." ".$nome_arq5." ".$nome_arq6." ".$nome_arq7." ".$nome_arq8." ".$nome_arq9);*/
            
            //MOVE ARQUIVOS DE PASTA TEMPORÁRIA PARA PASTA DEFINITIVA A PARTIR DE OUTRA FUNÇÃO EXTERNA
            $dir1 = uploadArq($nome_arq1);
            moveArq('flefoto1', $dir1);
            $dir2 = uploadArq($nome_arq2);
            moveArq('flefoto2', $dir2);
            $dir3 = uploadArq($nome_arq3);
            moveArq('flefoto3', $dir3);
            $dir4 = uploadArq($nome_arq4);
            moveArq('flefoto4', $dir4);
            $dir5 = uploadArq($nome_arq5);
            moveArq('flefoto5', $dir5);
            $dir6 = uploadArq($nome_arq6);
            moveArq('flefoto6', $dir6);
            $dir7 = uploadArq($nome_arq7);
            moveArq('flefoto7', $dir7);
            $dir8 = uploadArq($nome_arq8);
            moveArq('flefoto8', $dir8);
            $dir9 = uploadArq($nome_arq9);
            moveArq('flefoto9', $dir9);
            
            
            
            $sql = "INSERT INTO tblimghistoria (img1, img2, img3, img4, img5, img6, img7, img8, img9, status)
            VALUES ('".$dir1."','".$dir2."','".$dir3."','".$dir4."','".$dir5."','".$dir6."','".$dir7."','".$dir8."','".$dir9."', 0)";
            
            //echo($sql);
            
            //MANDA STRING PRO BANCO
            mysqli_query($conexao, $sql);
            
            
        }else{
            echo("EXTENSÃO DE ARQUIVO INVÁLIDA");
        }
        
        
        
        
    }



    if(isset($_GET['modo'])) //VERIFICA SE ALGUM REGISTRO DE DÉCADAS SERÁ MODIFICADO OU DELETADO
    {        
        $modo = $_GET['modo'];        
        if($modo == 'excluir')
        {
            $codigo = $_GET['codigo'];
            $sql = "DELETE FROM tbldecada WHERE idDecada =".$codigo;
            //echo($sql);
            mysqli_query($conexao, $sql);
            echo"<script language='javascript' type='text/javascript'>alert('Registro deletado com sucesso'); window.location.href='gerenciamento_historia.php'; </script>";
            die();
        }else if($codigo = 'editar')
        {
            $codigo = $_GET['codigo'];
            $botao = "Editar";
            $sql = "SELECT * FROM tblDecada WHERE idDecada =".$codigo;
            
            $_SESSION['id'] = $codigo;
            
            //echo($sql);
            
            $select = mysqli_query($conexao, $sql);

            if($rsConsulta=mysqli_fetch_array($select))
            {
                $titulo = $rsConsulta['tituloDecada'];
                $texto = $rsConsulta['textoDecada'];
            }
        
        }
    }



    if(isset($_POST['btnSalvar'])) //VERIFICA SE ALGUM REGISTRO SERÁ INSERIDO OU ALTERADO
    {
        $titulo = $_POST['txtTituloDecada'];
        $texto = $_POST['txtDecada'];
        
        
        if($_POST['btnSalvar']=='Salvar')
        {
            addslashes($sql = "INSERT INTO tbldecada (tituloDecada, textoDecada) VALUES ('".$titulo."','".$texto."')");
        }else if($_POST['btnSalvar']=='Editar')
        {
            addslashes($sql = "UPDATE tbldecada set tituloDecada ='".$titulo."', textoDecada ='".$texto."' WHERE idDecada =".$_SESSION['id']);
            echo($sql);
        }
        
        
        mysqli_query($conexao, $sql);
        //echo($sql);
        header('location:gerenciamento_historia.php');
        
    }



?>

<html>
    <head>
        <title>Gerenciamento de curiosidades</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>
    <body>
        <div id="principal">
            <?php include('hd.php') ?>
            <main>
                <form method="post" enctype="multipart/form-data" name="frm_historia" action="gerenciamento_historia.php">
                    <?php include('menu.php') ?>
                
                    <h1>Gerenciamento de curiosidades</h1>

                    <div id="cadastro_decadas">
                        <p><b>Cadastrar Décadas</b></p>

                        <p>Título da década:</p><input id="inp_hist" type="text" value="<?php echo($titulo) ?>" name="txtTituloDecada">
                        <p>Texto referente a década:</p><textarea name="txtDecada" placeholder="..." id="txt_hist"><?php echo($texto) ?></textarea><br><br>

                        <input type="submit" id="btnSalvarDecada" value="<?php echo($botao) ?>" name="btnSalvar">

                    </div>
                    <div id="ver_decadas">
                        <p><b>Ver Décadas</b></p>
                        
                        <?php 
                            
                            include('conect.php');
            
                            $sql = "SELECT * FROM tbldecada order by tituloDecada desc";
            
                            $select = mysqli_query($conexao, $sql);
                            
                            while($rsBusca=mysqli_fetch_array($select))
                            {
                        ?>
                        
                        <div class="titulos_decadas">
                            <?php echo($rsBusca['tituloDecada']) ?>
                        </div>
                        <div class="imagens_decadas">
                            <a href="gerenciamento_historia.php?modo=excluir&codigo=<?php echo($rsBusca['idDecada']) ?>">
                                <img src="imagens/del.png" alt="deletar" title="deletar">
                            </a>
                            <a href="gerenciamento_historia.php?modo=editar&codigo=<?php echo($rsBusca['idDecada']) ?>">
                                <img src="imagens/edit.png" alt="editar" title="editar">    
                            </a>                                
                        </div>
                        
                        <?php
                            }
                        ?>
                        
                    </div>

                    <div id="fotos_decadas">
                        <p>Foto 1</p> <input type="file" name="flefoto1">
                        <p>Foto 2</p> <input type="file" name="flefoto2">
                        <p>Foto 3</p> <input type="file" name="flefoto3">
                        <p>Foto 4</p> <input type="file" name="flefoto4">
                        <p>Foto 5</p> <input type="file" name="flefoto5">
                        <p>Foto 6</p> <input type="file" name="flefoto6">
                        <p>Foto 7</p> <input type="file" name="flefoto7">
                        <p>Foto 8</p> <input type="file" name="flefoto8">
                        <p>Foto 9</p> <input type="file" name="flefoto9"><br><br>
                        
                        <input type="submit" value="Enviar" name="btnFotos">
                        
                    </div>
                    
                    <?php 
                        include('conect.php');
                        
                        $sql = "SELECT * FROM tblimghistoria ORDER BY idImgHistoria desc";
                        $select = mysqli_query($conexao, $sql);
                            
                        while($rsResultado=mysqli_fetch_array($select)){
                    
                    ?>
                
                    <div class="gerenciamento_historia">
                        <div class="item_img_historia">
                            <img src="<?php echo($rsResultado['img1']) ?>" title="galeria" alt="galeria">
                        </div>
                        <div class="item_img_historia">
                            <img src="<?php echo($rsResultado['img2']) ?>" title="galeria" alt="galeria">
                        </div>
                        <div class="item_img_historia">
                            <img src="<?php echo($rsResultado['img3']) ?>" title="galeria" alt="galeria">
                        </div>
                        <div class="item_img_historia">
                            <img src="<?php echo($rsResultado['img4']) ?>" title="galeria" alt="galeria">
                        </div>
                        <div class="item_img_historia">
                            <img src="<?php echo($rsResultado['img5']) ?>" title="galeria" alt="galeria">
                        </div>
                        <div class="item_img_historia">
                            <img src="<?php echo($rsResultado['img6']) ?>" title="galeria" alt="galeria">
                        </div>
                        <div class="item_img_historia">
                            <img src="<?php echo($rsResultado['img7']) ?>" title="galeria" alt="galeria">
                        </div>
                        <div class="item_img_historia">
                            <img src="<?php echo($rsResultado['img8']) ?>" title="galeria" alt="galeria">
                        </div>
                        <div class="item_img_historia">
                            <img src="<?php echo($rsResultado['img9']) ?>" title="galeria" alt="galeria">
                        </div>
                        <div class="icone_gerencia_img">
                            <a href="gerenciamento_historia.php?modo2=verdadeiro&codigo2=<?php echo($rsResultado['idImgHistoria']) ?>">
                                <img title="Definir como atual" alt="Definir como atual" src="imagens/btdefine.png"> 
                            </a>
                            <a href="gerenciamento_historia.php?modo2=excluir&codigo2=<?php echo($rsResultado['idImgHistoria']) ?>">
                                <img title="Excluir" alt="Excluir" src="imagens/del.png">
                            </a>  
                        </div>
                    </div>
                    <?php
                        }
                    ?>
                </form>
            </main>
            <?php include('foot.php') ?>
        </div>    
    </body>
</html>