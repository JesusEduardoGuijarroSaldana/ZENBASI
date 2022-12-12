<?php
    include '../../TODO/conexion.php';
    $respuesta  = array();
    $accion     = $_POST["accion"];
    
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
        $Nombre = $_POST["Nombre"];
        $Ap_Paterno = $_POST["Ap_Paterno"];
        $Ap_Materno = $_POST["Ap_Materno"];
        $fechaNac = $_POST["fechaNac"];
        $RFC = $_POST["RFC"];
        $CedulaProfesional = $_POST["CedulaProfesional"];
        $QueryCreate = 'INSERT INTO docente(idDocente, Nombre, Ap_Paterno, Ap_Materno, fechaNac, RFC, CedulaProfesional, Usuario_idUsuario) VALUES(NULL, "'.$Nombre.'","'.$Ap_Paterno.'","'.$Ap_Materno.'","'.$fechaNac.'","'.$RFC.'","'.$CedulaProfesional.'",NULL)';
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
        $QueryRead = "SELECT * FROM docente";
        // Ejecutamos la consulta
        $ResultadoRead = mysqli_query($conexion, $QueryRead);
        // Obtenemos el número de registros
        $numeroRegistros = mysqli_num_rows($ResultadoRead);
        // Preguntamos si hay registros o no.
        if($numeroRegistros > 0){
            $respuesta["estado"] = 1;
            $respuesta["mensaje"] = "Registros encontrados";
            $respuesta["docentes"] = array();
            while($renglonDocente = mysqli_fetch_assoc($ResultadoRead)){
                $docente                = array();
                $docente["idDocente"]   = $renglonDocente["idDocente"];
                $docente["Nombre"]      = $renglonDocente["Nombre"];
                $docente["Ap_Paterno"]  = $renglonDocente["Ap_Paterno"];
                $docente["Ap_Materno"]  = $renglonDocente["Ap_Materno"];
                $docente["fechaNac"]    = $renglonDocente["fechaNac"];
                $docente["RFC"]         = $renglonDocente["RFC"];
                $docente["CedulaProfesional"] = $renglonDocente["CedulaProfesional"];
                array_push($respuesta["docentes"], $docente);
            }            
        }else{
            $respuesta["estado"] = 0;
            $respuesta["mensaje"] = "Registros no encontrados";        
        }
        echo json_encode($respuesta);
        mysqli_close($conexion);
    }
    function accionDeletePhp($conexion){
        $id             = $_POST['id'];
        $QueryDelete    = 'DELETE FROM docente  WHERE idDocente='.$id;
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