<?php
get_header();
get_template_part('/template/banner-page');

the_post();
// Trả về loại bài viết
$post_type =  get_post_type();

// Lấy obj thông tin đối tượng của loại bài viết
$post_obj = get_post_type_object($post_type);

// Lấy ra tên label loại bài viết
$post_type_slug = $post_obj->label;

// Lấy ra đường dẫn bài viết
$link_archive = get_post_type_archive_link($post_type);
?>
<div class="container container-narrow page-section">
    <!-- Begin Meta Box -->
    <div class="metabox metabox--position-up metabox--with-home-link">
        <p>
            <?php if (!empty($post_type)) {
            ?>
                <a class="metabox__blog-home-link" href="<?= esc_url($link_archive) ?> "><i class="fa fa-home" aria-hidden="true"></i> <?php echo esc_html($post_type_slug); ?></a>
            <?php
            } else {
            ?>
                <a class="metabox__blog-home-link" href="<?= home_url(); ?>"><i class="fa fa-home" aria-hidden="true"></i> Back to home</a>
            <?php
            } ?>
            <span class=" metabox__main">
                Posted by <?= get_the_author_posts_link(); ?> on <?php the_date(); ?>
            </span>
        </p>
    </div>
    <!-- End meta box -->

    <div class="generic-content">
        <?php the_content(); ?>
    </div>
</div>
<?php
get_footer();
