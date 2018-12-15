<?php

class Produtor {

    private $produtor;
    private $provincia;
    private $municipio;
    private $comuna;
    private $estado;

    private function __constructor($produtor, $provincia, $municipio, $comuna, $estado) {
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
