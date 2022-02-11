$(document).ready(function() {
    var depid;
    depid = $.trim($('#depid').val());
      ////////////////////DOCUMENTOS RECIBIDOS/////////////////////////////////////////
    function listar_archivado(){
        console.log(depid)
        $.ajax({
            url: "/cantidad-documentos/"+depid,
            type: "GET",
            datatype:"json",
            data:  {depid:depid},
            success: function(data) {
                let datos = JSON.parse(data)
                $('#t-pendientes').html(datos.cantidad_pendientes)
                $('#t-recibidos').html(datos.cantidad_recibidos)
                $('#t-derivados').html(datos.cantidad_derivados)
                $('#t-archivados').html(datos.cantidad_archivados)
                $('#t-doccreados').html(datos.cantidad_doccreados)
            }

        })
    }
    
                     ////DETALLAR
    listar_archivado()
  });
  