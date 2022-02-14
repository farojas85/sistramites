$(document).ready(function() {
    var opcion,depid,estado;
    depid = $.trim($('#depid').val());
    estado = 'T';
      ////////////////////DOCUMENTOS RECIBIDOS/////////////////////////////////////////
      function listar_filtro(){
        opcion =10;
        $('#tablefiltro').DataTable().clear().destroy();
        $.ajax({
             url: "/codigos-listar",
             type: "GET",
             datatype:"json",
             data:  {opcion:opcion,depid:depid},
             success: function(data) {
               //RECORRER OBJETO JS
               console.log(data)
               let ObjetoJSS1 = JSON.parse(data);
               for (let itemm of ObjetoJSS1){ var listar = itemm.data; }
               if (listar==0) {
              var   tablefiltro = $('#tablefiltro').DataTable({
                   "autoWidth" : false,
                   "columns":[null,null,null,null,null,null,null,null,null]
                   });
               } else {
                 opcion =11;
                  estado='T'
               var  tablefiltro = $('#tablefiltro').DataTable({
                       "ajax":{
                           "url":  "/tramites-por-departamento/"+depid+"/"+estado,
                           "method": 'GET', //usamos el metodo POST
                           "data": { opcion: opcion, depid: depid, estado: estado },
                           "dataSrc":""
                       },
                      "autoWidth"   : true,
                      "order": [[ 0, "desc" ]],
                       "columns":[
                   {"data": "tr_id"},
                       {"data": "tr_numexp"},
                        {"data": "tr_remintente"},
                       {"data": "tr_fecdoc"},
                       {"data": "tr_asunto"},
                       {"data": "dep_nombre"}, 
                       {"data" : "tr_estatusr"},  
                       {"data" : "tr_archivo",  
             "render" : function ( data, type, row, meta ){
                             if ( row.tr_archivo ==='NINGUNO') {
                              return "<a>NO POSEE</a>  ";
                        } else if ( row.mov_archivo !=='NINGUNO') {           return "<a href=\Documentos/Recepcion/" + data + "\  target=\"_blank\"  >VER</a>  ";}
             } },
                         {"defaultContent": "<button class='btn btn-warning btn-sm mdi mdi-format-list-bulleted font-size-11 btnDetallex' data-toggle='tooltip' 'data-placement='left' title='CONSULTAR Y EDITAR EXPEDIENTE'></button> <button class='btn btn-success btn-sm ri-printer-fill font-size-11 btnImprime' data-toggle='tooltip' 'data-placement='left' title='IMPRIMIR EXPEDIENTE'></button> <button class='btn btn-danger btn-sm mdi mdi-text-box-remove-outline font-size-11 btnElimini' data-toggle='tooltip' 'data-placement='left' title='ELIMINAR EXPEDIENTE'></button>"}
                       ]
                  ,
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
            tablefiltro.on( 'order.dt search.dt', function () {
                 tablefiltro.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                 cell.innerHTML = '<span style="display: block;margin: auto;text-align: center;" data-id="'+$(cell.innerHTML).attr("data-id")+'" >'+(i+1)+'</span>';
                  });
                 }).draw();
             }
           }
         });
        }
        //////LISTAR ONCLICK
         $(function(){ //ready function
            $('#Ebusca').click(function(){ //click event
             listar_filtro();
             //alert('se ejecuto');
           });
         });
                ////DETALLAR
         $(document).on("click", ".btnDetallex", function(){
             //opcion = 2;//filtar
             fila = $(this).closest("tr");
           //  idst = fila.find('td:eq(0)').text(); //capturo el ID
              idst = fila.find('td:eq(0)').find('span').attr("data-id");
             $("#principal").hide();
             $('#opciones').load('views/Procesos/E_documen.php',{ "idst": idst});
         });
  
         ////DETALLAR
         $(document).on("click", ".btnDetalle", function(){
             //opcion = 2;//filtar
             fila = $(this).closest("tr");
           //  idst = fila.find('td:eq(0)').text(); //capturo el ID
              idst = fila.find('td:eq(0)').find('span').attr("data-id");
             $("#principal").hide();
             $('#opciones').load('views/Procesos/V_Detalles.php',{ "idst": idst});
         });
         
          $(document).on("click", ".btnElimini", function(){
         fila = $(this).closest("tr");
         tr_id = fila.find('td:eq(0)').find('span').attr("data-id");
       //  tr_id= fila.find('td:eq(0)').text(); //capturo el ID
         $("#tr_id").val(tr_id);
         //DESPLEGAR EL MODAL CON LOS DATOS
         $('#M_Elimini').modal('show');
     }); 
  /// eliminar archivo
  
  
     /////////////////////////////////////////////////////////////////////////////
     ///
     $('#formElimini').submit(function(e){
     opcion =333;
     tr_id= $.trim($('#tr_id').val());
     e.preventDefault();
     $.ajax({
             url: "functions/Procesos/Procesos.php",
            type: "POST",
            datatype:"json",
            data:  {opcion:opcion,tr_id:tr_id},
            success: function(data) {
              listar_filtro();
             // toastr.success('Se han procesado los datos correctamente','EXITO');
            }
          });
        //CERRAR MODAL
        
        $('#M_Elimini').modal('hide');
    });  
});  