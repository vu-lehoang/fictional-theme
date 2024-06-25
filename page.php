<?php
get_header();
$get_the_id = get_the_ID();
get_template_part('/template/banner-page');
?>



<div class="container container--narrow page-section">
    <!-- Meta box -->
    <?php
    // Lấy ID của bài viết cha của bài viết hiện tại
    $post_parent_id = wp_get_post_parent_id($get_the_id);
    $parent_post = get_post($post_parent_id);
    if ($post_parent_id) : ?>
        <div class="metabox metabox--position-up metabox--with-home-link">
            <p>
                <a class="metabox__blog-home-link" href="<?= the_permalink($parent_post) ?>"><i class="fa fa-home" aria-hidden="true"></i> Back to <?= get_the_title($parent_post); ?></a> <span class="metabox__main"><?= the_title(); ?></span>
            </p>
        </div>

    <?php else :
    // content null
    endif; ?>
    <!-- End meta box -->

    <!-- Page Links -->
    <?php
    $testArray = get_pages(array('child_of' => get_the_ID()));
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

            $list_pages = wp_list_pages([
                'title_li'    => NULL,            // Không hiển thị tiêu đề mặc định
                'child_of'    => $findChildrenOf, // ID của trang cha để lấy các trang con của nó
                'sort_column' => 'menu_order',    // Sắp xếp các trang con theo trường menu_order
            ]);
            ?>
        </div>
    <?php endif; ?>
    <!-- End Page links -->

    <div class="generic-content">
        <?php the_content(); ?>
    </div>
</div>

<?php
get_footer();
