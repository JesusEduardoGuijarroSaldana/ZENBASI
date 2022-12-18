<?php
    include '../../TODO/conexion.php';
    $respuesta = array();
    $accion = $_POST["accion"];

    switch($accion){
        case "create":{
            accionCreatePhp($conexion);
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
        case "readUnionAlumnoTutor":{
            accionReadUnionAlumnoTutor($conexion);
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
        $Nombre         = $_POST["Nombre"];
        $Ap_Paterno     = $_POST["Ap_Paterno"];
        $Ap_Materno     = $_POST["Ap_Materno"];        
        $telefono       = $_POST["telefono"];
        $Email          = $_POST["Email"];
        $QueryCreate = 'INSERT INTO tutor(idTutor, Nombre, Ap_Paterno, Ap_Materno, telefono, Email, Usuario_idUsuario) VALUES(NULL, "'.$Nombre.'","'.$Ap_Paterno.'","'.$Ap_Materno.'","'.$telefono.'","'.$Email.'",NULL)';        
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
        //Diseñamos la consulta
        $QueryRead = "SELECT * FROM tutor";
        //Ejecutamos la consulta
        $ResultadoRead = mysqli_query($conexion, $QueryRead);
        //Obtenemos el número de registros
        $numeroRegistros = mysqli_num_rows($ResultadoRead);
        //Preguntamos si hya registros o no
        if($numeroRegistros > 0){
            $respuesta["estado"] = 1;
            $respuesta["mensaje"] = "Registros encontrados";
            $respuesta["tutores"] = array();
            while($renglonTutor = mysqli_fetch_assoc($ResultadoRead)){
                $tutor = array();
                $tutor["idTutor"] = $renglonTutor["idTutor"];
                $tutor["Nombre"] = $renglonTutor["Nombre"];
                $tutor["Ap_Paterno"] = $renglonTutor["Ap_Paterno"];
                $tutor["Ap_Materno"] = $renglonTutor["Ap_Materno"];
                $tutor["telefono"] = $renglonTutor["telefono"];
                $tutor["Email"] = $renglonTutor["Email"];
                //$tutor["hijos"] = $renglonTutor['Jesus'];
                array_push($respuesta["tutores"],$tutor);
            }
        }
        else{
            $respuesta["estado"] = 0;
            $respuesta["mensaje"] = "Resgistros no encontrados";        
        }
        echo json_encode($respuesta);
        mysqli_close($conexion);
    }
    function accionReadUnionAlumnoTutor($conexion){
        //$idTutor = $_POST['tutor'];
        //$idAlumno = $_POST['alumno'];
        //Diseñamos la consulta
        //$QueryRead = "SELECT CONCAT(tt.Nombre,' ',tt.Ap_Paterno,' ',tt.Ap_Materno) AS Tutor, CONCAT(al.Nombre,' ',al.Ap_Paterno,' ',al.Ap_Materno) AS Alumno FROM tutor_alumno AS ttAl JOIN tutor AS tt ON(ttAl.Tutor_idTutor = tt.idTutor) JOIN alumno AS al ON(ttAl.Alumno_idAlumno = al.idAlumno) WHERE (tt.idTutor = tutor AND al.idAlumno= alumno);";        
        $QueryRead = "SELECT * FROM tutor_alumno";
        //Ejecutamos la consulta
        $ResultadoRead = mysqli_query($conexion, $QueryRead);
        //Obtenemos el número de registros
        $numeroRegistros = mysqli_num_rows($ResultadoRead);
        //Preguntamos si hay registros o no
        if($numeroRegistros > 0){
            $respuesta["estado"] = 1;
            $respuesta["mensaje"] = "Registros encontrados";
            $respuesta["unionTutorAlumno"] = array();
            while($renglonunionTutorAlumno= mysqli_fetch_assoc($ResultadoRead)){
                $unionTutorAlumno = array();
                $unionTutorAlumno["idUnion"] = $renglonunionTutorAlumno["idUnion"];
                $unionTutorAlumno["tutor"] = $renglonunionTutorAlumno["Tutor_idTutor"];
                $unionTutorAlumno["alumno"] = $renglonunionTutorAlumno["Alumno_idAlumno"];                             
                array_push($respuesta["unionTutorAlumno"],$unionTutorAlumno);
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
        $QueryDelete = 'DELETE FROM tutor WHERE idTutor='.$id;
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