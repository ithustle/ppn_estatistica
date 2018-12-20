<?php

    require "./../class/Conexao.php";

    $conexao = new Conexao();
    $password = md5(filter_input(0, 'password'));

    $sqlLock = "LOCK TABLES password READ";
    $sqlUnlock = "UNLOCK TABLES";
    $sql = "SELECT * FROM password WHERE password = :password";
    
    $conexao->beginTransaction();
    $conexao->exec($sqlLock);
    $exe = $conexao->prepare($sql);

    $exe->bindValue(':password', $password);
    
    if (!$exe->execute()){
        $conexao->rollBack();
        print_r($exe->errorInfo()[2]);
    }  else {
        $retorno = $exe->fetchAll();
        $conexao->commit();
        $conexao->exec($sqlUnlock);
        
        foreach ($retorno as $key => $value) {
            echo $value[0];
        }
    }