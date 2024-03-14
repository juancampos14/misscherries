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
                        }else {
                        ?>
                            <div>
                                <img src="http://misscherries.loc/wp-content/uploads/2024/02/FOTO_1-e1710158811356.jpg" class="img-single-product" alt="default-image" >
                            </div>
                        <?php } ?>
                    </div>

                    <div class=" col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                        <h2 class="attributes-single-product">Descripcion</h2>
                        <?php
                            // Mostramos el contenido del post
                            the_content();
                        ?>
                        <h2 class="attributes-single-product">Precio (€)</h2>
                        <?php
                            // Mostrar el precio del producto
                            echo '<p>' . get_post_meta(get_the_ID(), 'precio', true) . '</p>';
                        ?>
                        <h2 class="attributes-single-product">Tallas</h2>
                        <?php
                            // Mostrar las tallas del producto
                            $sizes = wp_get_post_terms(get_the_ID(), 'Sizes');
                            if ($sizes) {
                                echo '<form class="form-sizes">';
                                foreach ($sizes as $size) {
                                    echo '<label class="label-sizes">';
                                        echo '<input class="input-sizes" type="radio" name="size" value="' . $size->slug . '">';
                                        echo '<span class="size-name">' . $size->name . '</span>';
                                    echo '</label><br>';
                                }
                                echo '</form>';
                            } else {
                                echo '<p>No hay tallas disponibles para este producto.</p>';
                            }
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