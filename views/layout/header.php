<!DOCTYPE HTML>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <!-- Hacer la aplicacion web adaptable a cada resolución  -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Beijing import Antofagasta</title>
    <meta name="description" content="Somos Distribuidores Mayoristas y te traemos Productos para tu Restaurante y 
    Envases Reutilizables de alta calidad, consultar al WhatsApp +56964602394 o visítanos en Antofagasta, Antonio Poupin 1070." />
    <meta name="author" content="Alejo Palma Santoro">
    <meta name="google-site-verification" content="dWpXJHi9VCAwrkWDU_6uYbZKVOf2VkL-dult-rpdwzg" />

    <!-- MDB ESSENTIAL -->
    <link rel="stylesheet" href="<?= base_url ?>css/mdb.min.css" />
    <!-- MDB PLUGINS -->
    <link rel="stylesheet" href="<?= base_url ?>plugins/css/all.min.css" />

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css" />

    <link rel="stylesheet" href="<?= base_url ?>css/styles.css" />
    <link rel="shortcut icon" href="<?= base_url ?>img/logo.webp">

</head>

<body style="background-image: url('<?= base_url ?>img/bg.png');">
    <!-- CABECERA -->
    <header>

        <?php $categoriasNav = Utils::showCategorias(); ?>

        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg fixed-top bg-light navbar-light">
            <!-- Container wrapper -->
            <div class="container">

                <!-- Navbar brand -->
                <a class="navbar-brand" href="<?= base_url ?>"><img id="logo" src="<?= base_url ?>img/logo.webp" alt="Beijing Logo" class="img-fluid rounded me-2" draggable="false" style="height: 40px; width: 70px;"> </img>Beijing Import</a>

                <!-- Toggle button -->
                <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fas fa-bars"></i>
                </button>

                <!-- Collapsible wrapper -->
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                        <li class="nav-item">
                            <a class="nav-link text-dark" href="<?= base_url ?>#sobreNosotros">Sobre Nosotros</a>
                        </li>

                        <!-- Dropdown categoria -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-dark" href="#" id="navbarDropdown" role="button" data-mdb-toggle="dropdown" aria-expanded="false">
                                Productos
                            </a>
                            <!-- Dropdown menu categorías -->
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <?php while ($categoriaViews = $categoriasNav->fetch_object()) : ?>
                                    <li><a class="dropdown-item text-dark" href="<?= base_url ?>categoria/ver&id=<?= $categoriaViews->id ?>"><?= $categoriaViews->nombre ?></a></li>
                                <?php endwhile; ?>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link text-dark" href="<?= base_url ?>#contacto">Contacto</a>
                        </li>

                        <li class="nav-item ms-lg-2">
                            <form class="d-flex input-group" style="width:70%" action="<?= base_url ?>producto/buscadorNavegador" method="POST">
                                <input type="text" name="buscar" id="buscar" class="form-control rounded" placeholder="Buscar" aria-label="buscar" aria-describedby="buscar-addon" />
                                <button class="btn btn-outline-primary" data-action='submit'>
                                    <i class="fas fa-search"></i>
                                </button>
                            </form>
                        </li>

                        <!-- Mostrar enlaces a la sesión admin -->
                        <?php if (isset($_SESSION['admin'])) :
                            $id_usuario = $_SESSION['identity']->id;
                        ?>
                            <!-- Dropdown -->
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-mdb-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-edit fa-fw me-1"></i>Administrar tienda
                                </a>
                                <!-- Dropdown menu -->
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="<?= base_url ?>categoria/index">Gestionar categorias</a></li>
                                    <li><a class="dropdown-item" href="<?= base_url ?>producto/gestion">Gestionar productos</a></li>
                                    <li><a class="dropdown-item" href="<?= base_url ?>carrusel/index">Gestionar Portada</a></li>
                                    <li><a class="dropdown-item" href="<?= base_url ?>usuario/editar&id=<?= $id_usuario ?>">Editar mi perfil</a></li>
                                    <li><a class="dropdown-item" href="<?= base_url ?>usuario/logout">Cerrar Sesión</a></li>
                                </ul>
                            </li>
                        <?php endif; ?>


                    </ul>

                </div>
            </div>
            <!-- Container wrapper -->
        </nav>
        <!-- Navbar -->
    </header>

    <!-- CONTENIDO CENTRAL -->
    <div class="container-fluid" id="central" style="margin-top: 75px;">

        <div class="fixed-bottom" style="width: 50px; left: 12px; bottom: 20px;">
            <a id="iconodewhatsap" href="https://wa.me/+56964602394" class="btn btn-primary btn-floating float-start" target="_blank" style="background-color: #128C7E; width:50px; height:50px">
                <i class="fab fa-whatsapp fa-3x" style="margin-top:6px ;"></i>
            </a>
        </div>