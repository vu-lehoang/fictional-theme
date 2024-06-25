<?php

/**
 * Index file
 */
get_header();

?>
<!-- Banner -->
<?php get_template_part('/template/banner'); ?>
<!-- End Banner -->

<!-- Blog layout -->
<div class="blog-grid">
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <div class="blog-list-grid">
                    <!-- Blog list -->
                    <?php if (have_posts()) :
                        while (have_posts()) :
                            the_post(); ?>
                            <div class="blog-list">
                                <?php if (has_post_thumbnail()) : ?>
                                    <div class="blog-list-img">
                                        <a href="<?= get_permalink(); ?>"><img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'large'); ?>" alt="">
                                        </a>
                                    </div>
                                <?php endif; ?>
                                <div class="blog-list-description">
                                    <h4><a href="<?php echo get_permalink(); ?>"><?php echo the_title(); ?></a></h4>
                                    <span class="blog-category"><?= the_category(', '); ?></span>
                                    <p class="content">
                                        <?php custom_the_excerpt('120');
                                        ?>
                                    </p>
                                    <a href="<?php echo get_permalink(); ?>" class="btn btn--blue">Xem thêm >></a>
                                    <div class="meta-box">
                                        <p>Posted by <span class="post-author"><?= get_the_author_posts_link(); ?></span> on <?php the_date(); ?></p>
                                    </div>
                                </div>
                            </div>
                            <!-- End blog list -->
                        <?php endwhile; ?>
                    <?php else : ?>
                        <h2>Nothing found blog</h2>
                    <?php endif; ?>


                </div>
                <?php  // Define custom pagination arguments
                $pagination_args = array(
                    'base' => str_replace(999999999, '%#%', esc_url(get_pagenum_link(999999999))),
                    'format' => '?paged=%#%',
                    'current' => max(1, get_query_var('paged')),
                    'total' => $wp_query->max_num_pages,
                    'prev_text' => __('&laquo; Trang trước'),
                    'next_text' => __('Trang sau &raquo;'),
                    'type' => 'array', // You can change this to 'list' or 'array' as per your requirement
                    'end_size' => 1,
                    'mid_size' => 2,
                );
                $paginate_links = paginate_links($pagination_args);

                echo '<div class="container container-paginate">';
                if (is_array($paginate_links)) {
                    foreach ($paginate_links as $link) {
                        // Add a custom class to the <li> containing the link
                        echo "<span class='pagination-item'>$link</span>";
                    }
                }
                echo '</div>';
                ?>
            </div>
        </div>
    </div>
</div>
<!-- End blog layout -->
<?php

get_footer();
?>