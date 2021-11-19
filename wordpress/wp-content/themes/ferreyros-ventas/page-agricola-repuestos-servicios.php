<?php
get_header();
/* Template Name: Página Repuestos Servicios */
global $post; 

$permisos_contenido = get_field('permisos_contenido'); 

if( permissions_content($permisos_contenido) == 'true' ): 

    $rows = get_field('banner');
    if( $rows ) : 

?>
    <section class="ferreyros__banner--capacitacion ferreyros__banner swiper-container">
        <div class="banner__list swiper-wrapper">
            <?php foreach( $rows as $row ): ?>
            <div class="banner__item swiper-slide">
                <div class="container-fluid g-0">
                    <div class="banner__content">
                        <?php if($row['contenido']['titulo'] || $row['contenido']['texto']): ?>
                            <div class="content">
                                <?php if($row['contenido']['titulo']): ?>
                                    <h1 class="title">
                                        <?php if($row['enlace']): ?>
                                            <a href="<?php echo $row['enlace']['url']; ?>" title="<?php echo $row['enlace']['title']; ?>" target="<?php echo $row['enlace']['target'] ? $row['enlace']['target'] : '_self'; ?>" >
                                                <?php echo $row['contenido']['titulo']; ?>
                                            </a>
                                        <?php else: 
                                            echo $row['contenido']['titulo'];
                                        endif; ?>
                                    </h1>
                                <?php endif; ?>
                                <?php if($row['contenido']['texto']): ?>
                                <p class="text"><?php echo $row['contenido']['texto']; ?></p>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="banner__picture">
                        <picture>
                            <?php if(!empty($row['imagen_portada']['imagen_desktop'])): ?>
                                <source media="(min-width: 992px)" srcset="<?php echo $row['imagen_portada']['imagen_desktop']['url']; ?>">
                            <?php else: ?>
                                <source media="(min-width: 992px)" srcset="<?php bloginfo( 'template_url' ); ?>/assets/images/jpgs/banner.jpg">
                            <?php endif; ?>
                            <?php if(!empty($row['imagen_portada']['imagen_mobile'])): ?>
                                <img class="picture" src="<?php echo $row['imagen_portada']['imagen_mobile']['url']; ?>" alt="<?php echo $row['imagen_portada']['imagen_mobile']['url']; ?>">
                            <?php else: ?>
                                <img class="picture" src="<?php bloginfo( 'template_url' ); ?>/assets/images/jpgs/banner-2.jpg" alt="Banner">
                            <?php endif; ?>
                        </picture>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <div class="swiper-pagination"></div>
    </section>
<?php endif; ?>
    <section class="ferreyros__page--content fred__page--<?php echo $post_slug = $post->post_name; ?> my-5">
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
    <?php 
        $logos = get_field('logos'); 
        if($logos):
    ?>
    <section class="ferreyros__page--content my-5">
        <div class="container">
            <div class="row justify-content-center">
                <?php foreach( $logos as $logo ): ?>
                <div class="col-sm-6 col-md-3 py-3 text-center">
                    <img src="<?php echo $logo['imagen']['url']; ?>" alt="<?php echo $logo['imagen']['alt']; ?>">
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <?php endif; ?>
<?php else: 

    require get_template_directory() . '/inc/content-not-permissions.php';

endif;?>

<?php get_footer(); ?>