$(document).ready(function() {
    var opcion,depid,estado;
    depid = $.trim($('#depid').val());
    //////////DOCUMENTOS PENDIENTES///////////////////////////////////////////////
    function listar_pendiente(){
      opcion =0;
      estado ='PENDIENTE';
      $('#tableproceso').DataTable().clear().destroy();
      $.ajax({
           url: "/tramites-por-departamento/"+depid+"/"+estado,
           type: "GET",
           datatype:"json",
           data:  {opcion:opcion,estado:estado,depid:depid},
           success: function(data) {
             //RECORRER OBJETO JS
             let ObjetoJSS = JSON.parse(data);
             for (let itemm of ObjetoJSS){ var listar = itemm.data; }
             if (listar==0) {
               var tableproceso = $('#tableproceso').DataTable({
                 "autoWidth" : false,
                 "columns":[null,null,null,null,null,null,null,null]
                 });
             } else {
               opcion =1;
              var tableproceso = $('#tableproceso').DataTable({
                     "ajax":{
                         "url": "/tramites-por-departamento/"+depid+"/"+estado,
                         "method": 'GET', //usamos el metodo POST
                         "data":{opcion:opcion,estado:estado,depid:depid},
                         "dataSrc":""
                     },
                    "autoWidth"   : false,
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
                              return "<button class='btn btn-warning btn-sm mdi mdi-format-list-bulleted font-size-12' data-toggle='tooltip' data-placement='left' title='DETALLAR ARCHIVO ADJUNTO'></button> <button class='btn btn-info btn-sm mdi mdi-format-list-bulleted font-size-12 btnTraza'  data-toggle='tooltip' data-placement='left' title='DETALLAR EXPEDIENTE'></button> ";
                        } else if ( row.mov_archivo !=='NINGUNO') {           return "<button class='btn btn-warning btn-sm mdi mdi-format-list-bulleted font-size-12 btnVer' data-toggle='tooltip' data-placement='left' title='DETALLAR ARCHIVO ADJUNTO'></button> <button class='btn btn-info btn-sm mdi mdi-format-list-bulleted font-size-12 btnTraza' data-toggle='tooltip' data-placement='left' title='DETALLAR EXPEDIENTE'></button> ";}
             } }],
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
            tableproceso.on( 'order.dt search.dt', function () {
                 tableproceso.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                 cell.innerHTML = '<span style="display: block;margin: auto;text-align: center;" data-id="'+$(cell.innerHTML).attr("data-id")+'" >'+(i+1)+'</span>';
                  });
                 }).draw();
             }
           }
         });
      }
      listar_pendiente();
  
      //filtrar
      $(document).on("click", ".btnVer", function(){
          opcion = 9;//filtar
          fila = $(this).closest("tr");
          iddoc = fila.find('td:eq(0)').text(); //capturo el ID
          $.ajax({
            type:"GET",
            url:"/tramites-por-departamento/"+depid+"/"+estado,
            datatype:"json",
            data:{iddoc:iddoc,opcion:opcion},
            success:function(data){
            //CARGAR VALORES
            var cadena = data;
            let ObjetoJS = JSON.parse(cadena);
            //RECORRER OBJETO
            for (let item of ObjetoJS){
                var archivo = item.tr_archivo;
            }
            if (archivo !=='') {
              ruta ='../Documentos/Recepcion/'+archivo;
              window.open(ruta, '_blank');
            }
          }
          });
        });
  
  
        //filtrar
        $(document).on("click", ".btnTraza", function(){
            opcion = 9;//filtar
            fila = $(this).closest("tr");
                        iddoc  = fila.find('td:eq(0)').find('span').attr("data-id");
            //iddoc = fila.find('td:eq(0)').text(); //capturo el ID
            $("#detalle1").hide();
            $('#opciones').load('views/Detalles/V_Subdetalle.php',{ "iddoc": iddoc});
  
          });
  
  });
  