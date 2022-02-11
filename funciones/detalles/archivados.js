$(document).ready(function() {
    var opcion,depid,estado;
    depid = $.trim($('#depid').val());
      ////////////////////DOCUMENTOS RECIBIDOS/////////////////////////////////////////
      function listar_archivado(){
        opcion =0;
        estado ='ARCHIVADO';
        $('#tablearchivados').DataTable().clear().destroy();
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
                var tablearchivados = $('#tablearchivados').DataTable({
                   "autoWidth" : false,
                   "columns":[null,null,null,null,null,null,null,null]
                   });
               } else {
                 opcion =1;
                var tablearchivados = $('#tablearchivados').DataTable({
                       "ajax":{
                           "url": "/tramites-por-departamento/"+depid+"/"+estado,
                           "method": 'GET', //usamos el metodo POST
                           "data":{opcion:opcion,estado:estado,depid:depid},
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
                       {"data" : "tr_archivo",  
             "render" : function ( data, type, row, meta ){
                             if ( row.tr_archivo ==='NINGUNO') {
                              return "<a>NO POSEE</a>  ";
                        } else if ( row.mov_archivo !=='NINGUNO') {           return "<a href=\Documentos/Recepcion/" + data + "\  target=\"_blank\"  >VER</a>  ";}
             } },
                         {"defaultContent": "<button class='btn btn-warning btn-sm mdi mdi-format-list-bulleted font-size-14 btnDetalleA' data-placement='left' title='DETALLAR EXPEDIENTE'></button>"}
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
                 tablearchivados.on( 'order.dt search.dt', function () {
                 tablearchivados.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                 cell.innerHTML = '<span style="display: block;margin: auto;text-align: center;" data-id="'+$(cell.innerHTML).attr("data-id")+'" >'+(i+1)+'</span>';
                  });
                 }).draw();
             }
           }
         });
        }
        
                     ////DETALLAR
         $(document).on("click", ".btnDetalleA", function(){
             //opcion = 2;//filtar
             fila = $(this).closest("tr");
           //  idst = fila.find('td:eq(0)').text(); //capturo el ID
              idst = fila.find('td:eq(0)').find('span').attr("data-id");
             $("#principal").hide();
             $('#opciones').load('views/Procesos/V_archivos.php',{ "idst": idst});
         });
         
         
        //////LISTAR ONCLICK
         $(function(){ //ready function
            $('#Earchiva').click(function(){ //click event
             listar_archivado();
           });
         });
  
  
  });
  