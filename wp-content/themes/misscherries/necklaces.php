<?php
get_header();
?>

<main>
    <div class="container">
        <div class="row">
            <?php
            // Consulta personalizada para obtener solo los productos de la categoría "Collares"
            $args = array(
                'post_type' => 'product', // Tipo de publicación de tus productos
                'posts_per_page' => -1,   // Mostrar todos los productos de la categoría
                'tax_query' => array(
                    array(
                        'taxonomy' => 'product_category', // Taxonomía de categoría de producto
                        'field' => 'slug',
                        'terms' => 'collares', // Slug de la categoría "Collares"
                    ),
                ),
            );

            $query = new WP_Query($args);

            if ($query->have_posts()) :
                while ($query->have_posts()) : $query->the_post();
            ?>
                    <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                        <div class="block-card">
                            <div class="img-card">
                                <a href="<?php the_permalink(); ?>">
                                    <?php
                                    if (has_post_thumbnail()) {
                                        the_post_thumbnail('thumbnail', array('class' => 'img-item', 'alt' => get_the_title()));
                                    }
                                    ?>
                                </a>
                            </div>
                            <div class="text-block-card">
                                <div class="div1-card">
                                    <div class="div2-card">
                                        <p class="card-text"><?php the_title(); ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            <?php
                endwhile;
            else :
                echo 'No hay productos en esta categoría.';
            endif;

            // Restaurar consulta original de WordPress
            wp_reset_postdata();
            ?>
        </div>
    </div>
</main>

<?php
get_footer();
?>
