$(document).ready(function () {
    var opcion, depid, estado;
    depid = $.trim($('#depid').val());
    ////////////////////DOCUMENTOS RECIBIDOS/////////////////////////////////////////
    function listar_filtro() {
      opcion = 10;
      $('#tablefiltro').DataTable().clear().destroy();
      $.ajax({
        url: "functions/Procesos/Procesos.php",
        type: "POST",
        datatype: "json",
        data: { opcion: opcion, depid: depid },
        success: function (data) {
          //RECORRER OBJETO JS
          let ObjetoJSS1 = JSON.parse(data);
          for (let itemm of ObjetoJSS1) { var listar = itemm.data; }
          if (listar == 0) {
            var tablefiltro = $('#tablefiltro').DataTable({
              "autoWidth": false,
              "columns": [null, null, null, null, null, null, null, null]
            });
          } else {
            opcion = 11;
            var tablefiltro = $('#tablefiltro').DataTable({
              "ajax": {
                "url": "functions/Procesos/Procesos.php",
                "method": 'POST', //usamos el metodo POST
                "data": { opcion: opcion, depid: depid },
                "dataSrc": ""
              },
              "autoWidth": true,
              "columns": [
                { "data": "tr_id" },
                { "data": "tr_numexp" },
                { "data": "tr_remintente" },
                { "data": "tr_fecdoc" },
                { "data": "tr_asunto" },
                { "data": "dep_nombre" },
                {
                  "data": "tr_archivo",
                  "render": function (data, type, row, meta) {
                    if (row.tr_archivo === 'NINGUNO') {
                      return "<button class='btn btn-warning btn-sm mdi mdi-format-list-bulleted font-size-12' data-toggle='tooltip' data-placement='left' title='DETALLAR ARCHIVO ADJUNTO'></button> <button class='btn btn-info btn-sm mdi mdi-format-list-bulleted font-size-12 btnTraza'data-toggle='tooltip' data-placement='left' title='DETALLAR EXPEDIENTE'></button> ";
                    } else if (row.mov_archivo !== 'NINGUNO') { return "<button class='btn btn-warning btn-sm mdi mdi-format-list-bulleted font-size-12 btnVer' data-toggle='tooltip' data-placement='left' title='DETALLAR ARCHIVO ADJUNTO'></button> <button class='btn btn-info btn-sm mdi mdi-format-list-bulleted font-size-12 btnTraza' data-toggle='tooltip' data-placement='left' title='DETALLAR EXPEDIENTE'></button> "; }
                  }
                }],
              "columnDefs": [
                {
                  "targets": 0,
                  "render": function (data, type, row, meta) {
                    //console.log(row.usu_id)
                    return '<span style="display: block;margin: auto;text-align: center;" data-id="' + row.tr_id + '" >' + row.tr_id + '</span>';
                  }
                }
              ]
            });
            tablefiltro.on('order.dt search.dt', function () {
              tablefiltro.column(0, { search: 'applied', order: 'applied' }).nodes().each(function (cell, i) {
                cell.innerHTML = '<span style="display: block;margin: auto;text-align: center;" data-id="' + $(cell.innerHTML).attr("data-id") + '" >' + (i + 1) + '</span>';
              });
            }).draw();
          }
        }
      });
    }
    //////LISTAR ONCLICK
    $(function () { //ready function
      $('#Ebusca').click(function () { //click event
        listar_filtro();
        //alert('se ejecuto');
      });
    });
  });
  