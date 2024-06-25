<?php

/**
 * Index file
 */
get_header();

?>
<!-- HTML Static -->
<?php get_template_part('/template/banner'); ?>
<div class="full-width-split group">
    <div class="full-width-split__one">
        <div class="full-width-split__inner">
            <h2 class="headline headline--small-plus t-center">Upcoming Course</h2>

            <!-- Event -->
            <?php
            // Lấy ra bài viết trong post type event
            $today = date('Ymd');
            $evt_post = new WP_Query(array(
                'posts_per_page' => -1,
                'post_type' => 'event',
                'meta_key' => 'event_date',
                'orderby' => 'meta_value_num',
                'order' => 'ASC',
                'meta_query' => array(
                    [
                        'key' => 'event_date',
                        'compare' => '>=',
                        'value' => $today,
                        'type' => 'numeric'
                    ]
                )

            ));
            while ($evt_post->have_posts()) :
                $evt_post->the_post();
            ?>
                <div class="event-summary">
                    <a class="event-summary__date t-center" href="#">
                        <!-- Begin Event Date-->
                        <?php if (get_field('event_date')) :  $date_event = new Datetime(get_field('event_date')); ?>
                            <span class="event-summary__month"><?= $date_event->format('M'); ?></span>
                            <span class="event-summary__day"><?= $date_event->format('d'); ?></span>

                        <?php else :
                        ?>
                            <span class="event-update">Updating</span>
                        <?php
                        endif; ?>
                        <!-- End Event Date -->
                    </a>
                    <div class="event-summary__content">
                        <h5 class="event-summary__title headline headline--tiny"> <a href="<?php echo the_permalink(); ?>"><?php the_title(); ?></a></h5>
                        <p>
                            <!-- Mô tả ngắn -->
                            <?php
                            echo (has_excerpt()) ? get_the_excerpt() :  wp_trim_words(get_the_content(), 18); ?>
                            <a href="<?php the_permalink(); ?>" class="nu gray">Read more</a>
                        </p>
                    </div>
                </div>
            <?php
                // Đặt lại dữ liệu sau khi sử dụng WP_Query
                wp_reset_postdata();
            endwhile; ?>
            <!-- End Event -->

            <p class="t-center no-margin"><a href="<?php echo site_url('/blog'); ?>" class="btn btn--blue">View All Course</a></p>
        </div>
    </div>
    <div class="full-width-split__two">
        <div class="full-width-split__inner">
            <h2 class="headline headline--small-plus t-center">From Our Blogs</h2>
            <!-- Blogs -->
            <?php
            // Get 3 post blog
            $postpage_home = new WP_Query(array(
                'posts_per_page' => 3,
                'post_type' => 'post'

            ));
            while ($postpage_home->have_posts()) :
                $postpage_home->the_post();
            ?>
                <div class="event-summary">
                    <a class="event-summary__date event-summary__date--beige t-center" href="#">
                        <span class="event-summary__month"><?php echo get_the_date('M'); ?></span>
                        <span class="event-summary__day"><?php echo get_the_date('d'); ?></span>
                    </a>
                    <div class="event-summary__content">
                        <h5 class="event-summary__title headline headline--tiny"><a href="<?php echo the_permalink(); ?>"><?php the_title(); ?></a></h5>
                        <p>
                            <?php
                            // Mô tả ngắn
                            echo (has_excerpt()) ? get_the_excerpt() :  wp_trim_words(get_the_content(), 18); ?>
                            <a href="<?php the_permalink(); ?>" class="nu gray">Read more</a>
                        </p>
                    </div>
                </div>

            <?php
                // Đặt lại dữ liệu sau khi sử dụng WP_Query
                wp_reset_postdata();
            endwhile; ?>
            <!-- End Blogs -->

            <p class="t-center no-margin"><a href="<?php echo site_url('/blog'); ?>" class="btn btn--yellow">View All Blog Posts</a></p>
        </div>
    </div>
</div>

<div class="hero-slider">
    <div data-glide-el="track" class="glide__track">
        <div class="glide__slides">
            <div class="hero-slider__slide" style="background-image: url(<?php echo DIR_URI ?>/images/bus.jpg)">
                <div class="hero-slider__interior container">
                    <div class="hero-slider__overlay">
                        <h2 class="headline headline--medium t-center">Free Transportation</h2>
                        <p class="t-center">All students have free unlimited bus fare.</p>
                        <p class="t-center no-margin"><a href="#" class="btn btn--blue">Learn more</a></p>
                    </div>
                </div>
            </div>
            <div class="hero-slider__slide" style="background-image: url(<?php echo DIR_URI  ?>/images/apples.jpg)">
                <div class="hero-slider__interior container">
                    <div class="hero-slider__overlay">
                        <h2 class="headline headline--medium t-center">An Apple a Day</h2>
                        <p class="t-center">Our dentistry program recommends eating apples.</p>
                        <p class="t-center no-margin"><a href="#" class="btn btn--blue">Learn more</a></p>
                    </div>
                </div>
            </div>
            <div class="hero-slider__slide" style="background-image: url(<?php echo DIR_URI ?>/images/bread.jpg)">
                <div class="hero-slider__interior container">
                    <div class="hero-slider__overlay">
                        <h2 class="headline headline--medium t-center">Free Food</h2>
                        <p class="t-center">Fictional University offers lunch plans for those in need.</p>
                        <p class="t-center no-margin"><a href="#" class="btn btn--blue">Learn more</a></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="slider__bullets glide__bullets" data-glide-el="controls[nav]"></div>
    </div>
</div>
<!-- End html static -->
<!-- Custom post -->
<?php if (have_posts()) {
    while (have_posts()) {
        the_post();
        if (has_post_thumbnail()) : ?>
            <div class="post-thumbnail">
                <a href="<?php echo get_permalink(); ?>">
                    <?php the_post_thumbnail('medium'); ?>
                </a>
            </div>
        <?php endif; ?>

        <h5 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>

        <?php the_excerpt(); ?>

        <p><?php the_author(); ?></p>
        <hr>
<?php
    }
}

get_footer();
?>