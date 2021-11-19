<?php
/* Template Name: Página Accesos directos horizontales Multiple*/
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
                <?php if( empty($hero['tipo_contenido']) ){ ?>
                    <div class="content">
                        <h1 class="title"><?php the_title(); ?></h1>
                    </div>
                <?php }elseif( $hero['tipo_contenido'] == 'textos' ) { ?>
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

    <?php if (have_posts() || the_content()) : ?>
    <section class="ferreyros__page--content ferreyros__page--<?php echo $post_slug = $post->post_name; ?> mt-5">
        <div class="container">
            <?php while (have_posts()) : the_post();
            
                the_content();
                
            endwhile; ?>
        </div>
    </section>
    <?php endif;?>

    <?php 
        $rows = get_field('lineamientos'); 
        if( $rows ) :
    ?>
    <section class="ferreyros__page--content ferreyros__page--<?php echo $post_slug = $post->post_name; ?>-2 my-5">
        <div class="container">
            <?php foreach( $rows as $row ): ?>
            <div class="row mt-5">
                <?php if($row['titulo']): ?>
                <div class="ferreyros__page--header">
                    <?php if(!empty($row['agregar_enlace_titulo'])): ?>
                        <h3>
                            <a class="title" href="<?php echo $row['agregar_enlace_titulo']['url']; ?>" target="<?php echo $row['agregar_enlace_titulo']['target'] ? $row['agregar_enlace_titulo']['target'] : '_self'; ?>">
                                <?php echo $row['titulo'] ?>
                            </a>
                        </h3>
                    <?php else:?>
                        <h3 class="title"><?php echo $row['titulo'] ?></h3>
                    <?php endif;?>
                </div>
                <?php endif;?>
                <?php $row_list = $row['lista'] ?>
                <div class="ferreyros__page--content">                    
                    <?php foreach( $row_list as $row_item ): ?>
                    <div class="col-sm-12 py-3">
                        <div class="ferreyros__card --mod6">
                            <div class="card__image">
                                <?php if( empty( $row['icono'] )): ?>
                                    <img class="image" src="<?php echo $row_item['icono']['url']; ?>" alt="<?php echo $row_item['icono']['alt']; ?>">
                                <?php endif;?>
                            </div>
                            <div class="card__content">
                                <h4 class="title"> 
                                    <a class="permalink" href="<?php echo $row_item['enlace']['url']; ?>" target="<?php echo $row_item['enlace']['target'] ? $row_item['enlace']['target'] : '_self'; ?>"><?php echo $row_item['enlace']['title']; ?></a>
                                </h4>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </section>
    <?php endif;?>

    <?php 
        $contenido_opcional = get_field('contenido_opcional'); 
        if($contenido_opcional):
    ?>
    <section class="ferreyros__page--content my-5">
        <div class="container">
            <?php echo $contenido_opcional; ?>
        </div>
    </section>
    <?php endif;?>

<?php else: 

    require get_template_directory() . '/inc/content-not-permissions.php';

endif;?>

<?php get_footer(); ?>