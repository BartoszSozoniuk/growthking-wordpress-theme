<?php
/**
 * GrowthKing Nav Walker
 *
 * Klasa do tworzenia niestandardowej nawigacji w motywie
 *
 * @package GrowthKing
 */

// Zabezpieczenie przed bezpośrednim dostępem
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Custom Walker dla menu nawigacyjnego
 */
class GrowthKing_Nav_Walker extends Walker_Nav_Menu {

    /**
     * Starts the element output.
     *
     * @param string   $output Used to append additional content (passed by reference).
     * @param WP_Post  $item   Menu item data object.
     * @param int      $depth  Depth of menu item.
     * @param stdClass $args   An object of wp_nav_menu() arguments.
     * @param int      $id     Current item ID.
     */
    function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
        if (isset($args->item_spacing) && 'discard' === $args->item_spacing) {
            $t = '';
            $n = '';
        } else {
            $t = "\t";
            $n = "\n";
        }
        $indent = ($depth) ? str_repeat($t, $depth) : '';

        $classes = empty($item->classes) ? array() : (array) $item->classes;
        $classes[] = 'nav-link';
        
        // Active class
        if (in_array('current-menu-item', $classes)) {
            $classes[] = 'active';
        }

        /**
         * Filters the arguments for a single nav menu item.
         */
        $args = apply_filters('nav_menu_item_args', $args, $item, $depth);

        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args, $depth));
        $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';
        
        $id = apply_filters('nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args, $depth);
        $id = $id ? ' id="' . esc_attr($id) . '"' : '';

        $output .= $indent . '<a' . $id . $class_names . ' href="' . esc_url($item->url) . '">';

        $atts = array();
        $atts['title']  = !empty($item->attr_title) ? $item->attr_title : '';
        $atts['target'] = !empty($item->target) ? $item->target : '';
        $atts['rel']    = !empty($item->xfn) ? $item->xfn : '';
        $atts['href']   = !empty($item->url) ? $item->url : '';

        /**
         * Filters the HTML attributes applied to a menu item's anchor element.
         */
        $atts = apply_filters('nav_menu_link_attributes', $atts, $item, $args, $depth);

        // Nawigacja - nie używamy tutaj atrybutów, wszystko jest umieszczone już przy tagu <a>

        $title = apply_filters('the_title', $item->title, $item->ID);
        $title = apply_filters('nav_menu_item_title', $title, $item, $args, $depth);

        $item_output = $args->before;
        $item_output .= $title;
        $item_output .= $args->after;

        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
        
        // Każdy element menu jest linkiem, więc kończymy jego tag po przetworzeniu jego zawartości
        $output .= '</a>';
    }

    /**
     * Kończy element.
     *
     * Nie dodajemy żadnych wrapperów, więc zostawiamy pustą implementację.
     */
    function end_el(&$output, $item, $depth = 0, $args = array()) {
        // Nie ma potrzeby zamykać elementu, ponieważ został już zamknięty w start_el
        $output .= "\n";
    }

    /**
     * Starts the list before the elements are added.
     *
     * Ponieważ nie używamy list (ul/li), nadpisujemy tę metodę, aby nic nie wstawiała.
     */
    function start_lvl(&$output, $depth = 0, $args = array()) {
        // Nie implementujemy submenu w tym motywie
    }

    /**
     * Ends the list of after the elements are added.
     *
     * Ponieważ nie używamy list (ul/li), nadpisujemy tę metodę, aby nic nie wstawiała.
     */
    function end_lvl(&$output, $depth = 0, $args = array()) {
        // Nie implementujemy submenu w tym motywie
    }
}
