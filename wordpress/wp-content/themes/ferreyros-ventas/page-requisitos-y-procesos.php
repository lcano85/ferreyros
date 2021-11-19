<?php

/* Template Name: Pagina Requisitos y Procesos */

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
    <section class="ferreyros__page--content ventas__page--requisitos-procesos">
        <?php 
            $seccion_1 = get_field('seccion_1'); 
        
            if($seccion_1['titulo_seccion'] || $seccion_1['requisitos']):
        ?>
        <div class="container">
            <div class="row"> 
                <div class="col-sm-12 text-center">
                    <h2 class="title"><?php echo $seccion_1['titulo_seccion']; ?></h2>
                </div>
            </div>
            <?php $rows = $seccion_1['requisitos']; ?>
            <div class="row">
                <?php foreach( $rows as $row ): ?>
                <div class="col-md-4 col-sm-12">
                    <div class="ferreyros__card --mod5">
                        <?php if($row['tipo_enlace_requisitos'] == 'interno'):  
                            $page = $row['enlace_interno_requisitos'];
                            if(get_the_post_thumbnail( $page->ID, 'thumbnail' )): ?>
                                <div class="card__image">
                                    <?php echo get_the_post_thumbnail( $page->ID, 'thumbnail' ); ?>
                                </div>
                            <?php endif; ?>
                        <?php elseif($row['tipo_enlace_requisitos'] == 'externo'): ?>
                            <div class="card__image">
                                <img class="image" src="<?php echo esc_url($row['enlace_externo_requisitos']['icono']['url']); ?>" alt="<?php echo esc_url($row['enlace_externo_requisitos']['icono']['alt']); ?>">
                            </div>
                        <?php endif; ?>
                        <div class="card__content">
                            <?php if($row['tipo_enlace_requisitos'] == 'interno'):
                                $page = $row['enlace_interno_requisitos'];
                            ?>
                                <h3 class="title"><?php echo get_the_title( $page->ID ); ?></h3>
                            <?php elseif($row['tipo_enlace_requisitos'] == 'externo'): ?>
                                <h3 class="title"><?php echo esc_html($row['enlace_externo_requisitos']['titulo']); ?></h3>
                            <?php endif; ?>
                            
                            <a class="permalink" href="<?php if($row['tipo_enlace_requisitos'] == 'interno'): $page = $row['enlace_interno_requisitos']; echo get_the_permalink( $page->ID ); elseif($row['tipo_enlace_requisitos'] == 'externo'): echo esc_url($row['enlace_externo_requisitos']['enlace']); endif; ?>" target="<?php if($row['tipo_enlace_requisitos'] == 'interno'): ?>_self<?php else: ?>_blank<?php endif; ?>"><?php echo $row['nombre_boton']  ?></a>

                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>
        <?php 
            $seccion_2 = get_field('seccion_2'); 
            if($seccion_2['titulo_seccion_2'] || $seccion_2['procesos']):
        ?>
        <div class="container">
            <div class="row"> 
                <div class="col-sm-12 text-center">
                    <h2 class="title"><?php echo $seccion_2['titulo_seccion_2']; ?></h2>
                </div>
            </div>
            <?php $rows = $seccion_2['procesos']; ?>
            <div class="row">
                <?php foreach( $rows as $row ): ?>
                <div class="col-md-4 col-sm-12">
                    <div class="ferreyros__card --mod5">
                        <?php if($row['tipo_enlace_procesos'] == 'interno'):  
                            $page = $row['enlace_interno_procesos'];
                            if(get_the_post_thumbnail( $page->ID, 'thumbnail' )): ?>
                                <div class="card__image">
                                    <?php echo get_the_post_thumbnail( $page->ID, 'thumbnail' ); ?>
                                </div>
                            <?php endif; ?>
                        <?php elseif($row['tipo_enlace_procesos'] == 'externo'): ?>
                            <div class="card__image">
                                <img class="image" src="<?php echo esc_url($row['enlace_externo_procesos']['icono']['url']); ?>" alt="<?php echo esc_url($row['enlace_externo_procesos']['icono']['alt']); ?>">
                            </div>
                        <?php endif; ?>
                        <div class="card__content">
                            <?php if($row['tipo_enlace_procesos'] == 'interno'):
                                $page = $row['enlace_interno_procesos'];
                            ?>
                                <h3 class="title"><?php echo get_the_title( $page->ID ); ?></h3>
                            <?php elseif($row['tipo_enlace_procesos'] == 'externo'): ?>
                                <h3 class="title"><?php echo esc_html($row['enlace_externo_procesos']['titulo']); ?></h3>
                            <?php endif; ?>
                            <a class="permalink" href="<?php if($row['tipo_enlace_procesos'] == 'interno'): $page = $row['enlace_interno_procesos']; echo get_the_permalink( $page->ID ); elseif($row['tipo_enlace_procesos'] == 'externo'): echo esc_url($row['enlace_externo_procesos']['enlace']); endif; ?>"><?php echo $row['nombre_boton']  ?></a>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>
    </section>

<?php else:

    require get_template_directory() . '/inc/content-not-permissions.php';

endif;?>   

<?php get_footer(); ?>