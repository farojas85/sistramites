$(document).ready(function() {
    var opcion,depid,estado;
    depid = $.trim($('#depid').val());
      ////////////////////DOCUMENTOS RECIBIDOS/////////////////////////////////////////
      function listar_recibidos(){
        opcion =0;
        estado ='RECIBIDO';
        $('#tablerecibidos').DataTable().clear().destroy();
        $.ajax({
             url: "/tramites-por-departamento/"+depid+"/"+estado,
             type: "GET",
             datatype:"json",
             data:  {opcion:opcion,estado:estado,depid:depid},
             success: function(data) {
               //RECORRER OBJETO JS
               let ObjetoJSS1 = JSON.parse(data);
               for (let itemm of ObjetoJSS1){ var listar = itemm.data; }
               if (listar==0) {
               var  tablerecibidos = $('#tablerecibidos').DataTable({
                   "autoWidth" : false,
                   "columns":[null,null,null,null,null,null,null,null]
                   });
               } else {
                 opcion =1;
                var tablerecibidos = $('#tablerecibidos').DataTable({
                       "ajax":{
                           "url": "/tramites-por-departamento/"+depid+"/"+estado,
                           "method": 'GET', //usamos el metodo POST
                           "data":{opcion:opcion,estado:estado,depid:depid},
                           "dataSrc":""
                       },
                      "autoWidth"   : false,
                      "order": [[ 0, "desc" ]],
                       "columns":[
                         {"data": "tr_id"},
                         {"data": "tr_fecdoc"},
                         {"data": "tdoc_nombre"},
                         {"data": "tr_numdoc"},
                         {"data": "tr_asunto"},
                         {"data": "tr_remintente"},
                         {"data": "dep_nombre"},
                         {"defaultContent": "<button class='btn btn-warning btn-sm mdi mdi-format-list-bulleted font-size-12 btnVer' data-placement='left' title='DETALLAR EXPEDIENTE'></button> <button class='btn btn-info btn-sm mdi mdi-text-box-remove-outline font-size-12 btnDerviar2' data-placement='left' title='DERIVAR EXPEDIENTE'></button> <button class='btn btn-success btn-sm mdi mdi-text-box-remove-outline font-size-12 btnArchivar' data-placement='left' title='ARCHIVAR EXPEDIENTE'></button>"}
                       ],
                     "columnDefs": [
                     {
                      "targets": 0,
                      "render": function (data, type, row, meta) {
                        //console.log(row.usu_id)
                        return '<span style="display: block;margin: auto;text-align: center;" data-id="'+row.tr_id+'" >'+row.tr_id+'</span>';
                        }
                      }
                   ]
                 });
            tablerecibidos.on( 'order.dt search.dt', function () {
                 tablerecibidos.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                 cell.innerHTML = '<span style="display: block;margin: auto;text-align: center;" data-id="'+$(cell.innerHTML).attr("data-id")+'" >'+(i+1)+'</span>';
                  });
                 }).draw();
             }
           }
         });
        }
      $('.select2').select2();
      //////LISTAR ONCLICK
       $(function(){ //ready function
          $('#Erecibe').click(function(){ //click event
           listar_recibidos();
         });
       });
  
      $("#btnNuevo").click(function(){
        $("#formCrear").trigger("reset");
        $('#M_Crear').modal('show');
      });
      //Autofocus Modal
      $(".modal").on('shown.bs.modal', function(){
          $(this).find('#docnombre').focus();
      });
      
  
  ////////////////////////////////////////////////////////////////////////////////
  ///////
    $(document).on("click", ".btnArchivar", function(){
        $("#formArchiva").trigger("reset");
        $('#selarch').val(null).trigger('change');
        fila = $(this).closest("tr");
      //  idarchi = fila.find('td:eq(0)').text(); //capturo el ID
         idarchi = fila.find('td:eq(0)').find('span').attr("data-id");
         fecharchi = fila.find('td:eq(3)').text();
        $("#idarchi").val(idarchi);
        $("#fecharchi").val(fecharchi);
        //DESPLEGAR EL MODAL CON LOS DATOS
        //revisarE(idarchi,'ARCHI');
        $('#M_Archivar').modal('show');
      });
  
  
      $('#formArchiva').submit(function(e){
      opcion =4;
      selarch = $.trim($('#selarch').val());
      idarchi =  $.trim($('#idarchi').val());
      selmotivo =  $.trim($('#selmotivo').val());
      e.preventDefault();
      $.ajax({
             url: "functions/Procesos/Procesos.php",
             type: "POST",
             datatype:"json",
             data:  {opcion:opcion,selarch:selarch,idarchi:idarchi,selmotivo:selmotivo,depid:depid},
             success: function(data) {
               listar_recibidos();
               toastr.success('Se han procesado los datos correctamente','EXITO');
             }
           });
       //CERRAR MODAL
       $('#M_Archivar').modal('hide');
      });
  
      /////////
      $(document).on("click", ".btnDerviar2", function(){
          $("#formreDeriva").trigger("reset");
          $('#rseldepa').val(null).trigger('change');
          $('#rselrec').val(null).trigger('change');
          fila = $(this).closest("tr");
         // reidderi = fila.find('td:eq(0)').text(); //capturo el ID
         reidderi = fila.find('td:eq(0)').find('span').attr("data-id");
          codigo = fila.find('td:eq(2)').text(); //capturo el CODIGO
          $("#reidderi").val(reidderi);
          //DESPLEGAR EL MODAL CON LOS DATOS
          $('#M_ReDerivar').modal('show');
        });
  
      ////////////////////////////////////////////////////////////////////////////
      ///ENVIAR
      $('#formreDeriva').submit(function(e){
      opcion =5;
      reidderi = $.trim($('#reidderi').val());
      rseldepa = $.trim($('#rseldepa').val());
      rselrec = $.trim($('#rselrec').val());
      rmproveido = $.trim($('#rmproveido').val());
      e.preventDefault();
      $.ajax({
             url: "functions/Procesos/Procesos.php",
             type: "POST",
             datatype:"json",
             data:  {opcion:opcion,reidderi:reidderi,depid:depid,rseldepa:rseldepa,rselrec:rselrec,rmproveido:rmproveido},
             success: function(data) {
               listar_recibidos();
               toastr.success('Se han procesado los datos correctamente','EXITO');
             }
           });
       //CERRAR MODAL
       $('#M_ReDerivar').modal('hide');
      });
  
  
  
  
  
  
  });
  