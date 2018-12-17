<?php

class ProdutorDao {
    
    private $conexao;
    private $produto;
    
    public function __construct(Conexao $conexao, Produto $produto) {
        $this->conexao = $conexao;
        $this->produto = $produto;
    }
    
    public function inserir() {
        $sqlLock = "LOCK TABLES produtos WRITE";
        $sqlUnlock = "UNLOCK TABLES";
        $sql = "INSERT INTO produtos (produtos, quantidade, estado) VALUES (:produto, :quantidade, :estado)";
        $this->conexao->beginTransaction();
        $this->conexao->exec($sqlLock);
        $exe = $this->conexao->prepare($sql);
        
        $exe->bindValue(':produto', $this->produto->getProduto() );
        $exe->bindValue(':quantidade', $this->produto->getQuantidade());
        $exe->bindValue(':estado', $this->produto->getEstado());
        
        if (!$exe->execute()){
            $this->conexao->rollBack();
            print_r($exe->errorInfo()[2]);
        }else{
            $this->conexao->commit(); 
            $this->conexao->exec($sqlUnlock);
             
            return true;
        }
    }

    public function estatisticaProdutores(){
        $sqlLock = "LOCK TABLES vw_produtores READ";
        $sqlUnlock = "UNLOCK TABLES";
        $sql = "SELECT * FROM vw_produtores";
        
        $this->conexao->beginTransaction();
        $this->conexao->exec($sqlLock);
        $exe = $this->conexao->prepare($sql);
        
        if (!$exe->execute()){
            $this->conexao->rollBack();
            print_r($exe->errorInfo()[2]);
        }  else {
            $retorno = $exe->fetchAll();
            $this->conexao->commit();
            $this->conexao->exec($sqlUnlock);
            
            foreach ($retorno as $r){
                return array (
                    $r['produtores'], 
                    $r['activos'], 
                    $r['inactivos']
                );
            }
        }
    }

    public function provinciaProdutor(){
        $sqlLock = "LOCK TABLES vw_prov READ";
        $sqlUnlock = "UNLOCK TABLES";
        $sql = "SELECT * FROM vw_prov";
        
        $this->conexao->beginTransaction();
        $this->conexao->exec($sqlLock);
        $exe = $this->conexao->prepare($sql);
        
        if (!$exe->execute()){
            $this->conexao->rollBack();
            print_r($exe->errorInfo()[2]);
        }  else {
            $retorno = $exe->fetchAll();
            $this->conexao->commit();
            $this->conexao->exec($sqlUnlock);
            
            foreach ($retorno as $r){
                return array (
                    $r['bengo'], 
                    $r['benguela'], 
                    $r['bie'],
                    $r['cabinda'], 
                    $r['cc'], 
                    $r['cn'],
                    $r['cs'], 
                    $r['cunene'], 
                    $r['huambo'],
                    $r['huila'], 
                    $r['luanda'], 
                    $r['lundan'],
                    $r['lundas'], 
                    $r['malanje'], 
                    $r['moxico'],
                    $r['namibe'],
                    $r['uige'],
                    $r['zaire']
                );
            }
        }
    }
}