<style>
  .linea {
    margin: 0px 20px;
    width: 90px;
    border-top: 1px solid #999;
    position: relative;
    top: 10px;
    float: left;
  }

  .leyenda {
    font-weight: bold;
    float: left;
  }
</style>
<div class="modal fade" id="M_Crear" data-backdrop="static" tabindex="-1" role="dialog"
  aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content ">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel"> Recepcion de Documentos</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="formCrear">
        <input name="usu_id" id="usu_id" type="hidden" value="<?=$dep_id;?>">
        <input name="action" id="action" type="hidden" value="upload" />
        <div class="modal-body">
          <div class="row">
            <lavel class="form-group col-xs-12 col-md-12 col-lg-12"
              style="color:red; height: calc(0.1em + .14rem + 2px);">EXPEDIENTE</lavel>
            <div class="form-group col-xs-12 col-md-12 col-lg-6">
              <label style=" margin-bottom: .3rem;">Numero de Expediente:</label>
              <input class="form-control text-uppercase" id="numero"
                style="height: calc(1.9em + .14rem + 2px); margin-bottom: .1rem;" value="00000" disabled>
            </div>
            <div class="form-group col-xs-12 col-md-12 col-lg-6">
              <label style=" margin-bottom: .3rem;">Tipo de Solicitud:</label>
              <select class="form-control text-uppercase" style="height: calc(2.1em + .18rem + 2px);" id="tr_tipo"
                placeholder="" pattern="[A-Za-z ].{1,}" title="Ingrese solo letras" required>
                <option>INTERNA</option>
                <option>EXTERNA</option>
              </select>
            </div>
            <lavel class="form-group col-xs-12 col-md-12 col-lg-12"
              style="color:red; height: calc(0.1em + .14rem + 2px);">ORIGEN</lavel>
            <div class="form-group col-xs-12 col-md-12 col-lg-12">
              <label style=" margin-bottom: .3rem;">Remitente:</label>
              <input class="form-control text-uppercase" id="remitente"
                style="height: calc(1.9em + .14rem + 2px); margin-bottom: .1rem;" placeholder=""
                title="Ingrese solo letras" required>
            </div>
            <lavel class="form-group col-xs-12 col-md-12 col-lg-12"
              style="color:red; height: calc(0.1em + .14rem + 2px); margin-bottom: .48rem;">DATOS DEL DOCUMENTO</lavel>
            <div class="form-group col-xs-12 col-md-12 col-lg-4">
              <label style=" margin-bottom: .3rem;">Fecha del Documento :</label>
              <input type="date" class="form-control text-uppercase" style="height: calc(1.9em + .14rem + 2px);"
                id="fdocumento" placeholder="" pattern="[A-Za-z ].{1,}" title="Ingrese solo letras" required>
            </div>
            <div class="form-group col-xs-12 col-md-12 col-lg-4">
              <label style=" margin-bottom: .3rem;">Tipo de Documento:</label>
              <SELECT id="tipod" style="height: calc(2.1em + .15rem + 2px);" class="form-control text-uppercase"
                required>
                <option value="">-Seleccionar-</option>
              </select>
            </div>
            <div class="form-group col-xs-12 col-md-12 col-lg-4">
              <label style=" margin-bottom: .3rem;">Numero de Documento:</label>
              <input class="form-control text-uppercase" style="height: calc(1.9em + .14rem + 2px);" id="ndocumento"
                placeholder="" required>
            </div>
            <div class="form-group col-xs-12 col-md-12 col-lg-6">
              <label style=" margin-bottom: .3rem;">Asunto:</label>
              <input class="form-control text-uppercase" style="height: calc(1.9em + .14rem + 2px);" id="asunto"
                placeholder="" required>
            </div>
            <div class="form-group col-xs-12 col-md-12 col-lg-6">
              <label style=" margin-bottom: .3rem;">Detalle:</label>
              <input class="form-control text-uppercase" style="height: calc(1.9em + .14rem + 2px);" id="detalle"
                placeholder="" required>
            </div>
            <div class="form-group col-xs-12 col-md-12 col-lg-6">
              <label style=" margin-bottom: .3rem;">Folio:</label>
              <input class="form-control text-uppercase" id="folio" placeholder="" type="text"
                title="Ingrese solo letras" required>
            </div>
            <div class="form-group col-xs-12 col-md-12 col-lg-6">
              <label>Adjuntar Archivo:</label>
              <div class="custom-file">
                <input style="width:50%; padding:5px 0px; border: 1px solid #39c;" height="20"
                  class="form-control btn btn-sm btn-info inputimg" title="AGREGAR DOCUMENTOS" accept=".doc,.docx,.pdf"
                  id="uploadImage1" type="file" name="uploadImage1" onchange="previewImage(1);"
                  class="form-control text-uppercase" />

              </div>
            </div>
            <lavel class="form-group col-xs-12 col-md-12 col-lg-12"
              style="color:red; height: calc(0.1em + .14rem + 2px);">TUPA</lavel>
            <div class="form-group col-xs-12 col-md-12 col-lg-8">
              <label>Proceso Administrativo:</label>
              <SELECT id="tupa" style="height: calc(2.1em + .14rem + 2px);" class="form-control text-uppercase"
                required>
                <option value="5">NINGUNO</option>
              </select>
            </div>
            <div class="form-group col-xs-12 col-md-12 col-lg-4">
              <label>Silencio Administrativo:</label>
              <select class="form-control text-uppercase" style="height: calc(2.1em + .18rem + 2px);" id="silencio"
                placeholder="" pattern="[A-Za-z ].{1,}" title="Ingrese solo letras" required>
                <option>POSITIVO</option>
                <option>NEGATIVO</option>
              </select>
            </div>
            <div class="form-group col-xs-12 col-md-12 col-lg-6">
              <label>Requisito:</label>
              <dt>
                <dl id="requiss"></dl>
              </dt>
            </div>
            <div class="form-group col-xs-12 col-md-12 col-lg-6">
              <label>Departamentos:</label>
              <dt>
                <dl id="departaaa"></dl>
              </dt>
            </div>

            <lavel class="form-group col-xs-12 col-md-12 col-lg-12"
              style="color:red; height: calc(0.1em + .14rem + 2px);">DERIVACION</lavel>

            <div class="form-group col-xs-12 col-md-12 col-lg-4">
              <label>Unidad:</label>
              <SELECT id="unidad" style="height: calc(2.1em  + .14rem + 2px);" class="form-control text-uppercase"
                required>
                <option value="3">NINGUNO</option>
              </select>

            </div>

            <div class="form-group col-xs-12 col-md-12 col-lg-4">
              <label>Proveido:</label>
              <input class="form-control text-uppercase" style="height: calc(1.9em + .14rem + 2px);" id="proveido"
                type="text" placeholder="" value="- 0 -" required>
            </div>
            <div class="form-group col-xs-12 col-md-12 col-lg-4">
              <label>Tipo:</label>
              <select class="form-control text-uppercase" style="height: calc(2.1em + .18rem + 2px);" id="tipoEstatus"
                placeholder="" pattern="[A-Za-z ].{1,}" title="Ingrese solo letras" required>

                <option>DERIVADO</option>
                <option>EN PROCESO</option>
                <option>ARCHIVADO</option>
              </select>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary waves-effect waves-light">Guardar</button>
          <button type="button" id="btnCancel" class="btn btn-danger waves-effect" data-dismiss="modal">Cerrar</button>
      </form>
    </div>
  </div>
</div>
</div>
</div>