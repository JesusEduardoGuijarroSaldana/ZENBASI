<?php
include '../../TODO/conexion.php'; // Union Tutor - Alumno
//$value['idTutor'].$value['Nombre'].$value['Ap_Paterno'].$value['Ap_Materno'];
//"><?= $value['idTutor'].$value['Nombre'].$value['Ap_Paterno'].$value['Ap_Materno'];
    //$selectTutor    = "SELECT CONCAT(Nombre, ' ',Ap_Paterno, ' ',Ap_Materno) AS nombreTutor FROM tutor";
    $selectTutor    = "SELECT * FROM tutor";
    $resultTutor    = mysqli_query($conexion, $selectTutor);
    $selectAlumno   = "SELECT * FROM alumno";
    //$selectAlumno   = "SELECT CONCAT(Nombre, ' ',Ap_Paterno, ' ',Ap_Materno) AS nombreAlumno FROM alumno";
    $resultAlumno   = mysqli_query($conexion, $selectAlumno);

    $message = '';
    if(isset($_POST['submit'])){
        $tutor  = $_POST['tutor'];
        //$idTutor = "SELECT idTutor FROM tutor WHERE idTutor=".$tutor;
        $alumno = $_POST['alumno'];
        //$idAlumno = "SELECT idAlumno FROM alumno WHERE CONCAT(Nombre,' ',Ap_Paterno,' ',Ap_Materno)=".$alumno;
        // Attempt insert query execution
        $insert = "INSERT INTO tutor_alumno (Tutor_idTutor ,Alumno_idAlumno) VALUES ('$tutor', '$alumno')";
        if(mysqli_query($conexion, $insert)){
            $message = "Se realizó la unión correctamente.";
        }else
            $message = "ERROR: Could not able to execute $insert. " . mysqli_error($conexion);
        // Close connection
        mysqli_close($conexion);
    }    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Uniones</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

</head>
<body>
  
    <div class="container-fluid h-100 bg-light text-dark">
        <div class="row justify-content-center align-items-center">
            <h1>Union Tutor y Alumno</h1>    
        </div>
        <hr/>
        <div class="row justify-content-center align-items-center h-100">
            <div class="col col-sm-6 col-md-6 col-lg-4 col-xl-3">
                <h5 class="text-success text-center" id="message"><?= $message; ?><h5>
                <form action="uniones.php" method="POST">                
                <div class="form-group">
                    <select class="form-control" name="tutor">
                        <option>Seleccione un Tutor</option>
                        <?php foreach($resultTutor as $key => $value){ ?>
                          <option value="<?=  $value['idTutor'];?>"><?= $value['Nombre']." ".$value['Ap_Paterno']." ".$value['Ap_Materno']; ?></option>                           
                        <?php } ?>
                    </select>
                    <select class="form-control" name="alumno">
                        <option>Seleccione un Alumno</option>
                        <?php foreach($resultAlumno as $key => $value){ ?>
                          <option value="<?= $value['idAlumno'];?>"><?= $value['Nombre']." ".$value['Ap_Paterno']." ".$value['Ap_Materno']; ?></option> 
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                <div class="container">
                  <div class="row">
                    <div class="col"><button type="submit" name="submit" class="col-6 btn btn-primary btn-sm float-left">Submit</button></div>
                    <div class="col">                                                 
                        <button type="button" class="col-6 btn btn-danger btn-sm float-right" role="link" onclick="window.location='../../TODO/ADMIN/tutoresAdmin.html'">Volver</button>
                  </div>                    
              </form>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>

      <script>
        $(document).ready(function()
        {
            setTimeout(function()
            {
                $('#message').hide();
            },3000);
        });
    </script>
</body>

</html>