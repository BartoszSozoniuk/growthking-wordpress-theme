<?php
/**
 * GrowthKing functions and definitions
 *
 * @package GrowthKing
 */

// Zabezpieczenie przed bezpośrednim dostępem
if (!defined('ABSPATH')) {
    exit;
}

// Stałe motywu
define('GK_THEME_DIR', get_template_directory());
define('GK_THEME_URI', get_template_directory_uri());
define('GK_THEME_VERSION', '1.0.0');

/**
 * Rejestracja menu
 */
function growthking_register_menus() {
    register_nav_menus(array(
        'primary' => esc_html__('Menu główne', 'growthking'),
        'footer_menu' => esc_html__('Menu w stopce', 'growthking'),
    ));
}
add_action('init', 'growthking_register_menus');

/**
 * Dodanie obsługi miniatur wpisów
 */
function growthking_setup() {
    add_theme_support('post-thumbnails');
    add_theme_support('title-tag');
    add_theme_support('custom-logo', array(
        'height'      => 100,
        'width'       => 250,
        'flex-width'  => true,
        'flex-height' => true,
    ));
}
add_action('after_setup_theme', 'growthking_setup');

/**
 * Rejestracja skryptów i stylów
 */
function growthking_scripts() {
    // Style
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Space+Grotesk:wght@300;400;500;600;700&display=swap', array(), null);
    wp_enqueue_style('growthking-style', get_stylesheet_uri(), array(), GK_THEME_VERSION);
    wp_enqueue_style('growthking-main', GK_THEME_URI . '/assets/css/main.css', array(), GK_THEME_VERSION);

    // Skrypty
    wp_enqueue_script('calendly', 'https://assets.calendly.com/assets/external/widget.js', array(), null, true);
    wp_enqueue_script('growthking-main', GK_THEME_URI . '/assets/js/main.js', array('jquery'), GK_THEME_VERSION, true);
    
    // Przekaż zmienne do JS
    wp_localize_script('growthking-main', 'growthkingData', array(
        'ajaxurl' => admin_url('admin-ajax.php'),
    ));
}
add_action('wp_enqueue_scripts', 'growthking_scripts');

/**
 * Includowanie pliku customizer
 */
require GK_THEME_DIR . '/inc/customizer.php';

/**
 * Menu Walker
 */
require GK_THEME_DIR . '/inc/class-growthking-nav-walker.php';

/**
 * Funkcje pomocnicze
 */
function gk_get_logo() {
    if (has_custom_logo()) {
        return get_custom_logo();
    } else {
        return '<a href="' . esc_url(home_url('/')) . '" class="logo">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M5 16L3 5L8.5 10L12 4L15.5 10L21 5L19 16H5Z" fill="#0055FF"/>
                <path d="M5 16V18C5 19.1046 5.89543 20 7 20H17C18.1046 20 19 19.1046 19 18V16H5Z" fill="#FF6B00"/>
            </svg>
            Growth<span>King</span>.ai
        </a>';
    }
}
