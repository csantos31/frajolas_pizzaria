<div id="conteudo">
    <button id="modalBtn">Inserir Categoria</button>                    
    <h1>Gerenciamento de categorias</h1>                
    <?php

        include('conect.php');

        $sql = 'select * from tblcategoria order by idCategoria desc';
        $select = mysqli_query($conexao, $sql);

        while($rsCategoria=mysqli_fetch_array($select)){
    ?>

        <div class="container_categoria">
            <div class="item_categoria">
                <?php echo($rsCategoria['nome']) ?>
            </div>
            <div class="icones_categoria"> 
                <a href="#" class="getCategoriaBtn" onclick="getCategoria(<?= $rsCategoria['idCategoria'] ?>)">
                    <img src="imagens/edit.png" alt="edit" title="edit">
                </a>
                <a id="excluir" onclick="excluirCategoria(<?= $rsCategoria['idCategoria'] ?>)">
                    <img src="imagens/del.png" alt="delete" title="delete">
                </a>                            
            </div>
        </div>

    <?php 
        }
    ?>
</div>