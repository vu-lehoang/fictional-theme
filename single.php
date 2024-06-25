<?php
get_header();
get_template_part('/template/banner');
the_post();
?>
<?php
// Lấy danh mục của bài viết hiện tại
$categories = get_the_category();

?>
<div class="container container-narrow page-section">
    <h2 class="title"><?php the_title(); ?></h2>
    <!-- Begin Meta Box -->
    <div class="metabox metabox--position-up metabox--with-home-link">
        <p>
            <?php if (!empty($categories)) {

            ?>

                <a class="metabox__blog-home-link" href="<?php echo esc_url(get_category_link($categories[0]->term_id)); ?> "><i class="fa fa-home" aria-hidden="true"></i> <?php echo esc_html($categories[0]->name); ?></a>
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


wp_footer();
