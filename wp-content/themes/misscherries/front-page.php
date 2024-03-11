<?php

get_header();

?>
<main>
            <section class="section-homepage">
                <div class="owl-container">
                    <div class="owl-carousel owl-theme">
                        <?php 
                            $images = get_field('galery-index');
                            if( $images ): ?>
                                <?php foreach( $images as $image_id ): ?>
                                    <div class="item">
                                        <?php echo wp_get_attachment_image( $image_id,'medium',false, ['class' => 'img-index'] ); ?>
                                    </div>
                                <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </section>
            <section class="section-homepage section-cards items1">
                <div class="container">
                    <!-- <img src="img/flor.svg" class="img-flower" alt="imagen_flor" >-->
                    <?php
                            // Nombre de la taxonomía
                            $taxonomy = 'Product_categories';
                            // Obtener los términos de la taxonomía, es decir, aqui es donde cargamos todos los terminos
                            $tax_terms = get_terms( array(
                                'taxonomy' => $taxonomy,
                                'parent'   => 0, // Obtener solo los términos que no tienen padres
                                'orderby'  => 'ID',
                                'order'    => 'ASC',
                            ) );
                    ?>
                    <div class="row display-card">
                        <?php foreach ($tax_terms as $tax_term) : //inicio de bucle foreach que itera sobre cada término recuperadno la variable tax_term ?> 
                            <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                                <div class="block-card">
                                    <a href="<?php echo esc_attr( get_term_link( $tax_term, $taxonomy ) ); //se obtiene la URL del termino actual del bucle?>" title="<?php echo $tax_term->name; ?>">
                                        <div class="img-card">
                                            <?php
                                                $id_image=get_field('imagen-taxonomy', $tax_term); //obtiene la imagen con la funcion get_field de acf
                                                echo wp_get_attachment_image($id_image,'full',false,[ 'class' => 'img-item imagen-taxonomy' ] );//muestra la imagen asociada al termino actual, la funcion es similar a la etiqueta <img> y usamos la id, ya que en wp esta configurado asi
                                            ?>
                                        </div>
                                        <div class="card-footer">
                                            <div class="background-footer-block1-card">
                                                <div class="background-footer-block2-card">
                                                    <p class="text-footer-card"><?php echo $tax_term->name; ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </section>
        </main>

<?php
get_footer();