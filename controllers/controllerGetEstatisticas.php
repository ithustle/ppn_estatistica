<?php

	require "./../class/Conexao.php";
    require "./../class/Produtor.php";
    require "./../class/ProdutorDao.php";

    $conexao = new Conexao();
    $produtor = new Produtor();

    $dao = new ProdutorDao($conexao, $produtor);

	echo json_encode([$dao->provinciaProdutor(), $dao->estatisticaProdutores()]);