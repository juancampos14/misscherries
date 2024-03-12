<?php

get_header();

?>
<main class="main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <?php
                // Comprobamos si hay posts
                if (have_posts()) :
                    // Mostramos el post actual
                    the_post();
                ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                        <header class="entry-header">
                            <h1 class="entry-title"><?php the_title(); ?></h1>
                        </header><!-- .entry-header -->

                        <div class="entry-content">
                            <?php
                            // Mostramos el contenido del post
                            the_content();
                            ?>
                        </div><!-- .entry-content -->

                        <footer class="entry-footer">
                            <?php
                            // Aquí puedes mostrar precio, descripción, etc.
                            ?>
                        </footer><!-- .entry-footer -->
                    </article><!-- #post-<?php the_ID(); ?> -->
                <?php
                endif;
                ?>
            </div><!-- .col-md-8 -->

            <div class="col-md-4">
                <?php
                // Puedes mostrar widgets, productos relacionados, u otra información en la barra lateral
                ?>
            </div><!-- .col-md-4 -->
        </div><!-- .row -->
    </div><!-- .container -->
</main><!-- #main-content -->
<?php
get_footer();