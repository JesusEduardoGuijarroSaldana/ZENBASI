let idEliminarTutor = 0;
//let idTutorUnir = 0;
function actionCreateTutor(){
    let nombreTutor = document.getElementById("nombreTutor").value;//alert(nombreTutor);
    let apPaternoTutor = document.getElementById("apPaternoTutor").value;//alert(apPaternoTutor);
    let apMaternoTutor = document.getElementById("apMaternoTutor").value;//alert(apMaternoTutor);
    let telTutor = document.getElementById("telTutor").value;//alert(telTutor);    
    let emailTutor = document.getElementById("emailTutor").value;//alert(emailTutor);        
    $.ajax({
        method: "POST",
        url: "../../TODO/phppropios/crud-tutoresAdmin.php",
        data:{
           Nombre: nombreTutor,
           Ap_Paterno: apPaternoTutor,
           Ap_Materno: apMaternoTutor,
           telefono: telTutor,
           Email: emailTutor,
           accion: "create"
        },
        success: function(respuesta){
            //alert("HOLA");
            let miObjetoJSON = JSON.parse(respuesta);            
            if(miObjetoJSON.estado==1){
                //agregamos el registro a la tabla
                let tabla = $("#tutores").DataTable();
                let botones = '<button type="button" class="btn btn-warning btn-sm mr-3" data-toggle="modal" data-target="#modalEditarTutor" onclick="identificarActualizar('+miObjetoJSON.id+');"><i class=" mdi mdi-pencil mr-1"></i>Editar</button>';
                //botones += '<button type="button" class="btn btn-primary btn-sm mr-3" data-toggle="modal" data-target="#modalAñadirAlumno" onclick="identificarTutorAUnir('+miObjetoJSON.id+');"><i class="mdi mdi-account-plus mr-1"></i>Añadir Alumno</button>';
                botones    += '<button type="button" class="btn btn-danger mr-3 btn-sm" data-toggle="modal" data-target="#modalEliminarTutor" onclick="identificarEliminarTutor('+miObjetoJSON.id+');"><i class=" mdi mdi-trash-can mr-1"></i>Eliminar</button>';
                tabla.row.add([nombreTutor, apPaternoTutor, apMaternoTutor, telTutor, emailTutor, "Sin Asignar", botones]).draw().node().id="renglon_"+miObjetoJSON.id;
                // mostrar mensaje con toastr
            }
                // mostrar mensaje con toastr en el else (q falta agregar)
        }
    })
}
function actionReadTutor(){
    $.ajax({
        method: "POST",
        url: "../../TODO/phppropios/crud-tutoresAdmin.php",
        data:{
            accion: "read"
        },
        success: function(respuesta){
            let miObjetoJSON = JSON.parse(respuesta);
            //alert("HOLA");
            if(miObjetoJSON.estado==1){
                ///mostrar en la tabla los tutores
                let tabla = $("#tutores").DataTable();
                miObjetoJSON.tutores.forEach(Nombre => {
                    let botones = '<button type="button" class="btn btn-warning btn-sm mr-3" data-toggle="modal" data-target="#modalEditarTutor" onclick="identificarActualizar('+Nombre.idTutor+');"><i class=" mdi mdi-pencil mr-1"></i>Editar</button>';
                    //botones += '<button type="button" class="btn btn-primary btn-sm mr-3" data-toggle="modal" data-target="#modalAñadirAlumno" onclick="identificarTutorAUnir('+Nombre.idTutor+');"><i class="mdi mdi-account-plus mr-1"></i>Añadir Alumno</button>';
                    botones    += '<button type="button" class="btn btn-danger mr-3 btn-sm" data-toggle="modal" data-target="#modalEliminarTutor" onclick="identificarEliminarTutor('+Nombre.idTutor+');"><i class=" mdi mdi-trash-can mr-1"></i>Eliminar</button>';
                    tabla.row.add([Nombre.Nombre, Nombre.Ap_Paterno, Nombre.Ap_Materno, Nombre.telefono, Nombre.Email,botones]).draw().node().id="renglon_"+Nombre.idTutor;                    
                });
            }
        }
    })
}
function actionReadUnionAlumnoTutor(){
    $.ajax({
        method: "POST",
        url: "../../TODO/phppropios/crud-tutoresAdmin.php",
        data: {
          accion: "readUnionAlumnoTutor"
        },
        success: function( respuesta ) {            
          let miObjetoJSON = JSON.parse(respuesta);
            if(miObjetoJSON.estado==1){
                let tabla = $("#unionTutorAlumno").DataTable();
                miObjetoJSON.unionTutorAlumno.forEach( TutorAlumno => {
                    let botones = '<button type="button" class="btn btn-danger mr-3 btn-sm" data-toggle="modal" data-target="#modalEliminarTutor" onclick="identificarEliminarTutor('+TutorAlumno.idUnion+');"><i class=" mdi mdi-trash-can mr-1"></i>Eliminar</button>';
                    tabla.row.add([TutorAlumno.tutor, TutorAlumno.alumno, botones]).draw().node().id="renglon_"+TutorAlumno.idUnion;
                })
            }
        }
      });
}
function actionDeleteTutor(){
    $.ajax({
        method: "POST",
        url: "../../TODO/phppropios/crud-tutoresAdmin.php",
        data: {
          id: idEliminarTutor,
          accion: "delete"
        },
        success: function(respuesta) {
            let miObjetoJSON = JSON.parse(respuesta);
            if(miObjetoJSON.estado==1){
                let tabla =$("#tutores").DataTable();
                tabla.row("#renglon_"+idEliminarTutor).remove().draw();
            }
        }
      });
}
function identificarEliminarTutor(id){
    idEliminarTutor = id;
    //alert(id);
}
////////////////////////////////////////////////////////////
// function identificarTutorAUnir(idTutorAUnir){
//     idTutorUnir = idTutorAUnir;
// }
// function mandarIdUnionTutor(){
//     $.ajax({        
//         url: "../../TODO/phppropios/unionTutorAlumnoAdmin.php",
//         type: "POST",
//         data: {
//             idTutorAUnir: idTutorUnir,
//             accion: "saveIdTutor"          
//         },
//         success: function(respuesta) {            
//             // do something
//             alert(idTutorUnir);
//         }
//       }); 
// }
////////////////////////////////////////////////////////////

