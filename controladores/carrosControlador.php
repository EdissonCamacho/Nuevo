<?php
include_once "../modelo/carrosModelo.php";


class carrosControl{
    public $idCarro;
    public $marca;
    public $color;
    public $tipo;

    public function ctrIngresarCarros(){
        $objRespuesta = carrosModelo::mdlIngresarCarros($this->marca,$this->color,$this->tipo);
        echo json_encode($objRespuesta);

    }

    public function ctrListarCarros(){
        $objRespuesta = carrosModelo::mdlListarCarros();
        echo json_encode($objRespuesta);

    }

    public function ctrEditarCarros(){
        $objRespuesta = carrosModelo::mdlEditarCarros($this->idCarro,$this->marca,$this->color,$this->tipo);
        echo json_encode($objRespuesta);
    }

    public function ctrEliminarCarro(){
        $objRespuesta = carrosModelo::mdlEliminarCarro($this->idCarro);
        echo json_encode($objRespuesta);
    }

}

if (isset($_POST["marca"]) && isset($_POST["color"]) && isset($_POST["tipo"])){
    $objCarros = new carrosControl();
    $objCarros->marca = $_POST["marca"];
    $objCarros->color = $_POST["color"];
    $objCarros->tipo = $_POST["tipo"];
    $objCarros->ctrIngresarCarros();
}

if (isset($_POST["listarCarros"])){
    $objListaCarros = new carrosControl();
    $objListaCarros->ctrListarCarros();
}


if (isset($_POST["modIdCarro"]) && isset($_POST["modMarca"]) && isset($_POST["modColor"]) && isset($_POST["modTipo"])){
    $objModCarros = new carrosControl();
    $objModCarros->idCarro = $_POST["modIdCarro"];
    $objModCarros->marca = $_POST["modMarca"];
    $objModCarros->color = $_POST["modColor"];
    $objModCarros->tipo = $_POST["modTipo"];
    $objModCarros->ctrEditarCarros();
}


if (isset($_POST["idEliminarCarro"])){
    $objEliminarCarro = new carrosControl();
    $objEliminarCarro->idCarro = $_POST["idEliminarCarro"];
    $objEliminarCarro->ctrEliminarCarro();

}