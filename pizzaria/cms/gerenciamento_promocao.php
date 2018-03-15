<?php 

    include('verifica.php'); //SEGURANÇA

    include('conect.php'); //CONEXÃO

    $nome = null;
    $valor = null;
    $descricao = null;
    $botao = "Salvar";

    if(isset($_GET['modo'])){  //VERIFICA SE REGISTRO SERÁ EXCLUÍDO OU ALTERADO
        $modo = $_GET['modo'];
        $_SESSION['id'] = $_GET['codigo'];
        
        if($modo=='excluir'){
            $sql = 'DELETE FROM tblpromocao WHERE idPromocao = '.$_SESSION['id'];
            mysqli_query($conexao,$sql);
            
            echo"<script language='javascript' type='text/javascript'>alert('Promoção deletada com sucesso'); window.location.href='gerenciamento_promocao.php'; </script>";
            die();
        }else if($modo == 'editar'){
            
            
            
            
            $sql = "select promo.idPromocao as id, promo.desconto AS desconto, promo.nome AS nomePromocao, promo.descricao AS descricao, produto.nome as nomeProduto from tblproduto as produto inner join tblpromocao as promo on produto.idProduto = promo.idProduto where promo.idPromocao =".$_SESSION['id'];
            $select = mysqli_query($conexao,$sql);
            
            //echo($sql);
            
            $rsPromo = mysqli_fetch_array($select);
            
            $nome = $rsPromo['nomePromocao'];
            $valor = $rsPromo['desconto'];
            $descricao =  $rsPromo['descricao'];
            $botao = "Editar";
        }
    }

    if(isset($_POST['btnSalvar'])){ //VERIFICA SE REGISTRO SERÁ INSERIDO OU ALTERADO
        $nome = $_POST['txtnome'];
        $valor = $_POST['txtvalor'];
        $descricao = $_POST['txtdesc'];
        $produto = $_POST['slt_produto'];
        $operacao = $_POST['btnSalvar'];

            
        if($operacao=='Salvar'){
            $sql = "INSERT INTO tblpromocao (desconto, nome, descricao, idProduto) VALUES (".$valor.",'".$nome."','".$descricao."',".$produto.")";
        
        }else if ($operacao=='Editar'){
            $sql = "UPDATE tblpromocao SET desconto=".$valor.", nome = '".$nome."', descricao ='".$descricao."', idProduto =".$produto." WHERE idPromocao=".$_SESSION['id'];
           // echo($sql);
        }
            
            mysqli_query($conexao, $sql);

            header('location:gerenciamento_promocao.php');
    }



?>


<html>
    <head>
        <title>CMS - Promoções</title>
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
                <form name="frmpromocao" method="post" action="gerenciamento_promocao.php">
                    <div id="conteudo"> <!--Conteúdo-->
                        <h1> Gerenciamento de Promoções </h1>
                        <div id="cadastra_promocao">
                            <b>Selecione o produto referente a promoção</b><br> <br>
                            <select name="slt_produto">
                                <?php 
                                    $sql = 'select * from tblproduto';
                                    $select = mysqli_query($conexao, $sql);

                                    while($rsProduto=mysqli_fetch_array($select)){
                                ?>
                                <option value="<?php echo($rsProduto['idProduto']); ?>"> <?php echo($rsProduto['nome']); ?> </option>
                                    <?php
                                            }

                                    ?>    
                            </select><br>

                            <input class="nome_promo" type="text" required name="txtnome" value="<?php echo($nome) ?>" placeholder="Nome da promoção"><br><br>
                            <input placeholder="Valor de desconto" class="nome_promo" type="decimal" required name="txtvalor" value="<?php echo($valor) ?>"> 
                            <textarea class="nome_promo" id="desc_promo" name="txtdesc" required placeholder="Descrição da promoção"><?php echo($descricao) ?></textarea>

                            <input id="btn_salva_unidade" type="submit" name="btnSalvar" value="<?php echo($botao) ?>">
                        </div>
                        <div id="exibe_promocao">
                            <table id="tbl_promo">
                                <tr>
                                    <td>Nome</td><td>Produto</td><td>Descricao</td>
                                </tr>
                            </table>
                            
                            <?php 
                                $sql = "select promo.idPromocao as id,promo.nome AS nomePromocao, promo.descricao AS descricao, produto.nome as nomeProduto from tblproduto as produto inner join tblpromocao as promo on produto.idProduto = promo.idProduto";
                                $select = mysqli_query($conexao, $sql);
                                while($rsPromo=mysqli_fetch_array($select)){
                            ?>
                                <div class="linha1">
                                    <div class="coluna1"> <?php echo($rsPromo['nomePromocao']) ?> </div>
                                    <div class="coluna1"> <?php echo($rsPromo['nomeProduto']) ?> </div>
                                    <div class="coluna1"> <?php echo($rsPromo['descricao']) ?> </div>
                                    <a href="gerenciamento_promocao.php?modo=editar&codigo=<?php echo($rsPromo['id']) ?>">
                                        <img src="imagens/edit.png" alt="edit" title="edit">
                                    </a>

                                    <a href="gerenciamento_promocao.php?modo=excluir&codigo=<?php echo($rsPromo['id']) ?>">
                                        <img src="imagens/del.png" alt="delete" title="delete">
                                    </a>
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