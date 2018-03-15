<?php 
    include('conect.php'); //CONECTA COM O BANCO
    include('verifica.php');  //VERIFICA SE HÁ CONEXÃO


    if(isset($_GET['modo'])) //VERIFICA SE REGISTRO SERÁ DELETADO OU MODIFICADO
    {
        $modo = $_GET['modo'];
        if($modo == 'excluir')
        {
            $codigo = $_GET['codigo'];
            $sql = 'DELETE FROM tblhome WHERE idHome = '.$codigo;
            mysqli_query($conexao,$sql);
            
            echo"<script language='javascript' type='text/javascript'>alert('Registro deletado com sucesso'); window.location.href='gerenciamento_home.php'; </script>";
            die();
            //echo($sql);
        }else if($modo == 'verdadeiro')
        {
            $codigo = $_GET['codigo'];
            $sql = "UPDATE tblhome set status = 0";
            mysqli_query($conexao,$sql);
            $sql = "UPDATE tblhome SET status = 1 where idHome = ".$codigo;
            mysqli_query($conexao,$sql);
            
            echo"<script language='javascript' type='text/javascript'>alert('Alterado com sucesso'); window.location.href='gerenciamento_home.php'; </script>";
            die();
        }
        
    }


    if(isset($_POST['btnSalvar'])) //ERIFICA SE REGISTROSERÁ INSERIDO OU ALTERADO
    {
        $texto_home = $_POST['txt_home'];
        
        $upload_dir="arquivos/";
        
        $nome_arq1 = basename($_FILES['fle_foto1']['name']);
        $nome_arq2 = basename($_FILES['fle_foto2']['name']);
        $nome_arq3 = basename($_FILES['fle_foto3']['name']);
        
        if(strstr($nome_arq1, '.jpg') || strstr($nome_arq1, '.png') && strstr($nome_arq2, '.jpg') || strstr($nome_arq2, '.png') && strstr($nome_arq3, '.jpg') || strstr($nome_arq3, '.png'))
        {
            $extensao1 = substr($nome_arq1, strpos($nome_arq1, "."), 5);
            $extensao2 = substr($nome_arq2, strpos($nome_arq2, "."), 5);
            $extensao3 = substr($nome_arq3, strpos($nome_arq3, "."), 5);
            
            $prefixo1 = substr($nome_arq1, 0, strpos($nome_arq1, "."));
            $prefixo2 = substr($nome_arq2, 0, strpos($nome_arq2, "."));
            $prefixo3 = substr($nome_arq3, 0, strpos($nome_arq3, "."));
            
            
            
            $nome_arq1 = md5($prefixo1).$extensao1;
            $nome_arq2 = md5($prefixo2).$extensao2;
            $nome_arq3 = md5($prefixo3).$extensao3;
            
            $file1 = $upload_dir . $nome_arq1;
            $file2 = $upload_dir . $nome_arq2;
            $file3 = $upload_dir . $nome_arq3;
            
            if(move_uploaded_file($_FILES['fle_foto1']['tmp_name'], $file1) && move_uploaded_file($_FILES['fle_foto2']['tmp_name'], $file2) && move_uploaded_file($_FILES['fle_foto3']['tmp_name'], $file3))
            {
                $sql = "INSERT INTO tblhome (texto, imgSlide1, imgSlide2, imgSlide3, status) VALUES ('".$texto_home."','".$file1."','".$file2."','".$file3."',0)";
                mysqli_query($conexao,$sql);
                echo("Editado com sucesso");
                header('location: gerenciamento_home.php');
            }else{
                echo("Erro na aplicação");
            }
            
        }else{
            echo("extensão de arquivo inválida");
        }
        
        
    } 

?>

<html>
    <head>
        <title>Gerenciamento da Home</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>
    <body>
        <div id="principal">
            <?php include('hd.php') ?>
            <form method="post" name="frm_home" enctype="multipart/form-data" action="gerenciamento_home.php">
                <main>
                    <?php include('menu.php') ?>

                    <h1>Gerenciamento da Página Home</h1>
                    
                    <div id="conteudo_home">
                        
                        <p>Primeira Foto (slide): </p> <input type="file" name="fle_foto1"> <br>
                        <p>Segunda Foto (slide): </p> <input type="file" name="fle_foto2"> <br>
                        <p>Terceira Foto (slide): </p> <input type="file" name="fle_foto3"> <br>
                    
                        <p>Texto curto: </p>  <textarea name="txt_home" value="" placeholder="..." id="txt_home"></textarea> <br><br>
                        
                        <input type="submit" name="btnSalvar" value="Enviar">
                                                
                    </div>
                    <div id="mostra_home">
                        <h1>Registros Anteriores</h1>  
                        
                        <table id="tabela_home">
                            <tr>
                                <td>Slide 1 |</td>
                                <td>Slide 2 |</td>
                                <td>Slide 3 |</td>
                                <td>Texto</td>
                            </tr>
                        </table>
                        
                        <?php 
                            include('conect.php');
                            $sql = "SELECT * FROM tblhome ORDER BY idHome desc";
                            $select = mysqli_query($conexao, $sql);
                            
                            while($rsResultado=mysqli_fetch_array($select)){
                        ?>
                        
                        <div class="container_home">
                            <div class="item_container_home"> <img src="<?php echo($rsResultado['imgSlide1']) ?>"> </div>
                            <div class="item_container_home"> <img src="<?php echo($rsResultado['imgSlide2']) ?>"> </div>
                            <div class="item_container_home"> <img src="<?php echo($rsResultado['imgSlide3']) ?>"> </div>
                            <div class="item_container_home"> <p> <?php echo($rsResultado['texto']) ?> </p> </div>
                            <div class="icone_home">
                                <a href="gerenciamento_home.php?modo=verdadeiro&codigo=<?php echo($rsResultado['idHome']) ?>">
                                    <img title="Definir como atual" alt="Definir como atual" src="imagens/btdefine.png"> 
                                </a>
                                <a href="gerenciamento_home.php?modo=excluir&codigo=<?php echo($rsResultado['idHome']) ?>">
                                    <img title="Excluir" alt="Excluir" src="imagens/del.png">
                                </a>                                
                            </div>
                        </div>
                        
                        <?php 
                            }
                        ?>
                        
                    </div>
                </main>
            </form>
            <?php include('foot.php') ?>
        </div>    
    </body>
</html>