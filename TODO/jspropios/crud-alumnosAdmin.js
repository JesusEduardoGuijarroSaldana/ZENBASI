let idEliminarAlumno = 0;
let idActualizarAlumno = 0;
let idAlumnoUnir = 0;
function actionCreateAlumno(){
    let nombreAlumno    = document.getElementById("nombreAlumno").value;
    let apPaternoAlumno       = document.getElementById("apPaternoAlumno").value;
    let apMaternoAlumno       = document.getElementById("apMaternoAlumno").value;
    let fechaNacAlumno = document.getElementById("fechaNacAlumno").value; 
    let curpAlumno            = document.getElementById("curpAlumno").value;
    var nivelAcademicoAlumno  = 0;
    if($("#1").is(":selected")){
        nivelAcademicoAlumno = 1;
    }else if($("#2").is(":selected")){
        nivelAcademicoAlumno = 2;
    }else{
        nivelAcademicoAlumno = 3; // secundaria
    }
    //alert(nivelAcademicoAlumno);
    $.ajax({
        method: "POST",
        url: "../../TODO/phppropios/crud-alumnosAdmin.php",
        data: {
            Nombre: nombreAlumno,
            Ap_Paterno: apPaternoAlumno,
            Ap_Materno: apMaternoAlumno,
            fechaNac: fechaNacAlumno,
            CURP: curpAlumno,
            NivelAcademico: nivelAcademicoAlumno,
            accion: "create"
        },
        success: function(respuesta) {
            let miObjetoJSON = JSON.parse(respuesta);
            if(miObjetoJSON.estado == 1){
                //agregamos el registro a la tabla
                let tabla = $("#alumnos").DataTable();
                let botones = '<button type="button" class="btn btn-warning btn-sm mr-3" data-toggle="modal" data-target="#editarAlumno" onclick="identificarActualizarAlumno('+miObjetoJSON.id+');"><i class=" mdi mdi-pencil mr-1"></i>Editar</button>';
                    botones += '<button type="button" class="btn btn-danger mr-3 btn-sm" data-toggle="modal" data-target="#modalEliminarAlumno" onclick="identificarEliminarAlumno('+miObjetoJSON.id+')"><i class=" mdi mdi-trash-can mr-1"></i>Eliminar</button>';
                    botones += '<button type="button" class="btn btn-primary mr-3 btn-sm" data-toggle="modal" data-target="#asignarGrupo"><i class=" mdi mdi-account-multiple-plus mr-1"></i>Asignar Grupo</button>';
                    if(nivelAcademicoAlumno == 1){
                        tabla.row.add([nombreAlumno, apPaternoAlumno, apMaternoAlumno, curpAlumno, "Kinder", "Sin Asignar",botones]).draw().node().id="renglon_"+miObjetoJSON.id;
                    }else if(nivelAcademicoAlumno == 2){
                        tabla.row.add([nombreAlumno, apPaternoAlumno, apMaternoAlumno, curpAlumno, "Primaria", "Sin Asignar",botones]).draw().node().id="renglon_"+miObjetoJSON.id;
                    }else
                        tabla.row.add([nombreAlumno, apPaternoAlumno, apMaternoAlumno, curpAlumno, "Secundaria", "Sin Asignar",botones]).draw().node().id="renglon_"+miObjetoJSON.id;
                }
            }        
      });
}
function actionReadAlumno(){
    $.ajax({
        method: "POST",
        url: "../../TODO/phppropios/crud-alumnosAdmin.php",
        data: {
          accion: "read"
        },
        success: function(respuesta) {
            let miObjetoJSON = JSON.parse(respuesta);
            if(miObjetoJSON.estado==1){
                let tabla = $("#alumnos").DataTable();
                miObjetoJSON.alumnos.forEach(Nombre => {
                    let botones = '<button type="button" class="btn btn-warning btn-sm mr-3" data-toggle="modal" data-target="#editarAlumno" onclick="identificarActualizarAlumno('+Nombre.idAlumno+');"><i class=" mdi mdi-pencil mr-1"></i>Editar</button>';
                    botones += '<button type="button" class="btn btn-danger mr-3 btn-sm" data-toggle="modal" data-target="#modalEliminarAlumno" onclick="identificarEliminarAlumno('+Nombre.idAlumno+');"><i class=" mdi mdi-trash-can mr-1"></i>Eliminar</button>';
                    botones += '<button type="button" class="btn btn-primary mr-3 btn-sm" data-toggle="modal" data-target="#asignarGrupo"><i class=" mdi mdi-account-multiple-plus mr-1"></i>Asignar Grupo</button>';
                    if(Nombre.NivelAcademico == 1){
                        tabla.row.add([Nombre.Nombre, Nombre.Ap_Paterno, Nombre.Ap_Materno, Nombre.CURP, "Kinder", "Sin Asignar",botones]).draw().node().id="renglon_"+Nombre.idAlumno;
                    }else if(Nombre.NivelAcademico == 2){
                        tabla.row.add([Nombre.Nombre, Nombre.Ap_Paterno, Nombre.Ap_Materno, Nombre.CURP, "Primaria", "Sin Asignar",botones]).draw().node().id="renglon_"+Nombre.idAlumno;
                    }else   
                        tabla.row.add([Nombre.Nombre, Nombre.Ap_Paterno, Nombre.Ap_Materno, Nombre.CURP, "Secundaria", "Sin Asignar",botones]).draw().node().id="renglon_"+Nombre.idAlumno;
                })
            }
        }
      });
}

