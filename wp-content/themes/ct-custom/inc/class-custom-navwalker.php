<?php
class Custom_Nav_Walker extends Walker_Nav_Menu {
    // Start level
    function start_lvl(&$output, $depth = 0, $args = array()) {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul class=\"dropdown-menu\">\n";
    }

    // Start element
    function start_el(&$output, $item, $depth = 0, $args = [], $id = 0) {
        $classes = empty($item->classes) ? array() : (array) $item->classes;

        $has_children = in_array('menu-item-has-children', $classes);

        $class_names = 'nav-item';
        if ($has_children) {
            $class_names .= ' dropdown';
            if ($depth > 0) {
                $class_names .= ' dropdown-submenu';
            }
        }

        $output .= "<li class=\"$class_names\">";

        $atts = [
            'href' => !empty($item->url) ? $item->url : '#',
            'class' => $depth === 0 ? 'nav-link' : 'dropdown-item',
            'target' => '_blank'
        ];

        if ($has_children && $depth === 0) {
            $atts['class'] .= ' dropdown-toggle';
            $atts['data-bs-toggle'] = 'dropdown';
        } elseif ($has_children && $depth > 0) {
            $atts['class'] .= ' dropdown-toggle';
        }

        $attributes = '';
        foreach ($atts as $attr => $value) {
            if (!empty($value)) {
                $value = esc_attr($value);
                $attributes .= " $attr=\"$value\"";
            }
        }

        $title = apply_filters('the_title', $item->title, $item->ID);
        $output .= "<a{$attributes}><span>{$title}</span></a>";
    }

    function end_el(&$output, $item, $depth = 0, $args = []) {
        $output .= "</li>\n";
    }

    function end_lvl(&$output, $depth = 0, $args = array()) {
        $output .= "</ul>\n";
    }
}