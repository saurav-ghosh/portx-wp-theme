<?php

// Modified Walker Class to Match Your HTML Structure
class bootstrap_5_wp_nav_menu_walker extends Walker_Nav_Menu
{
  private $current_item;

  function start_lvl(&$output, $depth = 0, $args = null)
  {
    $indent = str_repeat("\t", $depth);
    
    // Check if parent has homemenu structure (for HOME dropdown)
    if ($this->current_item && strpos(strtolower($this->current_item->title), 'home') !== false) {
      $output .= "\n$indent<div class=\"tp-submenu submenu has-homemenu\">\n";
      $output .= "$indent\t<div class=\"row gx-6 row-cols-1 row-cols-md-2 row-cols-xl-3\">\n";
    } else {
      // Regular dropdown structure
      $output .= "\n$indent<ul class=\"tp-submenu\">\n";
    }
  }

  function end_lvl(&$output, $depth = 0, $args = null)
  {
    $indent = str_repeat("\t", $depth);
    
    // Check if parent has homemenu structure
    if ($this->current_item && strpos(strtolower($this->current_item->title), 'home') !== false) {
      $output .= "$indent\t</div>\n";
      $output .= "$indent</div>\n";
    } else {
      $output .= "$indent</ul>\n";
    }
  }

  function start_el(&$output, $item, $depth = 0, $args = null, $id = 0)
  {
    if ($depth === 0) {
      $this->current_item = $item;
    }
    
    $indent = ($depth) ? str_repeat("\t", $depth) : '';

    $classes = empty($item->classes) ? array() : (array) $item->classes;

    // Add "has-dropdown" class for parent items instead of "menu-item-has-children"
    if ($args->walker->has_children && $depth === 0) {
      $classes[] = 'has-dropdown';
    }

    // Special handling for home submenu items
    $parent_item = ($depth > 0 && $this->current_item) ? $this->current_item : null;
    $is_home_submenu = $parent_item && strpos(strtolower($parent_item->title), 'home') !== false;
    
    if ($is_home_submenu) {
      $classes[] = 'col';
      $classes[] = 'homemenu';
    }

    $class_names = join(' ', array_filter($classes));
    $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';

    $id_attr = 'menu-item-' . $item->ID;
    $id_attr = strlen($id_attr) ? ' id="' . esc_attr($id_attr) . '"' : '';

    // Use div for home submenu items, li for others
    $tag = $is_home_submenu ? 'div' : 'li';
    $output .= $indent . '<' . $tag . $id_attr . $class_names . '>';

    // Build the link and content
    $attributes  = !empty($item->attr_title) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
    $attributes .= !empty($item->target)     ? ' target="' . esc_attr($item->target) . '"' : '';
    $attributes .= !empty($item->xfn)        ? ' rel="' . esc_attr($item->xfn) . '"' : '';
    $attributes .= !empty($item->url)        ? ' href="' . esc_attr($item->url) . '"' : '';

    $item_output = $args->before;

    if ($is_home_submenu) {
      // Special structure for home menu items
      $item_output .= '<div class="homemenu-thumb mb-15">';
      
      // You'll need to add custom fields or logic to get the thumbnail image
      $thumbnail = get_post_meta($item->ID, '_menu_item_thumbnail', true);
      if ($thumbnail) {
        $item_output .= '<img src="' . esc_url($thumbnail) . '" alt="">';
      } else {
        $item_output .= '<img src="assets/img/menu/home-1.jpg" alt="">'; // Default image
      }
      
      $item_output .= '<div class="homemenu-btn">';
      $item_output .= '<a class="tp-menu-btn"' . $attributes . '>View Demo</a>';
      $item_output .= '</div></div>';
      
      $item_output .= '<div class="homemenu-content text-center">';
      $item_output .= '<h4 class="homemenu-title">';
      $item_output .= '<a' . $attributes . '>';
      $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
      $item_output .= '</a></h4></div>';
    } else {
      // Regular menu item structure
      $item_output .= '<a' . $attributes . '>';
      $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
      $item_output .= '</a>';
    }

    $item_output .= $args->after;

    $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
  }

  function end_el(&$output, $item, $depth = 0, $args = null)
  {
    // Determine if this is a home submenu item
    $parent_item = ($depth > 0 && $this->current_item) ? $this->current_item : null;
    $is_home_submenu = $parent_item && strpos(strtolower($parent_item->title), 'home') !== false;
    
    $tag = $is_home_submenu ? 'div' : 'li';
    $output .= "</$tag>\n";
  }
}