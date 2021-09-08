<?php
include_once "conexion.php";


class carrosModelo
{

    public static function mdlIngresarCarros($marca, $color, $tipo)
    {
        $mensaje = "";

        $objRespuesta = conexion::conectar()->prepare("INSERT INTO carros(marca,color,tipo) VALUES (:marca,:color,:tipo) ");
        $objRespuesta->bindParam(":marca", $marca, PDO::PARAM_STR);
        $objRespuesta->bindParam(":color", $color, PDO::PARAM_STR);
        $objRespuesta->bindParam(":tipo", $tipo, PDO::PARAM_STR);



        if ($objRespuesta->execute()) {
            $mensaje = "Datos registrados correctamente";
        } else {
            $mensaje = "No fue posible registrar la información";
        }

        return $mensaje;
    }

    public static function mdlListarCarros()
    {
        $objRespuesta = conexion::conectar()->prepare("SELECT * From carros");
        $objRespuesta->execute();
        $listaCarros = $objRespuesta->fetchAll();
        $objRespuesta = null;
        return $listaCarros;
    }


    public static function mdlEditarCarros($idCarro, $marca, $color, $tipo)
    {

        $mensaje = "";
        try {
            $objRespuesta = conexion::conectar()->prepare("UPDATE carros SET marca='$marca',color='$color',tipo='$tipo' WHERE idcarro = '$idCarro' ");
            if ($objRespuesta->execute()) {
                $mensaje = "ok";
            } else {
                $mensaje = "no fue posible modificar la informacion";
            }
        } catch (Exception $e) {
            $mensaje = $e;
        }

        return $mensaje;
    }


    public static  function mdlEliminarCarro($idCarro)
    {
        $mensaje = "";

        try {

            $objRespuesta = conexion::conectar()->prepare("DELETE FROM carros  WHERE idCarro = '$idCarro'");

            if ($objRespuesta->execute()) {

                $mensaje = "Ok";
            } else {
                $mensaje = "No fue posible eliminar la información";
            }
        } catch (Exception $e) {

            $mensaje = $e;
        }

        return $mensaje;
    }
}
