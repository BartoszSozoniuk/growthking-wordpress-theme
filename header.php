<?php
/**
 * Główny plik nagłówka motywu
 *
 * @package GrowthKing
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>👑</text></svg>">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

    <!-- Header -->
    <header class="header">
        <div class="container header-container">
            <?php echo gk_get_logo(); ?>
            
            <nav class="nav-links">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'primary',
                    'container'      => false,
                    'menu_class'     => 'nav-menu',
                    'walker'         => new GrowthKing_Nav_Walker(),
                    'fallback_cb'    => false,
                ));
                ?>
                <a href="<?php echo esc_url(get_theme_mod('growthking_cta_button_url', '#')); ?>" class="btn btn-primary nav-button">
                    <?php echo esc_html(get_theme_mod('growthking_cta_button_text', 'Bezpłatna konsultacja')); ?>
                </a>
            </nav>
            <button class="mobile-menu-btn">☰</button>
        </div>
    </header>
