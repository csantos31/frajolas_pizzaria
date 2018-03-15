<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>Localização</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="icon" href="icon/favicon.ico">
        <script rel="js/mp1.js"></script>
        <script rel="js/mp2.js"></script>
        <script rel="js/map.js"></script>
    </head>
    <body>
        <div id="principal">
            <?php
                include("menu.php")
            ?>
            <div id="mainPagina">
                
                <h1>Localizações</h1>
                
                <div id="mapdiv">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3657.8817543553014!2d-46.98278058452939!3d-23.536754984695108!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x6f243fa486204a67!2sLos+Hermanos+Pizzaria!5e0!3m2!1spt-BR!2sbr!4v1505744141510" width="800" height="800"  style="border:0" allowfullscreen></iframe>
                </div> 
                <h2>Locais</h2>
                
                <?php 
                    $sql = "select e.logradouro, e.cidade, e.numero, es.sigla from tblendereco as e inner join tblestado as es on e.idEstado = es.idEstado";

                    $select = mysqli_query($conexao, $sql);
                    while($rsEndereco=mysqli_fetch_array($select))
                    {
                            
                ?>
                
                <div class="localiza">                    
                    <p><b><?php echo($rsEndereco['logradouro']) ?></b></p>
                    <p><?php echo($rsEndereco['numero']) ?></p>
                    <p><?php echo($rsEndereco['cidade']) ?></p>
                    <p><?php echo($rsEndereco['sigla']) ?></p>
                </div>
                
                <?php
                    }
                ?>
            </main>
            <?php
                include("rdp.php")
            ?>
        </div>
    </body>
</html>