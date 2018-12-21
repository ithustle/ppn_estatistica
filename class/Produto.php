<?php

class Produto {
    private $produto;
    private $quantidade;
    private $unidade;
    private $produtores;

    public function __construct($produto = NULL, $produtores = NULL, $unidade = NULL, $quantidade = NULL) {
        $this->produto = $produto;
        $this->quantidade = $quantidade;
        $this->unidade = $unidade;
        $this->produtores = $produtores;
    }

    function getProduto() {
        return $this->produto;
    }

    function getQuantidade() {
        return $this->quantidade;
    }

    function getUnidade() {
        return $this->unidade;
    }

    function getProdutores() {
        return $this->produtores;
    }
}
