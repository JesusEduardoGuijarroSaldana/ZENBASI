let idEliminar = 0;
function actionCreate(){
    let nivelAcademicoGrupo = "";
    if($("#kinder").is(":checked")){
        nivelAcademicoGrupo = "Kinder";
    }else if($("#primaria").is(":checked")){
        nivelAcademicoGrupo = "Primaria";
    }else{
        nivelAcademicoGrupo = "Secundaria"; // secundaria
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
            botones += '<button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#agregarMateria"><i class=" mdi mdi-book-plus mr-1"></i>Anadir materia</button>';
            tabla.row.add([nivelAcademicoGrupo, gradoGrupo, grupoLetra, botones]).draw().node().id="renglon_"+miObjetoJSON.id;
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
        success: function(respuesta) {
            let miObjetoJSON = JSON.parse(respuesta);
            if(miObjetoJSON.estado == 1){
                let tabla = $("#grupos").DataTable();
                miObjetoJSON.grupos.forEach(NivelEscolar => {
                    let botones = '<button type="button" class="btn btn-warning btn-sm mr-3" data-toggle="modal" data-target="#editarGrupo"><i class=" mdi mdi-pencil mr-1"></i>Editar</button>';
                    botones += '<button type="button" class="btn btn-danger mr-3 btn-sm" data-toggle="modal" data-target="#modalEliminarGrupo" onclick="identificarEliminar('+NivelEscolar.idGrupo+');"><i class=" mdi mdi-trash-can mr-1"></i>Eliminar</button>';
                    botones += '<button type="button" class="btn btn-primary btn-sm mr-3" data-toggle="modal" data-target="#agregarAlumno"><i class="mdi mdi-account-plus mr-1"></i>Anadir Alumno</button>';
                    botones += '<button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#agregarMateria"><i class=" mdi mdi-book-plus mr-1"></i>Anadir materia</button>';
                    tabla.row.add([NivelEscolar.NivelEscolar, NivelEscolar.Grado, NivelEscolar.GrupoLetra, botones]).draw().node().id="renglon_"+NivelEscolar.idGrupo;
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