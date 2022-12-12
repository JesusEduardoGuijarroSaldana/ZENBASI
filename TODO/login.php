<?php

include 'conexion.php';
$respuesta = array();

session_start();
if(isset($_POST['login']))
{

    $usuario=$_POST['user'];
    $pass=$_POST['pass'];

    $query="SELECT * FROM usuario WHERE nombreUsuario='".$usuario."' AND Password='".$pass."'";

    $resultado = mysqli_query($conexion,$query);

    $numRes = mysqli_num_rows($resultado);

    $fila = mysqli_fetch_array($resultado);

    //$nombre = ""

    if($numRes>0){
        $respuesta["estado"]        =1;
        $respuesta["mensaje"]       ="Accedio correctamente";
        $_SESSION['user']=$fila['nombreUsuario'];
        //$_SESSION['nombre']
        $respuesta["rol"]=$fila['rol'];
    } else{
        $respuesta["estado"]        =0;
        $respuesta["mensaje"]       ="Ocurrio un error desconocido";
    }

    echo json_encode($respuesta);
    mysqli_close($conexion);
    exit();
}
else{
    $respuesta["estado"] =0;
    $respuesta["mensaje"]="Sin accion definida";
    echo json_encode($respuesta);
}
?>