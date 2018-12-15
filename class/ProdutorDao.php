<?php

class ProdutorDao {
    
    private $conexao;
    private $produtor;
    
    function __construct(Conexao $conexao, Cliente $produtor) {
        $this->conexao = $conexao;
        $this->produtor = $produtor;
    }
    
    public function inserir() {
        $sqlLock = "LOCK TABLES produtores WRITE";
        $sqlUnlock = "UNLOCK TABLES";
        $sql = "INSERT INTO produtores (produtor, provincia, municipio, comuna, estado) VALUES (:produtor, :provincia, :municipio, :comuna, :estado)";
        $this->conexao->beginTransaction();
        $this->conexao->exec($sqlLock);
        $exe = $this->conexao->prepare($sql);
        
        $exe->bindValue(':produtor', $this->produtor->getProdutor() );
        $exe->bindValue(':provincia', $this->produtor->getProvincia());
        $exe->bindValue(':municipio', $this->produtor->getMunicipio());
        $exe->bindValue(':comuna', $this->produtor->getComuna());
        $exe->bindValue(':estado', $this->produtor->getEstado());
        
        if (!$exe->execute()){
            $this->conexao->rollBack();
            print_r($exe->errorInfo()[2]);
        }else{
            $this->conexao->commit(); 
            $this->conexao->exec($sqlUnlock);
             
            return true;
        }
    }
}