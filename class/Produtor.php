<?php

class Produtor {

    private $produtor;
    private $provincia;
    private $municipio;
    private $comuna;
    private $estado;

    public function __construct($produtor = NULL, $provincia = NULL, $municipio = NULL, $comuna = NULL, $estado = NULL) {
        $this->produtor = $produtor;
        $this->provincia = $provincia;
        $this->municipio = $municipio;
        $this->comuna = $comuna;
        $this->estado = $estado;
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
}
