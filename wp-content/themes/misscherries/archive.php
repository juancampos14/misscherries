<?php

get_header();

?>
<main>
    <?php
    $taxonomy = 'Product_categories';

    // Verificar si la página actual es una categoría de productos
    $current_term = get_queried_object();

    // Si es una categoría principal, mostrar subcategorías
    if ($current_term->parent == 0) {
        $subcategories = get_terms(array(
            'taxonomy' => $taxonomy,
            'parent' => $current_term->term_id,
            'hide_empty' => false,
        ));
        ?>
        <h2 class="title-product"><?php echo $current_term->name; ?></h2>
        <div class="row display-card">
            <?php foreach ($subcategories as $subcategory) : ?>
                <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                    <div class="block-card">
                        <a href="<?php echo esc_attr(get_term_link($subcategory, $taxonomy)); ?>">
                            <div class="img-card">
                                <?php
                                $id_image = get_field('imagen-taxonomy', $subcategory);
                                echo wp_get_attachment_image($id_image, 'full', false, ['class' => 'img-item imagen-taxonomy']);
                                ?>
                            </div>
                            <div class="text-block-card">
                                <div class="div1-card">
                                    <div class="div2-card">
                                        <p class="card-text"><?php echo $subcategory->name; ?></p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php } else { // Si es una subcategoría, mostrar productos
        ?>
        <h2 class="title-product"><?php echo $current_term->name; ?></h2>
        <div class="container">
            <div class="row">
                <?php
                $args = array(
                    'post_type' => 'product',
                    'posts_per_page' => -1,
                    'tax_query' => array(
                        array(
                            'taxonomy' => $taxonomy,
                            'field' => 'id',
                            'terms' => $current_term->term_id,
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
                                            the_post_thumbnail('full', array('class' => 'img-item', 'alt' => get_the_title()));
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
                endif;

                wp_reset_postdata();
                ?>
            </div>
        </div>
    <?php } ?>
</main>
<?php
get_footer();
