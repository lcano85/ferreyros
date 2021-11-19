<?php

/* Template Name: Página Responsabilidad Social */

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

    <section class="ferreyros__page--content py-5">
        <div class="container">
            <?php the_content();?>
        </div>
    </section>

    <section class="ferreyros__page--content fred__page--programas pb-5">
        <div class="container">
            <h2 class="text-center mb-4"><?php the_field('titulo_seccion'); ?></h2>
            <div class="programas__list row">
                <?php $rows = get_field('programas');
                    if( $rows ) : 
                        foreach( $rows as $row ): ?>
                        <div class="programas__item col-sm-12 col-md-6 py-3">
                            <div class="ferreyros__card">
                                <div class="card__image">                                
                                    <?php if( !empty( $row['programa_imagen'] )){ ?>
                                        <img class="image" src="<?php echo esc_url( $row['programa_imagen']['url'] ); ?>" alt="<?php echo esc_attr( $row['programa_imagen']['alt'] ); ?>">
                                    <?php }else{ ?>
                                        <img class="image" src="<?php bloginfo( 'template_url' ); ?>/assets/images/jpgs/card-image.jpg" alt="">
                                    <?php } ?>
                                </div>
                                <div class="card__content">
                                    <h2 class="title"><?php echo $row['programa_titulo']; ?></h2>
                                    <?php echo $row['programa_descripcion']; ?>
                                </div>
                            </div>
                        </div>
                <?php
                        endforeach;
                    endif; 
                ?>
            </div>
        </div>
    </section>

<?php else:

    require get_template_directory() . '/inc/content-not-permissions.php';

endif;?>

<?php get_footer(); ?>