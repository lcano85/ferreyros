<?php
/* Template Name: Página Accesos directos horizontales */
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
            <div class="row">
                <?php foreach( $rows as $row ): ?>
                <div class="col-sm-12 py-3">
                    <div class="ferreyros__card --mod6">
                        <div class="card__image">
                            <?php if( !empty( $row['icono'] )): ?>
                                <img class="image" src="<?php echo $row['icono']['url']; ?>" alt="<?php echo $row['icono']['alt']; ?>">
                            <?php endif;?>
                        </div>
                        <div class="card__content">
                            <h3 class="title"> 
                                <a class="permalink" href="<?php echo $row['enlace']['url']; ?>" target="<?php echo $row['enlace']['target'] ? $row['enlace']['target'] : '_self'; ?>"><?php echo $row['enlace']['title']; ?></a>
                            </h3>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <?php endif;?>

<?php else: 

    require get_template_directory() . '/inc/content-not-permissions.php';

endif;?>

<?php get_footer(); ?>