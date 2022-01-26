<div class="topnav">
    <div class="container-fluid">
        <nav class="navbar navbar-light navbar-expand-lg topnav-menu">
            <div class="collapse navbar-collapse" id="topnav-menu-content">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="/home">
                            <i class="ri-dashboard-line mr-2"></i> Inicio
                        </a>
                    </li>
                    <?php  
                        if($Grupo=="1"){
                    ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-apps" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="ri-apps-2-line mr-2"></i>Cat&aacute;logo <div class="arrow-down"></div>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="topnav-apps">
                            <a href="index.php?menu=1" class="dropdown-item">Tipo de Documentos</a>
                            <a href="index.php?menu=5" class="dropdown-item">Formas de Recepcion</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?menu=7">
                            <i class="ri-dashboard-line mr-2"></i> Departamentos / Documentos
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?menu=6">
                            <i class="ri-dashboard-line mr-2"></i> Tupa
                        </a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-components" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="ri-stack-line mr-2"></i>Administraci&oacute;n <div class="arrow-down"></div>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="topnav-apps">
                            <a href="index.php?menu=2" class="dropdown-item">Areas / Departamentos</a>
                            <a href="index.php?menu=4" class="dropdown-item">Usuarios</a>
                        </div>
                    </li>
                    <?php
                 }
                     ?>
                    <?php  
                        if($Grupo=="3"){
                    ?>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?menu=6">
                            <i class="ri-dashboard-line mr-2"></i> Tupa
                        </a>
                    </li>
                    <?php
                 }
                     ?>
                    <?php        if($Grupo=="4" or $Grupo=="2"){ ?>
                    <li class="nav-item">
                        <a href="index.php?menu=1" class="nav-link">
                            <i class="ri-dashboard-line"></i>
                            <span>Documentos</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="index.php?menu=2" class="nav-link">
                            <i class="ri-dashboard-line"></i>
                            <span>Archivador</span>
                        </a>
                    </li>
                    <?php    }  ?>

                    <?php  
            if($Grupo=="22"){
    ?>

                    <li class="nav-item">
                        <a class="nav-link" href="index.php?menu=1">
                            <i class="ri-dashboard-line mr-2"></i>Recepcion
                        </a>
                    </li>
                    <?php

                 }
                     ?>

                    <li class="nav-item">
                        <a class="nav-link" href="/logout">
                            <i class="ri-dashboard-line mr-2"></i> Salir
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</div>