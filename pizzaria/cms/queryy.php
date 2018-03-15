<?php 

    //envia ordem ao banco de dados

    mysqli_query($conexao, $sql);
    //echo($sql);
    header('location:adm_usuario.php');
?>