<?php

add_filter('wp_enqueue_scripts', function () {
    $stylesheet_directory_uri = get_stylesheet_directory_uri();
    $main_style_deps = array();
    if (file_exists(get_stylesheet_directory() . '/dist/css/vendor.css')) {
        wp_enqueue_style(
            MISSCHERRIES_THEME_SLUG . '/css/vendor',
            "{$stylesheet_directory_uri}/dist/css/vendor.css",
            array(),
            MISSCHERRIES_THEME_STYLES_VERSION
        );
        $main_style_deps[] = MISSCHERRIES_THEME_SLUG . '/css/vendor';
    }
    wp_enqueue_style(
        MISSCHERRIES_THEME_SLUG . '/css/main',
        "{$stylesheet_directory_uri}/dist/css/main.css",
        $main_style_deps,
        MISSCHERRIES_THEME_STYLES_VERSION
    );
    wp_enqueue_script(
        MISSCHERRIES_THEME_SLUG . '/js/main',
        "{$stylesheet_directory_uri}/dist/js/main.min.js",
        array('jquery'),
        MISSCHERRIES_THEME_SCRIPTS_VERSION,
        true
    );
    wp_localize_script(
        MISSCHERRIES_THEME_SLUG . '/js/main',
        'theme_data',
        array(
            'ajax_url' => admin_url('admin-ajax.php'),
            'site_url' => site_url(),
        )
    );
});

add_filter('admin_enqueue_scripts', function () {
    $stylesheet_directory_uri = get_stylesheet_directory_uri();
    if (file_exists(get_stylesheet_directory() . '/dist/js/admin.css')) {
        wp_enqueue_style(
            MISSCHERRIES_THEME_SLUG . '/admin',
            $stylesheet_directory_uri . '/dist/css/admin.css',
            array()
        );
    }
    if (file_exists(get_stylesheet_directory() . '/dist/js/admin.min.js')) {
        wp_enqueue_script(
            MISSCHERRIES_THEME_SLUG . '/admin-scripts',
            $stylesheet_directory_uri . '/dist/js/admin.min.js',
            array('jquery'),
            MISSCHERRIES_THEME_STYLES_VERSION,
            true
        );
        wp_localize_script(
            MISSCHERRIES_THEME_SLUG . '/admin-scripts',
            'admin_theme_data',
            array(
                'ajax_url' => admin_url('admin-ajax.php'),
                'site_url' => site_url(),
            )
        );
    }
});

add_filter('login_enqueue_scripts', function () {
    $stylesheet_directory_uri = get_stylesheet_directory_uri();
    if (file_exists(get_stylesheet_directory() . '/dist/js/login.css')) {
        wp_enqueue_style(MISSCHERRIES_THEME_SLUG . '/login', get_stylesheet_directory_uri() . '/dist/css/login.css', array());
    }
    if (file_exists(get_stylesheet_directory() . '/dist/js/login.min.js')) {
        wp_enqueue_script(
            MISSCHERRIES_THEME_SLUG . '/login-scripts',
            get_stylesheet_directory_uri() . '/dist/js/login.min.js',
            array('jquery'),
            MISSCHERRIES_THEME_STYLES_VERSION,
            true
        );
        wp_localize_script(MISSCHERRIES_THEME_SLUG . '/login-scripts', 'login_theme_data', array(
            'ajax_url' => admin_url('admin-ajax.php'),
            'site_url' => site_url(),
        ));
    }
});
