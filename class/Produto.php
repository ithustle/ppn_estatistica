<?php

class Produto {
    private $produto;
    private $quantidade;
    private $estado;

    private function __constructor($produto, $quantidade, $estado) {
        $this->produto = $produto;
        $this->quantidade = $quantidade;
        $this->estado = $estado;
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
