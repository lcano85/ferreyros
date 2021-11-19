<?php
/**
* Template Name: Pagina Principal
*/

global $post;

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

get_header();

$rows = get_field('banner');
if( $rows ) : ?>
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
                    <?php if(!empty($row['imagen_portada']['imagen'])): ?>
                        <img class="picture" src="<?php echo $row['imagen_portada']['imagen']['url']; ?>" alt="<?php echo $row['imagen_portada']['imagen']['alt']; ?>">
                    <?php else: ?>
                        <img class="picture" src="<?php bloginfo( 'template_url' ); ?>/assets/images/jpgs/banner.jpg" alt="banner">
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <div class="swiper-pagination"></div>
</section>
<?php endif; ?>

<?php $seccion_tablero = get_field('seccion_tablero'); 
if($seccion_tablero): ?>
<section class="ferreyros__page--content capacitacion__page--tablero">
    <div class="container">
        <div class="tablero__header">
            <h2 class="title">
                <?php echo $seccion_tablero['titulo_seccion']; ?>
            </h2>
            <p class="text"><?php echo $seccion_tablero['contenido']; ?></p>
        </div>
        <div class="tablero__content">
            <?php $seccion_avances = $seccion_tablero['avance_sp']; 
                if($seccion_avances): ?>
            <div class="tablero__avances">
                <?php echo $seccion_avances; ?>
            </div>
            <?php endif; ?>
        <?php $rows = $seccion_tablero['accesos_directos']; ?>
            <div class="row tablero__list justify-content-center">
                <?php foreach( $rows as $row ): ?>
                <div class="col-sm-6 col-md-4 col-lg-3 py-3 tablero__item">               
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
                                    $page = $row['acceso_directo_interno']; ?>
                                <h2 class="title">
                                    <a class="permalink" href="<?php echo get_the_permalink( $page->ID ); ?>">
                                        <?php echo get_the_title( $page->ID );?>
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
    </div>
</section>
<?php endif; ?>

<?php get_footer(); ?>