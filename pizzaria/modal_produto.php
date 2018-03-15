<?php 
    include('cms/conect.php');
    
    if(isset($_POST['id'])){
        $idProduto = $_POST['id'];
        
        $sql = "INSERT INTO tblproduto_clique(idProduto, clique) VALUES (".$idProduto.", 1);";
        
        mysqli_query($conexao, $sql);
        
        $sql = "SELECT * FROM tblproduto WHERE idProduto =".$idProduto;

        $select = mysqli_query($conexao, $sql);
        if($rsBusca = mysqli_fetch_array($select)){
            $foto = $rsBusca['fotoProduto'];
            $name = $rsBusca['nome'];
            $descri = $rsBusca['descricao'];
            $prec = $rsBusca['preco'];
        }

    }
?>


<html>
    <head>
        <title>Sobre Produto</title>
        <meta charset="utf-8">
        <link type="text/css" rel="stylesheet" href="css/style.css">
        <script type="text/javascript" src="cms/js/jquery.js"></script>
    </head>
    <body>
        <div id="pagina_modall">
            <div id="corpo_modal">
                <div id="header_modal"> 
                    <h1> Ver produto </h1>
                    <a href="index.php">
                        <span class="close_btn">X</span>
                    </a>
                </div>
                <div id="foto_produto"> 
                    <img src="cms/<?= $foto ?>">
                </div>
                <div id="sobre_produto">
                    <p><?= $name ?></p>
                    <p>Preço: R$ <?= $prec ?></p>
                    <p>Descrição: <?= $descri ?></p>
                </div>
            </div>
        </div>
    </body>
</html>