<?php
get_header();
$get_the_id = get_the_ID();

?>
<!-- Banner -->
<div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url(images/ocean.jpg)"></div>
    <div class="page-banner__content container container--narrow">
        <h1 class="page-banner__title"><?= the_title(); ?></h1>
        <div class="page-banner__intro">
            <p>A recap of our past events</p>
        </div>
    </div>
</div>
<!-- End Banner -->
<div class="container container--narrow page-section">
    <!-- Meta box -->
    <h1>Page pas Event</h1>

    <!-- Page Links -->
    <?php custom_page_links(); ?>
    <!-- End Page links -->

    <div class="generic-content">
        <?php the_content(); ?>
    </div>
</div>

<?php
get_footer();
