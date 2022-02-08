<?php
    $depart = $_POST['idst'];
    $dnom = $_POST['dnom'];
?>
<div class="row" id="detalle1">
    <input type="hidden" id="estado" value="PENDIENTE">
    <input type="hidden" id="depid" value="<?=$depart;?>">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-lg-6">
                  <h2 ><i class="fas fa-list"></i>&nbsp;Documentos: <?=$dnom; ?> </h2>
                </div>
                <div class="col-lg-6 text-right">
                    <button class="btn btn-sm btn-warning mb-2" id="btnIncio"><i class="mdi mdi-arrow-left mr-2"></i></button>
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
                        <a class="nav-link" data-toggle="tab" href="#Recibidos" role="tab" id="Erecibe">
                            <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
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
                                    <tr class="text-center" style="background:#343a40; color: white;">
                                        <th style="background:#343a40; color: white;">#</th>
                                        <th style="background:#343a40; color: white;">CODIGO</th>
                                        <th style="background:#343a40; color: white;">REMITENTE</th>
                                        <th style="background:#343a40; color: white;">FECHA</th>
                                        <th style="background:#343a40; color: white;">ASUNTO</th>
                                        <th style="background:#343a40; color: white;">ENVIADO A</th>
                                        <th style="background:#343a40; color: white;">OPCIONES</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center"></tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane active" id="Pendientes" role="tabpanel">
                        <div class="table-responsive mt-3">
                            <table class="table datatable" id="tableproceso" style="width: 100%;">
                                <thead class="thead">
                                    <tr class="text-center" style="background:#343a40; color: white;">
                                        <th style="background:#343a40; color: white;">#</th>
                                        <th style="background:#343a40; color: white;">CODIGO</th>
                                        <th style="background:#343a40; color: white;">REMITENTE</th>
                                        <th style="background:#343a40; color: white;">FECHA</th>
                                        <th style="background:#343a40; color: white;">ASUNTO</th>
                                        <th style="background:#343a40; color: white;">ENVIADO A</th>
                                        <th style="background:#343a40; color: white;">OPCIONES</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center"></tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="Recibidos" role="tabpanel">
                        <table class="table datatable" id="tablerecibidos" style="width: 100%;">
                            <thead class="thead">
                                <tr class="text-center" style="background:#343a40; color: white;">
                                    <th style="background:#343a40; color: white;">#</th>
                                    <th style="background:#343a40; color: white;">CODIGO</th>
                                    <th style="background:#343a40; color: white;">REMITENTE</th>
                                    <th style="background:#343a40; color: white;">FECHA</th>
                                    <th style="background:#343a40; color: white;">ASUNTO</th>
                                    <th style="background:#343a40; color: white;">ENVIADO A</th>
                                    <th style="background:#343a40; color: white;">OPCIONES</th>
                                </tr>
                            </thead>
                            <tbody class="text-center"></tbody>
                        </table>
                    </div>
                    <div class="tab-pane" id="Derivados" role="tabpanel">
                        <table class="table datatable" id="tablederivados" style="width: 100%;">
                            <thead class="thead">
                                <tr class="text-center" style="background:#343a40; color: white;">
                                    <th style="background:#343a40; color: white;">#</th>
                                    <th style="background:#343a40; color: white;">CODIGO</th>
                                    <th style="background:#343a40; color: white;">REMITENTE</th>
                                    <th style="background:#343a40; color: white;">FECHA</th>
                                    <th style="background:#343a40; color: white;">ASUNTO</th>
                                    <th style="background:#343a40; color: white;">ENVIADO A</th>
                                    <th style="background:#343a40; color: white;">OPCIONES</th>
                                </tr>
                            </thead>
                            <tbody class="text-center"></tbody>
                        </table>
                    </div>
                    <div class="tab-pane" id="Archivados" role="tabpanel">
                        <table class="table datatable" id="tablearchivados" style="width: 100%;">
                            <thead class="thead">
                                <tr class="text-center" style="background:#343a40; color: white;">
                                    <th style="background:#343a40; color: white;">#</th>
                                    <th style="background:#343a40; color: white;">CODIGO</th>
                                    <th style="background:#343a40; color: white;">REMITENTE</th>
                                    <th style="background:#343a40; color: white;">FECHA</th>
                                    <th style="background:#343a40; color: white;">ASUNTO</th>
                                    <th style="background:#343a40; color: white;">ENVIADO A</th>
                                    <th style="background:#343a40; color: white;">OPCIONES</th>
                                </tr>
                            </thead>
                            <tbody class="text-center"></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="opciones"></div>
<script type="text/javascript">
  //
  $(document).ready(function() {
  //Cerrar Formulario
     $("#btnIncio").click(function(){
         opcion = 1;
         $("#detalle1").hide();
         $('#principal').show();
     });
  });
</script>

<script type="text/javascript" src="functions/detalles/procesos.js"></script>
<script type="text/javascript" src="functions/detalles/filtros.js"></script>