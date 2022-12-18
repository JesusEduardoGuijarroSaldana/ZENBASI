let idEliminar = 0;
let idUnirGrupo = 0;
function actionCreate(){
    let nivelAcademicoGrupo = 0;
    if($("#kinder").is(":checked")){
        nivelAcademicoGrupo = 1;
    }else if($("#primaria").is(":checked")){
        nivelAcademicoGrupo = 2;
    }else{
        nivelAcademicoGrupo = 3; // secundaria
    }
    //alert(nivelAcademicoGrupo);
    let gradoGrupo = 0;
    if($("#1").is(":selected")){
        gradoGrupo = 1;
    }else if($("#2").is(":selected")){
        gradoGrupo = 2;
    }else if($("#3").is(":selected")){
        gradoGrupo = 3;
    }else if($("#4").is(":selected")){
        gradoGrupo = 4;
    }else if($("#5").is(":selected")){
        gradoGrupo = 5;
    }else
        gradoGrupo = 6;
    //alert(gradoGrupo);
    let grupoLetra = "";
    if($("#1").is(":selected")){
        grupoLetra = "A";
    }else if($("#2").is(":selected")){
        grupoLetra = "B";
    }else if($("#3").is(":selected")){
        grupoLetra = "C";
    }else if($("#4").is(":selected")){
        grupoLetra = "D";
    }else if($("#5").is(":selected")){
        grupoLetra = "E";
    }else
        grupoLetra = "F";
    //alert(grupoLetra);
    $.ajax({
        method: "POST",
        url: "../../TODO/phppropios/crud-gruposAdmin.php",
        data: {
            NivelEscolar: nivelAcademicoGrupo,
            Grado: gradoGrupo,
            GrupoLetra: grupoLetra,
            accion: "create"
        },
        success: function(respuesta) {
            let miObjetoJSON = JSON.parse(respuesta);
            let tabla = $("#grupos").DataTable();
            let botones = '<button type="button" class="btn btn-warning btn-sm mr-3" data-toggle="modal" data-target="#editarGrupo"><i class=" mdi mdi-pencil mr-1"></i>Editar</button>';
            botones += '<button type="button" class="btn btn-danger mr-3 btn-sm" data-toggle="modal" data-target="#modalEliminarGrupo" onclick="identificarEliminar('+miObjetoJSON.id+');><i class=" mdi mdi-trash-can mr-1"></i>Eliminar</button>';
            botones += '<button type="button" class="btn btn-primary btn-sm mr-3" data-toggle="modal" data-target="#agregarAlumno"><i class="mdi mdi-account-plus mr-1"></i>Añadir Alumno</button>';
            botones += '<button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#agregarMateria" onclick="selectMaterias(); identificarGrupo('+miObjetoJSON.id+'); actionReadUnionGrupoMateria();"><i class=" mdi mdi-book-plus mr-1"></i>Anadir materia</button>';
            //identificarNivelEscolar('+miObjetoJSON.nivelAcademicoGrupo+');
            if(nivelAcademicoGrupo == 1){
                tabla.row.add(["Kinder", gradoGrupo, grupoLetra, botones]).draw().node().id="renglon_"+miObjetoJSON.id;
            }else if(nivelAcademicoGrupo == 2){
                tabla.row.add(["Primaria", gradoGrupo, grupoLetra, botones]).draw().node().id="renglon_"+miObjetoJSON.id;
            }else if(nivelAcademicoGrupo == 3){
                tabla.row.add(["Secundaria", gradoGrupo, grupoLetra, botones]).draw().node().id="renglon_"+miObjetoJSON.id;
            }                
        }
      });    
}
function actionRead(){
    $.ajax({
        method: "POST",
        url: "../../TODO/phppropios/crud-gruposAdmin.php",
        data: {
            accion: "read"
        },
        success: function(respuesta){
            let miObjetoJSON = JSON.parse(respuesta);
            if(miObjetoJSON.estado == 1){
                let tabla = $("#grupos").DataTable();
                miObjetoJSON.grupos.forEach(NivelEscolar => {
                    let botones = '<button type="button" class="btn btn-warning btn-sm mr-3" data-toggle="modal" data-target="#editarGrupo"><i class=" mdi mdi-pencil mr-1"></i>Editar</button>';
                    botones += '<button type="button" class="btn btn-danger mr-3 btn-sm" data-toggle="modal" data-target="#modalEliminarGrupo" onclick="identificarEliminar('+NivelEscolar.idGrupo+');"><i class=" mdi mdi-trash-can mr-1"></i>Eliminar</button>';
                    botones += '<button type="button" class="btn btn-primary btn-sm mr-3" data-toggle="modal" data-target="#agregarAlumno"><i class="mdi mdi-account-plus mr-1"></i>Anadir Alumno</button>';
                    botones += '<button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#agregarMateria" onclick="selectMaterias(); identificarGrupo('+NivelEscolar.idGrupo+'); actionReadUnionGrupoMateria();"><i class=" mdi mdi-book-plus mr-1"></i>Anadir materia</button>';
                    //identificarNivelEscolar('+NivelEscolar.NivelEscolar+');
                    if(NivelEscolar.NivelEscolar == 1){
                        tabla.row.add(["Kinder", NivelEscolar.Grado, NivelEscolar.GrupoLetra, botones]).draw().node().id="renglon_"+NivelEscolar.idGrupo;
                    }else if(NivelEscolar.NivelEscolar == 2){
                        tabla.row.add(["Primaria", NivelEscolar.Grado, NivelEscolar.GrupoLetra, botones]).draw().node().id="renglon_"+NivelEscolar.idGrupo;
                    }else if(NivelEscolar.NivelEscolar == 3){
                        tabla.row.add(["Secundaria", NivelEscolar.Grado, NivelEscolar.GrupoLetra, botones]).draw().node().id="renglon_"+NivelEscolar.idGrupo;
                    }                        
                });
            }
        }
      });
}
function actionDelete(){
    $.ajax({
        method: "POST",
        url: "../../TODO/phppropios/crud-gruposAdmin.php",
        data: {
            id: idEliminar,
            accion: "delete"
        },
        success: function(respuesta) {
            let miObjetoJSON = JSON.parse(respuesta);
            if(miObjetoJSON.estado==1){
                let tabla = $("#grupos").DataTable();
                tabla.row("#renglon_"+idEliminar).remove().draw();
            }
        }
      });
}
function identificarEliminar(id){
    idEliminar = id;
    //alert(id);
}
///////////////////////////////
function selectMaterias(){
    $.ajax({
        method: "POST",
        url: "../../TODO/phppropios/crud-gruposAdmin.php",
        data: {
            //nivelEscolar: 'gNivelEscolar',
            accion: "readMaterias"
        },
        success: function(respuesta){
            //$('.something').html(respuesta);
            let miObjetoJSON = JSON.parse(respuesta);                        
            miObjetoJSON.materias.forEach(materia => {
                $("#selectMaterias").append('<option value='+materia.id_materia+'>'+materia.Nombre+" - Nivel Academico: "+materia.NivelAcademico+" - Grado: "+materia.Grado+'</option>');                
            });                        
        }
      });
}
function asignarUnion(){
    let materia = document.getElementById("selectMaterias").value;
    alert(materia);
    $.ajax({
        url: "../../TODO/phppropios/crud-gruposAdmin.php",
        method: "POST",
        data: {
            id_grupo: idUnirGrupo,
            id_materia: materia,
            accion: "unir",
        },
        success: function(respuesta) {
            let miObjetoJSON = JSON.parse(respuesta);
            // if(miObjetoJSON.estado == 1){
            //     let tabla = $("#materiasAgregadas").DataTable();
            //     miObjetoJSON.materiasAgregadas.forEach(GrupoMateria =>{
            //         let boton = '<button type="button" class="btn btn-danger mr-3 btn-sm" data-toggle="modal" data-target=""><i class=" mdi mdi-trash-can mr-1"></i>Eliminar</button>';
            //         tabla.row.add[(GrupoMateria.id_grupo, GrupoMateria.id_materia, boton)].draw().node().id_grupo="renglon_"+GrupoMateria.idUnion;
            //     });                                
            //}            
        }
      });
}
function identificarGrupo(id){
    idUnirGrupo = id;
    alert(idUnirGrupo);
}
function actionReadUnionGrupoMateria(){
    // $.ajax({
    //     method: "POST",
    //     url: "../../TODO/phppropios/crud-gruposAdmin.php",
    //     data: {
    //         accion: "readUnionGrupoMateria"
    //     },
    //     success: function(respuesta) {       
    //         let miObjetoJSON = JSON.parse(respuesta);            
    //         if(miObjetoJSON.estado==1){            
    //             let tabla = $("#materiasAgregadas").DataTable();
    //             miObjetoJSON.grupos.forEach(grupo => {
    //                 let boton = '<button type="button" class="btn btn-warning btn-sm mr-3" data-toggle="modal" data-target="#modalEditarTutor"><i class=" mdi mdi-pencil mr-1"></i>Eliminar</button>';                                        
    //                 tabla.row.add([grupo.grupo, grupo.materia, boton]).draw().node().id="renglon_"+grupo.idUnion;                    
    //             });
    //         }         
    //     }
    //   });
      $.ajax({
        method: "POST",
        url: "../../TODO/phppropios/crud-gruposAdmin.php",
        data: {
          accion: "readUnionGrupoMateria"
        },
        success: function( respuesta ) {            
          let miObjetoJSON = JSON.parse(respuesta);
            if(miObjetoJSON.estado==1){
                let tabla = $("#materiasAgregadas").DataTable();
                miObjetoJSON.unionGrupoMateria.forEach( GrupoMateria => {
                    let botones = '<button type="button" class="btn btn-danger mr-3 btn-sm" data-toggle="modal"><i class=" mdi mdi-trash-can mr-1"></i>Eliminar</button>';
                    tabla.row.add([GrupoMateria.grupo, GrupoMateria.materia, botones]).draw().node().id="renglon_"+GrupoMateria.idUnion;
                })
            }
        }
      });  
}
