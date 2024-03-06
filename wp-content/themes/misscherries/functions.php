<?php

$required_files = [
    'core/helpers.loader.php',
    'inc/config/definitions.php',
    'inc/config/theme-config.php',
];

foreach ($required_files as $required_file) {
    require_once(trailingslashit(get_stylesheet_directory()) . $required_file);
}

function register_my_menus() {
    register_nav_menus(
        array(
            'menu-footer' => __('Menu Footer'),
            'menu_header' => __('Menu Cabecera'),
            'container_class' => 'my_extra_menu_class'
        )
    );
}
add_action( 'init', 'register_my_menus' );

function themename_custom_logo_setup() {
	$defaults = array(
		'height'               => 100,
		'width'                => 400,
		'flex-height'          => true,
		'flex-width'           => true,
		'header-text'          => array( 'site-title', 'site-description' ),
		'unlink-homepage-logo' => true, 
	);
	add_theme_support( 'custom-logo', $defaults );
}
add_action( 'after_setup_theme', 'themename_custom_logo_setup' );

function first_div_container() {
    echo '<div class="container">
            <p>Miss Cherries nació para acompañar a la mujer en su empoderamiento y honrar su belleza auténtica con un toque original, elegante y divertido. De diseño vanguardista, 
                todas nuestras piezas son hipoalergénicas y están elaboradas en Plata de Ley 925 con baño de rodio y oro.
            </p>
            <h3>COMPRA DE FORMA SEGURA - ENVÍO GRATUITO A PARTIR DE 20 € - ENTREGA EN 24/48 H</h3>
            <button class="buttom-text-white">#MISSCHERRIES</button>
        </div>';
}

function text_email() {
    echo '<h3>MISS CHERIES SOCIAL CLUB</h3>
            <p> ¿Te gusta explorar nuevas tendencias y enterarte a tiempo de las ofertas exclusivas?
                Intriduce tu email y te enviaremos newsletters con las novedades.
                Compartimos nuestra pasión por la moda.
            </p>';
}

add_action ('init','custom_post_product');

function custom_post_product(){
    $labels = array(
        'name'                  => __('Products'),
        'singular_name'         => __('Custom_products'),
        'add_new'               => __('Añadir Nuevo Producto'),
        'add_new_item'          => __('Añadir nuevo producto'),
        'edit_item'             => __('Custom_products_edit_item'),
        'new_item'              => __('Custom_products_new_item'),
        'all_items'             => __('Tipos de productos'),
        'view_item'             => __('Custom_products_view_item'),
        'search_items'          => __('Buscar en todos nuestros productos'),
        'featured_image'        => 'Poster',
        'set_feature_image'     => 'Add Poster'
    );

    $args =array(
        'labels'                => $labels,
        'description'           => __('Tipos de productos que tenemos en misscherries'),
        'public'                => true,
        'menu_position'         => 5,
        'supports'              => array ('title', 'editor', 'thumbnail'),
        'has_archive'           => true,
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'query_var'             => true,
    );

    register_post_type('product',$args);
}


add_action( 'init', 'custom_product_taxonomies' );

function custom_product_taxonomies() {
    register_taxonomy(
        'Product_categories',
        'product',
        array(
            'labels' => array(
                'name'              => __( 'Product categories' ),
                'singular_name'     => __( 'Product categories' ),
                'search_items'      => __( 'Buscar Categoria' ),
                'all_items'         => __( 'Todas las categorias' ),
                'edit_item'         => __( 'Editar categoria' ),
                'update_item'       => __( 'Actualizar categoria' ),
                'add_new_item'      => __( 'Añadir nueva Categoria' ),
                'new_item_name'     => __( 'Nuevo nombre de la categoria' ),
                'menu_name'         => __( 'Product categories' ),
            ),
            'public'            => true,
            'hierarchical'      => true,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'rewrite'           => array( 'slug' => 'product_category' ),
        )
    );

}

function make_title()
{
    $title = '';
    $sitename = get_bloginfo("name");
    $maxlength = 60;
    $maxlength = $maxlength - strlen($sitename) - 3;

    // Título estático para la página principal
    if (is_front_page() || is_home()) {
        echo "Misscherries";
        return;
    }

    // title of article or page
    if (is_page() || is_single()) {
        $title = get_the_title();
    }

    // title of category
    if (is_category()) {
        $title = single_cat_title('', false);
    }

    // clean title
    $title = strip_tags($title);
    $title = trim($title);

    // limit title to max characters
    if (strlen($title) > $maxlength) {
        $subtext = substr($title, 0, $maxlength - 3);
        $endspace = strrpos($subtext, ' ');
        $title = substr($subtext, 0, $endspace) . '...';
    }

    // aqui se comprueba si la variable title esta vacia o no , si no esta vacia quiere decir que entro en page, single o category
    if (!empty($title)) {
        $title = $title . " | " . $sitename;
    } else {
        $title = $sitename;
    }
    
    echo $title;
}

function make_description()
{
    $maxlength = 160;
    $description = get_bloginfo("description");

    if (is_front_page() || is_home()) {
        echo "En esta pagina podemos encontrar las mejores joyas de una excelente calidad y con el mejor precio";
        return;
    }
    // description of article or page
    if (is_page() || is_single()) {
        $description = get_the_excerpt();
    }

    // description of category
    if (is_category()) {
        $description = category_description();
    }

    // clean description
    $description = strip_tags($description);
    $description = trim($description);

    // limit description to max characters
    if (strlen($description) > $maxlength) {
        $subtext = substr($description, 0, $maxlength - 3);
        $endspace = strrpos($subtext, ' ');
        $description = substr($subtext, 0, $endspace) . '...';
    }

    echo $description;
}
