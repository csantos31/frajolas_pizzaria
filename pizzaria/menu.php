<?php

//refactoring code to php version 7 **** before it was 5
//    $conexao=mysqli_connect('localhost','root','bcd127');
  //  mysqli_select_db($conexao,'dbfrajola');

  $conexao = mysqli_connect("localhost", "root", "bcd127", "dbfrajola");

  if (!$conexao) {
      echo "Error: Unable to connect to MySQL." . PHP_EOL;
      echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
      echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
      exit;
  }

    if(isset($_POST['btnLogin']))
    {
        $login = $_POST['txtUser'];
        $senha = $_POST['txtSenha'];

        addslashes($sql = "SELECT * FROM tbl_usuario WHERE username = '$login' AND senha = '$senha';");

        echo($sql);

        $verifica = mysqli_query($conexao,$sql) or die ("Erro ao selecionar");


        if(mysqli_num_rows($verifica)<=0)
         {
             echo"<script language='javascript' type='text/javascript'>alert('Login e/ou senha incorretos'); window.location.href='index.php'; </script>";
             die();
         }else{

            session_start();
            $rs = mysqli_fetch_array($verifica);

            $_SESSION['usuario'] = $rs['username'];
            $_SESSION['nome'] = $rs['nome'];

            header("location: cms/gerenciamento_fale_conosco.php");

         }

    }
?>


<header> <!--Cabeçalho-->
    <div id="transp"><!--apoio do header para que tenha o efeito de transparência-->

    </div>
    <div id="apoio">
            <form name="frm_login" method="post" action="index.php">
                <div id="cont_header">
                    <div id="logo">
                        <img id="lg" src="imagens/logo.jpg" title="logotipo" alt="logotipo">
                    </div>
                    <div id="menu">
                        <nav class="lista_menu">
                            <ul>
                                <li><a href="sobrenos.php">SOBRE NÓS |</a></li>
                                <li><a href="pizzadomes.php">Pizza do mês |</a></li>
                                <li><a href="localizacao.php">Localizações |</a></li>
                            </ul>
                        </nav>
                        <nav class="lista_menu">
                            <ul>
                                <li><a href="index.php">HOME |</a></li>
                                <li><a href="historia.php">HISTÓRIA |</a></li>
                                <li><a href="promocoes.php">PROMOÇÕES |</a></li>
                                <li><a href="faleconosco.php">FALE CONOSCO</a></li>
                            </ul>
                        </nav>
                    </div>
                    <div id="login">
                        <input name="txtUser" type="text" value="" placeholder="Usuário">

                        <input name="txtSenha" type="password" value="" placeholder="Senha">

                        <input name="btnLogin" type="submit" value="OK">
                    </div>
                </div>
            </form>
        </div>
        <div id="suporte_header"></div>

        <div id="respons">
            <input type="checkbox" id="btn_menu">
            <label for="btn_menu">&#9776;</label>
            <nav id="menu">
                <ul>
                    <li><a href="index.php" style="text-decoration:none">HOME</a></li>
                    <li><a href="historia.php" style="text-decoration:none">HISTÓRIA</a></li>
                    <li><a href="promocoes.php" style="text-decoration:none">PROMOÇÕES</a></li>
                    <li><a href="faleconosco.php" style="text-decoration:none">FALE CONOSCO</a></li>
                    <li><a href="sobrenos.php" style="text-decoration:none">SOBRE NÓS</a></li>
                    <li><a href="pizzadomes.php" style="text-decoration:none">PIZZA DO MÊS</a></li>
                    <li><a href="localizacao.php" style="text-decoration:none">LOCALIZAÇÕES</a></li>
                </ul>
            </nav>
        </div>
</header>
