<?php

// Định nghĩa một hằng số chứa đường dẫn tới thư mục chủ đề
define('DIR_URI', get_theme_file_uri());

// Thêm hỗ trợ cho ảnh đại diện bài viết (post thumbnails)
add_theme_support('post-thumbnails');

/**
 * Hàm nạp các tệp CSS và JavaScript cho chủ đề
 */
function university_files()
{
    // Nạp font từ Google Fonts
    wp_enqueue_style('custom-google-font', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');

    // Nạp Font Awesome từ CDN
    wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');

    // Nạp tệp CSS chính của chủ đề
    wp_enqueue_style('university_main_styles', DIR_URI . '/build/index.css');

    // Nạp tệp Blog CSS 
    wp_enqueue_style('blog_css', DIR_URI . '/assets/css/blog.css');

    // Nạp tệp CSS bổ sung của chủ đề
    wp_enqueue_style('university_extra_styles', DIR_URI . '/build/style-index.css');

    // Nạp tệp JavaScript chính của chủ đề, với jQuery là phụ thuộc và nạp ở footer
    wp_enqueue_script('university_main_js', DIR_URI . '/build/index.js', array('jquery'), '1.0', true);

    // Nạp tệp CSS của theme mặc định
    wp_enqueue_style('style', get_stylesheet_uri());
}

// Đăng ký hàm `university_files` để chạy khi hook `wp_enqueue_scripts` được gọi
add_action('wp_enqueue_scripts', 'university_files');

/**
 * Thêm thẻ tiêu đề trong chủ đề WordPress.
 *
 * Thẻ tiêu đề sẽ được tự động thêm vào phần <head> của trang bởi WordPress
 * khi chủ đề hỗ trợ tính năng này.
 */

/**
 * Định nghĩa hàm để thêm hỗ trợ thẻ tiêu đề.
 */
function university_features()
{
    add_theme_support('title-tag');
}

// Đăng ký hàm `university_features` để chạy khi hook `after_setup_theme` được gọi
add_action('after_setup_theme', 'university_features');

/**
 * Hiển thị đoạn trích giới hạn số lượng ký tự.
 *
 * @param int $charlimit Số lượng ký tự giới hạn.
 */
function custom_the_excerpt($charlimit)
{

    $excerpt = get_the_excerpt();
    $excerpt = substr($excerpt, 0, $charlimit);
    echo $excerpt . '...';
}


// Đăng ký menu
function register_my_menus()
{
    register_nav_menus(array(
        'primary-menu' => esc_html__('Primary Menu', 'fictional'),
        'footer-location-one'  => esc_html__('Footer Location One', 'fictional'),
        'footer-location-two'  => esc_html__('Footer Location Two', 'fictional'),
    ));
}
add_action('after_setup_theme', 'register_my_menus');

// Hiển thị menu
function display_footer_location($location = 'footer-location-one', $menu_id = 'footer_location_one', $class = 'nav-list', $menu_class = 'menu_items', $container = 'nav')
{
    wp_nav_menu([
        'theme_location' => $location,
        'container_class' => $class,
        'menu_class' => $menu_class,
        'menu_id' => $menu_id,
        'container' => $container,
        'depth' => 2,
        'fallback_cb' => false,
    ]);
}

// 
function university_adjust_queries($query)
{
    if (!is_admin() and is_post_type_archive('event') and $query->is_main_query) {
        $today = date('Ymd');
        $query->set('meta_key', 'event_date');
        $query->set('orderby', 'meta_value_num');
        $query->set('order', 'ASC');
        $query->set('meta_query', array([
            'key' => 'event_date',
            'compare' => '>=',
            'value' => $today,
            'type' => 'numeric'
        ]));
    }
}

add_action('pre_get_posts', 'university_adjust_queries');

// phân trang
function custom_page_links()
{
    // Lấy các trang con của trang hiện tại
    $testArray = get_pages(array('child_of' => get_the_ID()));
    $post_parent_id = wp_get_post_parent_id(get_the_ID());

    if ($testArray || $post_parent_id) :
?>

        <div class="page-links">
            <h2 class="page-links__title"><a href="<?= the_permalink($post_parent_id); ?>"><?php echo get_the_title($post_parent_id); ?></a></h2>
            <?php
            if ($post_parent_id) {
                $findChildrenOf = $post_parent_id;
            } else {
                $findChildrenOf = get_the_ID();
            }

            wp_list_pages([
                'title_li'    => NULL,            // Không hiển thị tiêu đề mặc định
                'child_of'    => $findChildrenOf, // ID của trang cha để lấy các trang con của nó
                'sort_column' => 'menu_order',    // Sắp xếp các trang con theo trường menu_order
            ]);
            ?>
        </div>
<?php
    endif;
}
