<?php
include 'Views/layouts/master/header.php';
include 'Views/layouts/master/body.php';

if($Grupo==1)
{
    include 'Views/detalles/departamentos.php';
}
else if($Grupo == 4 || $Grupo == 2)
{
    include "Views/config/v-principal.php";
}

include 'Views/layouts/master/footer.php';