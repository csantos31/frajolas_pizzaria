<?php 
    include('cms/conect.php');
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>História</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="icon" href="icon/favicon.ico">
        <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
        <script type="text/javascript" src="js/arc4.js"></script>
    </head>
    <body>
        <div id="principal_historia">
            <?php 
                include("menu.php");
            ?>
            <div id="mainPagina">
                <div id="superior_historia"> <!--Efeito galeria em história-->
                    
                    <?php 
                        $sql = "Select * from tblimghistoria where status = 1";
                        //echo($sql);    
                        $select = mysqli_query($conexao, $sql);
                        $rsGaleria = mysqli_fetch_array($select);
                    
                    ?>
                    
                    <div class="cover">
                        <img title="galeria" alt="galeria" src="cms/<?php echo($rsGaleria['img1']) ?>">
                    </div>
                    <div class="thumbs">
                          <img title="galeria" alt="galeria" class="active" src="cms/<?php echo($rsGaleria['img1']) ?>">
                        <img title="galeria" alt="galeria" class="gallery" src="cms/<?php echo($rsGaleria['img2']) ?>">
                        <img title="galeria" alt="galeria" class="gallery" src="cms/<?php echo($rsGaleria['img3']) ?>">
                        <img title="galeria" alt="galeria" class="gallery" src="cms/<?php echo($rsGaleria['img4']) ?>">
                        <img title="galeria" alt="galeria" class="gallery" src="cms/<?php echo($rsGaleria['img5']) ?>">
                        <img title="galeria" alt="galeria" class="gallery" src="cms/<?php echo($rsGaleria['img6']) ?>">
                        <img title="galeria" alt="galeria" class="gallery" src="cms/<?php echo($rsGaleria['img7']) ?>">
                        <img title="galeria" alt="galeria" class="gallery" src="cms/<?php echo($rsGaleria['img8']) ?>">
                        <img title="galeria" alt="galeria" class="gallery" src="cms/<?php echo($rsGaleria['img9']) ?>">
                    </div>
                </div>
                <div id="texto_historia"> <!--Texto referente aos anos 60, 70 e 80-->
                    <h1>Vamos viajar pela história?</h1>
                    
                    <?php 
                        $sql = "SELECT * FROM tbldecada order by tituloDecada";
            
                        $select = mysqli_query($conexao, $sql);
                        while($rsDecada=mysqli_fetch_array($select))
                        {
                            
                    ?>
                    
                            <div class="titulo_anos">
                                <h2><?php echo($rsDecada['tituloDecada']) ?></h2>
                            </div>
                            <p>
                                <?php echo($rsDecada['textoDecada']) ?>
                            </p>
                    <?php
                        }
                    ?>
                </div>
            </div>
            <?php 
                include("rdp.php");
            ?>
        </div>
    </body>
</html>