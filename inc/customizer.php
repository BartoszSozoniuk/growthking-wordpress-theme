<?php
/**
 * GrowthKing Theme Customizer
 *
 * @package GrowthKing
 */

// Zabezpieczenie przed bezpośrednim dostępem do pliku
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Funkcja rejestrująca opcje Customizera
 */
function growthking_customize_register( $wp_customize ) {

    /**
     * Sekcja: Kolory motywu
     */
    $wp_customize->add_section( 'growthking_colors', array(
        'title'       => __( 'Kolory motywu', 'growthking' ),
        'priority'    => 30,
    ) );

    // Kolor podstawowy niebieski
    $wp_customize->add_setting( 'growthking_primary_blue', array(
        'default'     => '#0055FF',
        'transport'   => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'growthking_primary_blue', array(
        'label'       => __( 'Kolor podstawowy (niebieski)', 'growthking' ),
        'section'     => 'growthking_colors',
        'settings'    => 'growthking_primary_blue',
    ) ) );

    // Kolor podstawowy pomarańczowy
    $wp_customize->add_setting( 'growthking_primary_orange', array(
        'default'     => '#FF6B00',
        'transport'   => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'growthking_primary_orange', array(
        'label'       => __( 'Kolor akcentowy (pomarańczowy)', 'growthking' ),
        'section'     => 'growthking_colors',
        'settings'    => 'growthking_primary_orange',
    ) ) );

    // Kolor tła ciemnego
    $wp_customize->add_setting( 'growthking_dark_bg', array(
        'default'     => '#0C1828',
        'transport'   => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'growthking_dark_bg', array(
        'label'       => __( 'Kolor tła ciemnego', 'growthking' ),
        'section'     => 'growthking_colors',
        'settings'    => 'growthking_dark_bg',
    ) ) );

    /**
     * Sekcja: Ustawienia nagłówka
     */
    $wp_customize->add_section( 'growthking_header', array(
        'title'       => __( 'Ustawienia nagłówka', 'growthking' ),
        'priority'    => 40,
    ) );

    // Tekst przycisku CTA
    $wp_customize->add_setting( 'growthking_cta_button_text', array(
        'default'     => 'Bezpłatna konsultacja',
        'transport'   => 'refresh',
        'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( 'growthking_cta_button_text', array(
        'label'       => __( 'Tekst przycisku CTA', 'growthking' ),
        'section'     => 'growthking_header',
        'type'        => 'text',
    ) );

    // Link przycisku CTA
    $wp_customize->add_setting( 'growthking_cta_button_url', array(
        'default'     => '#',
        'transport'   => 'refresh',
        'sanitize_callback' => 'esc_url_raw',
    ) );

    $wp_customize->add_control( 'growthking_cta_button_url', array(
        'label'       => __( 'Link przycisku CTA', 'growthking' ),
        'section'     => 'growthking_header',
        'type'        => 'url',
    ) );

    /**
     * Sekcja: Integracja z Klaviyo
     */
    $wp_customize->add_section( 'growthking_klaviyo', array(
        'title'       => __( 'Integracja z Klaviyo', 'growthking' ),
        'priority'    => 50,
    ) );

    // ID Formularza Klaviyo
    $wp_customize->add_setting( 'growthking_klaviyo_form_id', array(
        'default'     => '',
        'transport'   => 'refresh',
        'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( 'growthking_klaviyo_form_id', array(
        'label'       => __( 'ID formularza Klaviyo', 'growthking' ),
        'description' => __( 'Wprowadź ID formularza Klaviyo, np. UaKvrN', 'growthking' ),
        'section'     => 'growthking_klaviyo',
        'type'        => 'text',
    ) );

    /**
     * Sekcja: Media społecznościowe
     */
    $wp_customize->add_section( 'growthking_social', array(
        'title'       => __( 'Media społecznościowe', 'growthking' ),
        'priority'    => 60,
    ) );

    // Facebook
    $wp_customize->add_setting( 'growthking_facebook', array(
        'default'     => '',
        'transport'   => 'refresh',
        'sanitize_callback' => 'esc_url_raw',
    ) );

    $wp_customize->add_control( 'growthking_facebook', array(
        'label'       => __( 'Facebook URL', 'growthking' ),
        'section'     => 'growthking_social',
        'type'        => 'url',
    ) );

    // Twitter
    $wp_customize->add_setting( 'growthking_twitter', array(
        'default'     => '',
        'transport'   => 'refresh',
        'sanitize_callback' => 'esc_url_raw',
    ) );

    $wp_customize->add_control( 'growthking_twitter', array(
        'label'       => __( 'Twitter URL', 'growthking' ),
        'section'     => 'growthking_social',
        'type'        => 'url',
    ) );

    // LinkedIn
    $wp_customize->add_setting( 'growthking_linkedin', array(
        'default'     => '',
        'transport'   => 'refresh',
        'sanitize_callback' => 'esc_url_raw',
    ) );

    $wp_customize->add_control( 'growthking_linkedin', array(
        'label'       => __( 'LinkedIn URL', 'growthking' ),
        'section'     => 'growthking_social',
        'type'        => 'url',
    ) );

    // Instagram
    $wp_customize->add_setting( 'growthking_instagram', array(
        'default'     => '',
        'transport'   => 'refresh',
        'sanitize_callback' => 'esc_url_raw',
    ) );

    $wp_customize->add_control( 'growthking_instagram', array(
        'label'       => __( 'Instagram URL', 'growthking' ),
        'section'     => 'growthking_social',
        'type'        => 'url',
    ) );

    /**
     * Sekcja: Ustawienia stopki
     */
    $wp_customize->add_section( 'growthking_footer', array(
        'title'       => __( 'Ustawienia stopki', 'growthking' ),
        'priority'    => 70,
    ) );

    // Email kontaktowy
    $wp_customize->add_setting( 'growthking_contact_email', array(
        'default'     => 'kontakt@growthking.ai',
        'transport'   => 'refresh',
        'sanitize_callback' => 'sanitize_email',
    ) );

    $wp_customize->add_control( 'growthking_contact_email', array(
        'label'       => __( 'Email kontaktowy', 'growthking' ),
        'section'     => 'growthking_footer',
        'type'        => 'email',
    ) );

    // Numer telefonu
    $wp_customize->add_setting( 'growthking_contact_phone', array(
        'default'     => '+48 123 456 789',
        'transport'   => 'refresh',
        'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( 'growthking_contact_phone', array(
        'label'       => __( 'Numer telefonu', 'growthking' ),
        'section'     => 'growthking_footer',
        'type'        => 'text',
    ) );

    // Adres
    $wp_customize->add_setting( 'growthking_contact_address', array(
        'default'     => 'Warszawa, Polska',
        'transport'   => 'refresh',
        'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( 'growthking_contact_address', array(
        'label'       => __( 'Adres', 'growthking' ),
        'section'     => 'growthking_footer',
        'type'        => 'text',
    ) );

    // Tekst praw autorskich
    $wp_customize->add_setting( 'growthking_copyright_text', array(
        'default'     => '© ' . date('Y') . ' GrowthKing.ai - Wszystkie prawa zastrzeżone',
        'transport'   => 'refresh',
        'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( 'growthking_copyright_text', array(
        'label'       => __( 'Tekst praw autorskich', 'growthking' ),
        'section'     => 'growthking_footer',
        'type'        => 'text',
    ) );
}
add_action( 'customize_register', 'growthking_customize_register' );

/**
 * Generuje dynamiczny CSS na podstawie ustawień Customizera
 */
function growthking_customizer_css() {
    ?>
    <style type="text/css">
        :root {
            --primary-blue: <?php echo esc_attr( get_theme_mod( 'growthking_primary_blue', '#0055FF' ) ); ?>;
            --primary-orange: <?php echo esc_attr( get_theme_mod( 'growthking_primary_orange', '#FF6B00' ) ); ?>;
            --primary-dark: <?php echo esc_attr( get_theme_mod( 'growthking_dark_bg', '#0C1828' ) ); ?>;
        }
    </style>
    <?php
}
add_action( 'wp_head', 'growthking_customizer_css' );

/**
 * Funkcja do uzyskiwania wartości opcji z customizera
 */
function gk_theme_option($option_name, $default = '') {
    return get_theme_mod($option_name, $default);
}
