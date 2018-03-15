<?php

    //ESTABELECE CONEXÃO COM BANCO DE DADOS
    $conexao=mysqli_connect('localhost','root','bcd127');

    //SELECIONA O BANCO A SER UTILIZADO
    mysqli_select_db($conexao,'dbfrajola');
?>