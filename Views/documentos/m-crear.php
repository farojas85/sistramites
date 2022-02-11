<div class="modal fade" id="M_Crear" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Agregar Documentos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formCrear">
            <div class="modal-body">
              <div class="row">
                <div class="form-group col-xs-12 col-md-12 col-lg-6">
                 <label>DOCUMENTO:</label>
                 <input class="form-control text-uppercase" id="docnombre" placeholder="" pattern="[A-Za-z ].{1,}" title="Ingrese solo letras" required>
               </div>
               <div class="form-group col-xs-12 col-md-12 col-lg-6">
                <label>ABREVIATURA:</label>
                <input class="form-control text-uppercase" id="docabrevia" placeholder="" pattern="[A-Za-z ].{1,}" title="Ingrese solo letras" required>
              </div>
            </div>  </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary waves-effect waves-light">Guardar</button>
                <button type="button" id="btnCancel" class="btn btn-danger waves-effect" data-dismiss="modal">Cerrar</button>  </form>
            </div>
        </div>
    </div>
</div>