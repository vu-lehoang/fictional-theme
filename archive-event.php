<?php
get_header();
get_template_part('/template/banner');
?>
<div class="container container-narrow page-section">
    <?php while (have_posts()) :
        the_post(); ?>
        <div class=" event-summary">
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
                <p><?php echo wp_trim_words(get_the_content(), 35) ?> <a href="<?php the_permalink(); ?>" class="nu gray">Read more</a></p>
            </div>
        </div>
    <?php endwhile; ?>
    <!-- End -->
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
<?php
get_footer();
