<?php 

    include('verifica.php');  //SEGURANÇA
    include('conect.php');  //CONEXÃO
    include('util.php');

$produtos = array();
$acesso = array();

$sql = "SELECT idProduto FROM tblproduto;";
$produto = mysqli_query($conexao, $sql);

foreach($produto as $i){
    $sqli = "SELECT COUNT(c.clique) AS clique, p.nome FROM tblproduto_clique AS c INNER JOIN tblproduto AS p WHERE c.idProduto = ".$i['idProduto']." AND c.idProduto = p.idProduto;";
    
    $select = mysqli_query($conexao, $sqli);
    
    foreach($select as $it){
            
            array_push($acesso, $it);
        
    }
    
    
}

?>
<html>
    <head>
        <title>Estatísticas de acesso</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css"  href="css/style.css">
        
        <!-- Styles -->
        <style>
        #chartdiv {
           width		: 100%;
	       height		: 500px;
	       font-size	: 11px;
           background-color: #000; 
           color: #fff; 
        }
        h1{
            margin-top: -50px;
            margin-bottom: 50px;
        }    
        </style>

        <!-- Resources -->
        <script src="js/amcharts.js"></script>
        <script src="js/serial.js"></script>
        <script src="js/export.min.js"></script>
        <link rel="stylesheet" href="js/export.css" type="text/css" media="all" />
        <script src="js/black.js"></script>
        
        <!-- Chart code -->
        <script>
        var chart = AmCharts.makeChart( "chartdiv", {
          "type": "serial",
          "theme": "black",
          "dataProvider": [ 
            
                <?php 
                    foreach($acesso as $item){
                ?>
                {
                    "nome": "<?= $item['nome'] ?>",
                    "acesso": "<?= $item['clique'] ?>"
                },
                
                <?php
                    }
                
                ?>
        ],
          "valueAxes": [ {
            "gridColor": "#FFFFFF",
            "gridAlpha": 0.2,
            "dashLength": 0
          } ],
          "gridAboveGraphs": true,
          "startDuration": 1,
          "graphs": [ {
            "balloonText": "[[category]]: <b>[[value]]</b>",
            "fillAlphas": 0.8,
            "lineAlpha": 0.2,
            "type": "column",
            "valueField": "acesso"
          } ],
          "chartCursor": {
            "categoryBalloonEnabled": false,
            "cursorAlpha": 0,
            "zoomable": false
          },
          "categoryField": "nome",
          "categoryAxis": {
            "gridPosition": "start",
            "gridAlpha": 0,
            "tickPosition": "start",
            "tickLength": 20
          },
          "export": {
            "enabled": false
          }

        } );
        </script>
    </head>
    <body>
        <div id="principal">
            <?php include('hd.php') ?>
            
            <main>
                <?php include('menu.php') ?>
                
                <div id="conteudo">
                    <h1>Acesso por produto</h1>
                    <div id="chartdiv"></div>   
                </div>
            </main>
            <?php include('foot.php') ?>
        </div>
    </body>    
</html>