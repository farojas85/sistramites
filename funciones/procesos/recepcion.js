$(document).ready(function () {
  var opcion;

  ////////////////////////////////////////////////////////////////////////////
  ///NUEVO
  $("#btnNuevo").click(function () {
    $("#formCrear").trigger("reset");
    $('#M_Crear').modal('show');
    obtenerFilaCodigo()
    ListarTipoDocumentos()
    ListarTupasActivas()
    ListarUnidades()
  });
  //Autofocus Modal
  $(".modal").on('shown.bs.modal', function () {
    $(this).find('#docnombre').focus();
  });


  ///ENVIO DE DATOS
  $('#formCrear').submit(function (e) {
    e.preventDefault();
    opcion = 1;
    var formData = new FormData();
    formData.append('opcion', opcion);
    var action = $.trim($('#action').val());
    var numero = $.trim($('#numero').val());
    var tr_tipo = $.trim($('#tr_tipo').val());
    var remitente = $.trim($('#remitente').val());
    var fdocumento = $.trim($('#fdocumento').val());
    var tipod = $.trim($('#tipod').val());
    var ndocumento = $.trim($('#ndocumento').val());
    var asunto = $.trim($('#asunto').val());
    var detalle = $.trim($('#detalle').val());
    var folio = $.trim($('#folio').val());
    var archivo = $.trim($('#archivo').val());
    var tupa = $.trim($('#tupa').val());
    var silencio = $.trim($('#silencio').val());
    var tipoEstatus = $.trim($('#tipoEstatus').val());
    var unidad = $.trim($('#unidad').val());
    var proveido = $.trim($('#proveido').val());
    var usu_id = $.trim($('#usu_id').val());
    var files = $('#uploadImage1')[0].files;
    const $inputArchivos = document.querySelector("#uploadImage1")
    var files = $inputArchivos.files
    //formData.append('files[]', files);
    formData.append('numero', numero);
    formData.append('tr_tipo', tr_tipo);
    formData.append('remitente', remitente);
    formData.append('fdocumento', fdocumento);
    formData.append('tipod', tipod);
    formData.append('action', action);
    formData.append('ndocumento', ndocumento);
    formData.append('asunto', asunto);
    formData.append('detalle', detalle);
    formData.append('folio', folio);
    formData.append('archivo', archivo);
    formData.append('tupa', tupa);
    formData.append('silencio', silencio);
    formData.append('tipoEstatus', tipoEstatus);
    formData.append('unidad', unidad);
    formData.append('proveido', proveido);
    formData.append('usu_id', usu_id);
    formData.append('action', action);
    for (const archivo of files) {
        formData.append("files[]", archivo);
    }

    $.ajax({
      url: "/guardar-tramite",
      type: "POST",
      datatype: "json",
      data: formData,
      contentType: false,
      processData: false,
      success: function (data) {
        console.log(data)
        //  listar();
        //  toastr.success('Se han procesado los datos correctamente','EXITO');
        //refresh();
      }
    });
    // $('#M_Crear').modal('hide');
    // ruta = 'PDF/documentos/R_imprimirS.php?&d=' + numero;
    // window.open(ruta, '_blank');

  });
  function refresh() {
    setTimeout(function () {
      window.location.replace("index.php?menu=1");
    }, 150);
  }




  /////////////////////////////////////////////////////////////////////////////
  ///EDITAR
  $(document).on("click", ".btnEdit", function () {
    fila = $(this).closest("tr");
    iddoc = fila.find('td:eq(0)').text(); //capturo el ID
    docnom = fila.find('td:eq(1)').text();
    dremitente = fila.find('td:eq(2)').text();
    opcion = 4;
    $("#iddoc").val(iddoc);
    $("#docnom").val(docnom);
    $("#dremitente").val(dremitente);
    //DESPLEGAR EL MODAL CON LOS DATOS
    $.ajax({
      type: "POST",
      url: "functions/Recepcionista/Recepcion.php",
      datatype: "json",
      data: { iddoc: iddoc, opcion: opcion },
      success: function (data) {
        //CARGAR VALORES
        var cadena = data;
        let ObjetoJS = JSON.parse(cadena);
        //RECORRER OBJETO
        // tr_detalle, tr_nfolio, tr_remintente,tr_numdoc, tr_numexp 

        for (let item of ObjetoJS) {
          var datoa1 = item.tr_silencio;
          var tr_numexp = item.tr_numexp;
          var tr_remitente = item.tr_remintente;
          var tr_fecdoc = item.tr_fecdoc;
          var tr_numdoc = item.tr_numdoc;
          var tr_detalle = item.tr_detalle;
          var tr_nfolio = item.tr_nfolio;
          var tup_nombre = item.tup_nombre;
          var dep_nombre = item.dep_nombre;

        }
        //DATOS FALTANTES  
        $("#bsilencio").val(datoa1);
        $("#bexp").val(tr_numexp);
        $("#remitente").val(tr_remitente);
        $("#bfecha").val(tr_fecdoc);
        $("#bnumdoc").val(tr_numdoc);
        $("#bdetalle").val(tr_detalle);
        $("#nfolio").val(tr_nfolio);
        $("#btup_nombre").val(tup_nombre);
        $("#bdep_nombre").val(dep_nombre);

        refresh();
      }
    });
    $('#M_Editar').modal('show');

  });


  $(document).on("click", ".btnImprime", function () {
    fila = $(this).closest("tr");
    //  iddoc = fila.find('td:eq(0)').text(); //capturo el ID
    iddoc = fila.find('td:eq(0)').find('span').attr("data-id");
    //aca debes poner la ruta 
    ruta = 'PDF/documentos/R_Imprimir.php?&d=' + iddoc;
    window.open(ruta, '_blank');

  });




  $('#formEdoc').submit(function (e) {
    opcion = 2;
    docnom = $.trim($('#docnom').val());
    docabre = $.trim($('#docabre').val());
    iddoc = $.trim($('#iddoc').val());
    e.preventDefault();
    $.ajax({
      url: "functions/Recepcion/Recepcion.php",
      type: "POST",
      datatype: "json",
      data: { opcion: opcion, docnom: docnom, docabre: docabre, iddoc: iddoc },
      success: function (data) {
        listar();
        //  toastr.success('Se han procesado los datos correctamente','EXITO');
      }
    });
    //CERRAR MODAL
    $('#M_Editar').modal('hide');
  });
  /////////////////////////////////////////////////////////////////////////////
  ///ELIMINAR
  $(document).on("click", ".btnElim", function () {
    fila = $(this).closest("tr");
    eiddoc = fila.find('td:eq(0)').text(); //capturo el ID
    $("#eiddoc").val(eiddoc);
    //DESPLEGAR EL MODAL CON LOS DATOS
    $('#M_Eliminar').modal('show');
  });
  /////////////////////////////////////////////////////////////////////////////
  ///
  $('#formElimina').submit(function (e) {
    opcion = 3;
    eiddoc = $.trim($('#eiddoc').val());
    e.preventDefault();
    $.ajax({
      url: "functions/Recepcion/Recepcion.php",
      type: "POST",
      datatype: "json",
      data: { opcion: opcion, eiddoc: eiddoc },
      success: function (data) {
        listar();
        // toastr.success('Se han procesado los datos correctamente','EXITO');
      }
    });
    //CERRAR MODAL
    $('#M_Eliminar').modal('hide');
  });




});


