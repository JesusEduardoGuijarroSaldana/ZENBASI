function login()
{
 var user=$("#usuario").val();
 var pass=$("#password").val();

 if(user!="" && pass!="")
 {
    
    $.ajax
    ({
        type:'post',
        url:'login.php',
        data:{
        login:"login",
        user:user,
        pass:pass
        // variable de php : variable del js
        //lo que te traes por post : variable del js
    },
    success:function(respuesta) {
        let miObjetoJSON = JSON.parse(respuesta);
          
        if(miObjetoJSON.estado==1){

            if(miObjetoJSON.rol==0){
                window.location.href = "ADMIN/indexAdmin.php";
            }
            else if(miObjetoJSON.rol == 1){
                window.location.href = "DOCENTE/indexDocente.html"
            }
            else if(miObjetoJSON.rol == 2){
                window.location.href ="ALUMNO/indexAlumno.php"
            }
            else if(miObjetoJSON.rol == 3){
                window.location.href = "TUTOR/indexTutor.html"
            }
            else{
                window.location.href = "404.html"
            }

        }
        else{
          
            alert("Usuario y/o contraseña incorrectos");
          
        }

    }
    });
 }

 else
 {
  alert("Campos vacios");
 }

 return false;
}