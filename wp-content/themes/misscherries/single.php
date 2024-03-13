<?php

get_header();

?>
<main class="main-content">
    <div class="container">
        <?php
        // Comprobamos si hay posts
        if (have_posts()) :
            // Mostramos el post actual
            the_post();
        ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <header>
                    <h1 class="single-title-product" ><?php the_title(); ?></h1>
                </header>

                <div class="row">
                    <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                        <?php
                        // Mostramos la foto del post
                        if (has_post_thumbnail()) {
                            the_post_thumbnail('full', array('class' => 'img-single-product', 'alt' => get_the_title()));
                        }
                        ?>
                    </div>

                    <div class=" col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                        <?php
                        // Mostramos el contenido del post
                        the_content();
                        ?>
                        <div class="div-single-product">
                            <button type="submit" name="add-to-cart" class="add-single-product">Añadir al carrito</button>
                        </div>
                    </div>
                </div>
            </article>
        <?php
        endif;
        ?>
    </div>
</main>
<?php
get_footer();