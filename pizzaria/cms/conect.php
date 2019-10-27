<?php

    //ESTABELECE CONEXÃO COM BANCO DE DADOS
  /*  $conexao=mysqli_connect('localhost','root','bcd127');

    //SELECIONA O BANCO A SER UTILIZADO
    mysqli_select_db($conexao,'dbfrajola');


    */
    $conexao = mysqli_connect("localhost", "root", "bcd127", "dbfrajola");

    if (!$conexao) {
        echo "Error: Unable to connect to MySQL." . PHP_EOL;
        echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
        echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
        exit;
    }
