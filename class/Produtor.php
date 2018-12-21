<?php

class Produtor {

    private $produtor;
    private $provincia;
    private $municipio;
    private $comuna;
    private $estado;
    private $telefone;

    public function __construct($produtor = NULL, $provincia = NULL, $municipio = NULL, $comuna = NULL, $estado = NULL, $telefone = NULL) {
        $this->produtor = $produtor;
        $this->provincia = $provincia;
        $this->municipio = $municipio;
        $this->comuna = $comuna;
        $this->estado = $estado;
        $this->telefone = $telefone;
    }

    function getProdutor() {
        return $this->produtor;
    }

    function getProvincia() {
        return $this->provincia;
    }

    function getMunicipio() {
        return $this->municipio;
    }

    function getComuna() {
        return $this->comuna;
    }

    function getEstado() {
        return $this->estado;
    }

    function getTelefone() {
        return $this->telefone;
    }
}
