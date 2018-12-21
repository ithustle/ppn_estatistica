<?php

	require "./../class/Conexao.php";
    require "./../class/Produtor.php";
    require "./../class/Produto.php";
    require "./../class/ProdutorDao.php";
    require "./../class/ProdutoDao.php";

    $conexao = new Conexao();
    $produtor = new Produtor();
    $produto = new Produto();

    $dao = new ProdutorDao($conexao, $produtor);
    $daoProduto = new ProdutoDao($conexao, $produto);
    
    echo json_encode(
        [
            $dao->provinciaProdutor(), 
            $dao->estatisticaProdutores(), 
            $daoProduto->estatisticaProdutos(),
            $dao->contactosProdutores()
        ]
    );