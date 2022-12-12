<?php
    include '../../TODO/conexion.php';
    $respuesta = array();
    $accion = $_POST["accion"];

    switch($accion){
        case "create":{
            accionCreatePhp($conexion);
            break;
        }
        case "update":{
            accionUpdatePhp($conexion);
            break;
        }
        case "delete":{
            accionDeletePhp($conexion);
            break;
        }
        case "read":{
            accionReadPhp($conexion);
            break;
        }
        case "read-id":{
            accionReadByIdPhp($conexion);
            break;
        }
        default:{
            accionErrorPhp();
            break;
        }
    }
    function accionErrorPhp(){
        $respuesta["estado"] = 0;
        $respuesta["mensaje"]="Accion no válida";
        echo json_encode($respuesta);
        mysqli_close($conexion);
    }
    function accionCreatePhp($conexion){
        $NivelEscolar = $_POST["NivelEscolar"];
        $Grado = $_POST["Grado"];
        $GrupoLetra = $_POST["GrupoLetra"];
        $QueryCreate = 'INSERT INTO grupo(idGrupo, NivelEscolar, Grado, GrupoLetra, Docente_idDocente, Docente_idDocente1) VALUES(NULL, "'.$NivelEscolar.'","'.$Grado.'","'.$GrupoLetra.'",NULL,NULL)';
        if(mysqli_query($conexion, $QueryCreate)){
            $respuesta["estado"] = 1;
            $respuesta["id"] = mysqli_insert_id($conexion);
            $respuesta["mensaje"]   = "El registro se agrego correctamente"; 
        }else{
            $respuesta["estado"]    =0;
            $respuesta["id"]        =-1; //id del registro
            $respuesta["mensaje"]   ="Ocurrio un error desconocido";
        }
        echo json_encode($respuesta);    
        mysqli_close($conexion);
    }
    function accionReadPhp($conexion){
        // Diseñamos la consulta
        $QueryRead = "SELECT * FROM grupo";
        // Ejecutamos la consulta
        $ResultadoRead = mysqli_query($conexion, $QueryRead);
        // Obtenermos el número de registros
        $numeroRegistros = mysqli_num_rows($ResultadoRead);
        // Preguntamos si hay registros o no.
        if($numeroRegistros > 0){
            $respuesta["estado"] = 1;
            $respuesta["mensaje"] = "Registros encontrados";
            $respuesta["grupos"] = array();
            while($renglonGrupo = mysqli_fetch_assoc($ResultadoRead)){
                $grupo = array();
                $grupo["idGrupo"] = $renglonGrupo["idGrupo"];
                $grupo["NivelEscolar"] = $renglonGrupo["NivelEscolar"];
                $grupo["Grado"] = $renglonGrupo["Grado"];
                $grupo["GrupoLetra"] = $renglonGrupo["GrupoLetra"];
                array_push($respuesta["grupos"], $grupo);
            }
        }else{
            $respuesta["estado"] = 0;
            $respuesta["mensaje"] = "Resgistros no encontrados";        
        }
        echo json_encode($respuesta);
        mysqli_close($conexion);
    }
    function accionDeletePhp($conexion){
        $id = $_POST['id'];
        $QueryDelete = 'DELETE FROM grupo WHERE idGrupo='.$id;
        mysqli_query($conexion,$QueryDelete);
        if(mysqli_affected_rows($conexion)>0){
            $respuesta["estado"] = 1;
            $respuesta["mensaje"] = "El registro se eliminó correctamente";
        }else{
            $respuesta["estado"] =0;
            $respuesta["mensaje"] = "Ocurrio un error desconocido";
        }
        echo json_encode($respuesta);
        mysqli_close($conexion);
    }
?>