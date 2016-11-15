<html>
    <head>
        <title>PROGRAMACION III</title>

        <meta charset="UTF-8">
        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script type="text/javascript" src="./js/funciones_login.js"></script>

        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="css/estilo.css">

    </head>
    <body>
        <div class="container">
            <div class="page-header">
                <h1>SEGUNDO PARCIAL</h1>      
            </div>
            <div class="CajaInicio animated bounceInRight">
                <h1>LOGIN</h1>

                <form id="FormIngreso" method="post">
                    <input type="text" id="nombre" name="nombre" placeholder="nombre" required="">
                    <input type="text" id="email" placeholder="E-mail" value="" requiredÇ="" />
                    <input type="password" id="password" placeholder="Password" value="" required="" minlength="4"/>
                    <input type="button" class="btn btn-danger" value="LOGIN" onclick="Login()" />
                    <input type="button" class="btn btn-danger" onclick="CargarInput('admin','admin@admin.com','1234')" value="admin">
                </form>

            </div>
            <div style="text-align:center">
                <?php
                if (isset($_GET["uss"])) {
                    echo "<h1>Usuario sin Sesi&oacute;n Activa!!!</h1>";
                }
                ?>
            </div>
        </div>
    </body>
</html>