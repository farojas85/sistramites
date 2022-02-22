<?php
    include 'Views/layouts/master/header.php';
    include 'Views/layouts/master/body.php';

    $depart = $dep_id;

    include "documentos.php";
?>
<div class="row" id="principal">
    <input type="hidden" id="estado" value="PENDIENTE">
    <input type="hidden" id="depid" value="<?=$depart;?>">
    <input type="hidden" id="abrevia" value="<?=$Abrevia;?>">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-lg-6">
                  <h2 ><i class="fas fa-list"></i>&nbsp;Documentos </h2>
                </div>
                  <div class="col-lg-6 text-right">
                      <a href="#" class="btn btn-success mb-2" id="btnNuevo"><i class="mdi mdi-plus mr-2"></i> AGREGAR DOCUMENTO</a>
                  </div>
              </div>
              <ul class="nav nav-tabs" role="tablist">
               <li class="nav-item">
                      <a class="nav-link" data-toggle="tab" href="#Ubicar" role="tab" id="Ebusca">
                          <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                          <span class="d-none d-sm-block">Buscar</span>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link active" data-toggle="tab" href="#Pendientes" role="tab">
                          <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                          <span class="d-none d-sm-block">Pendientes</span>
                      </a>
                  </li>
              <li class="nav-item">
                      <a class="nav-link" data-toggle="tab" href="#Archivado" role="tab" id="Earchiv">
                          <span class="d-block d-sm-none"><i class="fas fa-cog"></i></span>
                          <span class="d-none d-sm-block">Recibidos</span>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" data-toggle="tab" href="#Derivados" role="tab" id="Ederiva">
                          <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span>
                          <span class="d-none d-sm-block">Derivados</span>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" data-toggle="tab" href="#Archivados" role="tab" id="Earchiva">
                          <span class="d-block d-sm-none"><i class="fas fa-cog"></i></span>
                          <span class="d-none d-sm-block">Archivados</span>
                      </a>
                  </li>
                 
              </ul>
              <!-- Tab panes -->
              <div class="tab-content p-3 text-muted">
                <div class="tab-pane" id="Ubicar" role="tabpanel">
                  <div class="table-responsive mt-3">
                  <table class="table datatable" id="tablefiltro" style="width: 100%;">
                      <thead class="thead">
                          <tr class="text-center" style="background:#343a40; color: white; font-size:12px;">
                                <th style="background:#343a40; color: white;">#</th>
                                <th style="background:#343a40; color: white;">N- EXPEDIENTE</th>
                                <th style="background:#343a40; color: white;">REMITENTE</th>
                                <th style="background:#343a40; color: white;">FECHA</th>
                                <th style="background:#343a40; color: white;">ASUNTO</th>
                                <th style="background:#343a40; color: white;">ENVIADO A</th> 
                                <th style="background:#343a40; color: white;">ESTATUS</th>
                                <th style="background:#343a40; color: white;">ADJUNTO</th>
                                 <th style="background:#343a40; color: white;">OPCIONES</th>
                          </tr>
                      </thead>
                      <tbody  class="text-center"></tbody>
                  </table>
                </div></div>
                  <div class="tab-pane active" id="Pendientes" role="tabpanel">
                    <div class="table-responsive mt-3">
                    <table class="table datatable" id="tableproceso" style="width: 100%;">
                        <thead class="thead">
                            <tr class="text-center" style="background:#343a40; color: white;">
                                <th style="background:#343a40; color: white;">#</th>
                          <th style="background:#343a40; color: white;">N- EXPEDIENTE</th>
                                <th style="background:#343a40; color: white;">REMITENTE</th>
                                <th style="background:#343a40; color: white;">FECHA</th>
                                <th style="background:#343a40; color: white;">ASUNTO</th>
                                <th style="background:#343a40; color: white;">ENVIADO A</th> 
                                <th style="background:#343a40; color: white;">ADJUNTO</th>
                                 <th style="background:#343a40; color: white;">OPCIONES</th>
                            </tr>
                        </thead>
                        <tbody  class="text-center"></tbody>
                    </table>
                  </div></div>
                  <div class="tab-pane" id="Recibidos" role="tabpanel">
                    <table class="table datatable" id="tablerecibidos" style="width: 100%;">
                        <thead class="thead">
                            <tr class="text-center" style="background:#343a40; color: white;">
                              <th style="background:#343a40; color: white;">#</th>
                                    <th style="background:#343a40; color: white;">N- EXPEDIENTE</th>
                                <th style="background:#343a40; color: white;">REMITENTE</th>
                                <th style="background:#343a40; color: white;">FECHA</th>
                                <th style="background:#343a40; color: white;">ASUNTO</th>
                                <th style="background:#343a40; color: white;">ENVIADO A</th> 
                                <th style="background:#343a40; color: white;">ADJUNTO</th>
                                 <th style="background:#343a40; color: white;">OPCIONES</th>
                            </tr>
                        </thead>
                        <tbody  class="text-center"></tbody>
                    </table>
                  </div>
                  <div class="tab-pane" id="Derivados" role="tabpanel">
                    <table class="table datatable" id="tablederivados" style="width: 100%;">
                        <thead class="thead">
                            <tr class="text-center" style="background:#343a40; color: white;">
                                <th style="background:#343a40; color: white;">#</th>
                          <th style="background:#343a40; color: white;">N- EXPEDIENTE</th>
                                <th style="background:#343a40; color: white;">REMITENTE</th>
                                <th style="background:#343a40; color: white;">FECHA</th>
                                <th style="background:#343a40; color: white;">ASUNTO</th>
                                <th style="background:#343a40; color: white;">ENVIADO A</th> 
                                <th style="background:#343a40; color: white;">ADJUNTO</th>
                                 <th style="background:#343a40; color: white;">OPCIONES</th>
                  
                            </tr>
                        </thead>
                        <tbody  class="text-center"></tbody>
                    </table>
                  </div>
              
                  <div class="tab-pane" id="Archivados" role="tabpanel">
                    <table class="table datatable" id="tablearchivados" style="width: 100%;">
                        <thead class="thead">
                            <tr class="text-center" style="background:#343a40; color: white;">
                                <th style="background:#343a40; color: white;">#</th>
                                   <th style="background:#343a40; color: white;">N- EXPEDIENTE</th>
                                <th style="background:#343a40; color: white;">REMITENTE</th>
                                <th style="background:#343a40; color: white;">FECHA</th>
                                <th style="background:#343a40; color: white;">ASUNTO</th>
                                <th style="background:#343a40; color: white;">ENVIADO A</th> 
                                <th style="background:#343a40; color: white;">ADJUNTO</th>
                                <th style="background:#343a40; color: white;">OPCIONES</th>
                            </tr>
                        </thead>
                        <tbody  class="text-center"></tbody>
                    </table>
                  </div>
                           <div class="tab-pane" id="Archivado" role="tabpanel">
                    <table class="table datatable" id="tablearchivado" style="width: 100%;">
                        <thead class="thead">
                            <tr class="text-center" style="background:#343a40; color: white;">
                               <th style="background:#343a40; color: white;">#</th>
                              <th style="background:#343a40; color: white;">N- EXPEDIENTE</th>
                                <th style="background:#343a40; color: white;">REMITENTE</th>
                                <th style="background:#343a40; color: white;">FECHA</th>
                                <th style="background:#343a40; color: white;">ASUNTO</th>
                                <th style="background:#343a40; color: white;">ENVIADO A</th> 
                                <th style="background:#343a40; color: white;">ADJUNTO</th>
                                 <th style="background:#343a40; color: white;">OPCIONES</th>
                            </tr>
                        </thead>
                        <tbody  class="text-center"></tbody>
                    </table>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="opciones"></div>

<script type="text/javascript">
    
      $("#tupa").on('change', function () {
      $("#tupa option:selected").each(function () {
          let id_tupa = $(this).val();
          //alert('se ejecuto');
            $('#requiss').empty();
            $.get("tupa-requisito-por-id/"+id_tupa, { id_tupa: id_tupa }, function(data) {
                let  requisito = JSON.parse(data)
                requisito.forEach(item => {
                 $('#requiss').append($('<option>', {
                    value: item.tur_id,
                    text: item.tur_nombre
                    }))
                })
            });
            $("#departaaa").empty()
            $.get("tupa-departamento-por-tupa/"+id_tupa, { id_tupa: id_tupa }, function(data) {
                let  departamento = JSON.parse(data)
                departamento.forEach(item => {
                $('#departaaa').append($('<option>', {
                        value: item.dep_id,
                        text: item.dep_nombre
                    }))
                })
            });
      });
    });
    
    
    
</script>

<!-- <script type="text/javascript" src="functions/procesos/procesos.js"></script> -->
<script type="text/javascript" src="funciones/procesos/filtro.js"></script>
<script type="text/javascript" src="funciones/procesos/recepcion.js"></script>

<?php include 'Views/layouts/master/footer.php'; ?>