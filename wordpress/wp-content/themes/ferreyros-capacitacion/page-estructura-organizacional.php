<?php
get_header();
/* Template Name: Página Estructura Organizacional */
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
    <section class="capacitacion__page--estructura-organizacional">
        <div class="container">
            <?php $estructura = get_field( 'estructura'); ?>
            <div class="row">
                <?php $x=0; foreach( $estructura as $row ): $x++; ?>
                <div class="mb-4 <?php if($x == 1): ?>col-sm-12<?php else: ?>col-lg-4 col-sm-12<?php endif; ?>">
                    <div class="ferreyros__card --mod4">
                        <div class="card__image"><img class="image" src="<?php echo $row['foto_empleado']['url']; ?>" alt="<?php echo $row['foto_empleado']['alt']; ?>"></div>
                        <div class="card__content">
                            <h2 class="title"><?php echo $row['nombre_empleado']; ?></h2>
                            <p class="text"><?php echo $row['cargo_empleado']; ?></p>
                            <?php if($row['correo_empleado']): ?>
                                <a class="info-link" href="mailto: <?php echo $row['correo_empleado']; ?>">
                                    <span class="icon">
                                        <svg>
                                            <use xlink:href="<?php bloginfo( 'template_url' ); ?>/assets/images/icons/icons.svg#fi-rr-envelope"></use>
                                        </svg>
                                    </span>
                                    <?php $porciones = explode("@", $row['correo_empleado']); ?>
                                    <span class="text"><?php echo $porciones[0]; ?></span></a>
                            <?php endif; ?>
                            <?php if($row['telefono_empleado']): ?>
                                <a class="info-link" href="tel: <?php echo $row['telefono_empleado']; ?>">
                                    <span class="icon">
                                        <svg>
                                            <use xlink:href="<?php bloginfo( 'template_url' ); ?>/assets/images/icons/icons.svg#fi-rr-smartphone"></use>
                                        </svg>
                                    </span>
                                    <span class="text"><?php echo $row['telefono_empleado']; ?></span>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <?php $organigrama_completo = get_field( 'organigrama_completo'); ?>
            <div class="row">                
                <div class="mb-4 col-sm-12 col-lg-4 offset-lg-4 text-center">
                    <a class="button" href="<?php echo $organigrama_completo['enlace']['url'] ?>" target="<?php echo $organigrama_completo['enlace']['target'] ? $organigrama_completo['enlace']['target'] : '_self'; ?>"><?php echo $organigrama_completo['enlace']['title'] ?></a>
                    <p class="login-alert"><?php echo $organigrama_completo['recomendacion']; ?></p>
                </div>
            </div>
        </div>
    </section>

<?php else:

    require get_template_directory() . '/inc/content-not-permissions.php';

endif;?>

<?php get_footer(); ?>