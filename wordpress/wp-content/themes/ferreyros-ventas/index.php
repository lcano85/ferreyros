<?php

global $post;
get_header(); ?>

<section class="ferreyros__page--content ferreyros__page--<?php echo $post_slug = $post->post_name; ?> py-5">
    <div class="container">
        <?php if (have_posts()) :
            while (have_posts()) : ?>
                <?php the_post(); ?>
                <?php the_content(); ?>
        <?php endwhile; 
            endif; 
            ?>
    </div>
</section>    
<?php get_footer(); ?>