<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the wordpress construct of pages
 * and that other 'pages' on your wordpress site will use a
 * different template.
 *
 * @package WordPress
 * @subpackage RotorWash
 * @since RotorWash 1.0
 */

get_header();
get_template_part('common/main-column', 'post-top');

if( have_posts() ):
    while( have_posts() ):
        the_post();

        // Grabs the featured image
        $attachment_id = get_post_thumbnail_id();
        $has_image = !empty($attachment_id) ? TRUE : FALSE;

        if ($has_image) {
            $image_src = wp_get_attachment_image_src($attachment_id, 'thumbnail');
            $image_path = $image_src[0];
            $image_class = 'img-circle';
        } else {
            $image_path = ASSETS_DIR . '/images/jason-lengstorf.jpg';
            $image_class = NULL;
        }

?>
        <div class="col-md-10 col-md-push-2">
            <h1><?php the_title(); ?></h1>
        </div>
        <div id="featured-image"
             class="col-md-2 col-md-pull-10 hidden-sm hidden-xs">
            <img src="<?php echo $image_path; ?>"
                 alt="Jason Lengstorf"
                 class="<?php echo $image_class; ?>">
        </div>

        <article class="col-md-8 col-md-offset-2">
            <?php the_content(); ?> 
            <p>
                Supports HTML5 Galleries?
                <?= current_theme_supports('html5', 'gallery') ? 'Yes' : 'No' ?> 
            </p>
        </article>
<?php 

    endwhile;
endif;

get_template_part('common/main-column', 'post-bottom');
get_footer();
