<?php

class ProdutoDao {
    
    private $conexao;
    private $produto;
    
    public function __construct(Conexao $conexao, Produto $produto) {
        $this->conexao = $conexao;
        $this->produto = $produto;
    }
    
    public function inserir() {
        $sqlLock = "LOCK TABLES produtos WRITE";
        $sqlUnlock = "UNLOCK TABLES";
        $sql = "INSERT INTO produtos (produtos, quantidade, unidades, produtores) VALUES (:produto, :quantidade, :unidades, :produtores)";
        $this->conexao->beginTransaction();
        $this->conexao->exec($sqlLock);
        $exe = $this->conexao->prepare($sql);
        
        $exe->bindValue(':produto', $this->produto->getProduto() );
        $exe->bindValue(':quantidade', $this->produto->getQuantidade());
        $exe->bindValue(':unidades', $this->produto->getUnidade());
        $exe->bindValue(':produtores', $this->produto->getProdutores());
        
        if (!$exe->execute()){
            $this->conexao->rollBack();
            print_r($exe->errorInfo()[2]);
        }else{
            $this->conexao->commit(); 
            $this->conexao->exec($sqlUnlock);
             
            return true;
        }
    }

    public function estatisticaProdutos(){
        $sqlLock = "LOCK TABLES vw_produtos READ";
        $sqlUnlock = "UNLOCK TABLES";
        $sql = "SELECT * FROM vw_produtos ORDER BY quantidade DESC LIMIT 17";
        
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
            
            return $retorno;
        }
    }

    public function estatisticaProdutosRodape(){
        $sqlLock = "LOCK TABLES vw_produtos READ";
        $sqlUnlock = "UNLOCK TABLES";
        $sql = "SELECT * FROM vw_produtos ORDER BY quantidade DESC";
        
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
            
            return $retorno;
        }
    }
}