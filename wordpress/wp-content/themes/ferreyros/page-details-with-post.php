<?php

/* Template Name: Pagina Detalles con Entrada*/

get_header(); 

global $post; 

$permisos_contenido = get_field('permisos_contenido'); 

if( permissions_content($permisos_contenido) == 'true' ): ?>

    <?php $hero = get_field('banner'); ?>
    <section class="ferreyros__banner--internal">
        <div class="container-fluid g-0">
            <div class="banner__picture">
                <?php if( !empty( $hero['imagen'] )){ ?>
                    <img class="picture" src="<?php echo esc_url( $hero['imagen']['url'] ); ?>" alt="<?php echo esc_attr( $hero['imagen']['alt'] ); ?>">
                <?php }else{ ?>
                    <img class="picture" src="<?php bloginfo( 'template_url' ); ?>/assets/images/jpgs/banner-2.jpg" alt="">
                <?php } ?>
            </div>
            <div class="banner__content">
                <?php if ( $post->post_parent ) { ?>
                    <div class="back-to-page">
                        <a class="permalink" href="<?php echo get_permalink( $post->post_parent ); ?>"> 
                            <span class="icon">
                                <svg>
                                    <use xlink:href="<?php bloginfo( 'template_url' ); ?>/assets/images/icons/icons.svg#fi-rr-arrow-left"></use>
                                </svg>
                            </span>
                            Volver
                        </a>
                    </div>
                <?php } ?>
                <?php  if( $hero['tipo_contenido'] == 'textos' ) { ?>
                    <div class="content">
                        <?php if($hero['titulo']){ ?>
                            <h1 class="title"><?php echo esc_html( $hero['titulo'] ); ?></h1>
                        <?php } ?>
                        <?php if($hero['contenido']){ ?>
                            <p class="text"><?php echo esc_html( $hero['contenido'] ); ?></p>
                        <?php } ?>
                    </div>
                <?php } elseif( $hero['tipo_contenido'] == 'icono' ){ ?>
                    <div class="content">
                        <?php if( !empty( $hero['icono'] )){ ?>
                            <img class="picture" src="<?php echo esc_url( $hero['icono']['url'] ); ?>" alt="<?php echo esc_attr( $hero['icono']['alt'] ); ?>">
                        <?php } ?>
                    </div>
                <?php } ?>
                
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <?php if(function_exists('bcn_display'))
                            {
                                bcn_display();
                            }
                        ?>
                    </ol>
                </nav>
            </div>
        </div>
    </section>

    <section class="ferreyros__page--content my-5">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-8">
                    <?php if (have_posts()) :
                        while (have_posts()) : ?>
                        <div class="row">
                            <div class="col-sm-12">
                                <?php the_post(); the_content(); ?>
                            </div>
                        </div>
                    <?php endwhile; 
                        endif; 
                    ?>
                </div>
                <div class="col-sm-12 col-md-4">
                    <div class="ferreyros__section mb-5">
                        <?php 
                            $titulo_seccion = get_field('titulo_seccion'); 
                            if($titulo_seccion):
                        ?>
                        <div class="row">
                            <div class="col-md-12">
                                <h3><?php echo $titulo_seccion; ?></h3>
                            </div>
                        </div>
                        <?php endif; ?>
                        <?php                             
                        $post_type = get_field( 'tipo_de_entrada' );
                        echo get_permalink( $post_type );
                        $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;                                               
                        $args = array(
                            'post_type'      => $post_type,
                            'posts_per_page' =>  1,
                            'order'          => 'DESC',
                            'order_by'       => 'date',
                            'post_status'    => 'publish',
                            'paged'          => $paged,
                        );                    
                        $loop = new WP_Query( $args );
                        $numberPages = $loop->max_num_pages;
                        if ( $loop->have_posts() ) : ?>
                            <div class="row mb-5">
                                <?php while( $loop->have_posts() ) : $loop->the_post(); ?>
                                <div class="col-sm-12">
                                    <div class="ferreyros__card">
                                        <div class="card__image">
                                            <?php if ( has_post_thumbnail() ) : 
                                                the_post_thumbnail('medium', ['class' => 'image']);
                                            else: ?>
                                            <img class="image" src="<?php bloginfo( 'template_url' ); ?>/assets/images/jpgs/card-image.jpg" alt="">
                                            <?php endif; ?>
                                        </div>
                                        <div class="card__content">
                                            <?php
                                                $categories = get_the_category();
                                                if ( ! empty( $categories ) ) : 
                                            ?>
                                            <div class="category"> <small><?php echo esc_html( $categories[0]->name ); ?></small></div>
                                            <?php endif; ?>
                                            <h2 class="title"> <a class="permalink" title="<?php echo the_title(); ?>" href="<?php the_permalink(); ?>"><?php echo mb_strimwidth(get_the_title(), 0, 50, '...'); ?></a></h2>
                                            <?php echo excerpt('35'); ?>
                                        </div>
                                        <div class="action text-center mt-3">
                                            <a class="ferreyros__btn" href="<?php the_permalink(); ?>" target="_self" >Ver más</a>
                                        </div>
                                    </div>
                                </div>
                                <?php 
                                    endwhile; wp_reset_postdata();
                                ?> 
                            </div>
                        <?php 
                            $link_page_posts = get_field('enlace_pagina_entradas');
                            if(!empty($link_page_posts)):
                        ?>
                            <div class="row justify-content-center mb-5">
                                <div class="col-sm-auto">
                                    <a class="ferreyros__btn" href="<?php echo $link_page_posts['url']; ?>" target="<?php echo $link_page_posts['target'] ? $link_page_posts['target'] : '_self'; ?>"><?php echo $link_page_posts['title']; ?></a>
                                </div>
                            </div>
                        <?php endif; ?>
                        <?php else: ?>
                            <div class="row my-5">
                                <p class="text-center"> ¡No hay publicaciones! </p>
                            </div>
                        <?php endif; ?>
                    </div>                    
                </div>
            </div>
        </div>
    </section>

<?php else: 

    require get_template_directory() . '/inc/content-not-permissions.php';

endif;?>

<?php get_footer(); ?>