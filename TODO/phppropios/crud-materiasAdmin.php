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
        $Nombre =           $_POST["Nombre"];
        $NivelAcademico =   $_POST["NivelAcademico"];
        $Grado =            $_POST["Grado"];
        $QueryCreate = 'INSERT INTO materia(idMateria, Nombre, NivelAcademico, Grado, Docente_idDocente, Grupo_idGrupo) VALUES(NULL, "'.$Nombre.'","'.$NivelAcademico.'","'.$Grado.'", NULL, NULL)';        
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
        $QueryRead = "SELECT * FROM materia";
        // Ejecutamos la consulta
        $ResultadoRead = mysqli_query($conexion, $QueryRead);
        // Obtenermos el número de registros
        $numeroRegistros = mysqli_num_rows($ResultadoRead);
        //echo($numeroRegistros);
        // Preguntamos si hay registros o no.
        if($numeroRegistros > 0){
            $respuesta["estado"] = 1;
            $respuesta["mensaje"] = "Registros encontrados";
            $respuesta["materias"] = array();
            while($renglonMateria = mysqli_fetch_assoc($ResultadoRead)){
                $materia = array();
                $materia["idMateria"] = $renglonMateria["idMateria"];
                $materia["Nombre"] = $renglonMateria["Nombre"];
                $materia["NivelAcademico"] = $renglonMateria["NivelAcademico"];
                $materia["Grado"] = $renglonMateria["Grado"];
                array_push($respuesta["materias"], $materia);
            }
        }
        else{
            $respuesta["estado"] = 0;
            $respuesta["mensaje"] = "Resgistros no encontrados";        
        }
        echo json_encode($respuesta);
        mysqli_close($conexion);
    }
    function accionDeletePhp($conexion){
        $id = $_POST['id'];
        $QueryDelete = 'DELETE FROM materia WHERE idMateria='.$id;
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
//     function accionUpdatePhp($conexion){
//         $id = $_POST["idMateria"];
//         $Nombre =           $_POST["Nombre"];
//         $NivelAcademico =   $_POST["NivelAcademico"];
//         $Grado =            $_POST["Grado"];
//         $QueryUpdate = "UPDATE materia SET Nombre='".$Nombre."', NivelAcademico='".$NivelAcademico."',Grado='".$Grado."' WHERE idMateria =".$id;
//         mysqli_query($conexion, $QueryUpdate);
//         if(mysqli_affected_rows($conexion)>0){
//             $respuesta["estado"]    = 1;
//             $respuesta["mensaje"]   ="El registro se actualizo correctamente";
//         }else{
//             $respuesta["estado"] = 0;
//             $respuesta["mensaje"] = "El registro no fue actualizado";
//         }
//         echo json_encode($respuesta);
//         mysqli_close($conexion);
//     }
//     function accionReadByIdPhp($conexion){
//         $id = $_POST["id"];
//         $QueryReadById = "SELECT * FROM materia WHERE idMateria=".$id;
//         $ResultadoReadById  = mysqli_query($conexion, $QueryReadById);
//         $numerosRegistros   = mysqli_num_rows($ResultadoReadById);
//         if($numerosRegistros>0){
//             $respuesta["estado"] = 1;
//             $respuesta["mensaje"] = "Registro encontrado";

//             $renglonMateriaById = mysqli_fetch_assoc($ResultadoReadById);
//             $repuesta["idMateria"]      = $renglonMateriaById["idMateria"];
//             $respuesta["Nombre"]        = $renglonMateriaById["Nombre"];
//             $respuesta["NivelAcademico"]= $renglonMateriaById["NivelAcademico"];
//             $respuesta["Grado"]         = $renglonMateriaById["Grado"];
//         }else {
//             $respuesta["estado"] = 0;
//             $respuesta["mensaje"] = "Registro no encontrado";
//         }
//         echo json_encode($respuesta);
//         mysqli_close($conexion);
//     }
// ?>