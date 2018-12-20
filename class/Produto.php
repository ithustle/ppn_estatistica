<?php

class Produto {
    private $produto;
    private $quantidade;
    private $estado;

    public function __construct($produto = NULL, $quantidade = NULL, $estado = NULL) {
        $this->produto = $produto;
       /* $this->quantidade = $quantidade;
        $this->estado = $estado;*/
    }

    function getProduto() {
        return $this->produto;
    }

    function getQuantidade() {
        return $this->quantidade;
    }

    function getEstado() {
        return $this->estado;
    }
}
