$(document).ready(function() {
    var opcion,depid,estado;
    depid = $.trim($('#depid').val());
      ////////////////////DOCUMENTOS RECIBIDOS/////////////////////////////////////////
      function listar_derivado(){
        opcion =0;
        estado ='DERIVADO';
        $('#tablederivados').DataTable().clear().destroy();
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
                var tablederivados = $('#tablederivados').DataTable({
                   "autoWidth" : false,
                   "columns":[null,null,null,null,null,null,null,null]
                   });
               } else {
                 opcion =1;
                var tablederivados = $('#tablederivados').DataTable({
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
                       {"data": "tr_numexp"},
                        {"data": "tr_remintente"},
                       {"data": "tr_fecdoc"},
                       {"data": "tr_asunto"},
                       {"data": "dep_nombre"},
                       {"data" : "tr_archivo",  
             "render" : function ( data, type, row, meta ){
                             if ( row.tr_archivo ==='NINGUNO') {
                              return "<a>NO POSEE</a>  ";
                        } else if ( row.mov_archivo !=='NINGUNO') {           return "<a href=\Documentos/Recepcion/" + data + "\  target=\"_blank\"  >VER</a>  ";}
             } },
                         {"defaultContent": "<button class='btn btn-warning btn-sm mdi mdi-format-list-bulleted font-size-14 btnDetalle' data-placement='left' title='DETALLAR EXPEDIENTE'></button> <button class='btn btn-info btn-sm mdi mdi-text-box-remove-outline font-size-12 btnEderiva' data-placement='left' title='DERIVAR EXPEDIENTE'></button> <button class='btn btn-danger btn-sm mdi mdi-text-box-remove-outline font-size-12 btnEliminaD' data-placement='left' title='ELIMINAR DERIVACION DEL EXPEDIENTE'></button>"}
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
                 tablederivados.on( 'order.dt search.dt', function () {
                 tablederivados.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                 cell.innerHTML = '<span style="display: block;margin: auto;text-align: center;" data-id="'+$(cell.innerHTML).attr("data-id")+'" >'+(i+1)+'</span>';
                  });
                 }).draw();
             }
           }
         });
        }
        //////LISTAR ONCLICK
         $(function(){ //ready function
            $('#Ederiva').click(function(){ //click event
             listar_derivado();
             //alert('se ejecuto');
           });
         });
      ////////////////
     $(document).on("click", ".btnEliminaD", function(){
         fila = $(this).closest("tr");
         eiddoc = fila.find('td:eq(0)').text(); //capturo el ID
         eiddoc = fila.find('td:eq(0)').find('span').attr("data-id");
         $("#eiddoc").val(eiddoc);
         //DESPLEGAR EL MODAL CON LOS DATOS
         revisarE(eiddoc,'ELIM');
         //$('#M_Eliminar').modal('show');
       });
  
       ////////////////////////////////////////////////////////////////////////////
       ///ENVIAR
       $('#formElimina').submit(function(e){
       opcion =6;
       eiddoc = $.trim($('#eiddoc').val());
       e.preventDefault();
       $.ajax({
              url: "functions/Procesos/Procesos.php",
              type: "POST",
              datatype:"json",
              data:  {opcion:opcion,eiddoc:eiddoc,depid:depid},
              success: function(data) {
                listar_derivado();
                toastr.success('Se han procesado los datos correctamente','EXITO');
              }
            });
        //CERRAR MODAL
        $('#M_Eliminar').modal('hide');
       });
  
      ///EDITA DERIVAR
       $(document).on("click", ".btnEderiva", function(){
           fila = $(this).closest("tr");
         //  ederiba = fila.find('td:eq(0)').text(); //capturo el ID
          ederiba = fila.find('td:eq(0)').find('span').attr("data-id");
          
          
          $.post("views/Procesos/rx.php", { xid: ederiba }, function(data) {
                $("#prueba2x2").html(data);
            });
         // $.post( "r.php", { xid: ederiba} );
           $("#ederiba").val(ederiba);
           //DESPLEGAR EL MODAL CON LOS DATOS
           revisarE(ederiba,'EDERI');
         });
  
  
         $('#M_EDerivar').submit(function(e){
         opcion =12;
         ederiba = $.trim($('#ederiba').val());
         erseldepa = $.trim($('#erseldepa').val());
         erselrec = $.trim($('#erselrec').val());
         ermproveido = $.trim($('#ermproveido').val());
         e.preventDefault();
         $.ajax({
                url: "functions/Procesos/Procesos.php",
                type: "POST",
                datatype:"json",
                data:  {opcion:opcion,ederiba:ederiba,erseldepa:erseldepa,erselrec:erselrec,ermproveido:ermproveido,depid:depid},
                success: function(data) {
                  listar_derivado();
                  toastr.success('Se han procesado los datos correctamente','EXITO');
                }
              });
          //CERRAR MODAL
          $('#M_EDerivar').modal('hide');
         });
  
  
       /////////////////////////////////
        function revisarE(id, tform){
          opcion = 2;
          $.ajax({
            type:"POST",
            url:"functions/Procesos/Procesos.php",
            datatype:"json",
            data:{id:id,opcion:opcion},
            success:function(data){
            //CARGAR VALORES
            var cadena = data;
            let ObjetoJS = JSON.parse(cadena);
            //RECORRER OBJETO
            for (let item of ObjetoJS){
                var estatusr = item.tr_estatusr;
            }
            //bloquear recepcion de documento para el tramitador
            //siempre y cuando el sea que lo creo
            if (estatusr !=='RECIBIDO') {
                if (tform =='ARCHI') {
                   $('#M_Archivar').modal('show');
                }
                if (tform =='RDERI') {
                   $('#M_ReDerivar').modal('show');
                }
                if (tform =='ELIM') {
                   $('#M_Eliminar').modal('show');
                }
                if (tform =='EDERI') {
                   $('#M_EDerivar').modal('show');
                }
            }
          }
        });
  
        }
  
  
  });
  