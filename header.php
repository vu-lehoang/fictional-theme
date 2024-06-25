<?php

/**
 * Header Template file
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Thêm các tập tin css js -->
    <?php wp_head(); ?>
</head>

<?php
// Lấy ID của menu chính (primary-menu)
$locations = get_nav_menu_locations();
$menu_id = $locations['primary-menu'];

// Lấy danh sách các mục menu từ menu có ID là $menu_id
$menu_items = wp_get_nav_menu_items($menu_id);

// Tạo mảng để lưu các mục menu cha và con
$parent_menus = [];
$submenu_items = [];

// Duyệt qua tất cả các mục menu
foreach ($menu_items as $item) {
    // Nếu item là mục menu cha (không có parent)
    if ($item->menu_item_parent == 0) {
        $parent_menus[$item->ID] = $item;
    } else {
        // Nếu item là mục menu con
        $submenu_items[$item->menu_item_parent][] = $item;
    }
}

?>

<body <?php body_class(); ?>>
    <header class="site-header">
        <div class="container">
            <h1 class="school-logo-text float-left">
                <a href="<?= home_url(); ?>"><strong>Fictional</strong> University</a>
            </h1>
            <span class="js-search-trigger site-header__search-trigger"><i class="fa fa-search" aria-hidden="true"></i></span>
            <i class="site-header__menu-trigger fa fa-bars" aria-hidden="true"></i>
            <div class="site-header__menu group">
                <!-- Begin Nav menu -->
                <?php if ($menu_items) : ?>
                    <nav class="main-navigation">
                        <ul>
                            <?php // Hiển thị các mục menu cha và con
                            foreach ($parent_menus as $parent) {

                                $parent_class = 'curren-menu-item';


                                if (get_post_type() == 'post' && $parent->title === 'Blog') {
                                    echo '<li class="parent-menu-item current-menu-item">';
                                } elseif (get_post_type() == 'event' && $parent->title === 'Events') {
                                    echo '<li class="parent-menu-item current-menu-item">';
                                } else {
                                    echo '<li class="parent-menu-item">';
                                }


                                echo '<a href="' . esc_url($parent->url) . '">' . esc_html($parent->title) . '</a>';

                                // Kiểm tra xem mục menu cha này có mục menu con không
                                if (isset($submenu_items[$parent->ID])) {
                                    echo '<ul class="submenu-items has-children-menu">';
                                    foreach ($submenu_items[$parent->ID] as $submenu) {

                                        echo '<li><a href="' . esc_url($submenu->url) . '">' . esc_html($submenu->title) . '</a></li>';
                                    }
                                    echo '</ul>';
                                }
                                echo '</li>';
                            } ?>
                        </ul>
                    </nav>
                <?php endif; ?>

                <!-- End nav menu -->
                <div class="site-header__util">
                    <a href="#" class="btn btn--small btn--orange float-left push-right">Login</a>
                    <a href="#" class="btn btn--small btn--dark-orange float-left">Sign Up</a>
                    <span class="search-trigger js-search-trigger"><i class="fa fa-search" aria-hidden="true"></i></span>
                </div>
            </div>
        </div>
    </header>