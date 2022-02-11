<?php
?>
<input type="hidden" value="<?=$dep_id?>" id="depid">
<div class="row">
     <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h3><i class=" ri-bubble-chart-line font-size-24"></i> <?=$Departamento;?></h3>
                <div class="row">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card">
                                <div class="card-body">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <table width="100%">
                <tr>
                    <td width="100%">
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="row">

                                    <div class="col-md-3">
                                        <div class="card">
                                            <div class="card-body" style="background-color:#0cd376; color:#fff;">
                                                <div class="media">
                                                    <div class="media-body overflow-hidden">
                                                        <p class="text-truncate font-size-14 mb-2">PENDIENTES</p>
                                                        <h4 class="mb-0" style="color:white" id="t-pendientes"></h4>
                                                    </div>
                                                    <div class="text-primary">
                                                        <i class="ri-stack-line font-size-24"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-body border-top py-3">
                                                <div class="text-truncate">
                                                    <span class="text-muted ml-2"><a
                                                            href="index.php?menu=22&r=P">VER</a></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="card">
                                            <div class="card-body" style="background-color:#9438f5; color:#fff;">
                                                <div class="media">
                                                    <div class="media-body overflow-hidden">
                                                        <p class="text-truncate font-size-14 mb-2">RECIBIDOS</p>
                                                        <h4 class="mb-0" style="color:white" id="t-recibidos"></h4>
                                                    </div>
                                                    <div class="text-primary">
                                                        <i class="ri-stack-line font-size-24"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-body border-top py-3">
                                                <div class="text-truncate">
                                                    <span class="text-muted ml-2"><a
                                                            href="index.php?menu=22&r=R">VER</a></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="card">
                                            <div class="card-body" style="background-color:blue; color:#fff;">
                                                <div class="media">
                                                    <div class="media-body overflow-hidden">
                                                        <p class="text-truncate font-size-14 mb-2">DERIVADOS</p>
                                                        <h4 class="mb-0" style="color:white" id="t-derivados"></h4>
                                                    </div>
                                                    <div class="text-primary">
                                                        <i class="ri-stack-line font-size-24"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-body border-top py-3">
                                                <div class="text-truncate">
                                                    <span class="text-muted ml-2"><a
                                                            href="index.php?menu=22&r=D">VER</a></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="card">
                                            <div class="card-body" style="background-color:#704105; color:#fff;">
                                                <div class="media">
                                                    <div class="media-body overflow-hidden">
                                                        <p class="text-truncate font-size-14 mb-2">ARCHIVADOS</p>
                                                        <h4 class="mb-0" style="color:white" id="t-archivados"></h4>
                                                    </div>
                                                    <div class="text-primary">
                                                        <i class="ri-stack-line font-size-24"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-body border-top py-3">
                                                <div class="text-truncate">
                                                    <span class="text-muted ml-2"><a
                                                            href="index.php?menu=22&r=A">VER</a></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="card">
                                            <div class="card-body" style="background-color:#d3bb0c; color:#fff;">
                                                <div class="media">
                                                    <div class="media-body overflow-hidden">
                                                        <p class="text-truncate font-size-14 mb-2">DOC. CREADOS</p>
                                                        <h4 class="mb-0" style="color:white" id="t-doccreados"></h4>
                                                    </div>
                                                    <div class="text-primary">
                                                        <i class="ri-stack-line font-size-24"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-body border-top py-3">
                                                <div class="text-truncate">
                                                    <span class="text-muted ml-2"><a
                                                            href="index.php?menu=22&r=T">VER</a></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>

<script type="text/javascript" src="funciones/documentos/principal.js"></script>