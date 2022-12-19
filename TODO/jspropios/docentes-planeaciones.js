function nuevaPlaneacion(){
    let materia = document.getElementById("selectMateria").value;
    var grupoMateria = document.getElementById("selectMateria");
    var selected = grupoMateria.options[grupoMateria.selectedIndex].text;
    //alert(selected);
    alert(materia);


    $.ajax({
        url: '../phppropios/docentes-planeaciones.php',
        type: 'POST',
        data: {
            id: identrega,
            revisores: revisor,
            accion: "nuevaplan",
        },            

        success: function(respuesta) {

            alert(respuesta);

           let miObjetoJSON = JSON.parse(respuesta);

            if(miObjetoJSON.estado==1){
                
                //agregamos el registro a la tabla
                let tabla = $("#revisores2").DataTable();

                let botones = '<button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target=".modal-eliminarrevisor"><span class="glyphicon glyphicon-trash" aria-hidden="true" ></span> Eliminar</button>';

                tabla.row.add([selected, botones]).draw().node().id="renglon_"+miObjetoJSON.id;
                 

                
                //mostramos mensaje al usuario
                toastr.success(miObjetoJSON.mensaje);
            }
            else{
                //alert(respuesta);
                //mandamos un error al usuario
                toastr.error(miObjetoJSON.mensaje);
            }
        }
    });
};


function readGruposDocente(){

    $.ajax({
        method: "POST",
        url: '../phppropios/docentes-planeaciones.php',
        //dataType: "json",
        
        data: {accion: 'readMateriasDocente'},

        success: function(respuesta){

            let miObjetoJSON = JSON.parse(respuesta);

            alert(miObjetoJSON.materias);

            miObjetoJSON.materias.forEach(materia => {
                $("#selectMateria").append('<option value='+materia.id+'>'+materia.nombre+'</option>');
                
            });
       
        },
        
      });
}

