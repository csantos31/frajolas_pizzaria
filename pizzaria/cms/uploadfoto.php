<?php 
    //VERIFICA SE EXTENSÃO DO ARQUIVO É REFERENTE A IMAGEM
    function verificaExtensao($nome_arq){
        if(strstr($nome_arq, '.jpg') || strstr($nome_arq, '.png')){
            return true;
        }else{
            return false;
        }
    }

    //CRIA UM NOME CRIPTOGRAFADO PARA IMAGEM
    function uploadArq($nome_arq){
        $extensao = substr($nome_arq, strpos($nome_arq, "."), 5);
        
        $prefixo = substr($nome_arq, 0, strpos($nome_arq, "."));
        
        $nome_arq = md5($prefixo).$extensao;
        
        $upload_dir = "arquivos/";
        
        $file = $upload_dir . $nome_arq;
        
        return($file);
    }


    //MOVE ARQUIVO DE PASTA TEMPORÁRIA PARA PASTA PERMANENTE
    function moveArq($objeto, $caminho){
        if(move_uploaded_file($_FILES[$objeto]['tmp_name'], $caminho)){
            return true;
        }else{
            return false;
        }
    }

    
    



?>