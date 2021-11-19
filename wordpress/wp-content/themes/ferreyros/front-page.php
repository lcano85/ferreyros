<?php
/**
* Template Name: Plantilla predeterminada
*/

global $post;

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

get_header();?>


    <?php if (have_posts()) :

        while (have_posts()) : the_post();?>
            <?php 
                

             
            ?> 
            <section class="ferreyros__page--content ferreyros__page--<?php echo $post_slug = $post->post_name; ?> py-5">
                <div class="container">
                    <?php the_content();?>
                </div>
            </section>

        <?php endwhile;
    endif;?>

<?php get_footer(); ?>