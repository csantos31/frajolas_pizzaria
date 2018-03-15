<?php 
    include('conect.php');
    include('verifica.php');

    if(isset($_GET['modo']))
    {
        $modo = $_GET['modo'];
        
        if($modo == 'verdadeiro')
        {
            $codigo = $_GET['codigo'];
            $sql = "UPDATE tblproduto set pizzaMes = 0";
            mysqli_query($conexao,$sql);
            $sql = "UPDATE tblproduto SET pizzaMes = 1 where idProduto = ".$codigo;
            mysqli_query($conexao,$sql);

            echo"<script language='javascript' type='text/javascript'>alert('Alterado com sucesso'); window.location.href='gerenciamento_home.php'; </script>";
            die();
        }
    
    }


    

?>
<html>
    <head>
        <title>Pizza do Mês</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>
    <body>
        <div id="principal">
            <?php include('hd.php') ?>
            <main>
                <?php include('menu.php') ?>
                <h1>Gerenciamento de pizza do mês</h1>
                
                <table id="tbl_pizza_do_mes">
                    <tr>
                        <td>Nome: </td>
                        <td>Descrição </td>
                    </tr>
                </table>
                
                <?php 
                    $sql = "Select * from tblproduto";
                    $select = mysqli_query($conexao, $sql);
            
                    while($rsPizza=mysqli_fetch_array($select))
                    {
                                        
                ?>
                
                <div class="linha">
                    <div class="coluna"> <?php echo($rsPizza['nome']) ?> </div>
                    <div class="coluna"> <?php echo($rsPizza['descricao']) ?> </div>
                    <a href="pizza_do_mes.php?modo=verdadeiro&codigo=<?php echo($rsPizza['idProduto']) ?>">
                        <div class="ic"> <img src="imagens/btdefine.png"> </div>
                    </a>
                </div>
                
                <?php 
                    }
                ?>
                
            </main>
            <?php include('foot.php') ?>
        </div>  
    
    </body>
</html>