function obtenerFilaCodigo() {
  depid = $.trim($('#depid').val());

  $.ajax({
    url: "/codigo-fila/" + depid,
    type: "GET",
    datatype: "json",
    data: { depid: depid },
    success: function (data) {
      var codigo = data
      obtenerDepartamentoPorId(depid, codigo);

    }
  });
}

function obtenerDepartamentoPorId(depid, codigo) {
  $.ajax({
    url: "/departamento-por-id/" + depid,
    type: "GET",
    datatype: "json",
    data: { depid: depid },
    success: function (data) {
      var depa = JSON.parse(data)
      $('#numero').val(depa.dep_abrevia + '000' + codigo)

    }
  });
}

function ListarTipoDocumentos() {
  $('#tipod').empty();
  $.ajax({
    url: "/tipo-documentos-listar",
    type: "GET",
    datatype: "json",
    success: function (data) {

      var tipoObj = JSON.parse(data)
      $('#tipod').append($('<option>', {
        value: '',
        text: '-Seleccionar-'
      }))

      tipoObj.forEach(item => {
        $('#tipod').append($('<option>', {
          value: item.tdoc_id,
          text: item.tdoc_nombre
        }))

      })
    }
  });
}

function ListarTupasActivas() {
  $('#tupa').empty();
  $.ajax({
    url: "/tupas-activas-listar",
    type: "GET",
    datatype: "json",
    success: function (data) {

      var tupa = JSON.parse(data)
      $('#tupa').append($('<option>', {
        value: '5',
        text: 'NINGUNO'
      }))

      tupa.forEach(item => {
        $('#tupa').append($('<option>', {
          value: item.tup_id,
          text: item.tup_nombre
        }))
      })
    }
  });
}


function ListarUnidades() {
  $('#unidad').empty();
  $.ajax({
    url: "/departamentos-filtro-listar",
    type: "GET",
    datatype: "json",
    success: function (data) {

      var depa = JSON.parse(data)
      $('#unidad').append($('<option>', {
        value: '5',
        text: 'NINGUNO'
      }))

      depa.forEach(item => {
        $('#unidad').append($('<option>', {
          value: item.dep_id,
          text: item.dep_nombre
        }))

      })
    }
  });
}