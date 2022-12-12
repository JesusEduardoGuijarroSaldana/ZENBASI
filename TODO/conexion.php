<?php
    // Conectamos a la base de datos.
    $conexion = mysqli_connect('localhost','root','','zenbasi');
    // Revisamos la conexión
    if(!$conexion){
        die("Error al conectarse: ".mysqli_connect_error());
    }
?>