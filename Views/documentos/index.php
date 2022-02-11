<?php
include 'Views/layouts/master/header.php';
include 'Views/layouts/master/body.php';

include 'Views/documentos/m-crear.php';
?>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-lg-6">
                  <h2 ><i class="fas fa-list"></i>&nbsp;Documentos</h2>
                </div>
                  <div class="col-lg-6 text-right">
                      <a href="#" class="btn btn-success mb-2" id="btnNuevo"><i class="mdi mdi-plus mr-2"></i> AGREGAR DOCUMENTO</a>
                  </div>
              </div>
                <div class="table-responsive mt-3">
                    <table class="table datatable" id="tabledoc" style="width: 100%;">
                        <thead class="thead">
                            <tr class="text-center" style="background:#343a40; color: white;">
                                <th style="background:#343a40; color: white;">#</th>
                                <th style="background:#343a40; color: white;">DOCUMENTO</th>
                                <th style="background:#343a40; color: white;">ABREVIATURA</th>
                                <th style="background:#343a40; color: white;">ACCIONES</th>
                            </tr>
                        </thead>
                        <tbody  class="text-center"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="funciones/documentos/documentos.js"></script>

<?php include 'Views/layouts/master/footer.php'; ?>