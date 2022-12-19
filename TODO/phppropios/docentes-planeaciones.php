<?php

include '../../TODO/conexion.php'; 

$respuesta = array();
    $accion = $_POST["accion"];


    switch($accion){
        case "readMateriasDocente":{
            readMateriasDocente($conexion);
            break;
        }
        case "nuevaplan":{
            nuevaPlaneacion($conexion);
            break;
        }

        default:{
            accionErrorPhp();
            break;
        }
    }

    function readMateriasDocente($conexion){
        //$querySelectMaterias = "SELECT "

        $querySelectMaterias = "SELECT * FROM materia";

        $resultadoMaterias = mysqli_query($conexion, $querySelectMaterias);

        $numMaterias = mysqli_num_rows($resultadoMaterias);

        if($numMaterias>0){
            $respuesta["estado"]=1;
            $respuesta["mensaje"]= "Materias encontrados";
            $respuesta["materias"] = array();
            while ($renglonMateria = mysqli_fetch_assoc($resultadoMaterias)) {
                $materia = array();
                $materia["id"]      = $renglonMateria["idMateria"];
                $materia["nombre"]  = $renglonMateria["Nombre"];
                array_push($respuesta["materias"], $materia);
            }
        }
        else{
            $respuesta["estado"] = 0;
            $respuesta["mensaje"] = "Materias no encontrados";
        }
        echo json_encode($respuesta);

    }


   

    function nuevaPlaneacion(){

    }


    ?>