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
        // case "read-AlumnosAgregar":{
        //     accionReadAlumnosAgregar($conexion);
        //     break;
        // }
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
        $Nombre             = $_POST["Nombre"];
        $Ap_Paterno         = $_POST["Ap_Paterno"];
        $Ap_Materno         = $_POST["Ap_Materno"];
        $fechaNac           = $_POST["fechaNac"];
        $CURP               = $_POST["CURP"];
        $NivelAcademico     = $_POST["NivelAcademico"];
        $QueryCreate = 'INSERT INTO alumno(idAlumno, Nombre, Ap_Paterno, Ap_Materno, fechaNac, CURP, NivelAcademico, CaliFinal_Promedio, Grupo_idGrupo, Grupo_Docente_idDocente, Grupo_idGrupo1, Usuario_idUsuario) VALUES(NULL,"'.$Nombre.'","'.$Ap_Paterno.'","'.$Ap_Materno.'","'.$fechaNac.'","'.$CURP.'","'.$NivelAcademico.'",NULL,NULL,NULL,NULL,NULL)';
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
        $QueryRead = "SELECT * FROM alumno";
        // Ejecutamos la consulta
        $ResultadoRead = mysqli_query($conexion, $QueryRead);
        // Obtenermos el número de registros
        $numeroRegistros = mysqli_num_rows($ResultadoRead);
        // Preguntamos si hay registros o no.
        if($numeroRegistros > 0){
            $respuesta["estado"] = 1;
            $respuesta["mensaje"] = "Registros encontrados";
            $respuesta["alumnos"] = array();
            while($renglonAlumno = mysqli_fetch_assoc($ResultadoRead)){
                $alumno = array();
                $alumno["idAlumno"] = $renglonAlumno["idAlumno"];
                $alumno["Nombre"] = $renglonAlumno["Nombre"];
                $alumno["Ap_Paterno"] = $renglonAlumno["Ap_Paterno"];
                $alumno["Ap_Materno"] = $renglonAlumno["Ap_Materno"];
                $alumno["CURP"] = $renglonAlumno["CURP"];
                $alumno["NivelAcademico"] = $renglonAlumno["NivelAcademico"];
                array_push($respuesta["alumnos"], $alumno);
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
        $QueryDelete = 'DELETE FROM alumno WHERE idAlumno='.$id;
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
    ///////////////////////////////////////////////////////////////////////////////////////////
    // function accionReadAlumnosAgregar($conexion){
    //     // Diseñamos la consulta 
    //     $QueryReadAlumnosAgregar = "SELECT * FROM alumno";
    //     // Ejecutamos la consulta
    //     $ResultadoReadAlumnosAgregar = mysqli_query($conexion, $QueryReadAlumnosAgregar);
    //     // Obtenemos el número de registros
    //     $numeroRegistros = mysqli_num_rows($ResultadoReadAlumnosAgregar);
    //     // Preguntamos si hay registros o no
    //     if($numeroRegistros > 0){
    //         $respuesta["estado"] = 1;
    //         $respuesta["mensaje"] = "Registros encontrados";
    //         $respuesta["alumnosAgregar"] = array();
    //         while($renglonAlumnoAgregar = mysqli_fetch_assoc($ResultadoReadAlumnosAgregar)){
    //             $alumnoAgregar = array();
    //             // Nombre, ApPaterno, ApMaterno, CURP 
    //             $alumnoAgregar["idAlumno"]      = $renglonAlumnoAgregar["idAlumno"];
    //             $alumnoAgregar["Nombre"]        = $renglonAlumnoAgregar["Nombre"];
    //             $alumnoAgregar["Ap_Paterno"]    = $renglonAlumnoAgregar["Ap_Paterno"];
    //             $alumnoAgregar["Ap_Materno"]    = $renglonAlumnoAgregar["Ap_Materno"];
    //             $alumnoAgregar["CURP"]          = $renglonAlumnoAgregar["CURP"];
    //             array_push($respuesta["alumnosAgregar"], $alumnoAgregar);
    //         }
    //     }else{
    //         $respuesta["estado"] = 0;
    //         $respuesta["mensaje"] = "Resgistros no encontrados";        
    //     }
    //     echo json_encode($respuesta);
    //     mysqli_close($conexion);
    // }
?>