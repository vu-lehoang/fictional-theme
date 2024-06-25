<?php

/**
 * Banner template file
 */

function get_headline_banner($title = 'Welcome', $class = 'headline headline--large', $tag = 'h1')
{


    // Construct the HTML tag with class attribute
    $html = '<' . $tag;
    if (!empty($class)) {
        $html .= ' class="' . esc_attr($class) . '"';
    }
    $html .= '>' . $title . '</' . $tag . '>';

    return $html;
}

?>

<div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url('<?php echo DIR_URI ?>/images/library-hero.jpg')"></div>
    <div class="page-banner__content container t-center c-white">

        <?php
        if (is_category() || is_archive()) {
            // echo get_headline_banner(single_cat_title('', false));
            $archive_title = get_the_archive_title();
            $array_cut = ['Archives: ', 'Category: '];
            $title_without_archive = str_replace($array_cut, '', $archive_title);
            echo get_headline_banner($title_without_archive);
        } elseif (is_single()) {
            echo get_headline_banner(get_the_title(), $class = 'headline headline-medium');
        } elseif (is_author()) {
            echo get_headline_banner('Posts by: ' . get_author_name());
        } elseif (is_home()) {
            echo get_headline_banner(single_post_title('', false));
        } else {
            echo get_headline_banner();
        }
        ?>

        <div class="page-banner__intro">
            <?php if (is_front_page()) : ?>
                <h2 class="headline headline--medium">We think you&rsquo;ll like it here.</h2>
                <h3 class="headline headline--small">Why don&rsquo;t you check out the <strong>major</strong> you&rsquo;re interested in?</h3>
                <a href="#" class="btn btn--large btn--blue">Find Your Major</a>
            <?php endif; ?>
            <?php if (is_category()) : ?>
                <p><?php the_archive_description(); ?>
                </p>
            <?php endif; ?>
            <?php if (is_author()) : ?>
                <p><?php the_author_description(); ?>
                </p>
            <?php endif; ?>
        </div>
    </div>
</div>