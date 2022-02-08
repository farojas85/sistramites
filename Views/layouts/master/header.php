<?php
    $Correo=$_SESSION["correo"] ;
    $Nivel=$_SESSION["gru_id"];
    $Id=$_SESSION["usu_id"];
    $dep_id=$_SESSION["dep_id"];
    $Usu_usuario=$_SESSION["usu_usuario"];
    $Departamento=$_SESSION["dep_nombre"];
    $Tipo_Usuario=$_SESSION["gru_nombre"];
    $Grupo = $_SESSION["gru_id"];

?>
<!doctype html>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <title>Dashboard | Aplicativo</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesdesign" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">
        <link href="css/tab.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="assets/libs/toastr/build/toastr.min.css">
        <!-- DataTables -->
        <link href="assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <!-- Responsive datatable examples -->
        <link href="assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <!-- select2-->
        <link href="assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
        <!-- Bootstrap Css -->
        <link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
       
        <!-- Icons Css -->
        <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
        <script src="assets/libs/jquery/jquery.min.js"></script>
    </head>