function actionDeleteAlumno(){
    $.ajax({
        method: "POST",
        url: "../../TODO/phppropios/crud-alumnosAdmin.php",
        data: {
            id: idEliminarAlumno,
            accion: "delete"
        },
        success: function(respuesta) {
            let miObjetoJSON = JSON.parse(respuesta);
            if(miObjetoJSON.estado==1){
                let tabla = $("#alumnos").DataTable();
                tabla.row("#renglon_"+idEliminarAlumno).remove().draw();
            }
        }
      });
}
function identificarEliminarAlumno(id){
    idEliminarAlumno = id;
    //alert(id);
}
function identificarActualizarAlumno(id){
    alert("HOLA");
    alert(id);
    //Realizar solicitud al servidor para que regrese los datos
    $.ajax({
        method: "POST",
        url: "../../TODO/phppropios/crud-alumnosAdmin.php",
        data: {
          id: idActualizarAlumno,
          accion: "read-id"
        },
        success: function(respuesta) {
            alert(respuesta);
            let miObjetoJSON = JSON.parse(respuesta);
            if(miObjetoJSON.estado==1){
                //Mostrar en la ventana de Actualizar los datos recuperados del servidor
                let nombreAlumnoActualizar   = document.getElementById('nombres-alumno-actualizar');
                nombreAlumnoActualizar.value = miObjetoJSON.Nombre;        
              }
        }
      });
}

////////////////////////////////////////////
// function actionReadAlumnosAgregar(){
//     $.ajax({
//         method: "POST",
//         url: "../../TODO/phppropios/crud-alumnosAdmin.php",
//         data: {
//             accion: "read-AlumnosAgregar"
//         },
//         success: function(respuesta) {
//             let miObjetoJSON = JSON.parse(respuesta);
//             //alert("hola");
//             if(miObjetoJSON.estado==1){
//                 let tabla = $("#alumnosAgregar").DataTable();
//                 miObjetoJSON.alumnosAgregar.forEach(Nombre => {
//                     let boton = '<button type="button" class="btn btn-primary btn-pill btn-sm onclick="identificarAlumnoAUnir('+Nombre.idAlumno+');" >Agregar</button>';
//                     // Nombre, ApPaterno, ApMaterno, CURP y botón
//                     tabla.row.add([Nombre.Nombre, Nombre.Ap_Paterno, Nombre.Ap_Materno, Nombre.CURP, boton]).draw().node().id="renglon_"+Nombre.idAlumno;
//                 })
//             }
//         }
//       });
// }
//////////////
// function identificarAlumnoAUnir(idAlumnoAUnir){
//     idAlumnoUnir = idAlumnoAUnir;
//     alert(idAlumnoAUnir);
// }
// function mandarIdUnionAlumno(){
//     $.ajax({        
//         url: "../../TODO/phppropios/unionTutorAlumnoAdmin.php",
//         type: "POST",
//         data: {
//             idAlumnoAUnir: idAlumnoUnir,
//             accion: "saveIdTutor"          
//         },
//         success: function(respuesta) {            
//             // do something
//             alert(idAlumnoUnir);
//         }
//       }); 
// }