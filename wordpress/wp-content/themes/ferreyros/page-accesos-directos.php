<?php
get_header();
/* Template Name: Página Accesos directos */
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
    <section class="ferreyros__page--content fred__page--<?php echo $post_slug = $post->post_name; ?>">
        <div class="container">
            <?php $rows = get_field('accesos_directos'); ?>
            <div class="row <?php echo $post_slug = $post->post_name; ?>__list justify-content-center">
                <?php foreach( $rows as $row ): ?>
                <div class="col-sm-6 col-md-4 col-lg-3 py-3 <?php echo $post_slug = $post->post_name; ?>__item">               
                    <div class="ferreyros__card --mod3">
                        <?php if($row['tipo_accesos_directos'] == 'interno'):  
                                $page = $row['acceso_directo_interno'];
                                if(get_field('icono', $page->ID)): ?>
                                    <div class="card__image">
                                        <img class="image" src="<?php echo get_field('icono', $page->ID); ?>" alt="<?php echo get_the_title( $page->ID ); ?>">
                                    </div>
                                <?php endif; ?>
                        <?php elseif($row['tipo_accesos_directos'] == 'externo'): ?>
                            <div class="card__image">
                                <img class="image" src="<?php echo esc_url($row['acceso_directo_externo']['icono']['url']); ?>" alt="<?php echo esc_url($row['acceso_directo_externo']['icono']['alt']); ?>">
                            </div>
                        <?php endif; ?>
                        <div class="card__content">
                            <?php if($row['tipo_accesos_directos'] == 'interno'):
                                    $page = $row['acceso_directo_interno'];
                                ?>
                                <h2 class="title"> 
                                    <a class="permalink" href="<?php echo get_the_permalink( $page->ID ); ?>">
                                        <?php 
                                            if($row['titulo_opcional']):
                                                echo $row['titulo_opcional']; 
                                            else:
                                                echo get_the_title( $page->ID );
                                            endif;
                                        ?>
                                    </a>
                                </h2>
                            <?php elseif($row['tipo_accesos_directos'] == 'externo'): ?>
                                <h2 class="title"> <a class="permalink" href="<?php echo esc_url($row['acceso_directo_externo']['url']); ?>" target="_blank"><?php echo esc_html($row['acceso_directo_externo']['titulo']); ?></a></h2>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

<?php else: 

    require get_template_directory() . '/inc/content-not-permissions.php';

endif;?>

<?php get_footer(); ?>