<?php
include 'Views/layouts/auth/header.php';
include 'Views/layouts/auth/master.php';
?>
<div class="row no-gutters">
    <div class="col-lg-4">
        <div class="authentication-bg">
            <div class="bg-overlay"></div>
        </div>
    </div>
    <div class="col-lg-8">
        <div class="authentication-page-content p-4 d-flex align-items-center min-vh-100">
            <div class="w-100">
                <div class="row justify-content-center">
                    <div class="col-lg-9">
                        <div>
                            <div class="mt-5 text-right">
                                <p>Consultar Documentos<a href="consulta.php" class="font-weight-medium text-primary">
                                        Pulsa Aqu&iacute; </a> </p>
                            </div>
                            <div class="text-center">
                                <div>
                                    <a href="/" class="logo"><img src="assets/images/img-01.png" height="150"
                                            alt="logo"></a>
                                </div>
                            </div>
                            <div class="p-2 mt-5">
                                <form class="form-horizontal" action="auth" method="post">

                                    <div class="form-group auth-form-group-custom mb-4">
                                        <i class="ri-user-2-line auti-custom-input-icon"></i>
                                        <label for="username">Usuario</label>
                                        <input type="text" class="form-control" name="usuario"
                                            placeholder="Usuario del sistema">
                                    </div>

                                    <div class="form-group auth-form-group-custom mb-4">
                                        <i class="ri-lock-2-line auti-custom-input-icon"></i>
                                        <label for="userpassword">Password</label>
                                        <input type="password" class="form-control" name="password"
                                            placeholder="Clave de acceso">
                                    </div>

                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="customControlInline">

                                    </div>

                                    <div class="mt-4 text-center">
                                        <button class="btn btn-primary w-md waves-effect waves-light"
                                            type="submit">ENTRAR</button>
                                    </div>
                                    <?php
                                        if(isset($error)){
                                            if($error=="1") {
                                            echo"CADUCADO SU ACCESO";   
                                            }   
                                            if($error=="2") {
                                            echo"ERROR DE ACCESO";   
                                            }
                                        }
                                        ?>
                                    <div class="mt-4 text-center">

                                    </div>
                                </form>
                                <p>Olvido contraseña? <a href="form.php" class="font-weight-medium text-primary">Pulsa
                                        Aqu&iacute; </a> </p>
                            </div>
                            <div class="mt-5 text-center">

                            </div>
                            <div class="mt-5 text-center">

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include 'Views/layouts/auth/footer.php';
?>