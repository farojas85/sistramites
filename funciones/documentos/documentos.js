$(document).ready(function() {
    var opcion;
    function listar(){
      opcion =9;
      $('#tabledoc').DataTable().clear().destroy();
      $.ajax({
           url: "/tipo-documentos-listar",
           type: "GET",
           datatype:"json",
           data:  {opcion:opcion},
           success: function(data) {
             //RECORRER OBJETO JS
             let ObjetoJSS = JSON.parse(data);
             for (let itemm of ObjetoJSS){ var listar = itemm.data; }
             if (listar==0) {
             var  tabledoc = $('#tabledoc').DataTable({
                 "autoWidth" : false,
                 "columns":[null,null,null,null]
                 });
             } else {
               opcion =0;
              var tabledoc = $('#tabledoc').DataTable({
                     "ajax":{
                         "url": "/tipo-documentos-listar",
                         "method": 'GET', //usamos el metodo POST
                         "data":{opcion:opcion},
                         "dataSrc":""
                     },
                    "autoWidth"   : false,
                     "columns":[
                       {"data": "tdoc_id"},
                       {"data": "tdoc_nombre"},
                       {"data": "tdoc_abrevia"},
                       {"defaultContent": "<button class='btn btn-warning btn-sm ri-edit-line  font-size-14 btnEdit' data-toggle='tooltip' data-placement='left' title='EDITAR TIPO DE DOCUMENTO'></button> <button class='btn btn-danger btn-sm mdi mdi-text-box-remove-outline font-size-14 btnElim' data-toggle='tooltip' data-placement='left' title='ELIMINAR TIPO DE DOCUMENTO'></button>"}
                     ] ,
                     "columnDefs": [
                     {
                      "targets": 0,
                      "render": function (data, type, row, meta) {
                        //console.log(row.usu_id)
                        return '<span style="display: block;margin: auto;text-align: center;" data-id="'+row.tdoc_id+'" >'+row.tdoc_id+'</span>';
                        }
                      }
                   ]
                 });
            tabledoc.on( 'order.dt search.dt', function () {
                 tabledoc.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                 cell.innerHTML = '<span style="display: block;margin: auto;text-align: center;" data-id="'+$(cell.innerHTML).attr("data-id")+'" >'+(i+1)+'</span>';
                  });
                 }).draw();
             }
           }
         });
      }
      listar();
      ////////////////////////////////////////////////////////////////////////////
      ///NUEVO
      $("#btnNuevo").click(function(){
        $("#formCrear").trigger("reset");
        $('#M_Crear').modal('show');
      });
      //Autofocus Modal
      $(".modal").on('shown.bs.modal', function(){
          $(this).find('#docnombre').focus();
      });
  
      ///ENVIO DE DATOS
      $('#formCrear').submit(function(e){
          opcion =1;
          docnombre= $.trim($('#docnombre').val());
          docabrevia= $.trim($('#docabrevia').val());
          e.preventDefault();
          $.ajax({
            url: "/tipo-documentos-guardar",
            type: "POST",
            datatype:"json",
            data:  {opcion:opcion,docnombre:docnombre,docabrevia:docabrevia},
            success: function(data)
            {
             listar();
         //    toastr.success('Se han procesado los datos correctamente','EXITO');
           }
         });
         //CERRAR MODAL
         $('#M_Crear').modal('hide');
     });
  
     /////////////////////////////////////////////////////////////////////////////
    //  ///EDITAR
    //  $(document).on("click", ".btnEdit", function(){
    //      fila = $(this).closest("tr");
    //       iddoc= fila.find('td:eq(0)').find('span').attr("data-id");
    //     // iddoc = fila.find('td:eq(0)').text(); //capturo el ID
    //      docnom = fila.find('td:eq(1)').text();
    //      docabre = fila.find('td:eq(2)').text();
    //      $("#iddoc").val(iddoc);
    //      $("#docnom").val(docnom);
    //      $("#docabre").val(docabre);
    //      //DESPLEGAR EL MODAL CON LOS DATOS
    //      $('#M_Editar').modal('show');
    //  });
  
    //  $('#formEdoc').submit(function(e){
    //  opcion =2;
    //  docnom = $.trim($('#docnom').val());
    //  docabre =  $.trim($('#docabre').val());
    //  iddoc =  $.trim($('#iddoc').val());
    //  e.preventDefault();
    //  $.ajax({
    //         url: "functions/Documentos/Documentos.php",
    //         type: "POST",
    //         datatype:"json",
    //         data:  {opcion:opcion,docnom:docnom,docabre:docabre,iddoc:iddoc},
    //         success: function(data) {
    //           listar();
    //       //    toastr.success('Se han procesado los datos correctamente','EXITO');
    //         }
    //       });
    //   //CERRAR MODAL
    //   $('#M_Editar').modal('hide');
    //  });
    //  /////////////////////////////////////////////////////////////////////////////
    //  ///ELIMINAR
    // $( document).on("click", ".btnElim", function(){
    //      fila = $(this).closest("tr");
    //      eiddoc= fila.find('td:eq(0)').find('span').attr("data-id");
    //      //eiddoc = fila.find('td:eq(0)').text(); //capturo el ID
    //      $("#eiddoc").val(eiddoc);
    //      //DESPLEGAR EL MODAL CON LOS DATOS
    //      $('#M_Eliminar').modal('show');
    // });
    //  /////////////////////////////////////////////////////////////////////////////
    //  ///
    //  $('#formElimina').submit(function(e){
    //     opcion =3;
    //     eiddoc = $.trim($('#eiddoc').val());
    //     e.preventDefault();
    //     $.ajax({
    //             url: "functions/Documentos/Documentos.php",
    //             type: "POST",
    //             datatype:"json",
    //             data:  {opcion:opcion,eiddoc:eiddoc},
    //             success: function(data) {
    //             listar();
    //         //   toastr.success('Se han procesado los datos correctamente','EXITO');
    //             }
    //         });
    //     //CERRAR MODAL
    //     $('#M_Eliminar').modal('hide');
    // });
  
  
  
  
});
  