<!DOCTYPE html>
    <html  >
    <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="generator" content="Mobirise v5.6.13, mobirise.com">
    <meta name="twitter:card" content="summary_large_image"/>
    <meta name="twitter:image:src" content="">
    <meta property="og:image" content="">
    <meta name="twitter:title" content="Home">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
    <link rel="shortcut icon" href="assets/images/GISSE_Logo.png" type="image/x-icon">
    <meta name="description" content="">
    <title>Sistema Logístico</title>
    <link rel="stylesheet" href="assets/css/normalize.css">
    <link rel="stylesheet" href="assets/vendors/mobirise-icons2/mobirise2.css">
    <link rel="stylesheet" href="assets/vendors/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/vendors/bootstrap/css/bootstrap-grid.min.css">
    <link rel="stylesheet" href="assets/vendors/bootstrap/css/bootstrap-reboot.min.css">
    <link rel="stylesheet" href="assets/vendors/dropdown/css/style.css">
    <link rel="stylesheet" href="assets/vendors/socicon/css/styles.css">
    <link rel="stylesheet" href="assets/vendors/theme/css/style.css">
    <link rel="preload" href="https://fonts.googleapis.com/css?family=Epilogue:100,200,300,400,500,600,700,800,900,100i,200i,300i,400i,500i,600i,700i,800i,900i&display=swap" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Epilogue:100,200,300,400,500,600,700,800,900,100i,200i,300i,400i,500i,600i,700i,800i,900i&display=swap">
    </noscript>
    <link rel="stylesheet" href="assets/vendors/mobirise/css/mbr-additional.css" type="text/css">
    <link rel="stylesheet" href="assets/css/css.css">
    </head>
    <body>
    <section data-bs-version="5.1" class="menu menu1 cid-sFGzlAXw3z" once="menu" id="menu1-2">
        <nav class="navbar navbar-dropdown navbar-expand-lg">
            <div class="container">
                <div class="navbar-brand">
                    <span class="navbar-logo">
                        <a href="index.php">
                            <img class="logo" src="assets/images/GISSE_Logo.png" alt="Gisse Aire C.A." style="height: 4.5rem;">
                        </a>
                    </span>
                    <span class="navbar-caption-wrap">
                        <a class="navbar-caption text-white display-7" href="index.php">Sistema Logístico</a>
                    </span>
                </div>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-bs-toggle="collapse" data-target="#navbarSupportedContent" data-bs-target="#navbarSupportedContent" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <div class="hamburger">
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav nav-dropdown" data-app-modern-menu="true">
                    <?php 
                    if(isset($_SESSION['usuario']) or isset($_SESSION['administrador']))
                        {
                    ?>
                        <li class="nav-item">
                            <a class="nav-link link text-white text-primary" href="index.php"><h4>Inicio</h4></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link link text-white text-primary" href="productos.php"><h4>Productos</h4></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link link text-white text-primary" href="historial.php"><h4>Historial</h4></a>
                        </li>
                        <?php 
                        if(isset($_SESSION['administrador']))
                            {
                                echo'<li class="nav-item">
                                        <a class="nav-link link text-white text-primary" href="administrativo.php"><h4>Administrativo</h4></a>
                                    </li>';
                            }
                        ?>
                        <li class="nav-item">
                            <a class="nav-link link text-white text-primary" href="logout.php"><h4><strong>Cerrar</strong></h4></a>
                        </li>
                    <?php 
                    } else {
                        ?>
                        <li class="nav-item">
                            <a class="nav-link link text-white text-primary" href="index.php"><h4>Inicio</h4></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link link text-white text-primary" href="login.php"><h4>Ingresa</h4></a>
                        </li>
                    <?php
                            }
                    ?>
                    
                    
                    </ul>
                </div>
            </div>
        </nav>
    </section>