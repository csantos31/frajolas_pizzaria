<?php
    /*conexao com o Banco de Dados*/

    //Estabelece uma conexao com o BD MySQl
    //old php version |$conexao=mysqli_connect('localhost','root','bcd127');

    //Ativa o database a ser utilizado no projeto
  //old php version |  mysqli_select_db($conexao,'dbfrajola');

    $conexao = mysqli_connect("localhost", "root", "bcd127", "dbfrajola");

    if (!$conexao) {
        echo "Error: Unable to connect to MySQL." . PHP_EOL;
        echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
        echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
        exit;
    }

    if(isset($_GET['btnEnviar']))
    {
        $nome = $_GET['txtnome'];
        $telefone = $_GET['txttelefone'];
        $celular = $_GET['txtcelular'];
        $email = $_GET['txtemail'];
        $homepage = $_GET['txthomepage'];
        $facebook = $_GET['txtfacebook'];
        $sugestao = $_GET['txtcritica'];
        $informacao = $_GET['txtdesc'];
        $profissao = $_GET['txtprofissao'];
        $sexo = $_GET['rbosexo'];

        addslashes($sql = "insert into tblfaleconosco (nome,telefone, celular, email, homepage, facebook, sugestao, informacaoproduto, profissao, sexo)

        values('".$nome."','".$telefone."','".$celular."','".$email."','".$homepage."','".$facebook."','".$sugestao."','".$informacao."','".$profissao."','".$sexo."')");

        mysqli_query($conexao,$sql);
        //echo($sql);
        header('location:faleconosco.php');

    }

?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>Fale Conosco</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="icon" href="icon/favicon.ico">
    </head>
    <body>
        <div id="principal">
            <?php
                include("menu.php");
            ?>
            <form name="frm_fale_conosco" action="faleconosco.php" method="get">
                <div id="mainPagina">
                    <div id="caixa_form"> <!--Caixa que contém o formulário-->
                        <h1>Fale conosco</h1>
                        <p>Nos envie suas sugestões, reclamações ou considerações!</p> <!--Título Formulário-->

                        <div class="container_formulario"> <!--Questões do Fale Conosco-->
                            <div class="item_form">
                                <input required type="text" placeholder="Nome" class="entrada" maxlength="45" value="" name="txtnome">
                            </div>
                            <div class="item_form">
                                <input type="number" placeholder="Telefone" class="entrada" maxlength="45"  value="" name="txttelefone">
                            </div>
                        </div>

                        <div class="container_formulario">
                            <div class="item_form">
                                <input required type="number" placeholder="Celular" class="entrada" maxlength="45" value="" name="txtcelular">
                            </div>
                            <div class="item_form">
                                <input required type="email" placeholder="E-mail" class="entrada" maxlength="45" value="" name="txtemail">
                            </div>
                        </div>

                        <div class="container_formulario">
                            <div class="item_form">
                                <input placeholder="Home Page" class="entrada" type="text" maxlength="254" value="" name="txthomepage">
                            </div>
                            <div class="item_form">
                                <input placeholder="Link do seu facebook" class="entrada" maxlength="254" type="text" value="" name="txtfacebook">
                            </div>
                        </div>
                        <div class="container_formulario">
                            <div class="item_form">
                                <p>Sexo:</p>
                                <input checked type="radio" name="rbosexo" value="f">Feminino
                                <input type="radio" name="rbosexo" value="m">Masculino
                            </div>

                            <div class="item_form">
                                <p>Profissão:</p>
                                <input required placeholder="Profissão" class="entrada" maxlength="45" type="text" value="" name="txtprofissao">
                            </div>
                        </div>

                        <div class="container_formulario">
                            <p>Sugestão / Crítica</p>
                            <input rols="5" placeholder="Deixe aqui sua sugestão ou crítica" class="textarea" maxlength="254" type=text value="" name="txtcritica">
                        </div>
                        <div class="container_formulario">
                            <p>Informações do produto</p>
                            <input placeholder="Deixe aqui informações do produto avaliado"  class="textarea" maxlength="254" type=text value="" name="txtdesc">
                        </div>

                        <input id="bt1" type="submit" value="Enviar" name="btnEnviar">
                    </div>
                </div>
            </form>
            <?php
                include("rdp.php")
            ?>
        </div>
    </body>
</html>
