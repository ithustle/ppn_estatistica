<?php

class Conexao extends PDO {
    private $dsn = 'mysql:host=localhost;dbname=ppn';
    private $user = 'ithustle';
    private $pass = 'naoexiste';
    private $cnn;


    public function __construct() {
        try {
            
            if ($this->cnn == NULL){
                
                $cnn = parent::__construct($this->dsn, $this->user, $this->pass);
                $this->handle = $cnn;
                
                return $this->handle;
            }
            
        } catch (PDOException $exc) {
            
            throw new Exception ("Mensagem: ". $exc->getMessage(). "Código de erro: ". $exc->getCode());
            return FALSE;
        }
    }
}
