<?php

/* Template Name: Página Videos Institucionales */

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
    

    <?php if (have_posts()) : ?>
    <section class="ferreyros__page--content ferreyros__page--<?php echo $post_slug = $post->post_name; ?> py-5">
        <div class="container">
            <?php while (have_posts()) : the_post();

                the_content();
                
            endwhile; ?>
        </div>
    </section>
    <?php endif;?>

    <?php 
        $section_videos = get_field('seccion_videos'); 
        if($section_videos):
    ?>
    <section class="ferreyros__page--content fred__page--videos-institucionales-2 py-5">
        <div class="container">
            <?php if($section_videos['titulo_seccion']): ?>
                <h2 class="title text-center mb-4"><?php echo $section_videos['titulo_seccion']; ?></h2>
            <?php endif; ?>        
            <?php 
                $rows = $section_videos['lista_video'];
                if( $rows ) : ?>
                <div class="row">
                    <?php foreach( $rows as $row ): ?>
                    <div class="col-sm-12 col-md-6 py-4">
                        <div class="ferreyros__card">
                            <div class="card__image">
                                <?php if($row['embebido']): ?>
                                    <?php echo $row['embebido']; ?>
                                <?php else: ?>
                                    <img class="image" src="<?php bloginfo( 'template_url' ); ?>/assets/images/jpgs/card-image-1.jpg" alt="">
                                <?php endif; ?>
                            </div>
                            <div class="card__content">
                                <?php if($row['titulo']): ?>
                                    <h2 class="title"><?php echo esc_html($row['titulo']); ?></h2>
                                <?php endif; ?>
                                <?php if($row['descripcion']): 
                                    echo $row['descripcion'];
                                endif; ?>
                            <?php 
                                $link = $row['enlace'];
                                if( $link ): 
                                    $link_url = $link['url'];
                                    $link_title = $link['title'];
                                    $link_target = $link['target'] ? $link['target'] : '_self';
                            ?>
                            <div class="action text-center mt-3">
                                <a class="ferreyros__btn" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
                            </div>
                            <?php endif; ?>                            
                            </div>
                        </div>                    
                    </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </section>
    <?php endif; ?>

<?php else:

    require get_template_directory() . '/inc/content-not-permissions.php';

endif;?>

<?php get_footer(); ?>