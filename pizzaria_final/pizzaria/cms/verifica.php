<?php
    session_start();
    $sessao_usuario = $_SESSION['usuario'];
    $sessao_nome = $_SESSION['nome'];
    

    if(!isset($_SESSION['usuario']) && (!isset($_SESSION['nome'])))
    {
        header('location: ../index.php');
    }

?>