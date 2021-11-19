<?php
/**
* Template Name: Plantilla predeterminada
*/

global $post;

get_header();

$permisos_contenido = get_field('permisos_contenido'); 

if( permissions_content($permisos_contenido) == 'true' ): ?>

    <?php if (have_posts()) : ?>

    <section class="ferreyros__page--content ferreyros__page--<?php echo $post_slug = $post->post_name; ?> py-5">
        <div class="container">
            <?php while (have_posts()) : the_post();
            
                the_content();

                // If comments are open or there is at least one comment, load up the comment template.
                if ( comments_open() || get_comments_number() ) {
                    comments_template();
                }
                
            endwhile; ?>
        </div>
    </section>

    <?php endif;?>

<?php else: 

    require get_template_directory() . '/inc/content-not-permissions.php';

endif;?>

<?php get_footer(); ?>