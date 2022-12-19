<?php
include '../../TODO/conexion.php'; // Unión Grupo - Materia
    $selectGrupo    = "SELECT * FROM grupo";
    $resultGrupo    = mysqli_query($conexion, $selectGrupo);
    $selectMateria   = "SELECT * FROM materia";
    $resultMateria   = mysqli_query($conexion, $selectMateria);
    $message = '';
    if(isset($_POST['submit'])){
        $grupo = $_POST['grupo'];
        $materia = $_POST['materia'];
        $insert = "UPDATE materia SET Grupo_idGrupo = '$grupo' WHERE idMateria=".$materia;
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
            <h1>Union Grupo y Materia</h1>    
        </div>
        <hr/>
        <div class="row justify-content-center align-items-center h-100">
            <div class="col col-sm-6 col-md-6 col-lg-4 col-xl-3">
                <h5 class="text-success text-center" id="message"><?= $message; ?><h5>
                <form action="uniones3.php" method="POST">                
                <div class="form-group">
                    <select class="form-control" name="grupo">
                        <option>Seleccione un Grupo</option>
                        <?php foreach($resultGrupo as $key => $value){ ?>
                          <option value="<?=  $value['idGrupo'];?>"><?= "Nivel Escolar: ".$value['NivelEscolar']." - Grado: ".$value['Grado']." - Grupo: ".$value['GrupoLetra']; ?></option>                           
                        <?php } ?>
                    </select>
                    <select class="form-control" name="materia">
                        <option>Seleccione una Materia</option>
                        <?php foreach($resultMateria as $key => $value){ ?>
                            <option value="<?=  $value['idMateria'];?>"><?= $value['Nombre']." - "."Nivel Academico: ".$value['NivelAcademico']." - Grado: ".$value['Grado']; ?></option> 
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                <div class="container">
                  <div class="row">
                    <div class="col"><button type="submit" name="submit" class="col-6 btn btn-primary btn-sm float-left">Submit</button></div>
                    <div class="col">                                                           
                        <button type="button" class="col-6 btn btn-danger btn-sm float-right" role="link" onclick="window.location='../../TODO/ADMIN/gruposAdmin.html'">Volver</button>
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