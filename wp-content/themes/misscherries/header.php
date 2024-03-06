<!doctype html>
<html <?php language_attributes(); ?>>
    <head >
        <meta charset="<?php bloginfo('charset'); ?>">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title><?php make_title(); ?></title>
        <meta name="description" content="<?php make_description(); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css"/>
        <?php wp_head(); ?>
    </head>
    <body <?php body_class(); ?>>
        <header><header class="container">
                <div class="row row-header">
                    <div class="col-12 col-sm-12 col-md-10 col-lg-6 col-xl-6" > <!--esta es la imagen principal del logo de misscherries que la añadimos mediante la funcion php -->
                        <?php
                            if ( function_exists( 'the_custom_logo' ) ) {  
                                the_custom_logo();
                            } 
                        ?>
                    </div>
                    <div class="col-3 col-sm-3 col-md-2 col-lg-2 col-xl-2 text-es" >
                        <p>ES</p>
                        <img src='http://misscherries.loc/wp-content/uploads/2024/02/flecha-e1708596513353.jpg' class="img-arrow" alt="img_arrow" fetchpriority="high" decoding="async" >
                    </div>
                    <div class="col-3 col-sm-3 col-md-4 col-lg-1 col-xl-1">
                        <img src='http://misscherries.loc/wp-content/uploads/2024/02/corazon-lleno-e1708596297749.jpg' class="img-heart" alt="img_heart" >
                    </div>
                    <div class="col-3 col-sm-3 col-md-4 col-lg-2 col-xl-2">
                        <p class="text-account ">MI CUENTA</p>
                    </div>
                    <div class="menu-header-2 col-3 col-sm-3 col-md-12 col-lg-12 col-xl-12" >
                        <button class="menu-toggler" type="button" >
                            <i class="fas fa-bars"></i>
                        </button>
                    </div>
                </div>
                <div class="menu-header-2" >
                        <nav class="nav-menu">
                            <ul class="menu-header">
                                <?php wp_nav_menu( array( 'theme_location' => 'menu_header' ) ); ?> <!-- este es el menu header de la pagina de misscherries que lo hemos añadido con esta funcion php -->
                            </ul>
                        </nav>
                    </div>
            </header>
        </header>
