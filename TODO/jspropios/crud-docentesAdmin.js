let idEliminar = 0;
function actionCreate(){
    let nombreDocente = document.getElementById("nombreDocente").value; //alert(nombreDocente);
    let apPaternoDocente = document.getElementById("apPaternoDocente").value; //alert(apPaternoDocente);
    let apMaternoDocente = document.getElementById("apMaternoDocente").value; //alert(apMaternoDocente);
    let fechaNacDocente = document.getElementById("fechaNacDocente").value; //alert(fechaNacDocente);
    let rfcDocente = document.getElementById("rfcDocente").value; //alert(rfcDocente);
    let cedulaDocente = document.getElementById("cedulaDocente").value; //alert(cedulaDocente);
    $.ajax({
        method: "POST",
        url: "../../TODO/phppropios/crud-docentesAdmin.php",
        data: {
            Nombre: nombreDocente,
            Ap_Paterno: apPaternoDocente,
            Ap_Materno: apMaternoDocente,
            fechaNac: fechaNacDocente,
            RFC: rfcDocente,
            CedulaProfesional: cedulaDocente,
            accion: "create"
        },
        success: function(respuesta) {
            let miObjetoJSON = JSON.parse(respuesta);
            if(miObjetoJSON.estado == 1){
                let tabla =$("#docentes").DataTable();
                let botones = '<button type="button" class="btn btn-warning btn-sm mr-3" data-toggle="modal" data-target="#modalEditarDocente"><i class=" mdi mdi-pencil mr-1"></i>Editar</button>';
                botones += '<button type="button" class="btn btn-danger mr-3 btn-sm" data-toggle="modal" data-target="#modalEliminarDocente" onclick="identificarEliminar('+miObjetoJSON.id+')"><i class=" mdi mdi-trash-can mr-1"></i>Eliminar</button>';
                botones += '<button type="button" class="btn btn-primary mr-3 btn-sm" data-toggle="modal" data-target="#asignarMateria"><i class=" mdi mdi-account-multiple-plus mr-1"></i>Asignar Grupo</button>';
                tabla.row.add([nombreDocente, apPaternoDocente, apMaternoDocente, fechaNacDocente, rfcDocente, cedulaDocente, botones]).draw().node().id="renglon_"+miObjetoJSON.id;
            }            
        }
      });
}
function actionRead(){
    //alert("HOLAA");
    $.ajax({
        method: "POST",
        url: "../../TODO/phppropios/crud-docentesAdmin.php",
        data:{
            accion: "read"
        },
        success: function(respuesta){
            let miObjetoJSON = JSON.parse(respuesta);
            //alert("HOLA");
            if(miObjetoJSON.estado==1){
                ///mostrar en la tabla las materias
                let tabla = $("#docentes").DataTable();
                miObjetoJSON.docentes.forEach(Nombre => {
                    let botones = '<button type="button" class="btn btn-warning btn-sm mr-3" data-toggle="modal" data-target="#modalEditarDocente" onclick="identificarActualizar('+Nombre.idDocente+');"><i class=" mdi mdi-pencil mr-1"></i>Editar</button>';
                    botones += '<button type="button" class="btn btn-danger mr-3 btn-sm" data-toggle="modal" data-target="#modalEliminarDocente" onclick="identificarEliminar('+Nombre.idDocente+');"><i class=" mdi mdi-trash-can mr-1"></i>Eliminar</button>';
                    botones += '<button type="button" class="btn btn-primary mr-3 btn-sm" data-toggle="modal" data-target="#asignarMateria"><i class=" mdi mdi-account-multiple-plus mr-1"></i>Asignar Grupo</button>';
                    tabla.row.add([Nombre.Nombre, Nombre.Ap_Paterno, Nombre.Ap_Materno, Nombre.fechaNac, Nombre.RFC, Nombre.CedulaProfesional, botones]).draw().node().id="renglon_"+Nombre.idDocente;                    
                });
            }
        }
    })
}
function actionDelete(){
    $.ajax({
        method: "POST",
        url: "../../TODO/phppropios/crud-docentesAdmin.php",
        data: {
            id: idEliminar, // tiene que ser variable global
            accion: "delete"
        },
        success: function(respuesta) {
            let miObjetoJSON = JSON.parse(respuesta);
            if(miObjetoJSON.estado==1){ // //se comprueba q se elimina del servidor
                let tabla = $("#docentes").DataTable();
                tabla.row("#renglon_"+idEliminar).remove().draw();
            }
        }
      });
}
function identificarEliminar(id){
    idEliminar = id;
    alert(id);
}