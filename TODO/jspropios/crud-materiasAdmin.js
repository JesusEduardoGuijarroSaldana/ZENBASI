let idEliminar = 0;
let idActualizar = 0;
function actionCreate(){
    //alert("Hola");
    let nombreMateria = document.getElementById("nombreMateria").value;
    //alert(nombreMateria);
    let nivelAcademico = 0;
    // ¿qué nivel academico es?
    if($("#kinder").is(":checked")){
        nivelAcademico = 1;
    }else if($("#primaria").is(":checked")){
        nivelAcademico = 2;
    }else{
        nivelAcademico = 3; // secundaria
    }
    //alert(nivelAcademico);
    let gradoMateria = 0;
    if($("#1").is(":selected")){
        gradoMateria = 1;
    }else if($("#2").is(":selected")){
        gradoMateria = 2;
    }else if($("#3").is(":selected")){
    gradoMateria = 3;
    }else if($("#4").is(":selected")){
        gradoMateria = 4;
    }else if($("#5").is(":selected")){
        gradoMateria = 5;
    }else
        gradoMateria = 6;
    //let gradoMateria = document.getElementById("gradoMateria").value;
    //alert(gradoMateria);
    $.ajax({
        method: "POST",
        url: "../../TODO/phppropios/crud-materiasAdmin.php",
        data:{
           Nombre: nombreMateria,
           NivelAcademico: nivelAcademico,
           Grado: gradoMateria,
           accion: "create"
        },
        success: function(respuesta){
            let miObjetoJSON = JSON.parse(respuesta);
            if(miObjetoJSON.estado==1){
                //agregamos el registro a la tabla
                let tabla = $("#materias").DataTable();
                let botones = '<button type="button" class="btn btn-warning btn-sm mr-3" href="#" data-toggle="modal" data-target="#modalEditarMateria" onclick="identificarActualizar('+miObjetoJSON.id+');"><i class="mdi mdi-pencil mr-1">Editar</i> </button>';
                //<button type="button" class="btn btn-warning btn-sm mr-3" data-toggle="modal" data-target="#editarMateria"><i class=" mdi mdi-pencil mr-1"></i>Editar</button>
                botones += '<button type="button" class="btn btn-danger mr-3 btn-sm" href="#" data-toggle="modal" data-target="#modalEliminarMateria" onclick="identificarEliminar('+miObjetoJSON.id+');"><i class="mdi mdi-trash-can mr-1">Eliminar</i> </button>';
                //<button type="button" class="btn btn-danger mr-3 btn-sm" data-toggle="modal" data-target="#eliminarMateria"><i class=" mdi mdi-trash-can mr-1"></i>Eliminar</button>                        
                if(nivelAcademico == 1){
                    tabla.row.add([nombreMateria, "Kinder",gradoMateria, botones]).draw().node().id="renglon_"+miObjetoJSON.id;
                }else if(nivelAcademico == 2){
                    tabla.row.add([nombreMateria, "Primaria",gradoMateria, botones]).draw().node().id="renglon_"+miObjetoJSON.id;
                }else
                    tabla.row.add([nombreMateria, "Secundaria",gradoMateria, botones]).draw().node().id="renglon_"+miObjetoJSON.id;
                
                // mostrar mensaje con toastr
            }
                // mostrar mensaje con toastr en el else (q falta agregar)
        }
    })
}
function actionRead(){
    $.ajax({
        method: "POST",
        url: "../../TODO/phppropios/crud-materiasAdmin.php",
        data:{
            accion: "read"
        },
        success: function(respuesta){
            let miObjetoJSON = JSON.parse(respuesta);
            //alert("HOLA");
            if(miObjetoJSON.estado==1){
                ///mostrar en la tabla las materias
                let tabla = $("#materias").DataTable();
                miObjetoJSON.materias.forEach(Nombre => {
                    let botones = '<button type="button" class="btn btn-warning btn-sm mr-3" href="#" data-toggle="modal" data-target="#modalEditarMateria" onclick="identificarActualizar('+Nombre.idMateria+');"><i class="mdi mdi-pencil mr-1">Editar</i> </button>';
                    botones += '<button type="button" class="btn btn-danger mr-3 btn-sm" href="#" data-toggle="modal" data-target="#modalEliminarMateria" onclick="identificarEliminar('+Nombre.idMateria+');"><i class="mdi mdi-trash-can mr-1">Eliminar</i> </button>';
                    //alert(Nombre.idMateria);
                    if(Nombre.NivelAcademico == 1){
                        tabla.row.add([Nombre.Nombre, "Kinder",Nombre.Grado, botones]).draw().node().id="renglon_"+Nombre.idMateria;
                    }else if(Nombre.NivelAcademico == 2){
                        tabla.row.add([Nombre.Nombre, "Primaria", Nombre.Grado,botones]).draw().node().id="renglon_"+Nombre.idMateria;
                    }else
                        tabla.row.add([Nombre.Nombre, "Secundaria",Nombre.Grado, botones]).draw().node().id="renglon_"+Nombre.idMateria;                    
                });
            }
        }
    })
}
function actionDelete(){    
    $.ajax({
        method: "POST",
        url: "../../TODO/phppropios/crud-materiasAdmin.php",
        data: {
            id: idEliminar, // tiene que ser variable global
            accion: "delete"
        },
        success: function(respuesta){
            let miObjetoJSON = JSON.parse(respuesta);
            if(miObjetoJSON.estado==1){ //se compureba q se elimina del servidor
                let tabla = $("#materias").DataTable();
                tabla.row("#renglon_"+idEliminar).remove().draw();
                //toastr.success(miObjetoJSON.mensaje);
            }
            else{
                //toastr.error(miObjetoJSON.mensaje);
            }
        }
    })
}
function identificarEliminar(id){
    idEliminar = id;    
    alert(id);
}
// function actionUpdate(){
//     //alert("Hola");
//     let nombreMateriaActualizar = document.getElementById("nombreMateriaActualizar").value;
//     //alert(nombreMateria);
//     let nivelAcademicoActualizar = 0;
//     // ¿qué nivel academico es?
//     if($("#ed_kinder").is(":checked")){
//         nivelAcademicoActualizar = 1;
//     }else if($("#ed_primaria").is(":checked")){
//         nivelAcademicoActualizar = 2;
//     }else{
//         nivelAcademicoActualizar = 3;
//     }
//     let gradoMateriaActualizar = 0;
//     if($("#ed_1").is(":selected")){
//         gradoMateriaActualizar = 1;
//     }else if($("#ed_2").is(":selected")){
//         gradoMateriaActualizar = 2;
//     }else if($("#ed_3").is(":selected")){
//         gradoMateriaActualizar = 3;
//     }else if($("#ed_4").is(":selected")){
//         gradoMateriaActualizar = 4;
//     }else if($("#ed_5").is(":selected")){
//         gradoMateriaActualizar = 5;
//     }else
//         gradoMateriaActualizar = 6;
//     $.ajax({
//         method: "POST",
//         url: "../../TODO/phppropios/crud-materiasAdmin.php",
//         data: {
//             idMateria: idActualizar,
//             Nombre: nombreMateriaActualizar,
//             NivelAcademico: nivelAcademicoActualizar,
//             Grado: gradoMateriaActualizar,
//             accion: "update"
//         },
//         success: function(respuesta){
//             let miObjetoJSON = JSON.parse(respuesta);
//             if(miObjetoJSON.estado == 1){
//                 // debemos mostrar en la tabla los datos actualizados
//                 let tabla = $("#materias").DataTable();
//                 // Paso 1.
//                 let temp = tabla.row("#renglon_"+idActualizar).data();
//                 // Paso 2.
//                 temp[0] = nombreMateriaActualizar;
//                 if(nivelAcademicoActualizar == 1){
//                     temp[1] = 1;
//                 }else if(nivelAcademicoActualizar == 2){
//                     temp[2] = 2;
//                 }else
//                     temp[2] = 3;
//                 if(gradoMateriaActualizar == 1){
//                     temp[3] = 1;
//                 }else if(gradoMateriaActualizar == 2){
//                     temp[3] = 2;
//                 }else if(gradoMateriaActualizar == 3){
//                     temp[3] = 3;
//                 }else if(gradoMateriaActualizar == 4){
//                     temp[3] = 4;
//                 }else if(gradoMateriaActualizar == 5){
//                     temp[3] = 5;
//                 }else   
//                     temp[3] = 6;
//                 // Paso 3.
//                 tabla.row("renglon_"+idActualizar).data(temp).draw();
//                 // agregar mensaje al usuario de correcto
//             }// agregar mensaje al usuario de inconrrecto en else
//         }
//     })
// }
// function identificarActualizar(id){
//     alert(id);
//     idActualizar = id;
//     // Realiazar solicitud al servidor para que regrese los datos
//     $.ajax({
//         method: "POST",
//         url: "../../TODO/phppropios/crud-materiasAdmin.php",
//         data: {
//             id: idActualizar,
//             accion: "read-id"
//         },
//         success: function(respuesta){
//             let miObjetoJSON = JSON.parse(respuesta);
//             if(miObjetoJSON.estado == 1){
//             // Mostrar en la ventana de actualizar los datos recuperados del servidor
//                 let nombreMateriaActualizar = document.getElementById("nombreMateriaActualizar");
//                 nombreMateriaActualizar.value = miObjetoJSON.Nombre;
//                 if(miObjetoJSON.NivelAcademico==1){                
//                     $("#ed_kinder").prop("checked", true);
//                 }else if(miObjetoJSON.NivelAcademico==2){
//                     $("#ed_escuela").prop("checked", true);
//                 }else{
//                     $("#ed_secundaria").prop("checked", true);
//                 }
//                 if(miObjetoJSON.Grado == 1){
//                     $("#ed_1").prop("selected", true);
//                 }else if(miObjetoJSON.Grado == 2){
//                     $("#ed_2").prop("selected", true);
//                 }else if(miObjetoJSON.Grado == 3){
//                     $("#ed_3").prop("selected", true);
//                 }else if(miObjetoJSON.Grado == 4){
//                     $("#ed_4").prop("selected", true);
//                 }else if(miObjetoJSON.Grado == 5){
//                     $("#ed_5").prop("selected", true);
//                 }else
//                     $("#ed_6").prop("selected", true);
//             }
//         }

//     })
// }